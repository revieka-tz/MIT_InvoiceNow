<x-layout>
    <x-slot:tabtitle>MIT InvoiceNow - Invoice</x-slot:tabtitle>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="space-y-4">
        

<!-- Single Card with Radio Buttons, Dropdown, Button, and Table -->
<div class="p-6 bg-white shadow-md rounded-lg flex-none">
    <div class="flex flex-col space-y-4">
        
        <div class="flex space-x-4">
            <!-- Datepicker From -->
            <div x-data="{ date: '' }" class=" flex-1">
                <label for="datepicker-from" class="block text-sm font-medium text-gray-700">Issue Date From</label>
                <input id="datepicker-from" x-ref="datepicker-from" type="date" x-model="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>

            <!-- Datepicker To -->
            <div x-data="{ date: '' }" class=" flex-1">
                <label for="datepicker-to" class="block text-sm font-medium text-gray-700">To</label>
                <input id="datepicker-to" x-ref="datepicker-to" type="date" x-model="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
        </div>

        <div class="flex">
            <div class="w-1/2 pr-4">
                <fieldset>
                    <legend class="block text-sm font-medium text-gray-700">Transaction Type</legend>
                    <div class="mt-2 space-y-2">
                        <div>
                            <input id="option1" name="options" type="radio" value="ar_invoice" class="mr-2" />
                            <label for="option1" class="text-xl text-gray-600">A/R Invoice</label>
                        </div>
                        <div>
                            <input id="option2" name="options" type="radio" value="ar_credit_note" class="mr-2" />
                            <label for="option2" class="text-xl text-gray-600">A/R Credit Note</label>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="w-1/2 flex flex-col space-y-4">
                <div>
                    <label for="dropdown" class="block text-sm font-medium text-gray-700">Card Code</label>
                    <select id="dropdown" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Option 1</option>
                        <option>Option 2</option>
                        <option>Option 3</option>
                    </select>
                </div>

                <!-- Search Button -->
                <div class="w-full">
                    <button id="searchButton" type="button" class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Search
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- Single Card with Table -->
        <div class="p-6 bg-white shadow-md rounded-lg flex-none">
            <div class="flex flex-col space-y-4">

                <!-- Table for showing the API response -->
                <div class="overflow-auto h-64">
                    <table class="min-w-full divide-y divide-gray-200" id="invoiceTable">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr>
                                <th class="px-6 py-4 text-left">
                                    <input type="checkbox" id="selectAllCheckbox" class="rounded border-gray-300" />
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 tracking-wider">Invoice Number</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 tracking-wider">Document Identifier</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 tracking-wider">Invoice Issue Date</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 tracking-wider">Seller Name</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 tracking-wider">Buyer Name</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 tracking-wider">Invoice Type Code</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 tracking-wider">Currency Code</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Dynamic content will go here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery AJAX to handle API call -->
    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            // Ensure the A/R Invoice radio button is selected before proceeding
            if (document.getElementById('option1').checked) {
                fetchInvoices();
            } else {
                alert('Please select the "A/R Invoice" option before proceeding.');
            }
        });

        function fetchInvoices() {
            // Clear any existing table rows
            document.getElementById('invoiceTableBody').innerHTML = '';

            // Make the AJAX request to fetch invoices
            fetch("{{ route('api.get') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.invoices && data.invoices.length > 0) {
                    let tableBody = document.getElementById('invoiceTableBody');
                    data.invoices.forEach(invoice => {
                        let row = `<tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="rounded border-gray-300" value="${invoice.Calculated_InvoiceNumber}" />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${invoice.Calculated_InvoiceNumber}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${invoice.Calculated_DocumentIdentifier}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${new Date(invoice.Calculated_InvoiceIssueDate).toLocaleDateString()}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${invoice.Calculated_SellerName}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${invoice.Calculated_BuyerName}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${invoice.Calculated_InvoiceTypeCode}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${invoice.Calculated_InvoiceCurrencyCode}</td>
                        </tr>`;
                        tableBody.insertAdjacentHTML('beforeend', row);
                    });
                } else {
                    document.getElementById('invoiceTableBody').innerHTML = '<tr><td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">No invoices found.</td></tr>';
                }
            })
            .catch(error => {
                console.error('Error fetching invoices:', error);
                document.getElementById('invoiceTableBody').innerHTML = '<tr><td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">Error fetching invoices.</td></tr>';
            });
        }

        // Select all checkboxes functionality
        document.getElementById('selectAllCheckbox').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('#invoiceTableBody input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        document.addEventListener('alpine:init', () => {
            Alpine.data('datepicker', () => ({
                init() {
                    flatpickr(this.$refs['datepicker-from'], {
                        dateFormat: "Y-m-d",
                    });
                    flatpickr(this.$refs['datepicker-to'], {
                        dateFormat: "Y-m-d",
                    });
                }
            }));
        });
    </script>
</x-layout>
