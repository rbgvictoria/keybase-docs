@php
    // Map the type to the specific Tailwind class sets
    // This ensures the full strings exist for the Tailwind scanner
    $colorMap = [
        'info' => [
            'outline' => 'text-blue-600 border-blue-600 dark:text-blue-400 dark:border-blue-400',
            'fill'    => 'bg-blue-100 text-blue-700 border-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800'
        ],
        'success' => [
            'outline' => 'text-green-600 border-green-600 dark:text-green-400 dark:border-green-400',
            'fill'    => 'bg-green-100 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-300 dark:border-green-800'
        ],
        'warning' => [
            'outline' => 'text-amber-600 border-amber-600 dark:text-amber-400 dark:border-amber-400',
            'fill'    => 'bg-amber-100 text-amber-700 border-amber-200 dark:bg-amber-900/30 dark:text-amber-300 dark:border-amber-800'
        ],
        'error' => [
            'outline' => 'text-red-600 border-red-600 dark:text-red-400 dark:border-red-400',
            'fill'    => 'bg-red-100 text-red-700 border-red-200 dark:bg-red-900/30 dark:text-red-300 dark:border-red-800'
        ],
        'debug' => [
            'outline' => 'text-slate-600 border-slate-600 dark:text-slate-400 dark:border-slate-400',
            'fill'    => 'bg-slate-100 text-slate-700 border-slate-200 dark:bg-slate-900/30 dark:text-slate-300 dark:border-slate-800'
        ],
    ];

    $type = $type ?? 'debug';
    $selectedVariant = $variant ?? 'fill';
    $activeVariant = $colorMap[$type][$selectedVariant] ?? $colorMap['debug'][$selectedVariant];

    $baseClasses = "inline-flex items-center mx-2 px-2 py-0.5 rounded-full text-[12px] font-bold tracking-wider border align-middle -mt-0.5";
@endphp

<span class="not-prose {{ $baseClasses }} {{ $activeVariant }} whitespace-nowrap" ...>
    {{ ucfirst($type) }}
</span>