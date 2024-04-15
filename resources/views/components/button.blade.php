<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-caramel border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-espresso focus:bg-coffee-brown active:bg-espresso focus:outline-none focus:ring-2 focus:ring-coffee-brown focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
