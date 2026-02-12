<?php

use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;

$navigation = require('navigation.php');

$path = function ($page) {
    $collection = $page->collection ?? $page->getCollection();

    $folder = \Illuminate\Support\Str::replace('_', '-', (string) $collection);
    
    return $page->getFilename() === 'introduction' 
        ? $folder
        : $folder . '/' . Illuminate\Support\Str::slug($page->getFilename());
};

return [
    'baseUrl' => 'http://keybase-docs.test',
    'collections' => [
        'using_keys' => [ // This matches your folder name '_using-keys'
            'path' => $path,
            'sort' => 'order',
        ],
        'editor_guides' => [
            'path' => $path,
            'sort' => 'order',
        ],
        'api_docs' => [
            'path' => $path,
            'sort' => 'order',
        ],
        'theory' => [
            'path' => $path,
            'sort' => 'order',
        ],
    ],
    'navigation' => $navigation,
    'commonmark_extensions' => [
        new HeadingPermalinkExtension(),
    ],
    'commonmark_config' => [
        'heading_permalink' => [
            'html_class' => 'anchor-link',
            'symbol' => '',
            'insert' => 'after',
        ],
    ],];