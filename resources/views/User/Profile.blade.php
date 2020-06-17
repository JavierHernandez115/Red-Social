@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="ProfileUser">
                @if($User->Image)
                <div class="AvatarContainer">
                    <img class="Avatar" src="{{route('User.Avatar',['FileName'=>$User->image])}}">                       
                </div>
                @endif
                <div class="ProfileData">
                    <h1 class="Nick"> {{'@'.$User->nick}}</h1>
                    <h2>{{$User->name.' '.$User->surname}}</h2>                    
                    <p class="Nick Date">{{'Se Unio  '.\FormatTime::LongTimeFilter($User->created_at)}}</p>
                </div>
            </div>
            <div class="clearfix ClearProfile"></div>
            @foreach($User->Image as $Images)
            @include('includes.Publicacion',['Image'=>$Images])
            @endforeach
        </div>
    </div>


</div>
@endsection