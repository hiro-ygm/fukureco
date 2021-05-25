<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use \InterventionImage;
use App\HashTag;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => [ 'create', 'store', 'edit', 'update', 'destroy' ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request , Post $posts)
    {
        #キーワード受け取り
        $keyword = $request->input('keyword');

        #クエリ生成
        $query = Post::query();

        #もしキーワードがあったら
        if (!empty($keyword)) {
            $query->where( DB::raw("DAYOFWEEK(created_at)"),$keyword);
        }
        $posts = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')
            ->with('posts', $posts)
            ->with('keyword', $keyword);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $this->validate($request, [
            'image' => 'required',
            'hash_tags' => ['string', 'max:255']
        ]);

        $filePath = $request->file('image')->getClientOriginalName();
        $image = $request->file('image');
        InterventionImage::make($image)->resize(510, 340)->save(public_path().'/storage'.$filePath);
        // InterventionImage::make($image)->resize(510, 340)->save(storage_path().'/app/public/'.$filePath);
     

        $post = new Post;
        $post->image = str_replace('public/', '', $filePath);
        $post->user_id = $request->user()->id;
        $post->save();

        //HashTagの新規保存
        $hash_tag_names = preg_split('/\s+/', $request->input('hash_tags'), -1, PREG_SPLIT_NO_EMPTY);
        $hash_tags_id = [];
        foreach ($hash_tag_names as $hash_tag_name) {
            //既存のレコードがあれば何もしない
            //なければ新規保存
            $hash_tag = HashTag::firstOrCreate([
                'name' => $hash_tag_name
            ]);

            $hash_tags_id[] = $hash_tag->id;
        }

        //中間テーブルの新規保存
        $post->hashTags()->sync($hash_tags_id);

        $request->session()->flash('flash_message', '新規投稿が完了しました');
        
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', [
            'post' => $post
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post = Post::find($post->id);

        if($request->file('image')){
            $filePath = $request->file('image')->store('public');
            // $post->image = str_replace('public/', '', $filePath);
            $post->image = basename($filePath);
        }
        $post->save();

        //HashTagの新規保存
        $hash_tag_names = preg_split('/\s+/', $request->input('hash_tags'), -1, PREG_SPLIT_NO_EMPTY);
        $hash_tags_id = [];
        foreach ($hash_tag_names as $hash_tag_name) {
            //既存のレコードがあれば何もしない
            //なければ新規保存
            $hash_tag = HashTag::firstOrCreate([
                'name' => $hash_tag_name
            ]);

            $hash_tags_id[] = $hash_tag->id;
        }

        //中間テーブルの新規保存
        $post->hashTags()->sync($hash_tags_id);

        $request->session()->flash('flash_message','投稿の更新が完了しました');

        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post = Post::find($post -> id);
        $post->delete();

        return redirect('/posts');
    }

    public function showByHashTag($id)
    {
        $hash_tag = HashTag::find($id);

        return view('posts.index',[
            'posts' => $hash_tag->posts
        ]);
    }
}
