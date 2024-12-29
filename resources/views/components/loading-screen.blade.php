<div wire:loading id="loading-screen" class="fixed block inset-0 bg-white opacity-75 z-50">
    <div class="flex justify-center items-center h-screen">
        <!-- Контейнер для "пульсуючого" круга + лого -->
        <div class="relative h-40 w-40">
            <!-- Зовнішній пульсуючий круг -->
            <div class="absolute inline-flex h-full w-full rounded-full bg-amber-500 opacity-75 animate-ping"></div>

            <!-- Внутрішній статичний круг із лого -->
            <div class="relative inline-flex items-center justify-center h-40 w-40 rounded-full bg-amber-300">
                <!-- Лого -->
                <img src="/logo.png" alt="Logo" class="h-16 w-16" />
            </div>
        </div>
    </div>
</div>
