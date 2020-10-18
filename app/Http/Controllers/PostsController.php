<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('posts.index', ['posts' => $posts]);
    }
    
    public function create()
    {
        return view('posts.create');
    }
    
    public function store(Request $request)//formから送られてきたRequestを$requestとする？
    {
        $params = $request -> validate([ //$requestにvalidationをかけてを$paramsに格納する
            'title' => 'required|max:20',
            'body' => 'required|max:140',
            ]);
            
            Post::create($params); //PostDBに$paramsを保存する
            
            return redirect()->route('top');//topページに飛ばす
    }
    
    public function show($post_id)
    {
        $post = Post::findOrFail($post_id); //$post(詳細画面を出すpost)はPostモデルからidが"$post_id"であるものを探してきたもの
        return view('posts.show',['post'=>$post]);//postディレクトリのshowを返すけど、投稿は上記で探してきたもの
    }
    
    
    
    
    public function edit($post_id) 
    {
        $post = Post::findOrFail($post_id); //$post(編集する投稿)はPostモデルからidが"$post_id"であるものを探してきたもの
        return view('posts.edit',['post'=>$post]);//postsディレクトリの編集画面を返すけど、編集する投稿内容は上記の結果
    }
    
    
    
    
    public function update($post_id, Request $request)//編集するのは$post_idで、formから送られてきたものを$requestとする
    {
        $params = $request -> validate([ //編集内容にvalidationをかけて$paramsに格納する
            'title' => 'required|max:20',
            'body' => 'required|max:140',
            ]);
            
            $post = Post::findOrFail($post_id); //$post(編集する投稿は)Postモデルからidが$post_idのものを探してくる
            $post->fill($params)->save(); //特定された$postを$paramsに上書き？して保存する
            
            return redirect()->route('top');
    }
    
    
    
    public function destroy($post_id)//削除するのは$post_id
    {
            $post = Post::findOrFail($post_id); //$post(編集する投稿は)Postモデルからidが$post_idのものを探してくる
            $post->delete(); //特定された$postを削除
            
            return redirect()->route('top');
    }
}

