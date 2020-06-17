<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Comment;
use App\Like;

class ImageController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function Create() {
        return view('Image.Create');
    }

    public function Save(Request $request) {
        $User = \Auth::User();
        $UserId = $User->id;
        $Image = new Image();
        //Validar Los Datos

        $validate = $this->validate($request, [
            'ImageDesc' => 'required',
            'ImagePath' => 'required|image'
        ]);

        //Tomar Los Datos
        $ImagePath = $request->file('ImagePath');
        $ImageDesc = $request->input('ImageDesc');
        $Image->User_Id = $UserId;
        $Image->description = $ImageDesc;

        if ($ImagePath) {
            //Asignar Nombre Unico a la Imagen
            $ImagePathName = time() . $ImagePath->getClientOriginalName();
            //Guardarlo en El Disco
            Storage::disk('Images')->put($ImagePathName, File::get($ImagePath));

            //Guardar el Nombre de la Imagen En La BD

            $Image->imagePath = $ImagePathName;
            $Image->save();
        }

        return redirect()->route('home')->with(['Message' => 'Imagen Subida Con Exito']);
    }

    public function ShowImage($FileName) {
        $File = Storage::disk('Images')->get($FileName);

        return new Response($File, 200);
    }

    public function Details($Id) {
        $Image = Image::find($Id);
        return view('Image.Details', [
            'Image' => $Image
        ]);
    }

    public function Delete($Id) {
        $User = \Auth::User();
        $Image = Image::find($Id);
        if ($User && $User->id == $Image->User->id) {
            $Comments = Comment::where('Image_Id', $Id)->get();
            $Likes = Like::where('Image_Id', $Id)->get();

            if ($Comments->count() > 0) {
                foreach ($Comments as $Comment) {

                    $Comment->delete();
                }
            }

            if ($Likes->count() > 0) {
                foreach ($Likes as $Like) {
                    $Like->delete();
                }
            }
            Storage::disk('Images')->delete($Image->imagePath);
            $Image->delete();
            $Message=array('Message'=>'La Imagen se Ha Borrado Correctamente');
        }else{
            $Message=array('Message'=>'La Imagen No se Ha Borrado');
        }
        
        return redirect('/')->with($Message);
    }

}
