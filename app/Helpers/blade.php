<?php

function check_login()
{

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