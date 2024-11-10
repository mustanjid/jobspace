@props(['active' => false])

<li>
    <a class="
    {{ $active
        ? 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group'
        : 'flex items-center p-2 text-blue-500 rounded-lg hover:bg-gray-100 group' }}"
         {{ $attributes }}>
        {{ $slot }}
    </a>
</li>