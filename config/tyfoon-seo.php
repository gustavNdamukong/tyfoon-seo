<?php

return [
    'cacheable' => true,
    'cache_driver' => env('TYFOON_SEO_CACHE_DRIVER', 'redis'),
    'redis_connection' => env('TYFOON_SEO_REDIS_CONNECTION', 'default'),
];