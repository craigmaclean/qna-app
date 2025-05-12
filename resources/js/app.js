import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.toggleSubservices = function (subserviceId) {
    // Fetch the element by its ID
    const subservices = document.getElementById(subserviceId);

    if (subservices) {
        if (subservices.classList.contains('hidden')) {
            subservices.classList.remove('hidden');
            subservices.classList.add('open');
        } else {
            subservices.classList.remove('open');
            subservices.classList.add('hidden');
        }
    } else {
        console.error(`Element with ID ${subserviceId} not found.`);
    }
}

/**
 * Before submitting the form, remove the required attribute from all disabled fields.
 */
document.getElementById('createBidForm').addEventListener('submit', function (e) {
    document.querySelectorAll('.service-item-row input[disabled], .service-item-row select[disabled]').forEach(field => {
        field.removeAttribute('required'); // Remove required from disabled fields
    });
});



document.toggleRow = function (checkbox) {
    // Find the parent <tr> of the checkbox
    const row = checkbox.closest('tr');

    // Ensure there's a row
    if (!row) return;

    // Toggle classes based on checkbox state
    if (checkbox.checked) {
        row.classList.remove('opacity-50', 'pointer-events-none'); // Remove inactive classes

        row.querySelectorAll('input, select').forEach(field => {
            field.removeAttribute('disabled'); // Enable form fields
            field.setAttribute('required', 'true'); // Make required
            field.setAttribute('value', '1');
        });
    }
    else {
        row.classList.add('opacity-50', 'pointer-events-none'); // Add inactive classes

        row.querySelectorAll('input, select').forEach(field => {
            field.setAttribute('disabled', 'true'); // Disable form fields
            field.removeAttribute('required'); // Remove required attribute
            field.setAttribute('value', '0');
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {

    document.getElementById('sidebarToggle').addEventListener('click', function() {
        const sidebar = document.getElementById("sidebar");
        const sidebarToggle = document.getElementById("sidebarToggle");

        if(sidebarToggle.classList.contains('is-open')) {
            sidebarToggle.classList.remove('is-open');
            sidebarToggle.classList.add('is-closed');
            sidebar.classList.remove('');
            sidebarToggle.innerHTML = "&raquo;";
        }
        else if(sidebarToggle.classList.contains('is-closed')) {
            sidebarToggle.classList.remove('is-closed');
            sidebarToggle.classList.add('is-open');
            sidebarToggle.innerHTML = "&laquo;";
        }

    });


    document.getElementById('toggleProfileSubMenu').addEventListener('mouseover', function() {
        const profileSubMenu = document.getElementById('userInfoMenu');

        if (profileSubMenu.style.display === ' block') {
            profileSubMenu.style.display = 'none';
        }
        else {
            profileSubMenu.style.display = 'block';
        }

    });



    document.getElementById('taxExempt').addEventListener('change', function () {
        const taxPercentageWrapper = document.getElementById('taxPercentageWrapper');
        const taxElements = document.querySelectorAll('.tax-element');

        if (this.checked) {
            taxPercentageWrapper.classList.add('hidden');
            taxElements.forEach(element => element.classList.add('hidden'));
        } else {
            taxPercentageWrapper.classList.remove('hidden');
            taxElements.forEach(element => element.classList.remove('hidden'));
        }
    });



    /**
     * Add New Contractor Functionality
     * - General contractor percentage will be diplayed if at least ONE contractor is added.
     * - Function will also look for 'old' data (and populate applicable fields)
     *   if page is reloaded due to validation error.
     */

    document.addServiceItemRow = function (e) {
        const thisServiceTable = e.parentElement.querySelector('table');
        const parentServiceNumber = e.parentElement.id.split('-')[1]; // ex. get 12 from subservices-12 (string)
        let serviceTableNumRows = e.parentElement.querySelector('table tbody').rows.length + 1;
        console.log(serviceTableNumRows);

        //alert(thisServiceTable);

        if (thisServiceTable) {
            const tbody = thisServiceTable.querySelector('tbody');
            const newRow = document.createElement('tr');
            //newRow.setAttribute('class', 'opacity-50 pointer-events-none service-item-row subServiceRow');
            newRow.classList.add('service-item-row', 'subServiceRow');

            newRow.innerHTML = `<td class="px-2 border">
                <input type="checkbox" name="service_${parentServiceNumber}_custom_sub_services[${serviceTableNumRows}][checked]" class="text-blue-600 pointer-events-auto form-checkbox subServiceItemId new-service-item-checkbox" value="1" onchange="toggleRow(this)" checked disabled>
                <i class="fa-solid fa-trash-can remove-service-item" onclick="removeServiceItemRow(this)" style="color: red; font-size: 1rem; font-weight: normal; margin-top: 10px; cursor: pointer;"></i>
            </td>
            <td class="px-2 border">
                <label for="service_item_{{ $subService->id }}">
                    <input type="text" name="service_${parentServiceNumber}_custom_sub_services[${serviceTableNumRows}][name]" class="border-gray-300 w-full new-service-item-name" style="border-radius: 0.375rem;"  />
                </label>
            </td>
            <td class="px-2 border" style="padding: 1rem;">
                <select name="service_${parentServiceNumber}_custom_sub_services[${serviceTableNumRows}][units]" class="input-field-create-bid subServiceItemUnits" required>
                    <option class="text-gray-500" disabled selected>- SELECT -</option>
                    <option>EA</option>
                    <option>LFT</option>
                    <option>SFT</option>
                </select>
            </td>
            <td class="px-2 border">
                <input type="text" name="service_${parentServiceNumber}_custom_sub_services[${serviceTableNumRows}][quantity]" class="w-full input-field-create-bid subServiceItemQty" required>
            </td>
            <td class="relative px-2 border">
                <span class="fixed-input-icon">$</span>
                <input type="number" name="service_${parentServiceNumber}_custom_sub_services[${serviceTableNumRows}][unit_cost]" value="{{ $subService->default_unit_cost }}" class="w-full input-field-create-bid subServiceItemUnitCost" required>
            </td>
            <td class="relative px-2 border">
                <span id="service-item-[{$id}]-amount" class="subServiceItemAmount"></span>
            </td>
            <td class="relative px-2 border">
                <input type="number" name="service_${parentServiceNumber}_custom_sub_services[${serviceTableNumRows}][markup_percent]" class="w-full input-field-create-bid subServiceItemMarkupPercent" required>
                <span class="fixed-input-icon-right">%</span>
            </td>
            <td class="relative px-2 border">
                <span id="service-item-[{$id}]-labor" class="subServiceItemLabor"></span>
            </td>
            <!--<td class="relative px-2 border">
                <span id="service-item-[{$id}]-tax" class="subServiceItemTax"></span>
            </td>-->
            <td class="relative px-2 border">
                <span id="service-item-[{$id}]-total" class="subServiceItemTotal"></span>
            </td>
            `;

            serviceTableNumRows++;

            tbody.appendChild(newRow);

            // Apply focus on the input field (service name)
            const newServiceItemInput = newRow.querySelector('.new-service-item-name');
            if (newServiceItemInput) {
                newServiceItemInput.focus();
            }
        }
    }



    /**
     * Remove Service Item
     * - XXXXXXX
     */
    document.addEventListener('click', function (e) {
        if (e.target.matches('.remove-service-item')) {
            const row = e.target.closest('tr');

            if (row) {
                row.remove();
            }
        }
    });


    /**
     * Add New Contractor Functionality
     * - General contractor percentage will be diplayed if at least ONE contractor is added.
     * - Function will also look for 'old' data (and populate applicable fields)
     *   if page is reloaded due to validation error.
     */

    document.getElementById('addNewContractor').addEventListener('click', function () {
        //const generalContractorPercentWrapper = document.getElementById('gcPercentageWrapper');
        //const generalContractorPercent = document.getElementById('generalContractorPercent');

        const container = document.getElementById('newGeneralContractorWrapper');
        const index = container.children.length;

        // Show GC Percentage when 'add new contractor button is clicked.
        // Add 'required' attribute to the % input field
        //generalContractorPercentWrapper.classList.remove('hidden');
        //generalContractorPercent.setAttribute('required', '');

        // Change the contractors_present hidden field to true
        document.getElementById('contractorsPresent').value = 'true';

        // Get old contractor data for this index (if any)
        const contractorData = window.oldContractorData?.[index] || {};

        let newFieldSet = '';

        // Add a divider only if there are already fieldsets in the container
        if (index > 0) {
            newFieldSet += `<hr class="my-4 border-t border-gray-300">`;
        }

        newFieldSet += `
            <!-- New Contractor Form Fieldset -->
            <div class="grid grid-cols-1 mt-10 new-contractor-fieldset gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="contractors[${index}][contractor_first_name]" class="block font-medium text-gray-900 text-md">First Name <span class="text-red-500">*</span></label>

                    <div class="mt-2">
                        <input type="text" name="contractors[${index}][contractor_first_name]" class="input-field-create-bid" value="${contractorData.contractor_first_name || ''}" required>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="contractors[${index}][contractor_last_name]" class="block font-medium text-gray-900 text-md">Last Name <span class="text-red-500">*</span></label>

                    <div class="mt-2">
                        <input type="text" name="contractors[${index}][contractor_last_name]" class="input-field-create-bid" value="${contractorData.contractor_last_name || ''}" required>
                    </div>
                </div>


                <div class="sm:col-span-3">
                    <label for="contractors[${index}][contractor_company]" class="block font-medium text-gray-900 text-md">Company Name <span class="text-red-500">*</span></label>

                    <div class="mt-2">
                        <input type="text" name="contractors[${index}][contractor_company]" class="input-field-create-bid" value="${contractorData.contractor_company || ''}" required>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="contractors[${index}][contractor_title]" class="block font-medium text-gray-900 text-md">Title <span class="text-red-500">*</span></label>

                    <div class="mt-2">
                        <input type="text" name="contractors[${index}][contractor_title]" class="input-field-create-bid" value="${contractorData.contractor_title || ''}" required>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="contractors[${index}][contractor_phone]" class="block font-medium text-gray-900 text-md">Phone <span class="text-red-500">*</span></label>

                    <div class="mt-2">
                        <input type="tel" name="contractors[${index}][contractor_phone]" class="input-field-create-bid" value="${contractorData.contractor_phone || ''}" required>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="contractors[${index}][contractor_email]" class="block font-medium text-gray-900 text-md">Email</label>

                    <div class="mt-2">
                        <input type="email" name="contractors[${index}][contractor_email]" class="input-field-create-bid" value="${contractorData.contractor_email || ''}">
                    </div>
                </div>
                <div class="text-right sm:col-span-6">
                    <button type="button" class="remove-contractor-button text-red-600 hover:text-red-800">
                        Remove Contractor
                    </button>
                </div>
            </div><!-- end .new-contractor-fieldset -->`;
        container.insertAdjacentHTML('beforeend', newFieldSet);
    });



    /**
     * Remove Contractor Functionality
     * - General contractor percentage will be hidden unless at least ONE contractor is still visible.
     */
    document.getElementById('newGeneralContractorWrapper').addEventListener('click', function (event) {
        const generalContractorPercentWrapper = document.getElementById('gcPercentageWrapper');
        const generalContractorPercent = document.getElementById('generalContractorPercent');

        if (event.target.matches('.remove-contractor-button')) {
            const fieldset = event.target.closest('.new-contractor-fieldset');
            if (fieldset) {
                const divider = fieldset.previousElementSibling;

                // Remove the divider if it exists and is an HR tag
                if (divider && divider.tagName === 'HR') {
                    divider.remove();
                }
                fieldset.remove();

                // Check if there are any contractor fieldsets left
                const contractorFieldsets = document.querySelectorAll('.new-contractor-fieldset');
                if (contractorFieldsets.length === 0) {
                    // Hide GC Percentage when there are no contractors left on the page
                    // Remove 'required' attribute from the % input field
                    generalContractorPercentWrapper.classList.add('hidden');
                    generalContractorPercent.removeAttribute('required');

                    // Change the contractors_present hidden field to false
                    document.getElementById('contractorsPresent').value = 'false';
                }
            }
        }
    });



    /**
     * Check for 'Old' Form Data (in case page is reloaded due to validation error)
     * - General contractor percentage will be visible and re-populated.
     */
    document.addEventListener('DOMContentLoaded', function () {
        const contractorsPresent = document.getElementById('contractorsPresent');
        const generalContractorPercentWrapper = document.getElementById('gcPercentageWrapper');

        if (contractorsPresent.value === 'true') {
            generalContractorPercentWrapper.classList.remove('hidden');
            document.getElementById('generalContractorPercent').setAttribute('required', '');
        }
    });



    /**
     * SUBSERVICES
     */

    /*
    function calculateSubServiceItemAmount() {
        // Loop through all rows that have sub-service items
        const rows = document.querySelectorAll('.subServiceRow');
        rows.forEach(row => {
            // Get the inputs for the current row
            const qtyInput = row.querySelector('.subServiceItemQty');
            const unitCostInput = row.querySelector('.subServiceItemUnitCost');
            const amountOutput = row.querySelector('.subServiceItemAmount');

            // Parse the values or default to 0
            const qty = parseFloat(qtyInput.value) || 0;
            const unitCost = parseFloat(unitCostInput.value) || 0;

            // Calculate the amount
            const amount = qty * unitCost;

            // Update the amount span
            amountOutput.textContent = amount.toFixed(2);
        });
    }
    // Attach event listeners to all quantity and unit cost inputs
    document.querySelectorAll('.subServiceItemQty, .subServiceItemUnitCost').forEach(input => {
        input.addEventListener('input', calculateSubServiceItemAmount);
    });


    function calculateSubServiceLaborAmount() {
        // Loop through all rows that have sub-service items
        const rows = document.querySelectorAll('.subServiceRow');
        rows.forEach(row => {
            // Get the inputs for the current row
            const qtyInput = row.querySelector('.subServiceItemQty');
            const unitCostInput = row.querySelector('.subServiceItemUnitCost');
            const markupPercentInput = row.querySelector('.subServiceItemMarkupPercent');
            const laborOutput = row.querySelector('.subServiceItemLabor');

            // Parse the values or default to 0
            const qty = parseFloat(qtyInput.value) || 0;
            const unitCost = parseFloat(unitCostInput.value) || 0;
            const markupPercent = parseFloat(markupPercentInput.value) || 0;

            // Calculate the labor amount
            const labor = (((qty * unitCost) * (markupPercent * 0.01)) + (qty * unitCost)) * 0.5;

            // Update the amount span
            laborOutput.textContent = labor.toFixed(2);
        });
    }
    // Attach event listeners to all quantity and unit cost inputs
    document.querySelectorAll('.subServiceItemQty, .subServiceItemUnitCost, .subServiceItemMarkupPercent').forEach(input => {
        input.addEventListener('input', calculateSubServiceLaborAmount);
    });
    */




    function calculateSubServiceItem() {

        // Loop through all rows that have sub-service items
        const rows = document.querySelectorAll('.subServiceRow');
        const rowData = []; // array to hold data objects for each row

        rows.forEach(row => {
            // Create an object to store the current row's data
            const data = {
                id: 1,
                units: '',
                qty: parseFloat(row.querySelector('.subServiceItemQty')?.value || 0),
                unitCost: parseFloat(row.querySelector('.subServiceItemUnitCost')?.value || 0),
                markupPercent: 0.01 * parseFloat(row.querySelector('.subServiceItemMarkupPercent')?.value || 0),
                //taxPercent: 0.01 * parseFloat(row.querySelector('.subServiceItemTaxPercent')?.value || 0),
                //taxTotal: 0,
                amount: 0,
                markupTotal: 0,
                labor: 0,
                total: 0
            };

            // Get+parse the inputs for the current row
            // const qty = parseFloat(row.querySelector('.subServiceItemQty')?.value || 0);
            // const unitCost = parseFloat(row.querySelector('.subServiceItemUnitCost')?.value || 0);
            // const markupPercent = 0.01 * parseFloat(row.querySelector('.subServiceItemMarkupPercent')?.value || 0);
            // const taxPercent = 0.01 * parseFloat(row.querySelector('.subServiceItemTaxPercent')?.value || 0);

            // Perform calculations
            data.amount = data.qty * data.unitCost;
            data.markupTotal = data.amount * data.markupPercent;
            data.labor = ((data.amount * data.markupPercent) + (data.amount)) * 0.5;
            //data.taxTotal = data.labor * (document.querySelector('.bid-tax-percentage').value * 100);
            data.total = data.amount + data.markupTotal;



            // Update the DOM
            row.querySelector('.subServiceItemAmount').textContent = data.amount.toFixed(2);
            row.querySelector('.subServiceItemLabor').textContent = data.labor.toFixed(2);
            //row.querySelector('.subServiceItemTax').textContent = data.taxTotal.toFixed(2);
            row.querySelector('.subServiceItemTotal').textContent = data.total.toFixed(2);

            // Push the data object to the array
            rowData.push(data);
        });

        console.log(document.querySelector('.bid-tax-percentage').value);

        // console.log("Markup percent: " + data.markupPercent);
        // console.log("Markup total: " + data.markupTotal);

        //console.log("Row Data: " + rowData);

        return rowData;
    }
    // Use event delegation to handle new rows dynamically
    document.body.addEventListener('input', function (event) {
        if (event.target.matches('.subServiceItemQty, .subServiceItemUnitCost, .subServiceItemMarkupPercent')) {
            calculateSubServiceItem();
        }``
    });

    // // Attach event listeners
    // document.querySelectorAll('.subServiceItemQty, .subServiceItemUnitCost, .subServiceItemMarkupPercent').forEach(input => {
    //     input.addEventListener('input', calculateSubServiceItem);
    // });


    /**
     * LABOR CALCULATOR
     */

    function getLaborTotal() {
        const laborDays = parseFloat(document.getElementById('laborDays').value) || 0;
        const laborUnitCost = parseFloat(document.getElementById('laborUnitCost').value) || 0;
        const laborTotal = laborDays * laborUnitCost;

        // console.log(laborDays);
        // console.log(laborUnitCost);
        // console.log(laborTotal);

        const laborTotalElements = document.getElementsByClassName('laborTotal');

        for(let i = 0; i < laborTotalElements.length; i++) {
            laborTotalElements[i].innerHTML = laborTotal.toFixed(2);
        }

        return laborTotal;
    }
    // attach event listeners to both inputs
    document.querySelectorAll('#laborDays, #laborUnitCost').forEach(input => {
        input.addEventListener('input', getLaborTotal);
    });


    /**
     * BID SUMMARY
     */

    function generateBidSummary() {
        const servicesData = calculateSubServiceItem();

        const bidGrandTotals = servicesData.reduce(
            (totals, data) => {
                totals.subtotal += data.total || 0;
                return totals;
            },
            {
                subtotal: 0,
            }
        );

        const taxPercent = parseFloat(document.getElementById('bidTaxPercentage')?.value || 0) / 100;
        const generalConditionsPercent = parseFloat(document.getElementById('generalConditionsPercent')?.value || 0) / 100;
        const overheadProfitPercent = parseFloat(document.getElementById('overheadProfitPercent')?.value || 0) / 100;

        bidGrandTotals.generalConditionsTotal = bidGrandTotals.subtotal * generalConditionsPercent;
        bidGrandTotals.overheadProfitTotal = bidGrandTotals.subtotal * overheadProfitPercent;
        bidGrandTotals.tax = bidGrandTotals.subtotal * taxPercent;
        bidGrandTotals.grandTotal =
            bidGrandTotals.subtotal +
            bidGrandTotals.generalConditionsTotal +
            bidGrandTotals.overheadProfitTotal +
            bidGrandTotals.tax;

        document.getElementById('subtotal').innerHTML = '$ ' + bidGrandTotals.subtotal.toFixed(2);
        document.getElementById('generalConditionsTotal').innerHTML = '$ ' + bidGrandTotals.generalConditionsTotal.toFixed(2);
        document.getElementById('overheadProfitTotal').innerHTML = '$ ' + bidGrandTotals.overheadProfitTotal.toFixed(2);
        document.getElementById('taxTotal').innerHTML = '$ ' + bidGrandTotals.tax.toFixed(2);
        document.getElementById('grandTotal').innerHTML = '$ ' + bidGrandTotals.grandTotal.toFixed(2);

        console.log(bidGrandTotals);
    }
    // Attach event listeners
    document.querySelectorAll('.subServiceItemQty, .subServiceItemUnitCost, .subServiceItemMarkupPercent, #generalConditionsPercent, #overheadProfitPercent, #bidTaxPercentage').forEach(input => {
        input.addEventListener('input', generateBidSummary);
    });


    /**
     * Dashboard Sorting Functionality
     */
    document.addEventListener('DOMContentLoaded', function () {
        const sortSelect = document.getElementById('bids_sort');

        sortSelect.addEventListener('change', function () {
            const selectedSort = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('sort', selectedSort);
            window.location.href = url.toString(); // Redirects with updated query string
        });
    });




});
