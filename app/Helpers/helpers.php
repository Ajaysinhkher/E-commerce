<?php

use App\Models\Page;
use App\Models\StaticPage;

if (!function_exists('getPageContent')) {
    function getPageContent(string $slug, string $default = ''): string
    {
        $page = Page::where('slug', $slug)->first();
        return optional($page)->content ?? $default;
    }
}


// if (!function_exists('getStaticPageContent')) {
//     function getStaticPageContent(string $slug, string $default = ''): string
//     {
//         $staticPage = StaticPage::where('slug', $slug)->first();
//         return optional($staticPage)->content ?? $default;
//     }
// }

