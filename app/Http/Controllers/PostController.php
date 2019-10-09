<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\Traits\UploadTrait;

class PostController extends Controller
{
    use UploadTrait;

    public function __construct(){
        $this->middleware('auth');  //So only authenticated users will be able to update their profile
    }

    public function post(){
        $categories = Category::all();  //retrieves all categories from database onto the web page
        return view('posts.posts', ['categories' => $categories]);
    }

    public function addPost(Request $request){
        $request->validate([
            'post_title'      =>  'required',
            'post_body'       =>  'required',
            'category_id'     =>  'required',
            'post_image'      =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

                //get current post
                
                $posts = User::findOrFail(auth()->user()->id);
                //set post
                $posts->post_title = $request->input('post_title');
                $posts->post_body = $request->input('post_body');
                $posts->category_id = $request->input('category_id');
                if($request->has('post_image')){
        
                    //Get image file
                    $image = $request->file('post_image');
        
                    //Make an imagee name based on username and current timestamp
                    $name = str_slug($request->input('post_title')).'_'.time();
                    
                    //Define folder path
                    $folder = '/uploads/images/';
        
                    //Make a file path where image will be stored
                    $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
        
                    //Upload image
                    $this->uploadOne($image, $folder, 'public', $name);
        
                    //Set posts profile image path in databse to filePath
                    $posts->post_image = $filePath;
                }
            
                //Save posts record to database
                $posts->save();
        
                //Redirect user
                return redirect()->back()->with(['status' => 'Post submitted successfully']);

    }
}
