<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-amber-600 to-amber-700 border border-transparent rounded-xl font-semibold text-sm text-white tracking-wide hover:from-amber-700 hover:to-amber-800 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm']) }}>
    {{ $slot }}
</button>
