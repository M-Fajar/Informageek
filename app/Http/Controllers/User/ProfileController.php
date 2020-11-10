<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Image;
use File;

class ProfileController extends Controller
{
    public function __invoke($username){
    
        $user = DB::table('users')->where('username',$username)->first();
        return response()->json(
            [
                'status' => 'success',
                'user' => [
                    
                'name' => $user->name,
                'username' =>  $user->username,
                'bio'=> $user->bio,
                'foto'=>$user->foto,
                'cover'=> $user->cover
                ]

            ],200
        );
    }
    public function me (Request $request ){
        $user = $request->user();
        return response()->json([
            'username' => $user->username,
            'foto' => $user->foto   
        ]);





    }
    
    public function updateAvatar(Request $request){
        //avatar
        $user = $request->user();
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg'
        ]);
        // Get file from request
      $file = $request->file('image');
      $imageAvatar =$this->resizeImage($file,'80'); //ratio avatar
      $imageProfile =$this->resizeImage($file,'480'); //ratio profile


      $fileNameToStore =$this->getNamePhoto($file);

      Image::make($imageProfile)->save(public_path('media/profile') . '/' . $fileNameToStore);
      $save =  Image::make($imageAvatar)->save(public_path('media/avatar') . '/' . $fileNameToStore);
      if($save){
          User::where('id',$user->id)->update(array('foto' => $fileNameToStore));
      }
        
    }

    public function updateCover(Request $request){
        //avatar
        $user = $request->user();
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,PNG'
        ]);
        // Get file from request
      $file = $request->file('image');
      
      $image = $this->resizeImage($file,'1500');
      $fileNameToStore = $this->getNamePhoto($file);

      $save =  Image::make($image)->save(public_path('media/cover') . '/' . $fileNameToStore);
      if($save){    
        User::where('id',$user->id)->update(array('cover' => $fileNameToStore));
        return json_encode('succes');
    }

    }

    
    public function getNamePhoto($file){
        // Get filename with extension
      $filenameWithExt = $file->getClientOriginalName();

      // Get file path
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

      // Remove unwanted characters
      $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
      $filename = preg_replace("/\s+/", '-', $filename);

      // Get the original image extension
      $extension = $file->getClientOriginalExtension();

      // Create unique file name
      $fileNameToStore = $filename.'_'.time().'.'.$extension;

        return $fileNameToStore;
    }
    

    public function resizeImage($file,$ratio){
        // Resize image
        $resize = Image::make($file)->resize($ratio, null, function ($constraint) {
           $constraint->aspectRatio();
         })->encode('jpg');
   
         // Create hash value
         $hash = md5($resize->__toString());
   
         // Prepare qualified image name
         $image = $hash."jpg";
         return $resize->__toString();

   }

    
}
