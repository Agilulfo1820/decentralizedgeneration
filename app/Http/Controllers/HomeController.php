<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Home;


class HomeController extends Controller
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

    public function index(){
        $home= Home::first();
        return view('pages.index',compact('home'));
    }

    public function create(){
        return view('pages.home_create_template');
    }

    public function store(Request $request){
       
        $this->validate($request,[
            'testo' => 'required'
            ]);
        
                //handle file upload, serve per rendere il nome del file unico in modo da non creare problemi
            if($request -> hasFile('my_image')){
                //get filename with the extension
                $filenameWithExt = $request -> file('my_image')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get just extansion
                $extension = $request->file('my_image')->getClientOriginalExtension();
                //filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                //upload image
                $path = $request->file('my_image')->storeAs('public/home_image', $fileNameToStore);
            }else{
                $fileNameToStore="no_image.jpg";
            }
    
            if($request -> hasFile('curriculum')){
                //get filename with the extension
                $curriculumnameWithExt = $request -> file('curriculum')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($curriculumnameWithExt, PATHINFO_FILENAME);
                //get just extansion
                $extension = $request->file('curriculum')->getClientOriginalExtension();
                //filename to store
                $curriculumNameToStore= $filename.'_'.time().'.'.$extension;
                //upload image
                $path = $request->file('curriculum')->storeAs('public/curriculum', $curriculumNameToStore);
            }else{
                $curriculumNameToStore="nessuncurriculum.pdf";
            }
    
            //create post
            $home= new Home;
            $home->testo=$request->input('testo');
            $home->user_id = auth()->user()->id;
    
            $home->about1_text=$request->input('about1_text');
            $home->about1_title=$request->input('about1_title');
    
            $home->about2_text=$request->input('about2_text');
            $home->about2_title=$request->input('about2_title');
            
            //handle file upload, serve per rendere il nome del file unico in modo da non creare problemi
            if($request -> hasFile('about1_image')){
                //get filename with the extension
                $about1_filenameWithExt = $request -> file('about1_image')->getClientOriginalName();
                //get just filename
                $about1_filename = pathinfo($about1_filenameWithExt, PATHINFO_FILENAME);
                //get just extansion
                $about1_extension = $request->file('about1_image')->getClientOriginalExtension();
                //filename to store
                $about1_fileNameToStore= $about1_filename.'_'.time().'.'.$about1_extension;
                //upload image
                $path = $request->file('about1_image')->storeAs('public/home_image', $about1_fileNameToStore);
            }else{
                $about1_fileNameToStore="no_image.jpg";
            }
    
            //handle file upload, serve per rendere il nome del file unico in modo da non creare problemi
            if($request -> hasFile('about2_image')){
                //get filename with the extension
                $about2_filenameWithExt = $request -> file('about2_image')->getClientOriginalName();
                //get just filename
                $about2_filename = pathinfo($about2_filenameWithExt, PATHINFO_FILENAME);
                //get just extansion
                $about2_extension = $request->file('about2_image')->getClientOriginalExtension();
                //filename to store
                $about2_fileNameToStore= $about2_filename.'_'.time().'.'.$about2_extension;
                //upload image
                $path = $request->file('about2_image')->storeAs('public/home_image', $about2_fileNameToStore);
            }else{
                $about2_fileNameToStore="no_image.jpg";
            }
            
            //$home->user_id=auth()->user()->id;
            
              
    
                // if((auth()->user()->id) !== ($home->user_id)){
                //     return redirect('/')->with('error',"Unauthorized page.");
                // }
    
            if($request->hasFile('my_image')){
                $home->my_image=$fileNameToStore;
            }
            if($request->hasFile('curriculum')){
                $home->curriculum=$curriculumNameToStore;
            }
            if($request->hasFile('about1_image')){
                $home->about1_image=$about1_fileNameToStore;
            }
            if($request->hasFile('about2_image')){
                $home->about2_image=$about2_fileNameToStore;
            }
    
            $home->save();
                
            return redirect('/')->with('success','Post created!');
    }

    public function home_edit(){
        $home= Home::orderBy('id','desc')->take(1)->get();
        return view('pages.home_update', compact('home'));
    }

    public function update(Request $request){

        $this->validate($request,[
        'testo' => 'required'
        ]);
    
            //handle file upload, serve per rendere il nome del file unico in modo da non creare problemi
        if($request -> hasFile('my_image')){
            //get filename with the extension
            $filenameWithExt = $request -> file('my_image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extansion
            $extension = $request->file('my_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('my_image')->storeAs('public/home_image', $fileNameToStore);
        }else{
            $fileNameToStore="no_image.jpg";
        }

        if($request -> hasFile('curriculum')){
            //get filename with the extension
            $curriculumnameWithExt = $request -> file('curriculum')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($curriculumnameWithExt, PATHINFO_FILENAME);
            //get just extansion
            $extension = $request->file('curriculum')->getClientOriginalExtension();
            //filename to store
            $curriculumNameToStore= $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('curriculum')->storeAs('public/curriculum', $curriculumNameToStore);
        }else{
            $curriculumNameToStore="nessuncurriculum.pdf";
        }

        //create post
        $home = Home::first();
        $home->testo=$request->input('testo');
        $home->user_id = auth()->user()->id;

        $home->about1_text=$request->input('about1_text');
        $home->about1_title=$request->input('about1_title');

        $home->about2_text=$request->input('about2_text');
        $home->about2_title=$request->input('about2_title');
        
        //handle file upload, serve per rendere il nome del file unico in modo da non creare problemi
        if($request -> hasFile('about1_image')){
            //get filename with the extension
            $about1_filenameWithExt = $request -> file('about1_image')->getClientOriginalName();
            //get just filename
            $about1_filename = pathinfo($about1_filenameWithExt, PATHINFO_FILENAME);
            //get just extansion
            $about1_extension = $request->file('about1_image')->getClientOriginalExtension();
            //filename to store
            $about1_fileNameToStore= $about1_filename.'_'.time().'.'.$about1_extension;
            //upload image
            $path = $request->file('about1_image')->storeAs('public/home_image', $about1_fileNameToStore);
        }else{
            $about1_fileNameToStore="no_image.jpg";
        }

        //handle file upload, serve per rendere il nome del file unico in modo da non creare problemi
        if($request -> hasFile('about2_image')){
            //get filename with the extension
            $about2_filenameWithExt = $request -> file('about2_image')->getClientOriginalName();
            //get just filename
            $about2_filename = pathinfo($about2_filenameWithExt, PATHINFO_FILENAME);
            //get just extansion
            $about2_extension = $request->file('about2_image')->getClientOriginalExtension();
            //filename to store
            $about2_fileNameToStore= $about2_filename.'_'.time().'.'.$about2_extension;
            //upload image
            $path = $request->file('about2_image')->storeAs('public/home_image', $about2_fileNameToStore);
        }else{
            $about2_fileNameToStore="no_image.jpg";
        }
        
        //$home->user_id=auth()->user()->id;
        
          

            // if((auth()->user()->id) !== ($home->user_id)){
            //     return redirect('/')->with('error',"Unauthorized page.");
            // }

        if($request->hasFile('my_image')){
            $home->my_image=$fileNameToStore;
        }
        if($request->hasFile('curriculum')){
            $home->curriculum=$curriculumNameToStore;
        }
        if($request->hasFile('about1_image')){
            $home->about1_image=$about1_fileNameToStore;
        }
        if($request->hasFile('about2_image')){
            $home->about2_image=$about2_fileNameToStore;
        }

        $home->save();
            
        return redirect('/')->with('success','Post created!');
    }


}
