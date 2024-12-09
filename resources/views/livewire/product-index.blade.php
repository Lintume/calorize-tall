<div class="flex flex-col justify-center">
     <div class="flex flex-col shadow justify-between rounded-lg xl:p-8 mt-5 bg-white mb-1">
          <div class="p-5">
               <!-- Search bar -->
               <div class="mb-5">
                    <input
                        type="text"
                        placeholder="{{ __('Search...') }}"
                        class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        wire:model="searchTerm"
                    />
               </div>
               <!-- Table -->
               <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                         <thead class="bg-gray-50">
                         <tr>
                              <th class="w-1/4 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Product title') }}</th>
                              <th class="w-1/4 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Prot.') }}</th>
                              <th class="w-1/4 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Fat') }}</th>
                              <th class="w-1/4 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Ch.') }}</th>
                              <th class="w-1/4 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Cal.') }}</th>
                         </tr>
                         </thead>
                         <tbody class="bg-white divide-y divide-gray-200">
                         @foreach($products as $product)
                              <tr>
                                   <td class="px-2 py-4 break-words">{{ $product->title }}</td>
                                   <td class="px-2 py-4 whitespace-nowrap">{{ $product->proteins }}</td>
                                   <td class="px-2 py-4 whitespace-nowrap">{{ $product->fats }}</td>
                                   <td class="px-2 py-4 whitespace-nowrap">{{ $product->carbohydrates }}</td>
                                   <td class="px-2 py-4 whitespace-nowrap">{{ $product->calories }}</td>
                              </tr>
                         @endforeach
                         </tbody>
                    </table>
               </div>
               <!-- Pagination -->
               <div class="mt-4">
                    {{ $products->links() }}
               </div>
          </div>
     </div>
</div>