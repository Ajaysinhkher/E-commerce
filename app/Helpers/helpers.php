<?php

use App\Models\Page;

if (!function_exists('getPageContent')) {
    function getPageContent(string $slug, string $default = ''): string
    {
        $page = Page::where('slug', $slug)->first();
        return optional($page)->content ?? $default;
    }
}
