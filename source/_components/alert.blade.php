@php
    $themes = [
        'info' => [
            'icon' => 'ℹ️',
            'container' => 'bg-blue-50 border-blue-500 dark:bg-blue-900/20 dark:border-blue-700',
            'title' => 'text-blue-800 dark:text-blue-300',
            'body' => 'text-blue-700 dark:text-blue-400',
        ],
        'success' => [
            'icon' => '✅',
            'container' => 'bg-green-50 border-green-500 dark:bg-green-900/20 dark:border-green-700',
            'title' => 'text-green-800 dark:text-green-300',
            'body' => 'text-green-700 dark:text-green-400',
        ],
        'warning' => [
            'icon' => '⚠️',
            'container' => 'bg-amber-50 border-amber-500 dark:bg-amber-900/20 dark:border-amber-700',
            'title' => 'text-amber-800 dark:text-amber-300',
            'body' => 'text-amber-700 dark:text-amber-400',
        ],
        'danger' => [
            'icon' => '🚫',
            'container' => 'bg-red-50 border-red-500 dark:bg-red-900/20 dark:border-red-700',
            'title' => 'text-red-800 dark:text-red-300',
            'body' => 'text-red-700 dark:text-red-400',
        ],
    ];

    $theme = $themes[$type] ?? $themes['info'];
@endphp

<div class="my-8 border-l-4 p-4 rounded-r-lg shadow-sm {{ $theme['container'] }}" role="alert">
    <div class="flex items-center gap-2 font-bold mb-1 {{ $theme['title'] }}">
        <span class="text-sm opacity-80">{{ $theme['icon'] }}</span>
        {{ isset($title) ? $title : ucfirst($type) }}
    </div>
    <div class="leading-relaxed {{ $theme['body'] }}">
        @markdown($slot)
    </div>
</div>