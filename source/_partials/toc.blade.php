@php
    use Illuminate\Support\Str;

    // Use the variable passed from the @include
    $max = $maxLevel ?? 3; 
    $min = 2;
    
    $levels = implode('', range($min, $max));
    $content = method_exists($page, 'getContent') ? $page->getContent() : '';
    $matches = [];
    
    if ($content) {
        preg_match_all("/<h([{$levels}]).*?>(.*?)<\/h[{$levels}]>/", $content, $matches, PREG_SET_ORDER);
    }
@endphp

@if(count($matches) > 0)
    <div class="my-8 p-6 border border-gray-200 dark:border-gray-800 rounded-sm">
        <h4 class="text-sm font-bold uppercase tracking-widest mb-4 text-gray-500 dark:text-gray-400">
            On this page
        </h4>
        <ul class="space-y-3">
            @foreach($matches as $match)
                @php 
                    $level = $match[1]; // This will be '2' or '3'
                    $text = $match[2];
                    $cleanHeading = strip_tags($text);
                    $slug = \Illuminate\Support\Str::slug($cleanHeading); 
                @endphp
                <li class="{{ $level == '3' ? 'ml-4' : '' }}">
                    <a href="#{{ $slug }}" 
                       class="transition-colors duration-200 hover:text-gray-900 dark:hover:text-white
                       {{ $level == '2' 
                           ? 'text-sm font-semibold text-green-600 dark:text-green-400' 
                           : 'text-sm font-medium text-gray-500 dark:text-gray-400' 
                       }}">
                        {{ $cleanHeading }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif