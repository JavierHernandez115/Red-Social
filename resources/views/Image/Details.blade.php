@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card UserPub UserPubDetails">
                <div class="card-header">
                    <div class="UserData">
                        <?php $User = \Auth::User() ?>
                        @if($Image->User->image)
                        <div class="AvatarContainer">
                            <img class="Avatar" src="{{route('User.Avatar',['FileName'=>$Image->User->image])}}">                       
                        </div>
                        @endif
                        <div class="UserName">
                            {{$Image->User->name.' '.$Image->User->surname}}
                            <span class="Nick">
                                {{' | @'.$Image->User->nick}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="PubImage">
                        <img src="{{route('Image.Show',['FileName'=>$Image->imagePath])}}">
                    </div>

                    <div class="Description">
                        <span class="Nick"> {{'@'.$Image->User->nick}}</span>
                        <span class="Nick Date">{{' | '.\FormatTime::LongTimeFilter($Image->created_at)}}</span>
                        <p>{{$Image->description}}</p>
                    </div>
                    <?php $UserLike = false ?>
                    @foreach($Image->Like as $Like)

                    @if($Like->User_Id==Auth::User()->id)
                    <?php $UserLike = true ?>
                    @endif
                    @endforeach
                    <div class="Likes">
                        @if($UserLike)
                        <img src="{{asset('Images/heart-red.png')}}" data-id="{{$Image->id}}" class="btn-Like">
                        @else
                        <img src="{{asset('Images/heart-gray.png')}}" data-id="{{$Image->id}}" class="btn-DisLike">
                        @endif
                        <span id="{{$Image->id}}" class="CountLikes">{{Count($Image->Like)}}</span>
                    </div>

                    @if($Image->User->id==Auth::User()->id)
                    <div class="Actions">
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
                        Eliminar
                        </button>
                       

                       


                    </div>
                     <!-- The Modal -->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">¿Estas Seguro?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        Si Borras Esta Imagen Nunca Podras Reuperarla ¿estas seguro
                                        que deseas Borrarla?
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                        <a href="{{route('Image.Delete',['Id'=>$Image->id])}}" class="btn  btn-danger">Borrar</a>
                                    
                                    </div>

                                </div>
                            </div>
                        </div>

                    @endif
                    <div class="clearfix"></div>  
                    <div class="Comments">
                        <h2>Comentarios ({{count($Image->Comment)}})</h2>
                        <form method="POST" action="{{route('Comment.Save')}}" class=""> 
                            @csrf
                            <input type="hidden" name="Image_Id" value="{{$Image->id}}" required/>

                            <p>
                                <textarea class="form-control{{ $errors->has('Content') ? ' is-invalid' : '' }}"  name="Content" required placeholder="Agrega Un Comentario"></textarea>
                                @if($errors->has('Content'))
                                <span class="invalid-feedback" role='alert'>
                                    <strong>
                                        {{$errors->first('Content')}}
                                    </strong>
                                </span>
                                @endif
                            </p>

                            <button type="submit" class="btn btn-success">Publicar</button>
                        </form>
                        @include('Includes.ShowMessage')
                        @foreach($Image->Comment as $Comments)
                        <div class="CommentsContent">
                            <div class="AvatarContainer">
                                <img class="Avatar" src="{{route('User.Avatar',['FileName'=>$Comments->User->image])}}">                       
                            </div>
                            <div class="Description">
                                <span class="Nick"> {{'@'.$Comments->User->nick}}</span>
                                <span class="Nick Date">{{' | '.\FormatTime::LongTimeFilter($Comments->created_at)}}</span>
                                <p>{{$Comments->content}}</p>
                                @if($User && ($User->id==$Comments->User_Id || $User->id==$Comments->Image->User_Id))
                                <a class="btn btn-danger" href="{{route('Comment.Delete',['Id'=>$Comments->id])}}">Eliminar</a>
                                @endif
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection