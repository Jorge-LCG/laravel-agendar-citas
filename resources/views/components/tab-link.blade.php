@props(['tab' => 'default'])

<li class="me-2">
    <a 
        x-on:click="active = '{{ $tab }}'"
        :class="{
            'cursor-pointer inline-flex items-center justify-center p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active': active === '{{ $tab }}',
            'cursor-pointer inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 group': active !== '{{ $tab }}'
        }"
    >
        {{ $slot }}
    </a>
</li>