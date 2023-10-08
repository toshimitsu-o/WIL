<a
    {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 rounded-md font-semibold text-white text-sm uppercase tracking-widest focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 bg-gradient-to-tl from-sky-500 to-violet-900 opacity-90 hover:opacity-100']) }}>
    {{ $slot }}
</a>
