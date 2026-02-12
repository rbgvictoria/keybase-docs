@php
    $rawCollection = $page->_meta->collection;
    $isIntro = $page->getFilename() === 'introduction';
    
    // 1. Get the collection items
    $collectionItems = ${$rawCollection} ?? collect();
    
    // 2. Check if an introduction page actually exists in this collection
    $hasIntro = $collectionItems->contains(fn($item) => $item->getFilename() === 'introduction');

    $collectionLabel = \Illuminate\Support\Str::title(str_replace('_', ' ', (string) $rawCollection));
    $collectionUrl = '/' . \Illuminate\Support\Str::replace('_', '-', (string) $rawCollection);
@endphp

@if($rawCollection)
<nav class="flex items-center text-gray-500 text-sm tracking-wide" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2 list-none mt-0 pl-0">
        <li class="-ml-0.5">
            <a href="{{ $page->baseUrl }}/" class="hover:text-green-600 transition-colors no-underline">Home</a>
        </li>
        
        <li class="flex items-center space-x-2">
            <span class="text-gray-400">/</span>
            {{-- 3. Only link if an intro exists AND we aren't already on it --}}
            @if($hasIntro && !$isIntro)
                <a href="{{ $page->baseUrl }}{{ $collectionUrl }}" class="hover:text-green-600 transition-colors no-underline">
                    {{ $collectionLabel }}
                </a>
            @else
                <span class="{{ $isIntro ? 'text-green-600' : '' }}">{{ $collectionLabel }}</span>
            @endif
        </li>

        @if(!$isIntro)
            <li class="flex items-center space-x-2">
                <span class="text-gray-400">/</span>
                <span class="text-gray-900 dark:text-white">{{ $page->title }}</span>
            </li>
        @endif
    </ol>
</nav>
@endif