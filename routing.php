<?php

$__urls = array();

function route($methods, $url, $callable){
	global $__urls;
	$__urls[ '@^'.implode('|', $methods).':'.$url.'/?$@' ] = $callable;
}

function get($url, $callable){
	route(array('GET'), $url, $callable);
}

function post($url, $callable){
	route(array('POST'), $url, $callable);
}

function dispatch(){
	global $__urls;
	$path = "$_SERVER[REQUEST_METHOD]:$_SERVER[REQUEST_URI]";
	foreach( $__urls as $pattern => $callable ){
		if( preg_match($pattern, $path, $args) ){
			array_shift($args);
			if( is_array($callable) ){
				foreach( $callable as $c ){
					call_user_func_array($c, $args);
				}
			}
			else {
				call_user_func_array($callable, $args);
			}
			return TRUE;
		}
	}
	return FALSE;
}
