<?php

$app->get('/posts/all', 'PostsController@getAllPosts');
$app->get('/posts/get/{id}', 'PostsController@getPost');
$app->delete('/posts/delete', 'PostsController@deletePost');
$app->put('/posts/insert', 'PostsController@insertPost');
$app->put('/posts/update', 'PostsController@updatePost');

$app->group(['prefix' => 'services'], function () use ($app) {
    $app->get('/posts/all', 'ServicesPostsController@getAllPosts');
    $app->get('/posts/get/{id}', 'ServicesPostsController@getPost');
    $app->delete('/posts/delete', 'ServicesPostsController@deletePost');
    $app->put('/posts/insert', 'ServicesPostsController@insertPost');
    $app->put('/posts/update', 'ServicesPostsController@updatePost');
});

$app->group(['prefix' => 'gateway'], function () use ($app) {
    $app->get('/posts/all', 'GatewayPostsController@getAllPosts');
    $app->get('/posts/get/{id}', 'GatewayPostsController@getPost');
    $app->delete('/posts/delete', 'GatewayPostsController@deletePost');
    $app->put('/posts/insert', 'GatewayPostsController@insertPost');
    $app->put('/posts/update', 'GatewayPostsController@updatePost');
});

$app->get('/', function(){
    return 'Hello World';
});