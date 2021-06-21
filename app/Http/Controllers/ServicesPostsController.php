<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;

class ServicesPostsController extends Controller
{

  /**
   * signifies which methods require auth in class
   * @method __construct
   */
  public function __construct()
  {
    
  }

/**
 * Return all posts from database
 * @method getAllPosts
 * @return string JSON containing all the posts
 */
  public function getAllPosts()
  {
    $client = new Client();
    $services  = explode(',', env('OTHER_SERVICES'));
    $promises = [];

    foreach ($services as $key => $service) {
      array_push($promises, ...[
        $key => $client->requestAsync('GET', $service . '/posts/all')->then(function ($response) {
          echo $response->getBody() . "\n";
        })
      ]);
    }

    Promise\all($promises)->wait();
  }
/**
 * Return a post by ID
 * @method getPost
 * @param  Request $request Response class
 * @param  int $id id of required post
 * @return string JSON containg the post data
 */
  public function getPost( Request $request, $id )
  {
    $client = new Client();
    $services  = explode(',', env('OTHER_SERVICES'));
    $promises = [];

    foreach ($services as $key => $service) {
      array_push($promises, ...[
        $key => $client->requestAsync('GET', $service . "/posts/get/$id")->then(function ($response) {
          echo $response->getBody() . "\n";
        })
      ]);
    }

    Promise\all($promises)->wait();
  }
/**
 * Deletes a post
 * @method deletePost
 * @param  Request $request Request class
 * @return string JSON containing deleted post id and success value
 */
  public function deletePost( Request $request )
  {
    $client = new Client();
    $services  = explode(',', env('OTHER_SERVICES'));
    $promises = [];
    $id = $request->input('id');

    foreach ($services as $key => $service) {
      array_push($promises, ...[
        $key => $client->requestAsync('DELETE', $service . "/posts/delete?id=$id")->then(function ($response) {
          echo $response->getBody() . "\n";
        })
      ]);
    }

    Promise\all($promises)->wait();
  }
/**
 * Inserts a post to the DB
 * @method insertPost
 * @param  Request $request Request class
 * @return string JSON object of inserted post values
 */
  public function insertPost( Request $request )
  {
    $client = new Client();
    $services  = explode(',', env('OTHER_SERVICES'));
    $promises = [];
    $user_id = $request->input('user_id');
    $title = $request->input('title');
    $content = $request->input('content');

    foreach ($services as $key => $service) {
      array_push($promises, ...[
        $key => $client->requestAsync('PUT', $service . "/posts/insert?user_id=$user_id&title=$title&content=$content")->then(function ($response) {
          echo $response->getBody() . "\n";
        })
      ]);
    }

    Promise\all($promises)->wait();
  }

  /**
   * [updatePost description]
   * @method updatePost
   * @param  Request $request [description]
   * @return {[type] [description]
   */
  public function updatePost( Request $request )
  {
    $client = new Client();
    $services  = explode(',', env('OTHER_SERVICES'));
    $promises = [];
    $id = $request->input('id');
    $user_id = $request->input('user_id');
    $title = $request->input('title');
    $content = $request->input('content');

    foreach ($services as $key => $service) {
      array_push($promises, ...[
        $key => $client->requestAsync('PUT', $service . "/posts/update?id=$id&user_id=$user_id&title=$title&content=$content")->then(function ($response) {
          echo $response->getBody() . "\n";
        })
      ]);
    }

    Promise\all($promises)->wait();
  }

}
