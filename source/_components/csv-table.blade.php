@php
    // 1. Clean the content from CommonMark's automatic code wrapping
    $content = $slot;
    $content = preg_replace('/^<pre><code>/', '', $content);
    $content = preg_replace('/<\/code><\/pre>$/', '', $content);
    
    // 2. Decode entities (like &quot;) back to raw characters for the CSV parser
    $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');
    
    if (empty(trim($content))) return;

    $lines = explode("\n", trim($content));
    $firstLine = $lines[0];

    // 3. Identify Delimiter
    if (strpos($firstLine, "\t") !== false) {
        $delimiter = "\t";
    } elseif (strpos($firstLine, "  ") !== false && strpos($firstLine, ",") === false) {
        $delimiter = "regex"; 
    } else {
        $delimiter = ",";
    }

    // 4. Extract Headers
    if ($delimiter === "regex") {
        $headers = preg_split('/\s{2,}/', trim(array_shift($lines)));
    } else {
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $content);
        rewind($stream);
        $headers = fgetcsv($stream, 0, $delimiter);
        array_shift($lines);
        fclose($stream);
    }

    // 5. Process Rows
    $rows = [];
    foreach ($lines as $line) {
        if (empty(trim($line))) continue;

        if ($delimiter === "regex") {
            $startsWithSpace = preg_match('/^\s{2,}/', $line);
            $cells = preg_split('/\s{2,}/', trim($line));
            
            if ($startsWithSpace) {
                array_unshift($cells, "");
            }
            $rows[] = $cells;
        } else {
            $rows[] = str_getcsv($line, $delimiter);
        }
    }
@endphp

<div class="not-prose my-8 overflow-hidden border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 font-sans relative group">
    {{-- Hidden container for the Copy Button to target --}}
    <div class="hidden raw-csv-data">{{ trim($content) }}</div>

    <div class="overflow-x-auto">
        <table class="min-w-full !my-0 border-collapse">
            <thead class="bg-gray-50/80 dark:bg-gray-900/80 border-gray-200 dark:border-gray-800">
                <tr class="border-y-2 border-gray-300 dark:border-gray-700">
                    @foreach($headers as $header)
                        <th class="px-4 py-3 text-left text-sm font-black text-gray-500 dark:text-gray-400 border-r last:border-0 border-gray-100 dark:border-gray-800">
                            {{ trim($header) ?: 'Column' }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-900">
                @foreach($rows as $row)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-900/30 transition-colors odd:bg-transparent bg-white even:bg-slate-50 dark:bg-slate-900 dark:even:bg-slate-800/50">
                        @foreach($headers as $index => $h)
                            <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300 align-top leading-relaxed min-w-[150px]">
                                {!! nl2br(e(trim($row[$index] ?? ''))) !!}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex items-center justify-between bg-gray-50/50 dark:bg-gray-900/50 px-4 py-2 border-t border-gray-100 dark:border-gray-800">
        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">
            Format: {{ $delimiter === ',' ? 'CSV' : ($delimiter === "\t" ? 'TSV' : 'Fixed-width') }} | Rows: {{ count($rows) }}
        </div>

        <button 
            onclick="copyToClipboard(this)" 
            class="text-[10px] text-gray-400 hover:text-blue-500 font-bold uppercase tracking-widest transition-colors flex items-center gap-1"
        >
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
            </svg>
            Copy
        </button>
    </div>
</div>

<script>
if (typeof copyToClipboard !== 'function') {
    function copyToClipboard(btn) {
        const container = btn.closest('.group');
        const text = container.querySelector('.raw-csv-data').innerText;
        
        navigator.clipboard.writeText(text).then(() => {
            const originalContent = btn.innerHTML;
            btn.innerText = 'Copied!';
            setTimeout(() => btn.innerHTML = originalContent, 2000);
        });
    }
}
</script>