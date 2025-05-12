<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <section class="main-top">
            @if (auth()->check())
                <h2>Hello, {{ auth()->user()->first_name }} &#128075;&#127996;</h2>
            @else
                <h2>Hello, Guest &#128075;</h2>
            @endif

            <div>
                <a href="/bids/create"><button type="button" class="btn btn-new-bid">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Create a New Bid
                </button></a>
            </div>
    </section>

    <section id="dashboardOverview">
        <div class="dashboard-bid-widget">
            <img src="{{ asset('images/icon-total-bids.png') }}" width="125px" height="125px" alt="Total Bids">
            <div class="bid-widget-info">
                <h5>Total Bids</h5>
                <h6>{{ $totalBids }}</h6>
            </div><!-- end .bid-widget-info -->
        </div><!-- .dashboard-bid-widget -->

        <div class="dashboard-bid-widget">
            <img src="{{ asset('images/icon-active-bids.png') }}" width="125px" height="125px" alt="Active Bids">
            <div class="bid-widget-info">
                <h5>Active Bids</h5>
                <h6>{{ $activeBids }}</h6>
            </div><!-- end .bid-widget-info -->
        </div><!-- .dashboard-bid-widget -->

        <div class="dashboard-bid-widget">
            <img src="{{ asset('images/icon-inactive-bids.png') }}" width="125px" height="125px" alt="Inactive Bids">
            <div class="bid-widget-info">
                <h5>Inactive Bids</h5>
                <h6>{{ $inactiveBids }}</h6>
            </div><!-- end .bid-widget-info -->
        </div><!-- .dashboard-bid-widget -->
    </section><!-- end #dashboard-overview -->

    <section id="dashboardBids">
        <h1>All Bids</h1>

        <div class="flex w-full gap-3">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative w-1/2">
                <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" id="default-search" class="block w-full p-3 text-base text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:bg-white focus:ring-1 focus:ring-gray-300 focus:border-gray-300" placeholder="Search All Bids" required />
            </div>

            <form method="GET" action="{{ route('dashboard') }}#dashboardBids" class="w-1/2">
                <label for="bids_sort" class="sr-only">Sort by:</label>

                <select name="sort" id="bids_sort"
                    class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-1 focus:ring-gray-300 focus:border-gray-300"
                    onchange="this.form.submit()">
                    <option value="newest" {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                </select>
            </form>

        </div>

        <table id="bidsTable"">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Grand Total</th>
                    <th scope="col" class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @if ($bids->count() > 0)
                    @foreach ($bids as $bid)
                        <tr>
                            <td><a href="#"><strong>{{ $bid->client_first_name }} {{ $bid->client_last_name }}</strong></a></td>
                            <td><a href="#"><strong>{{ $bid->project_name }}</strong></a></td>
                            <td>{{ $bid->client_email }}</td>
                            <td>${{ number_format($bid->grand_total, 2) }}</td>
                            <td class="bid-status">
                                @if ($bid->status_active == '1')
                                    <button type="button" class="btn btn-status btn-status-active">Active</button>
                                @else
                                    <button type="button" class="btn btn-status btn-status-inactive">Inactive</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">You currently don't have any bids.</td>
                    </tr>
                @endif
            </tbody>

        </table>


        @if ($bids->count() > 0)
            <div class="dashboard-bids-entries-wrapper">
                <p>Showing {{ $bids->firstItem() }} to {{ $bids->lastItem() }} of {{ $bids->total() }} entries</p>

                <nav id="bidsPagination" aria-label="Page navigation example">
                    {{ $bids->withQueryString()->fragment('dashboardBids')->links() }}
                </nav>
            </div>
        @endif


    </section><!-- #dashboardBids -->
</x-app-layout>
