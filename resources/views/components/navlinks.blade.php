@props(['tab', 'route'])

<li>
    <a @click="tab='{{$tab}}'" href="{{ $route }}" :class="tab==='{{$tab}}' ? 'text-primary-700 md:hover:text-primary-700' : 'text-gray-600'" class="block py-2 px-3 font-semibold rounded hover:bg-primary-600 hover:text-white md:hover:bg-transparent md:border-0 md:p-0 lg:hover:scale-110 md:hover:text-gray-900">
        {{ $slot }}
    </a>
</li>
