<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects =  Project::orderBy('created_at','desc')->paginate(10);
        return view('projects.index')->with('projects',$projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
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
            'role' => 'required',
            'skills' => 'required',
            'text' => 'required',
            'project_image' => 'image|max:1999|required',
            'project_bg' => 'image|nullable|max:1999',
            'link'=>'nullable'

            ]);
    
            //handle file upload, serve per rendere il nome del file unico in modo da non creare problemi
            if($request -> hasFile('project_image')){
                

                //get filename with the extension
                $filenameWithExt = $request -> file('project_image')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extansion
                $extension = $request->file('project_image')->getClientOriginalExtension();
                //filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                //upload image
                $path = $request->file('project_image')->storeAs('public/project_images', $fileNameToStore);
            }else{
                $fileNameToStore="noprojectimage.jpg";
            }

              //handle file upload, serve per rendere il nome del file unico in modo da non creare problemi
              if($request -> hasFile('project_bg')){
                

                //get filename with the extension
                $filenameWithExt = $request -> file('project_bg')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extansion
                $extension = $request->file('project_bg')->getClientOriginalExtension();
                //filename to store
                $bgFileNameToStore= $filename.'_'.time().'.'.$extension;
                //upload image
                $path = $request->file('project_bg')->storeAs('public/project_images', $bgFileNameToStore);
            }else{
                $bgFileNameToStore="noprojectimage.jpg";
            }
    
           //create post
            $post =new Project;
            $post->title=$request->input('title');
            $post->role=$request->input('role');
            $post->text=$request->input('text');
            $post->user_id=auth()->user()->id;
            $post->skills=$request->input('skills');
            $post->link=$request->input('link');
            $post->project_image=$fileNameToStore;
            $post->project_bg=$bgFileNameToStore;
            $post->save();
    
           return redirect('/projects')->with('success','Project created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projects= Project::find($id);
        return view('projects.show')->with('projects',$projects);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project= Project::find($id);

        //check for correct user
        if((auth()->user()->id) !== ($project->user_id)){
            return redirect('/projects')->with('error',"Unauthorized page.");
        }
        return view('projects.edit')->with('project',$project);
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
            'role' => 'required',
            'skills' => 'required',
            'text' => 'required',
            'link'=>'nullable'

            ]);
    
            //handle file upload, serve per rendere il nome del file unico in modo da non creare problemi
            if($request -> hasFile('project_image')){
                

                //get filename with the extension
                $filenameWithExt = $request -> file('project_image')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extansion
                $extension = $request->file('project_image')->getClientOriginalExtension();
                //filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                //upload image
                $path = $request->file('project_image')->storeAs('public/project_images', $fileNameToStore);
            }else{
                $fileNameToStore="noprojectimage.jpg";
            }

              //handle file upload, serve per rendere il nome del file unico in modo da non creare problemi
              if($request -> hasFile('project_bg')){
                

                //get filename with the extension
                $filenameWithExt = $request -> file('project_bg')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extansion
                $extension = $request->file('project_bg')->getClientOriginalExtension();
                //filename to store
                $bgFileNameToStore= $filename.'_'.time().'.'.$extension;
                //upload image
                $path = $request->file('project_bg')->storeAs('public/project_images', $bgFileNameToStore);
            }else{
                $bgFileNameToStore="noprojectimage.jpg";
            }
    
           //create post
            $post =Project::find($id);
            $post->title=$request->input('title');
            $post->role=$request->input('role');
            $post->text=$request->input('text');
            $post->user_id=auth()->user()->id;
            $post->skills=$request->input('skills');
            $post->link=$request->input('link');
              



        if((auth()->user()->id) !== ($post->user_id)){
            return redirect('/projects')->with('error',"Unauthorized page.");
        }

        if($request->hasFile('project_image')){
            $post->project_image=$fileNameToStore;
        }
        if($request->hasFile('project_bg')){
            $post->project_bg=$bgFileNameToStore;  
        }

        $post->save();
        
       return redirect('/projects')->with('success','Project edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Project::find($id);

        if((auth()->user()->id) !== ($post->user_id)){
            return redirect('/projects')->with('error',"Unauthorized page.");
        }

        if($post->project_image != 'noprojectimage.jpg'){
            //Delete Image
            Storage::delete('public/project_images/'.$post->project_image);
        }
        if($post->project_bg != 'noprojectimage.jpg'){
            //Delete Image
            Storage::delete('public/project_images/'.$post->project_bg);
        }

        $post->delete();

        return redirect('/projects')->with('success','Project removed');
    }
}
