@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('Includes.ShowMessage')
            @foreach($Images as $Image)
                @include('Includes.Publicacion',['Image'=>$Image])
            @endforeach
            <div class="clearfix"></div>
            {{$Images->links()}}
        </div>
    </div>


</div>
@endsection
