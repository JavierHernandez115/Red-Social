<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//use App\Image;
//Route::get('/', function () {
//   /* $Images=Image::all();
//    foreach($Images as $Image){
//        echo '<h4>'.$Image->User->name.' '.$Image->User->surname.'</h4>';
//        echo $Image->description.'<br/>';
//        echo $Image->imagePath.'<br/>';
//        if(count($Image->Comment)){
//            echo '<h4>Comentarios:</h4>';
//         foreach($Image->Comment as $Comment){
//             echo '<h5>'.$Comment->User->name.' '.$Comment->User->surname.'</h5>';
//             echo $Comment->content;
//         }   
//        }
//        echo '<br/><strong>Likes:</strong>'.count($Image->Like);
//        
//        echo '<hr/>';
//    }
//    
//    die();*/
//    return view('welcome');
//});

Auth::routes();
//Rutas Generales
Route::get('/', 'HomeController@index')->name('home');

//Usuario
Route::get('/config','UserController@Config')->name('Config');
Route::post('/User/Update','UserController@Update')->name('User.Update');
Route::get('/User/Avatar/{FileName}','UserController@getImage')->name('User.Avatar');
Route::get('/User/Profile/{Id}','UserController@Profile')->name('User.Profile');
Route::get('/User/get/{search?}','UserController@Index')->name('User.Index');
//Imagenes
Route::get('/Image/Create','ImageController@Create')->name('Image.Create');
Route::post('/Image/Save','ImageController@Save')->name('Image.Save');
Route::get('/Image/File/{FileName}','ImageController@ShowImage')->name('Image.Show');
Route::get('/Image/Details/{Id}','ImageController@Details')->name('Image.Details');
Route::get('/Image/Delete/{Id}','ImageController@Delete')->name('Image.Delete');
//Comentarios
Route::post('/Comment/Save','CommentController@Save')->name('Comment.Save');
Route::get('/Comment/Delete/{Id}','CommentController@Delete')->name('Comment.Delete');

//Likes
Route::get('/Like/Save/{ImageId}','LikeController@Like')->name('Like');
Route::get('/Like/Delete/{ImageId}','LikeController@DisLike')->name('DisLike');
Route::get('Like/Count/{ImageId}','LikeController@Count')->name('Like.Count');
Route::get('MyLikes','LikeController@getAll')->name('Like.getAll');