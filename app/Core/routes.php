<?php
/**
 * Routes - all standard routes are defined here.
 */

/** Create alias for Router. */
use Core\Router;
use Helpers\Hooks;

/** Define routes. */
Router::any('', 'Controllers\Welcome@index');
Router::any('subpage', 'Controllers\Welcome@subPage');

//author 
// (:any), (:all), (:num)
Router::get('author', 'Controllers\Author@index');
Router::any('author/add', 'Controllers\Author@add');
Router::any('author/edit/(:num)', 'Controllers\Author@edit');

//post
Router::get('post', 'Controllers\Post@index');
Router::any('post/add', 'Controllers\Post@add');
Router::any('post/edit/(:num)', 'Controllers\Post@edit');
Router::get('post/delete/(:num)', 'Controllers\Post@delete');

//comments
Router::get('post/comment', 'Controllers\Post@comment');
Router::any('post/comment/(:all)', 'Controllers\Post@comment');

/** Module routes. */
$hooks = Hooks::get();
$hooks->run('routes');

/** If no route found. */
Router::error('Core\Error@index');

/** Turn on old style routing. */
Router::$fallback = false;

/** Execute matched routes. */
Router::dispatch();
