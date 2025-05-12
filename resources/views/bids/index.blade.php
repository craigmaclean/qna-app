<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <h1 class="mb-8 text-3xl font-bold">All Bids</h1>

                    <div class="container p-6 mx-auto">
                        <!-- Filter Dropdown -->
    <div class="flex items-center justify-end mb-4">
        <form method="GET" action="{{ route('bids.index') }}" class="flex items-center">
            <label for="filter" class="mr-2 font-medium text-gray-700">Filter:</label>
            <select name="filter" id="filter" class="block px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-orange-500"
                onchange="this.form.submit()">
                <option value="" {{ request('filter') == '' ? 'selected' : '' }}>All</option>
                <option value="active" {{ request('filter') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="archived" {{ request('filter') == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
        </form>
    </div>

                    @foreach ($bids as $bid)
                    <div class="flex p-6 mb-6 transition-all duration-300 ease-in-out bg-white border-l-4 border-orange-500 shadow-md hover:bg-gray-100 hover:shadow-lg">
                        <div class="w-3/4">
                            <h2 class="flex items-center pb-0 mb-0 text-xl font-bold">
                                {{ $bid->project_name }}
                                <span class="ml-4 px-2 py-1 text-xs font-medium text-white rounded-md
                                {{ $bid->status_active ? 'bg-green-500' : 'bg-gray-400' }}">
                                    {{ $bid->status_active ? 'Active' : 'Archived' }}
                                </span>
                            </h2>
                        </div>
                        <div class="w-1/6">
                            <!-- Additional info if needed -->
                        </div>
                        <div class="w-1/4">
                            <h3 class="text-lg text-right">{{ $bid->grand_total }}</h3>
                        </div>
                        <div class="relative flex items-center justify-end w-1/12">
                            <!-- Ellipsis Menu Button -->
                            <button class="text-gray-400 hover:text-gray-800 focus:outline-none" id="menuButton">
                                <span class="text-xl font-bold">&#x22EE;</span> <!-- Vertical Ellipsis -->
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="menu" class="absolute right-0 hidden w-32 mt-2 bg-white rounded-md shadow-lg">
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Clone</a>
                                <form method="POST" action="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="block w-full px-4 py-2 text-sm text-left text-red-700 hover:bg-gray-100">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script>
                        const menuButton = document.getElementById('menuButton');
                        const menu = document.getElementById('menu');

                        menuButton.addEventListener('click', () => {
                            menu.classList.toggle('hidden');
                        });

                        document.addEventListener('click', (event) => {
                            if (!menuButton.contains(event.target) && !menu.contains(event.target)) {
                                menu.classList.add('hidden');
                            }
                        });
                    </script>

                    @endforeach

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $bids->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
