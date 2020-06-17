<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;

class UserController extends Controller {

    function __construct() {
        $this->middleware('auth');
    }

    public function Config() {

        return view('User.Config');
    }

    public function Update(Request $request) {
        //Identificacion de los Usuarios

        $User = \Auth::User();
        $Id = $User->id;


        //ValidarFormulario
        $Validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,' . $Id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $Id,
        ]);

        //Recoger los datos del Formulario
        $Name = $request->input('name');
        $SurName = $request->input('surname');
        $Nick = $request->input('nick');
        $Email = $request->input('email');

        $User->name = $Name;
        $User->surname = $SurName;
        $User->nick = $Nick;
        $User->email = $Email;

        //Subir La Imagen
        $Image_Path = $request->file('ImagePath');
        if ($Image_Path) {
            //Poner Nombre Unico
            $Image_Path_Name = time() . $Image_Path->getClientOriginalName();

            //Guardar en la Carpeta Storage stprage/app/Users
            Storage::disk('Users')->put($Image_Path_Name, File::get($Image_Path));

            //Setear el nombre de la Imagen en la Tabla
            $User->image = $Image_Path_Name;
        }
        $User->Update();

        return redirect()->route('Config')->with(['Message' => 'Usuario Actualizado Correctamente']);
    }

    public function getImage($FileName) {
        $File = Storage::disk('Users')->get($FileName);
        return new Response($File, 200);
    }

    public function Profile($Id) {
        $User = User::find($Id);
        return view('User.Profile', [
            'User' => $User
        ]);
    }

    public function Index($Search = null) {
        if ($Seacrh && $Seacrch != null) {
            $Users=Userwhere();
        } else {
            $Users = User::get();
           
        }
         if ($Users) {
                return view('User.Index', ['Users' => $Users]);
            } else {
                return route('/');
            }
    }

}
