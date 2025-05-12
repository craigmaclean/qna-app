<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalBids = Bid::count();
        $activeBids = Bid::where('status_active', 1)->count();
        $inactiveBids = Bid::where('status_active', 0)->count();
        //$bidTotal = (data.qty * data.unitCost) + (data.amount * data.markupPercent);

        $sort = $request->query('sort', 'newest');

        $bids = Bid::when($sort === 'oldest', fn ($query) => $query->oldest(), fn ($query) => $query->latest())
                ->paginate(10)
                ->withQueryString();

        return view('dashboard', compact('totalBids', 'activeBids', 'inactiveBids', 'bids'));
    }

}
