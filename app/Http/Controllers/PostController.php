<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //$posts =  Post::orderBy('title','desc')->get();
       //$posts = Post::where('title', "Post two")->get();
       //$posts = DB::select('SELECT * FROM posts');
       //$posts = Post::All();
       //$posts =  Post::orderBy('title','desc')->take(1)->get();
       $posts =  Post::orderBy('created_at','desc')->paginate(6);
       return view('posts.index')->with('posts',$posts);
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
    public function store(Request $request)
    {
        $this->validate($request,[
        'title' => 'required',
        'body' => 'required',
        'cover_image' => 'image|nullable|max:1999'
        ]);

            //handle file upload, serve per rendere il nome del file unico in modo da non creare problemi
            if($request -> hasFile('cover_image')){
                

                //get filename with the extension
                $filenameWithExt = $request -> file('cover_image')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extansion
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                //filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                //upload image
                $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            }else{
                $fileNameToStore="noimage.jpg";
            }

       //create post
        $post =new Post;
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->user_id=auth()->user()->id;
        $post->cover_image=$fileNameToStore;
        $post->save();

       return redirect('/post')->with('success','Post created!');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post= Post::find($id);

        //check for correct user
        if((auth()->user()->id) !== ($post->user_id)){
            return redirect('/post')->with('error',"Unauthorized page.");
        }
        return view('posts.edit')->with('post',$post);
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
            'title' => 'required',
            'body' => 'required'
            ]);
    
              //handle file upload, serve per rendere il nome del file unico in modo da non creare problemi
              if($request -> hasFile('cover_image')){
                

                //get filename with the extension
                $filenameWithExt = $request -> file('cover_image')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extansion
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                //filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                //upload image
                $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            }else{
                $fileNameToStore="noimage.jpg";
            }

       //create post
       $post =Post::find($id);
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->user_id=auth()->user()->id;
        
        
          

            if((auth()->user()->id) !== ($post->user_id)){
                return redirect('/post')->with('error',"Unauthorized page.");
            }

            if($request->hasFile('cover_image')){
                $post->cover_image=$fileNameToStore;
            }

            $post->save();
            
           return redirect('/post')->with('success','Post created!');
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

        if((auth()->user()->id) !== ($post->user_id)){
            return redirect('/post')->with('error',"Unauthorized page.");
        }

        if($post->cover_image != 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();

        return redirect('/post')->with('success','Post removed');
    }
}
