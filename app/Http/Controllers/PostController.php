<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Models\post;
use App\Models\User;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index(){
        $posts =post::paginate(2);
        // $post=DB::table('posts')->paginate(5);


            return view( 'posts.index', [
                'posts'=>$posts
            ]);


    }



    public function show($postId)
    {
        // $post = post::where('id', $postId)->first();
        $post= post::find($postId);

        return view('posts.show', ['post' => $post]);
    }





    public function create(){
        $Users=User::all();

        return view('posts.create' , [
            'Users' => $Users,
        ]);
    }






    public function store(StorePostRequest $request){
        $data = $request->all();
        // dd($data);
        $title = $data['title'];
        $description = $data['desc'];
        $postCreator = $data['creator'];

post::create([
    'title'=>$title,
    'desc'=>$description,
    'user_Id'=>$postCreator,
    'slug' => \Str::slug($request->slug)


]);


        return redirect(route('posts'));

    }

    public function destroy($postId){

        post::findOrfail($postId)->delete();
        return redirect('/posts');
      
    }

    public function restore(){
        $posts=post::withTrashed()->restore();

        return redirect('/posts');


    }
public function edit($postId){
    $post= post::findOrFail($postId);
    // dd($postId);
    $Users=User::all();

    return view('posts.edit', ['post' => $post,'Users' => $Users,
]);

}

public function update($postId , Request $request){
    $post= post::findOrFail($postId);
    $data = $request->all();
        // dd($data);
        $title = $data['title'];
        $description = $data['desc'];
        $postCreator = $data['creator'];
    $post->update([
        'title'=>$title,
        'desc'=>$description,
        'user_Id'=>$postCreator,


    ]);
    return redirect(route('posts'));


}



}