<?php

use luxury\Router;


//default routes for admin
Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin' ]);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);

//default routes
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

