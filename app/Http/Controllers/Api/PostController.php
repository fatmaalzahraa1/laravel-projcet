<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts= Post::all();
        return PostResource::collection($posts);
        //  $response=[];
        //  foreach ($posts as $post){
        //     $response[]=[
        //         'id'=> $post->id,
        //         'title'=>$post->title,
        //     ];
        //  }
        //  return $response;
    }

    public function show($postId)
    {
        $post= post::find($postId); 
        return new PostResource($post);
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->all();
        $title = $data['title'];
        $description = $data['desc'];
        $postCreator = $data['creator'];

        $posts = post::create([
            'title' => $title,
            'desc' => $description,
            'user_Id' => $postCreator,
            // 'slug' => \Str::slug($request->slug)
        ]);
        return $posts;
    }


}
