<div x-data="{
    date: '{{ $date }}',
    showRemainingCalories: false,
    totalCalories: 1560,
    remainingCalories: -2
}">
    <div class="flex flex-wrap mt-8 mb-4">
        <div class="flex w-full">
            <!-- дейтпікер -->
            <div class="w-full">
                <input
                    wire:model.live="date"
                    type="date"
                    id="date"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                />
                <div class="text-red-600">@error('date') {{ $message }} @enderror</div>
            </div>
        </div>
    </div>
    <div class="flex flex-col justify-center">
        <div class="flex flex-col shadow justify-between rounded-lg pb-8 xl:p-8 mt-3 bg-white">
            <div class="block-container p-4 space-y-3">
                <template x-for="block in [1, 2, 3, 4]" :key="block">
                    <div class="rounded-lg border border-gray-300 p-4 flex justify-between items-center">
                        <div x-text="'Блок ' + block"></div>
                        <i class="fas fa-plus"></i>
                    </div>
                </template>
            </div>
        </div>
    </div>
    <div @click="showRemainingCalories = !showRemainingCalories"
         :class="{
        'bg-green-600': showRemainingCalories && remainingCalories >= 0,
        'bg-red-600': showRemainingCalories && remainingCalories < 0,
        'bg-yellow-600': !showRemainingCalories
        }"
         class="fixed bottom-0 right-0 mb-4 mr-4 w-20 h-20  rounded-full z-50 flex flex-col items-center justify-center bg-opacity-75 text-white">
        <div x-show="!showRemainingCalories" class="font-bold" x-text="totalCalories">1560</div>
        <div x-show="showRemainingCalories" class="font-bold" x-text="remainingCalories">1360</div>
        <div class="text-xs">Ккал</div>
    </div>
</div>
