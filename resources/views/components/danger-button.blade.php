<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full font-semibold rounded-lg text-sm px-5 py-2.5 items-center text-white bg-error-600 border border-transparent uppercase tracking-widest hover:bg-error-500 active:bg-error-700 focus:outline-none focus:ring-2 focus:ring-error-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>