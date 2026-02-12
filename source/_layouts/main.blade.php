<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="canonical" href="{{ $page->getUrl() }}">
        <meta name="description" content="{{ $page->description }}">
        <title>{{ $page->title }}</title>
        @viteRefresh()
        @if($page->production)
            <link rel="stylesheet" href="{{ $page->asset('assets/css/main.css') }}">
            <script type="module" src="{{ $page->asset('assets/js/main.js') }}"></script>
        @else
            <link rel="stylesheet" href="http://localhost:5175/source/assets/css/main.css">
            <script type="module" src="http://localhost:5175/source/assets/js/main.js"></script>
        @endif
        <script defer type="module" src="{{ vite('source/assets/js/main.js') }}"></script>
    </head>
    <body class="text-gray-900 font-sans antialiased">
        @yield('body')
    </body>
</html>
