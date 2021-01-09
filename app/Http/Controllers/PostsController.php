<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Http\UploadedFile;            

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // if(request('tag')){
        //     $posts=Tag::where('name',request('tag'))->firstOrFail()->posts;
        // }
        // else{

            $posts = Post::orderBy('created_at','desc')->paginate(10);
        // }
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat=Category::all();
        return view('posts.create')->with('cat',$cat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'title'=> 'required',
            'body'=>'required',
            'category_id'=>'required',
            'cover_image'=>'image|nullable|max:50000'
            ]);
            if($request->hasFile('cover_image')){

                $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
                $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension=$request->file('cover_image')->getClientOriginalExtension();
                $fileNameToStore=$filename.'_'.time().'.'.$extension;
                $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
                
            } else{ 
                $fileNameToStore='noimage.jpg';
            }
            $post= new Post;
            $post->title=$request->input('title');
            $post->body=$request->input('body');
            $post->category_id=$request->input('category_id');
            $post->user_id=auth()->user()->id;
            $post->cover_image=$fileNameToStore;

            $post->save();
            return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
        $post= Post::find($id);
         
        
        return view('posts.show')->with('post',$post);
    }

    public function search(Request $request)
    {

        $search=$request->get('search');
        $posts=POST::where('title','like','%'.$search.'%')->paginate();
        return view('posts.index')->with('posts',$posts);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post= Post::find($id); 
        $cat=Category::all();


        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','UnAuth',);

        }

        $data=array('post'=>$post,'cat'=>$cat);

        
        return view('posts.edit')->with($data);
        // return view('posts.edit',['post'=> $post,'cat'=> $cat]);
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
        $this->validate($request,[
            'title'=> 'required',
            'body'=>'required',
            'category_id'=>'required']);

            if($request->hasFile('cover_image')){

                $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
                $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension=$request->file('cover_image')->getClientOriginalExtension();
                $fileNameToStore=$filename.'_'.time().'.'.$extension;
                $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
                
            } 
            $post= Post::find($id);
            $post->title=$request->input('title');
            $post->body=$request->input('body');
            $post->category_id=$request->input('category_id');
            if($request->hasFile('cover_image')){
                if ($post->cover_image != 'noimage.jpg') {
                    Storage::delete('public/cover_images/'.$post->cover_image);
                }
                $post->cover_image=$fileNameToStore;
            }
            $post->save();
            return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::find($id);

        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','UnAuth');

        }
        if ($post->cover_image != 'noimage.jpg') {
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts');

    }
}
