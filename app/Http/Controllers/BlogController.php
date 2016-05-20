<?php

namespace App\Http\Controllers;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller {
    
    public function index()     {
         return view('index',['posts'=>Post::all()]);
    }

    public function newPost()     {
        return view('new');
    }

    public function createPost(Request $request)   {
        // get the post
        $post = new Post();
        
        $post->title = $request['title'];
        $post->content = nl2br($request['content']);
        $post->save();

        return Redirect()->route('viewPost',['id'=>$post->id]);
    }

    // view a post by id
    public function viewPost($id)   {
        // get the post
        $post = Post::where('id',$id)->first();
        return view('view',['post'=>$post]);
    }

    // create a comment for a given post
    public function createComment(Request $request)     {
        // get the post that the user commented on
        $post = Post::find($request['postid']);
        echo 'hello'. $request;

        // create a new comment
        $comment = new Comment();
        $comment->name = $request['name'];
        $comment->content = nl2br($request['content']);
        $comment->post_id = $post->id;
        $comment->save();

        // save the comment with a relation to the post
        //$post->comments()->save($comment);

        // go back to the post
        return Redirect()->route('viewPost', ['id' => $post->id]);
  }

}

