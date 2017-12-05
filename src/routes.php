<?php

use App\App;
use App\Models\Post;

return [
    [
        'method' => 'POST',
        'pattern' => '/',
        'handler' => function($request){
            return App::render('main');
        }
    ],
    
    [
        'method' => 'POST',
        'pattern' => '/posts',
        'handler' => function ($request) {
            return App::json(Post::all());
        }
    ],
    
    [
        'method' => 'POST',
        'pattern' => '/posts/(\d+)',
        'handler' => function($request, $id){
            return App::json(Post::find($id));
        }
    ],
    
    // TODO: URL it in rest way
    [
        'method' => 'POST',
        'pattern' => '/posts/create',
        'handler' => function($request){
            $post = Post::create($request['json']);
            return App::json($post);
        }
    ],
    
    //TODO: Create an a form to fill DB columns
    [
        'method' => 'POST',
        'pattern' => '/posts/new',
        'handler' => function(){
            $data = [
                "title"=>$_GET['title'],
                "content"=>$_GET['content'],
                "author"=>$_GET['author']
            ];
            $post = Post::create($data);
            return App::json($post);
        }
    ],
    
    [
        'method' => 'POST',
        'pattern' => "/posts/delete",
        'handler' => function($request){
            $id = $request['json'];
            Post::find($id);
            $result = Post::destroy($request['json']);
            $msg = 'Item Was Deleted Successfully';
            return $result.$msg;
        }
    ]
];