<x-layout>
    <x-slot:tabtitle>MIT InvoiceNow - Log Record</x-slot:tabtitle>
    <x-slot:title>{{  $title }}</x-slot:title>
     {{-- 1st Row - Date From To --}}
     <div class="space-y-4">
        <div class="flex space-x-4">
          <div x-data="{ date: '' }" class="p-6 bg-white shadow-md rounded-lg flex-1">
              <label for="datepicker-from" class="block text-sm font-medium text-gray-700">Due Date From</label>
              <input 
                  id="datepicker-from"
                  x-ref="datepicker-from"
                  type="date"
                  x-model="date"
                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              />
          </div>
          <div x-data="{ date: '' }" class="p-6 bg-white shadow-md rounded-lg flex-1">
              <label for="datepicker-to" class="block text-sm font-medium text-gray-700">To</label>
              <input 
                  id="datepicker-to"
                  x-ref="datepicker-to"
                  type="date"
                  x-model="date"
                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              />
          </div>
          <!-- Column 3:Button -->
          <div class="w-1/3 flex flex-col space-y-4">
    
            <!-- Button -->
            <div class="w-full h-full">
                <button
                    type="button"
                    class="w-full h-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Search
                </button>
            </div>
        </div>
        </div>
    
        <!-- Single Card with Radio Buttons on the Left, Dropdown and Button on the Right -->
        <div class="p-6 bg-white shadow-md rounded-lg flex-none">
          <div class="flex flex-col space-y-4">
              <!-- Row 1: Radio Buttons and Dropdown/Buttons -->
              <div class="flex">
    
                  
              </div>
    
              
    
              <!-- Table -->
              <div>
                  <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-gray-50">
                          <tr>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">DocEntry</th>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">DocNum</th>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">DocDate</th>
                          </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                          <tr>
                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Row 1 Cell 1</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Row 1 Cell 2</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Row 1 Cell 3</td>
                          </tr>
                          <tr>
                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Row 2 Cell 1</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Row 2 Cell 2</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Row 2 Cell 3</td>
                          </tr>
                          <!-- Add more rows as needed -->
                      </tbody>
                  </table>
              </div>
    
              <!-- Buttons -->
              <div class="flex space-x-4">
                  <button
                      type="button"
                      class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                  >
                      Retrieve
                  </button>
                  
              </div>
          </div>
      </div>
        
        
      </div>
        </div>
      
      <script>
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
                }))
            });
      </script>
</x-layout>