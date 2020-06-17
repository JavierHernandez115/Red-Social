<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function Save(Request $request) {


        //Validacion
        $validate = $this->validate($request, [
            'Image_Id' => 'integer|required',
            'Content' => 'string|required'
        ]);
        $User = \Auth::User();
        $UserId = $User->id;
        $Comment = new Comment();
        
        //Recoger Datos del Formulario  
        $Content = $request->input('Content');
        $ImageId = $request->input('Image_Id');

        $Comment->Image_Id = $ImageId;
        $Comment->Content = $Content;

        $Comment->User_Id = $UserId;
        $Comment->save();

        return redirect()->route('Image.Details', ['Id' => $ImageId])
                        ->with([
                            'Message' => 'Comentario Publicado'
        ]);
    }
    
    public function Delete($Id) {
        $User=\Auth::User();
        $Comment= Comment::find($Id);
        if($User && ($Comment->User_Id== $User->id || $User->id== $Comment->Image->User_Id)){
            $Comment->delete();
            
            return redirect()->route('Image.Details',['Id'=> $Comment->Image->id])
                    ->with([
                        'Message'=>'El Comentario se ha Eliminado'
                    ]);
            
            
        }else{
            return redirect()->route('Image.Details',['Id'=> $Comment->Image->id])
                    ->with([
                        'Message'=>'NO SE HA ELIMINADO EL COMENTARIO'
                    ]);
        }
            
        
    }

}
