<?php

function profile_image( $email_address ){

    $hash = md5( strtolower( trim($email_address) ) );
    if( file_exists('http://www.gravatar.com/avatar/'.$hash.'?s=200') )
        return 'http://www.gravatar.com/avatar/'.$hash.'?s=200';

    return 'https://placeholdit.imgix.net/~text?txtsize=33&txt=grvitar&w=160&h=160';
}

/**
 * Returns class name for active links
 *
 * @param $route
 * @param string $class
 * @return string
 */
function set_active($route, $class = 'active')
{
	return (Route::currentRouteName() == $route) ? $class : '';
}

/**
 * Returns class name if active route is found in passed routes array
 *
 * @param $routes
 * @param string $class
 * @return string
 */
function section_active($routes, $class = 'active')
{
	return ( in_array(Route::currentRouteName(), $routes) ) ? $class : '';
}