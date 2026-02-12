@php
    $currentLang = $lang ?? 'text';
    $languages = [
        'js'   => 'JavaScript',
        'ts'   => 'Typescript',
        'php'  => 'PHP',
        'html' => 'HTML',
        'css'  => 'CSS',
        'bash' => 'Terminal',
        'md'   => 'Markdown'
    ];
    $displayLang = $languages[$currentLang] ?? strtoupper($currentLang);
    $blockId = 'code_' . uniqid();

    // Strip out the extra <p> tags the parser might have added around the slot
    // but keep the internal Markdown code fence structure.
    $cleanedSlot = trim($slot);
@endphp

<div class="my-8 overflow-hidden rounded-xl border-2 border-gray-200 dark:border-gray-700 shadow-md bg-white dark:bg-gray-950">
    {{-- Header --}}
    <div class="flex items-center justify-between bg-gray-100/80 px-4 py-2 dark:bg-gray-900 border-b-2 border-gray-200 dark:border-gray-800 font-sans">
        <span class="text-xs font-black tracking-widest text-gray-500 uppercase">
            {{ $displayLang }}
        </span>
        
        <button onclick="copyCode('{{ $blockId }}', this)" class="text-gray-400 hover:text-green-600 transition-colors">
             <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75"></path>
            </svg>
        </button>
    </div>

    {{-- 
        THE HIGHLIGHT.JS WRAPPER
        We use 'display: grid' to force all nested blocks to stack 
        without extra margin gaps. 
    --}}
    <div class="p-5 overflow-x-auto grid
        [&_p]:hidden 
        [&_pre]:!m-0 [&_pre]:!p-0 [&_pre]:!bg-transparent 
        [&_code]:!p-0 [&_code]:!bg-transparent [&_code]:!text-sm [&_code]:!font-bold [&_code]:!leading-tight">
        <div id="{{ $blockId }}">
            {!! $cleanedSlot !!}
        </div>
    </div>
</div>