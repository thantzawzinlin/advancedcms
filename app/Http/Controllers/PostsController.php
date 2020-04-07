<?php

namespace App\Http\Controllers;

use App\Http\Requests\posts\PostStoreRequest;
use App\Http\Requests\posts\PostEditRequest;
use App\Post;
use App\Category;

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
        $category=Category::all();
        if($category->count()>0){
            return view('admin.posts.create')->with('categories',$category);
        }
         toastr()->success('You must created a category before creating any post.');
        return redirect()->route('categories.create');
        
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
            'published_at'=>$request->published_at,
            'category_id'=>$request->category_id
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
        return view('admin.posts.create')->with('post',$post)
                                        ->with('categories',Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostEditRequest $request,Post $post)
    {
        $data=$request->only(['title','content','published_at','image','category_id']);
        if($request->hasFile('image')){
           //insert image to folder
           $image=$request->image->store('posts');
            //delete old image from folder
           // Storage::delete($post->image);
           $post->DeleteImage();
            $data['image'] =$image;
        }
        $post->update($data);

        toastr()->success('You have successfully created new post.');
        return redirect()->route('posts.index');
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
        //Storage::delete($post->image);
         $post->DeleteImage();
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
