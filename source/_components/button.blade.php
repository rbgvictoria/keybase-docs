@php
    $base = "inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold rounded-lg transition-all focus:outline-none focus:ring-2 focus:ring-offset-2";
    
    $variants = [
        'primary' => "bg-green-600 text-white hover:bg-green-700 shadow-sm focus:ring-green-500",
        'secondary' => "bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700",
    ];

    $class = $variants[$variant ?? 'primary'];
@endphp

<a href="{{ $url }}" class="{{ $base }} {{ $class }}">
    {{ $slot }}
</a>