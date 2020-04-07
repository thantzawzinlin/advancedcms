<?php

namespace App\Http\Controllers;

use App\Http\Requests\posts\PostStoreRequest;
use App\Post;
use Illuminate\Support\Facades\Storage;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index')->with('posts',Post::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
       // dd($request->image->store('posts'));
        $image=$request->image->store('posts');
        Post::create([
            'title'=>$request->title,
            'image'=>$image,
            'content'=>$request->content,
            'published_at'=>$request->published_at
        ]);
        toastr()->success('You have successfully created new post.');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.create')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
       $post=Post::withTrashed()->where('id',$id)->firstOrFail();
       if($post->trashed()){
        Storage::delete($post->image);
        $post->forceDelete();
       }else{
        $post->delete();
       }
       
        toastr()->success('You have successfully deleted new post.');
            return redirect()->back();
        
    }
     public function trashed(){
        
         $trashed = Post::onlyTrashed()->get();
         
         return view('admin.posts.index')->with('posts',$trashed);
        // return view('admin.posts.index');
    }
    public function restore($id){
        //$post=Post::withTrashed()->find($id); //it work too

        $post=Post::withTrashed()->where('id',$id)->firstOrFail();
        $post->restore();
        //return view('admin.posts.index')->with('posts',$trashed);
         toastr()->success('You have successfully restore your post.');
           return redirect()->route('posts.index');
    }
    
   
}
