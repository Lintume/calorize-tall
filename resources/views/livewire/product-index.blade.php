<div class="flex flex-col justify-center">
     <div class="flex flex-col shadow justify-between rounded-lg mt-5 bg-white mb-1">
          <div class="p-5 md:p-10">
               <!-- Search bar -->
               <div class="mb-5 md:mb-10">
                    <input
                        type="text"
                        placeholder="{{ __('Search...') }}"
                        class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        wire:model.live.debounce.500ms="search"
                    />
                    <div class="text-red-600">@error('search') {{ $message }} @enderror</div>
               </div>
               <!-- Table -->
               <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                         <thead class="bg-gray-50">
                         <tr>
                              <th class="w-1/4 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Title') }}</th>
                              <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Prot') }}</th>
                              <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Fat') }}</th>
                              <th class="w-1/12 px-1 py-2 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">{{ __('Carb') }}</th>
                              <th class="w-1/12 px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Kcal') }}</th>
                              <th class="w-1/12 px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                         </tr>
                         </thead>
                         <tbody class="bg-white divide-y divide-gray-200">
                         @foreach($products as $product)
                              <tr>
                                   <td class="px-2 py-4 break-words">
                                        @if($product->user_id)
                                             <a href="{{route('product.edit', $product->id) }}"
                                                class="hover:underline">
                                                  <i class="fas fa-edit text-blue-800"></i>
                                             </a>
                                        @endif
                                        <a href="{{route('product.show', $product->id) }}"
                                           class="hover:underline">
                                             {{ $product->title }}
                                        </a>
                                   </td>
                                   <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap">{{ $product->proteins }}</td>
                                   <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap">{{ $product->fats }}</td>
                                   <td class="px-1 py-2 text-center text-gray-400 whitespace-nowrap">{{ $product->carbohydrates }}</td>
                                   <td class="px-2 py-3 text-center whitespace-nowrap">{{ $product->calories }}</td>
                                   <td class="px-2 py-3 whitespace-nowrap">
                                        @if($product->user_id)
                                             <a href="#" wire:click.prevent="delete({{ $product->id }})"
                                                class="text-red-500 hover:underline">
                                                  <i class="fas fa-trash-alt"></i>
                                             </a>
                                        @endif
                                   </td>
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