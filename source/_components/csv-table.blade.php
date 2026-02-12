@php
    $content = $slot; // No trim yet, we need to see leading whitespace
    if (empty(trim($content))) return;

    $lines = explode("\n", trim($content));
    $firstLine = $lines[0];

    // 1. Identify Delimiter
    if (strpos($firstLine, "\t") !== false) {
        $delimiter = "\t";
    } elseif (strpos($firstLine, "  ") !== false && strpos($firstLine, ",") === false) {
        $delimiter = "regex"; 
    } else {
        $delimiter = ",";
    }

    // 2. Extract Headers
    if ($delimiter === "regex") {
        $headers = preg_split('/\s{2,}/', trim(array_shift($lines)));
    } else {
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $content);
        rewind($stream);
        $headers = fgetcsv($stream, 0, $delimiter);
        array_shift($lines); // Sync $lines with stream
        fclose($stream);
    }

    // 3. Process Rows
    $rows = [];
    foreach ($lines as $line) {
        if (empty(trim($line))) continue;

        if ($delimiter === "regex") {
            // Check if the line starts with 2+ spaces (indicating empty first column)
            $startsWithSpace = preg_match('/^\s{2,}/', $line);
            $cells = preg_split('/\s{2,}/', trim($line));
            
            if ($startsWithSpace) {
                array_unshift($cells, ""); // Add the missing empty subkey
            }
            $rows[] = $cells;
        } else {
            $rows[] = str_getcsv($line, $delimiter);
        }
    }
@endphp

<div class="not-prose my-8 overflow-hidden border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-950 font-sans">
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
    {{-- Footer stays the same --}}
    <div class="bg-gray-50/50 dark:bg-gray-900/50 px-4 py-2 border-t border-gray-100 dark:border-gray-800 text-[10px] text-gray-400 font-bold uppercase tracking-widest">
        Format: {{ $delimiter === ',' ? 'Comma-separated values (CSV)' : 'Tab-separated values (TSV)'}} | Rows: {{ count($rows) }}
    </div>
</div>