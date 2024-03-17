<a href="{{$href}}" {{ $attributes->merge(['class' => 'inline-flex items-center rounded border border-transparent bg-cyan-600 px-2.5 py-1.5 text-xs font-medium text-white shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}
>
    {{ $slot }}
</a>


