<div id="temp-div-for-hiding" style="display: none;">
                            <!-- Services Information -->

                            <div class="pb-12 border-b border-gray-900/10" id="create-bid-services-information">
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

                                        <div id="subservices-{{ $service->id }}" class="hidden">

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
                                                        <th class="w-16 px-2">Tax</th>
                                                        <th class="w-20 px-2">Total</th>
                                                        <!--<th class="w-20 px-2">Cost/SqFt</th>-->
                                                    </tr>
                                                </thead>
                                                @foreach ($service->subServices as $subService)
                                                <tbody>
                                                    <tr class="opacity-50 pointer-events-none service-item-row subServiceRow">
                                                        <td class="px-2 border">
                                                            <input type="checkbox" name="service_item_{{ $subService->id }}" class="text-blue-600 pointer-events-auto form-checkbox subServiceItemId" onchange="toggleRow(this)">
                                                        </td>
                                                        <td class="px-2 border"><label for="service_item_{{ $subService->id }}">{{ $subService->sub_service_name }}</label></td>
                                                        <td class="px-2 border">
                                                            <select name="service_item_[{$id}]_[units]" class="input-field-create-bid subServiceItemUnits" required>
                                                                <option class="text-gray-500" disabled selected>- SELECT -</option>
                                                                <option>EA</option>
                                                                <option>LFT</option>
                                                                <option>SFT</option>
                                                            </select>
                                                        </td>
                                                        <td class="px-2 border">
                                                            <input type="text" name="service_item_[{$id}]_[qty]" class="w-full input-field-create-bid subServiceItemQty">
                                                        </td>
                                                        <td class="relative px-2 border">
                                                            <span class="fixed-input-icon">$</span>
                                                            <input type="number" name="service_item_[{$id}]_[unit_cost]" value="{{ $subService->default_unit_cost }}" min="0.01" max="" step="0.01" class="w-full input-field-create-bid subServiceItemUnitCost" required>
                                                        </td>
                                                        <td class="relative px-2 border">
                                                            <span id="service-item-[{$id}]-amount" class="subServiceItemAmount">0.00</span>
                                                        </td>
                                                        <td class="relative px-2 border">
                                                            <input type="number" name="service_item_[{$id}]_[markup_percent]" min="1.0" max="" step="0.5" class="w-full input-field-create-bid subServiceItemMarkupPercent" required>
                                                            <span class="fixed-input-icon-right">%</span>
                                                        </td>
                                                        <td class="relative px-2 border">
                                                            <span id="service-item-[{$id}]-labor" class="subServiceItemLabor">0.00</span>
                                                        </td>
                                                        <td class="relative px-2 border">
                                                            <span id="service-item-[{$id}]-tax" class="subServiceItemTax"></span>
                                                        </td>
                                                        <td class="relative px-2 border">
                                                            <span id="service-item-[{$id}]-total" class="subServiceItemTotal"></span>
                                                        </td>
                                                        <!--<td class="relative px-2 border">
                                                            <span id="service-item-[{$id}]-cost_sqft"></span>
                                                        </td>-->
                                                    </tr><!-- end .service-item-row -->
                                                </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                            </div><!-- #create-bid-services-information -->
