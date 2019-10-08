<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;

class ProfileController extends Controller
{

    use UploadTrait;

    public function __construct(){
        $this->middleware('auth');  //So only authenticated users will be able to update their profile
    }

    public function index(){
        return view('auth.profile');
    }

    public function updateProfile(Request $request){

        //Form Validation
        $request->validate([
            'name'              =>  'required',
            'designation'       =>  'required',
            'profile_image'     =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        //get current user
        $user = User::findOrFail(auth()->user()->id);
        //set user name
        $user->name = $request->input('name');
        $user->designation = $request->input('designation');
        if($request->has('profile_image')){

            //Get image file
            $image = $request->file('profile_image');

            //Make an imagee name based on username and current timestamp
            $name = str_slug($request->input('name')).'_'.time();
            
            //Define folder path
            $folder = '/uploads/images/';

            //Make a file path where image will be stored
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();

            //Upload image
            $this->uploadOne($image, $folder, 'public', $name);

            //Set user profile image path in databse to filePath
            $user->profile_image = $filePath;
        }
    
        //Save user record to database
        $user->save();

        //Redirect user
        return redirect()->back()->with(['status' => 'Profile updated successfully']);
    }
}
