<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller {

    
    function __construct() {
        $this->middleware('auth');
    }

    
    public function Like($ImageId) {
        $User= \Auth::User();
        
        $Like_Exist= Like::where('User_Id',$User->id)->where('Image_Id',$ImageId)->exists();

        if(!$Like_Exist){
            $Like=new Like();
            
            $Like->Image_Id=$ImageId;
            $Like->User_Id=$User->id;
            
            $Like->Save();
            
            return response()->json([
                'Like'=>$Like
            ]);
        }else{
            return redirect()->route('DisLike',['ImageId'=>$ImageId]);
        }
        
    }
    
    
    public function DisLike($ImageId) {
        $User=\Auth::User();
        
        $Like=Like::where('User_Id',$User->id)->where('Image_Id',$ImageId)->first();
        
        if($Like){
            $Like->delete();
            
            return response()->json([
                'Like'=>$Like,
                'Message'=>'Has Dado DisLike'
            ]);
        }else{
            return response()->json([
                'Message'=>'El Like No Existe'
            ]);
        }
    }
    
    public function Count($ImageId) {
        $Like=new Like();
        $Count=$Like->where('Image_Id',$ImageId)->count();
        return response()->json([
            'Count'=>$Count
        ]);
    }
    
    public function getAll() {
        $User= \Auth::User();
        $Likes= Like::where('User_Id',$User->id)->orderBy('id','desc')->paginate(5);
        
        return view('Likes.Likes',[
            'Likes'=>$Likes
        ]);
            
    }
}