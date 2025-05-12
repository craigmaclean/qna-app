<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Contractor;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BidController extends Controller
{
    // index() — To list all records (GET)
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        // Base query
        $query = Bid::query();

        if ($filter === 'active') {
            $query->where('status_active', 1);
        } elseif ($filter === 'archived') {
            $query->where('status_active', 0);
        }

        // Fetch the filtered results with pagination
        $bids = $query->paginate(10); // 25 bids per page

        return view('bids.index', compact('bids'));
    }

    // store() — To create a new record (POST)

    public function store(Request $request)
    {
        // Debugging
        Log::info('Form submitted:', $request->all());

        $validated = $request->validate([
            'status_active' => 'boolean',
            'client_first_name' => 'required|string|max:255',
            'client_last_name' => 'required|string|max:255',
            'client_company' => 'required|string|max:255',
            'client_phone' => [
                'required',
                'string',
                'regex:/^(\d{3}[- ]?\d{3}[- ]?\d{4})$/',
                'max:12',
            ],
            'client_email' => 'required|email|max:255',
            'project_name' => 'required|string|max:500',
            'project_sqft' => 'string|max:255',
            'general_conditions_percent' => 'nullable|string|max:10',
            'overhead_profit_percent' => 'nullable|string|max:10',
            'tax_exempt' => 'boolean',
            'tax_percent' => 'string|max:10',
            'labor_days' => 'required|string|max:255',
            'labor_unit_cost' => 'required|string|max:255',
            'contractors' => 'nullable|array',
            'contractors.*.contractor_first_name' => 'required_if:contractors_present,true|string|max:255',
            'contractors.*.contractor_last_name' => 'required_if:contractors_present,true|string|max:255',
            'contractors.*.contractor_company' => 'required_if:contractors_present,true|string|max:255',
            'contractors.*.contractor_email' => 'nullable|email|max:255',
            'contractors.*.contractor_phone' => [
                'required_if:contractors_present,true',
                'string',
                'regex:/^(\d{3}[- ]?\d{3}[- ]?\d{4})$/',
                'max:12',
            ],
            'contractors.*.contractor_title' => 'required_if:contractors_present,true|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();

        // ---- Grand Total Calculation BEFORE saving the Bid ----
        $predefinedTotal = 0;
        $customTotal = 0;

        foreach ($request->all() as $key => $serviceData) {
            if (str_starts_with($key, 'service_')) {
                preg_match('/service_(\d+)_sub_service/', $key, $matches);
                $serviceId = $matches[1] ?? null;

                foreach ($serviceData as $subServiceId => $subServiceData) {
                    if (isset($subServiceData['checked'])) {
                        $qty = $subServiceData['quantity'] ?? 0;
                        $unit = $subServiceData['unit_cost'] ?? 0;
                        $markup = $subServiceData['markup_percent'] ?? 0;
                        $markupAmount = ($qty * $unit) * ($markup / 100);
                        $predefinedTotal += ($qty * $unit) + $markupAmount;
                    }
                }

                // Custom sub-services
                $customKey = "service_{$serviceId}_custom_sub_services";
                if ($request->has($customKey)) {
                    foreach ($request->input($customKey) as $customSub) {
                        if (!empty($customSub['name'])) {
                            $qty = $customSub['quantity'] ?? 0;
                            $unit = $customSub['unit_cost'] ?? 0;
                            $markup = $customSub['markup_percent'] ?? 0;
                            $markupAmount = ($qty * $unit) * ($markup / 100);
                            $customTotal += ($qty * $unit) + $markupAmount;
                        }
                    }
                }
            }
        }

        $subtotal = $predefinedTotal + $customTotal;

        $generalConditionsPercent = (float) ($request->input('general_conditions_percent') ?? 0);
        $overheadProfitPercent = (float) ($request->input('overhead_profit_percent') ?? 0);
        $taxRaw = $request->input('tax_percent', 0);
        $taxPercent = is_numeric($taxRaw) ? (float)$taxRaw / 100 : 0;
        $taxExempt = $request->boolean('tax_exempt');

        $generalConditionsTotal = $subtotal * ($generalConditionsPercent / 100);
        $overheadProfitTotal = $subtotal * ($overheadProfitPercent / 100);
        $taxTotal = $taxExempt ? 0 : $subtotal * $taxPercent;

        $grandTotal = $subtotal + $generalConditionsTotal + $overheadProfitTotal + $taxTotal;

        $validated['grand_total'] = ceil($grandTotal);

        // ---- Save Bid ----
        $bid = Bid::create($validated);

        // Save Contractors
        if (!empty($validated['contractors'])) {
            foreach ($validated['contractors'] as $contractorData) {
                $contractor = Contractor::create($contractorData);
                $bid->contractors()->attach($contractor->id);
            }
        }

        // Save Predefined and Custom Sub-Services
        foreach ($request->all() as $key => $serviceData) {
            if (str_starts_with($key, 'service_')) {
                preg_match('/service_(\d+)_sub_service/', $key, $matches);
                if (!isset($matches[1])) continue;

                $serviceId = $matches[1];

                foreach ($serviceData as $subServiceId => $subServiceData) {
                    if (isset($subServiceData['checked'])) {
                        $quantity = $subServiceData['quantity'] ?? 0;
                        $units = $subServiceData['units'] ?? null;
                        $unitCost = $subServiceData['unit_cost'] ?? 0;
                        $markupPercent = $subServiceData['markup_percent'] ?? 0;
                        $markupAmount = ($quantity * $unitCost) * ($markupPercent / 100);
                        $totalCost = ($quantity * $unitCost) + $markupAmount;

                        $bid->subServices()->attach($subServiceId, [
                            'bid_id' => $bid->id,
                            'service_id' => $serviceId,
                            'units' => $units,
                            'quantity' => $quantity,
                            'adjusted_unit_cost' => $unitCost,
                            'markup_percent' => $markupPercent,
                            'total_cost' => $totalCost,
                        ]);
                    }
                }

                // Save custom sub-services
                $customKey = "service_{$serviceId}_custom_sub_services";
                if ($request->has($customKey)) {
                    foreach ($request->input($customKey) as $customSub) {
                        if (!empty($customSub['name'])) {
                            $qty = $customSub['quantity'] ?? 0;
                            $units = $customSub['units'] ?? null;
                            $unit = $customSub['unit_cost'] ?? 0;
                            $markup = $customSub['markup_percent'] ?? 0;
                            $markupAmount = ($qty * $unit) * ($markup / 100);
                            $totalCost = ($qty * $unit) + $markupAmount;

                            DB::table('bids_custom_sub_services')->insert([
                                'bid_id' => $bid->id,
                                'service_id' => $serviceId,
                                'custom_sub_service_name' => $customSub['name'],
                                'units' => $units,
                                'quantity' => $qty,
                                'unit_cost' => $unit,
                                'markup_percent' => $markup,
                                'total_cost' => $totalCost,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()->route('bids.index')->with('success', 'Bid created successfully!');
    }




    public function create()
    {
        // fetch all services with related sub-services
        $services = Service::with('subServices')->get();

        $oldContractors = old('contractors', []);

        return view('bids.create', compact('services', 'oldContractors'));
    }


    // show() — To display a single record (GET)
    // edit() — To show a form for editing (GET)
    // update() — To update a record (PUT/PATCH)
    // destroy() — To delete a record (DELETE)

}
