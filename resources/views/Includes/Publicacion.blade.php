<div class="card UserPub">
    <div class="card-header">
        <div class="UserData">
            @if($Image->User->image)
            <div class="AvatarContainer">
                <img class="Avatar" src="{{route('User.Avatar',['FileName'=>$Image->User->image])}}">                       
            </div>
            @endif
            <div class="UserName">
                <a href="{{route('User.Profile',['Id'=>$Image->User->id])}}">
                {{$Image->User->name.' '.$Image->User->surname}}
                <span class="Nick">
                    {{' | @'.$Image->User->nick}}
                </span>
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="PubImage">
            <a href="{{route('Image.Details',['Id'=>$Image->id])}}" role="button"><img src="{{route('Image.Show',['FileName'=>$Image->imagePath])}}"><a/>
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

        <div class="Comments">
            <a class="btn btn-Comments btn-sm btn-warning" href="">Comentarios ({{count($Image->comment)}})</a>
        </div>                    
    </div>
</div>
