@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card UserPub">
                <div class="card-header">Subir Nueva Imagen</div>
                <div class="card-body">
                    <form method="POST" action="{{route('Image.Save')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="ImagePath" class="col-md-3 col-form-label text-md-right">Imagen</label>
                            <div class="col-md-7">
                                <input id="ImagePath" type="file" name="ImagePath" class="form-control{{ $errors->has('ImagePath') ? ' is-invalid' : '' }}" required/>
                                @if ($errors->has('ImagePath'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('ImagePath') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ImageDesc" class="col-md-3 col-form-label text-md-right">Descripcion</label>
                            <div class="col-md-7">
                                <textarea name="ImageDesc" class="form-control{{ $errors->has('ImageDesc') ? ' is-invalid' : '' }}" required></textarea>
                            @if($errors->has('ImageDesc'))
                            <span class="invalid-feedback" role='alert'>
                                <strong>{{$errors->first('ImageDesc')}}</strong>
                            </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group row"> 
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary">Guardar Imagen</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection