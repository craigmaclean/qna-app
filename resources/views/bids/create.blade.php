<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-semibold leading-tight text-gray-800">
            {{ __('Create a New Bid') }}
        </h2>
    </x-slot>



    <div class="py-12">

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex overflow-hidden">
                <div class="py-6 mb-4 text-gray-900">
                   <h2 class="text-3xl font-bold"><a href="/bids/create">Create a new bid</a></h2>
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-3xl">
                <div class="p-12 text-gray-900">


                    <form id="createBidForm" method="POST" action="{{ route('bids.store') }}">
                        @csrf
                        <div class="space-y-12">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="text-red-500">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Client Information -->
                            <div class="pb-12 border-b border-gray-900/10">
                                <h2 class="text-base text-lg font-semibold text-gray-900">Client Information</h2>
                                <p class="mt-1 text-gray-600 text-md">Enter all client-specific information.</p>

                                <hr class="w-1/4 mt-2 border-t border-gray-300">

                                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label class="block font-medium text-gray-900 text-md">First Name <span class="text-red-500">*</span>
                                            <input type="text" name="client_first_name" class="input-field-create-bid" value="{{ old('client_first_name') }}" required>
                                        </label>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label class="block font-medium text-gray-900 text-md">Last Name <span class="text-red-500">*</span>
                                            <input type="text" name="client_last_name" class="input-field-create-bid" value="{{ old('client_last_name') }}" required>
                                        </label>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label class="block font-medium text-gray-900 text-md">Company Name <span class="text-red-500">*</span>
                                            <input type="text" name="client_company" class="input-field-create-bid" value="{{ old('client_company') }}" required>
                                        </label>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label class="block font-medium text-gray-900 text-md">Phone <span class="text-red-500">*</span>
                                            <input type="tel" name="client_phone" class="input-field-create-bid" value="{{ old('client_phone') }}" required>
                                        </label>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label class="block font-medium text-gray-900 text-md">Email <span class="text-red-500">*</span>
                                            <input type="email" name="client_email" class="input-field-create-bid" value="{{ old('client_email') }}" required>
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <!-- Project Information -->
                            <div class="pb-12 border-b border-gray-900/10">
                                <h2 class="text-base text-lg font-semibold text-gray-900">Project Information</h2>
                                <p class="mt-1 text-gray-600 text-md">Enter all project-specific information.</p>

                                <hr class="w-1/4 mt-2 border-t border-gray-300">

                                <!-- Status active - Pass boolean = true/1 -->
                                <input type="hidden" name="status_active" value="1">

                                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label class="block font-medium text-gray-900 text-md">Project Name <span class="text-red-500">*</span>
                                            <input type="text" name="project_name" class="input-field-create-bid" value="{{ old('project_name') }}" required>
                                        </label>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label class="block font-medium text-gray-900 text-md">Square Footage
                                            <input type="text" name="project_sqft" class="input-field-create-bid" value="{{ old('project_sqft') }}">
                                        </label>
                                    </div>


                                    <div class="sm:col-span-3">
                                        <label class="block font-medium text-gray-900 text-md">Tax Exempt? <span class="text-red-500">*</span></label>

                                        <div class="mt-4">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input type="hidden" name="tax_exempt" value="0"> <!-- Hidden input for unchecked value -->
                                                <input type="checkbox" name="tax_exempt" id="taxExempt" class="sr-only peer" value="1" {{ old('tax_exempt') ? 'checked' : '' }}>
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                                <span class="font-medium text-md ms-3 dark:text-gray-300">Yes</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div id="taxPercentageWrapper" class="sm:col-span-3 {{ old('tax-exempt') ? 'hidden' : '' }}">
                                        <label class="block font-medium text-gray-900 text-md">Tax Percentage <span class="text-red-500">*</span></label>

                                        <div class="relative mt-2">
                                            <input type="number" min="1" max="30" step="any" name="tax_percent" id="bidTaxPercentage" class="input-field-create-bid bid-tax-percentage" placeholder="9.5" value="{{ old('tax_percent', 9.5) }}">
                                            <span class="fixed-input-icon-right">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- General Contractors -->
                            <div id="generalContractorsWrapper" class="pb-12 border-b border-gray-900/10">
                                <h2 class="text-base text-lg font-semibold text-gray-900">General Contractors</h2>
                                <p class="mt-1 text-gray-600 text-md">Set the contractor percentage and add any  contractors that are associated with this project.</p>

                                <hr class="w-1/4 mt-2 border-t border-gray-300">

                                <!-- Embed 'old' Laravel form data into global JS variable. Used by app.js -->
                                <script>
                                    window.oldContractorData = @json(old('contractors', []));
                                </script>


                                <!-- Used to check if any contractors have been added - hidden by default -->
                                <input type="hidden" name="contractors_present" id="contractorsPresent" value="false">

                                {{-- <div id="gcPercentageWrapper" class="grid hidden grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="p-4 rounded-lg sm:col-span-2 bg-slate-100">
                                        <label class="relative block font-medium text-gray-900 text-md">General Contractor Percentage <span class="text-red-500">*</span>
                                            <input type="number" min="1.0" max="30.0" step="0.5" name="gc_percentage" id="generalContractorPercent" class="input-field-create-bid">
                                            <span class="!top-8 fixed-input-icon-right">%</span>
                                        </label>
                                    </div>
                                </div> --}}

                                <div id="newGeneralContractorWrapper">
                                    @if (!empty($oldContractors))
                                        @foreach ($oldContractors as $index => $contractor)
                                            <div class="grid grid-cols-1 mt-10 new-contractor-fieldset gap-x-6 gap-y-8 sm:grid-cols-6">
                                                <div class="sm:col-span-3">
                                                    <label for="contractors[{{ $index }}][contractor_first_name]" class="block font-medium text-gray-900 text-md">First Name <span class="text-red-500">*</span></label>
                                                    <div class="mt-2">
                                                        <input type="text" name="contractors[{{ $index }}][contractor_first_name]" class="input-field-create-bid" value="{{ $contractor['contractor_first_name'] ?? '' }}" required>
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-3">
                                                    <label for="contractors[{{ $index }}][contractor_last_name]" class="block font-medium text-gray-900 text-md">Last Name <span class="text-red-500">*</span></label>
                                                    <div class="mt-2">
                                                        <input type="text" name="contractors[{{ $index }}][contractor_last_name]" class="input-field-create-bid" value="{{ $contractor['contractor_last_name'] ?? '' }}" required>
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-3">
                                                    <label for="contractors[{{ $index }}][contractor_company]" class="block font-medium text-gray-900 text-md">Company Name <span class="text-red-500">*</span></label>

                                                    <div class="mt-2">
                                                        <input type="text" name="contractors[{{ $index }}][contractor_company]" class="input-field-create-bid" value="{{ $contractor['contractor_company'] ?? '' }}" required>
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-3">
                                                    <label for="contractors[{{ $index }}][contractor_title]" class="block font-medium text-gray-900 text-md">Title <span class="text-red-500">*</span></label>

                                                    <div class="mt-2">
                                                        <input type="text" name="contractors[{{ $index }}][contractor_title]" class="input-field-create-bid" value="{{ $contractor['contractor_title'] ?? '' }}" required>
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-3">
                                                    <label for="contractors[{{ $index }}][contractor_phone]" class="block font-medium text-gray-900 text-md">Phone <span class="text-red-500">*</span></label>

                                                    <div class="mt-2">
                                                        <input type="tel" name="contractors[{{ $index }}][contractor_phone]" class="input-field-create-bid" value="{{ $contractor['contractor_phone'] ?? '' }}" required>
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-3">
                                                    <label for="contractors[{{ $index }}][contractor_email]" class="block font-medium text-gray-900 text-md">Email</label>

                                                    <div class="mt-2">
                                                        <input type="email" name="contractors[{{ $index }}][contractor_email]" class="input-field-create-bid" value="{{ $contractor['contractor_email'] ?? '' }}">
                                                    </div>
                                                </div>

                                                <div class="text-right sm:col-span-6">
                                                    <button type="button" class="text-red-600 remove-contractor-button hover:text-red-800">
                                                        Remove Contractor
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div><!--- end #newGeneralContractorWrapper -->

                                <button type="button" id="addNewContractor" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-8">
                                    <svg class="w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                    Add new Contractor
                                </button>
                            </div><!-- end #generalContractorsWrapper -->





                            <!-- Services Information -->

                            <div class="pb-12 border-b border-gray-900/10" id="createBidServicesInformation">
                                <h2 class="text-base text-lg font-semibold text-gray-900">Services</h2>
                                <p class="mt-1 text-gray-600 text-md">Please select all applicable services to add to this bid.</p>

                                <!-- Services Selection -->
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
                                    @foreach($services->chunk(5) as $service)
                                        <div>
                                            @foreach($service as $singleService)
                                                <label class="flex items-center space-x-2">
                                                    <input type="checkbox" id="service-{{ $singleService->id }}" class="text-blue-600 form-checkbox" onclick="toggleSubservices('subservices-{{ $singleService->id }}')">
                                                    <span>{{ $singleService->service_name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>


                                <div class="mt-6 sm:col-span-6">
                                    @foreach ($services as $service)
                                    <div class="mt-2">

                                        <div id="subservices-{{ $service->id }}" class="flex flex-col hidden">

                                            <!-- Subservices for {{ $service->name }} -->
                                            <table class="w-full border border-collapse border-gray-300 table-auto service-items">
                                                <thead>
                                                    <!-- Service Name Row -->
                                                    <tr class="bg-gray-800">
                                                        <th colspan="11" class="px-4 py-2 text-lg font-bold text-center text-white border border-gray-300">
                                                            {{ $service->service_name }}
                                                        </th>
                                                    </tr>
                                                    <!-- Column Headers -->
                                                    <tr class="text-left bg-gray-100">
                                                        <th class="w-4 py-2">&nbsp;</th>
                                                        <th class="w-1/4 px-2">Service Item</th>
                                                        <th class="w-16 px-2">Units</th>
                                                        <th class="w-16 px-2">Quantity</th>
                                                        <th class="w-24 px-2">Unit Cost</th>
                                                        <th class="w-24 px-2">Amount</th>
                                                        <th class="w-20 px-2">Markup</small></th>
                                                        <th class="w-20 px-2">Labor</th>
                                                        <!--<th class="w-16 px-2 tax-element">Tax</th>-->
                                                        <th class="w-20 px-2">Total</th>
                                                        <!--<th class="w-20 px-2">Cost/SqFt</th>-->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($service->subServices as $subService)
                                                    <tr class="opacity-50 pointer-events-none service-item-row subServiceRow">
                                                        <td class="px-2 border">
                                                            <input type="checkbox" name="service_{{ $service->id }}_sub_service[{{ $subService->id }}][checked]" class="text-blue-600 pointer-events-auto form-checkbox subServiceItemId" value="0" onchange="toggleRow(this)">
                                                        </td>
                                                        <td class="px-2 border"><label for="service_item_{{ $subService->id }}">{{ $subService->sub_service_name }}</label></td>
                                                        <td class="px-2 border">
                                                            <select name="service_{{ $service->id }}_sub_service[{{ $subService->id }}][units]" class="input-field-create-bid subServiceItemUnits">
                                                                <option value="" class="text-gray-500" disabled selected>- SELECT -</option>
                                                                <option value="EA">EA</option>
                                                                <option value="LFT">LFT</option>
                                                                <option value="SFT">SFT</option>
                                                            </select>
                                                        </td>
                                                        <td class="px-2 border">
                                                            <input type="number" name="service_{{ $service->id }}_sub_service[{{ $subService->id }}][quantity]" class="w-full input-field-create-bid subServiceItemQty">
                                                        </td>
                                                        <td class="relative px-2 border">
                                                            <span class="fixed-input-icon">$</span>
                                                            <input type="number" name="service_{{ $service->id }}_sub_service[{{ $subService->id }}][unit_cost]" class="w-full input-field-create-bid subServiceItemUnitCost">
                                                        </td>
                                                        <td class="relative px-2 border">
                                                            <span id="service-item-[{$id}]-amount" class="subServiceItemAmount"></span>
                                                        </td>
                                                        <td class="relative px-2 border">
                                                            <input type="number" name="service_{{ $service->id }}_sub_service[{{ $subService->id }}][markup_percent]" class="w-full input-field-create-bid subServiceItemMarkupPercent">
                                                            <span class="fixed-input-icon-right">%</span>
                                                        </td>
                                                        <td class="relative px-2 border">
                                                            <span id="service-item-[{$id}]-labor" class="subServiceItemLabor"></span>
                                                        </td>
                                                        <!--<td class="relative px-2 border tax-element">
                                                            <span id="service-item-[{$id}]-tax" class="subServiceItemTax"></span>
                                                        </td>-->
                                                        <td class="relative px-2 border">
                                                            <span id="service-item-[{$id}]-total" class="subServiceItemTotal"></span>
                                                        </td>
                                                        <!--<td class="relative px-2 border">
                                                            <span id="service-item-[{$id}]-cost_sqft"></span>
                                                        </td>-->
                                                    </tr><!-- end .service-item-row -->
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <button type="button" onclick="addServiceItemRow(this)" id="addNewServiceItem" class="add-new-service-item text-gray-600 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-8">
                                                <svg class="inline-block w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                Add New Service Item
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                            </div><!-- #createBidServicesInformation -->





                            <!-- Labor Calculator -->
                            <div id="" class="pb-12 border-b border-gray-900/10">
                                <h2 class="text-base text-lg font-semibold text-gray-900">Labor</h2>
                                <p class="mt-1 text-gray-600 text-md">Use the following section to calculate estimated labor charges. <strong>This does not have any effect on the bid summary.</strong></p>

                                <hr class="w-1/4 mt-2 border-t border-gray-300">

                                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-2">
                                        <label for="labor-days" class="block font-medium text-gray-900 text-md"># of Days <span class="text-red-500">*</span></label>

                                        <div class="relative mt-2">
                                            <input type="number" min="1" max="365" name="labor_days" id="laborDays" autocomplete="" class="input-field-create-bid" value="{{ old('labor_days') }}" required>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="labor-unit-cost" id="" class="block font-medium text-gray-900 text-md">Unit Cost <span class="text-red-500">*</span></label>

                                        <div class="relative mt-2">
                                            <span class="fixed-input-icon">$</span>
                                            <input type="number" value="{{ old('labor_unit_cost', 2000.00) }}" min="" max="5000.00" name="labor_unit_cost" id="laborUnitCost" autocomplete="" class="indent-3 input-field-create-bid" required>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label class="block font-medium text-gray-900 text-md">Total Labor</label>

                                        <span class="laborTotal"></span><!-- end .laborTotal -->
                                    </div>
                                </div>
                            </div>



                            <!-- Miscellaneous -->
                            <div class="pb-12 border-b border-gray-900/10">
                                <h2 class="text-base text-lg font-semibold text-gray-900">Miscellaneous</h2>
                                <p class="mt-1 text-gray-600 text-md">Use the following section to apply any applicable charges.</p>

                                <hr class="w-1/4 mt-2 border-t border-gray-300">

                                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-2">
                                        <label for="generalConditionsPercent" class="block font-medium text-gray-900 text-md">General Conditions</label>

                                        <div class="relative mt-2">
                                            <input type="number" name="general_conditions_percent" id="generalConditionsPercent" min="0.0" max="" value="{{ old('general_conditions_percent') }}" class="input-field-create-bid">
                                            <span class="fixed-input-icon-right">%</span>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="overheadProfitPercent" id="" class="block font-medium text-gray-900 text-md">Overhead &amp; Profit</label>

                                        <div class="relative mt-2">
                                            <input type="number" name="overhead_profit_percent" id="overheadProfitPercent" min="0.0" max="" value="{{ old('overhead_profit_percent') }}" class="input-field-create-bid">
                                            <span class="fixed-input-icon-right">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div id="bidSummary">
                                <div class="mt-6 sm:col-span-6">
                                    <div class="mt-2">

                                        <div id="" class="hiddennn">

                                            <!-- Totals -->
                                            <table class="w-full border border-collapse border-gray-300 table-auto service-items">
                                                <thead>
                                                    <tr class="bg-gray-800">
                                                        <th colspan="11" class="px-4 py-2 text-lg font-bold text-center text-white border border-gray-300">
                                                            Bid Summary
                                                        </th>
                                                    </tr>
                                                    <!-- Column Headers -->
                                                    <tr class="text-left bg-gray-100">
                                                        <th class="p-2">Subtotal</th>
                                                        <th class="p-2">Labor</th>
                                                        <th class="p-2">General Conditions</th>
                                                        <th class="p-2">Overhead &amp; Profit</th>
                                                        <th class="p-2 tax-element">Total Tax</th>
                                                        <th class="p-2">Grand Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="relative px-2 border">
                                                            <span id="subtotal" class="inline-block indent-4"></span>
                                                        </td>
                                                        <td class="relative px-2 border">
                                                            <span class="inline-block laborTotal indent-4"></span>
                                                        </td>
                                                        <td class="relative px-2 border">
                                                            <span id="generalConditionsTotal" class="inline-block indent-4"></span>
                                                        </td>
                                                        <td class="relative px-2 border">
                                                            <span id="overheadProfitTotal" class="inline-block indent-4"></span>
                                                        </td>
                                                        <td class="relative px-2 border tax-element">
                                                            <span id="taxTotal" class="inline-block indent-4"></span>
                                                        </td>
                                                        <td class="relative px-2 border">
                                                            <span id="grandTotal" class="inline-block indent-4"></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end #bidSummary -->


                            <script>


                            </script>
                        </div>


                        <div class="flex items-center justify-end mt-6 gap-x-6">
                          <button type="button" class="font-semibold text-gray-900 text-sm/6">Cancel</button>
                          <button type="submit" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        </div>
                      </form>

                    <!---- debug start ---->
                      <!--<div id="form-debug" class="p-4 bg-gray-100 border rounded">
                        <h3 class="font-bold">Form Debug:</h3>
                        <pre id="debug-output"></pre>
                    </div>-->
                    <!---- debug end ---->

                    <script>
                        /*
                        document.addEventListener("DOMContentLoaded", function () {
                            const form = document.querySelector("form"); // Change this if your form has a specific ID
                            const debugOutput = document.getElementById("debug-output");

                            function updateDebug() {
                                let formData = {};
                                new FormData(form).forEach((value, key) => {
                                    // Handle multiple checkboxes/radio buttons with same name
                                    if (formData[key]) {
                                        formData[key] = [].concat(formData[key], value);
                                    } else {
                                        formData[key] = value;
                                    }
                                });

                                debugOutput.textContent = JSON.stringify(formData, null, 2);
                            }

                            form.addEventListener("input", updateDebug);
                            form.addEventListener("change", updateDebug);
                        });
                        */
                        </script>


                </div>
            </div>
        </div>
</x-app-layout>
