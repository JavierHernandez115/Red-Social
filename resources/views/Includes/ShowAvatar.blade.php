@if(Auth::User()->image)
<div class="AvatarContainer">
    <img class="Avatar" src="{{route('User.Avatar',['FileName'=>Auth::User()->image])}}"/>
</div>
@endif