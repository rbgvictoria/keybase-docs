@php
    use Illuminate\Support\Str;

    $max = $maxLevel ?? 3; 
    $min = 2;
    
    $levels = implode('', range($min, $max));
    $content = method_exists($page, 'getContent') ? $page->getContent() : '';
    $matches = [];
    
    if ($content) {
        // Updated Regex: It now looks for HTML tags OR Markdown style headings
        // This makes it more resilient regardless of how Jigsaw passes the content
        preg_match_all("/(?:<h([{$levels}]).*?>(.*?)<\/h[{$levels}]>|^#{1,{$max}}\s+(.*)$)/m", $content, $matches, PREG_SET_ORDER);
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
                    // Handle both HTML matches and Markdown matches
                    if (str_contains($match[0], '<h')) {
                        $level = $match[1];
                        $text = $match[2];
                    } else {
                        // Calculate level by counting #
                        $level = strlen(trim(str_replace(ltrim($match[0], '#'), '', $match[0])));
                        $text = $match[3];
                    }

                    $cleanHeading = trim(strip_tags($text));
                    // Remove any remaining leading # just in case
                    $cleanHeading = ltrim($cleanHeading, '# ');
                    $slug = Str::slug($cleanHeading); 
                @endphp
                
                <li class="{{ $level == '3' ? 'ml-4' : '' }}">
                    <a href="#{{ $slug }}" 
                       class="no-underline transition-colors duration-200 hover:text-gray-900 dark:hover:text-white hover:underline
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