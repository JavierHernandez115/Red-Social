@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Mis Imagenes Favoritas</h1>
            @foreach($Likes as $Like)
                @include('Includes.Publicacion',['Image'=>$Like->image])
            @endforeach
            <div class="clearfix"></div>
            {{$Likes->links()}}
        </div>
    </div>


</div>
@endsection
