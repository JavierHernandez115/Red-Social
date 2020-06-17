@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Gente</h1>
            <form method="GET" action="#">
            <div class="row">
                <div class="form-group col">
                    <input type="text" id="search"  class="form-control"/>
                </div>
                <div class="form-grup col">
                    <input type="submit" value='Buscar' class="btn btn-success"/>
                </div>
            </div>
            </form>
            <hr>
            @foreach($Users as $User)
            <div class="ProfileUser AllProfiles">
                <a class="Link" href="{{route('User.Profile',['Id'=>$User->id])}}">
                    @if($User->Image)
                    <div class="AvatarContainer">
                        <img class="Avatar" src="{{route('User.Avatar',['FileName'=>$User->image])}}">                       
                    </div>
                    @endif
                    <div class="ProfileData">
                        <h2 class="Nick"> {{'@'.$User->nick}}</h2>
                        <h3>{{$User->name.' '.$User->surname}}</h3>                    
                        <p class="Nick Date">{{'Se Unio  '.\FormatTime::LongTimeFilter($User->created_at)}}</p>
                    </div>
                </a>
            </div>
            <div class="clearfix"></div>
            @endforeach
        </div>
    </div>
</div>
@endsection
