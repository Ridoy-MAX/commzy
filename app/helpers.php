<?php

// app/helpers.php

if (!function_exists('is_active_route')) {
    function is_active_route($routeName)
    {
        return request()->routeIs($routeName) ? 'active' : '';
    }
}
