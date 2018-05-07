<?php

namespace App\Http\Controllers;

use Redirect;
use Auth;
use Illuminate\Support\Facades\Input;
use Storage;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class LikingComments extends Controller
{


    public function liking(Request $request)
    {
      $id = $request->input('likeid');
      $likes = $request->input('likes');
      $sendeduser = $request->input('sendeduser');
      $likesadded = $likes + 1;

      //GETTING VALUES FROM DB
      $checking = DB::table('memes')->where('id', $id)->get();
      foreach($checking as $check){
        $users =  $check->likedusers;
      }
      //SETTING IT TO TABLE
      $userstable = explode(",", $users);

      //CHECKING IF LIKING USER ISNT IN DATABASE
      foreach($userstable as $user){
        if($sendeduser == $user) {
          $communicat = "Already rated";
          return redirect()->action('HomeController@indexliking', ['id' => $id])->with('status', $id);
        }
      }
      //ADDING NON LIKED BEFORE USER TO DB
      $usersstring = implode("," , $userstable);
      $usersstring = $usersstring.",".$sendeduser;
      DB::table('memes')->where('id', $id)->update(['likedusers' => $usersstring]);
      DB::table('memes')->where('id', $id)->update(['likes' => $likesadded]);


      return redirect()->action('HomeController@indexliking' , ['id' => $id])->with('status', $id);
    }





    public function disliking(Request $request)
    {
      $id = $request->input('dislikeid');
      $dislikes = $request->input('dislikes');
      $sendeduser = $request->input('sendeduser');
      $dislikesadded = $dislikes + 1;

      //GETTING VALUES FROM DB
      $checking = DB::table('memes')->where('id', $id)->get();
      foreach($checking as $check){
        $users =  $check->likedusers;
      }
      //SETTING IT TO TABLE
      $userstable = explode(",", $users);

      //CHECKING IF DISLIKING USER ISNT IN DATABASE
      foreach($userstable as $user){
        if($sendeduser == $user) {
          $communicat = "Already rated";
          return redirect()->action('HomeController@indexliking' , ['id' => $id])->with('status', $id);
        }
      }
      //ADDING NON LIKED BEFORE USER TO DB
      $usersstring = implode("," , $userstable);
      $usersstring = $usersstring.",".$sendeduser;
      DB::table('memes')->where('id', $id)->update(['likedusers' => $usersstring]);
      DB::table('memes')->where('id', $id)->update(['dislikes' => $dislikesadded]);

      return redirect()->action('HomeController@indexliking' , ['id' => $id])->with('status', $id);
    }





    public function likingmem(Request $request)
    {
      $id = $request->input('likeid');
      $likes = $request->input('likes');
      $sendeduser = $request->input('sendeduser');
      $likesadded = $likes + 1;

      //GETTING VALUES FROM DB
      $checking = DB::table('memes')->where('id', $id)->get();
      foreach($checking as $check){
        $users =  $check->likedusers;
      }
      //SETTING IT TO TABLE
      $userstable = explode(",", $users);

      //CHECKING IF LIKING USER ISNT IN DATABASE
      foreach($userstable as $user){
        if($sendeduser == $user) {
          $communicat = "Already rated";
          return redirect("/$id")->with('status', $id);
        }
      }
      //ADDING NON LIKED BEFORE USER TO DB
      $usersstring = implode("," , $userstable);
      $usersstring = $usersstring.",".$sendeduser;
      DB::table('memes')->where('id', $id)->update(['likedusers' => $usersstring]);
      DB::table('memes')->where('id', $id)->update(['likes' => $likesadded]);


      return redirect("/$id")->with('status', $id);
    }





    public function dislikingmem(Request $request)
    {
      $id = $request->input('dislikeid');
      $dislikes = $request->input('dislikes');
      $sendeduser = $request->input('sendeduser');
      $dislikesadded = $dislikes + 1;

      //GETTING VALUES FROM DB
      $checking = DB::table('memes')->where('id', $id)->get();
      foreach($checking as $check){
        $users =  $check->likedusers;
      }
      //SETTING IT TO TABLE
      $userstable = explode(",", $users);

      //CHECKING IF DISLIKING USER ISNT IN DATABASE
      foreach($userstable as $user){
        if($sendeduser == $user) {
          $communicat = "Already rated";
          return redirect("/$id")->with('status', $id);
        }
      }
      //ADDING NON LIKED BEFORE USER TO DB
      $usersstring = implode("," , $userstable);
      $usersstring = $usersstring.",".$sendeduser;
      DB::table('memes')->where('id', $id)->update(['likedusers' => $usersstring]);
      DB::table('memes')->where('id', $id)->update(['dislikes' => $dislikesadded]);

      return redirect("/$id")->with('status', $id);
    }




    public function likingcategory(Request $request)
    {
      $id = $request->input('likeid');
      $likes = $request->input('likes');
      $sendeduser = $request->input('sendeduser');
      $category = $request->input('category');
      $likesadded = $likes + 1;

      //GETTING VALUES FROM DB
      $checking = DB::table('memes')->where('id', $id)->get();
      foreach($checking as $check){
        $users =  $check->likedusers;
      }
      //SETTING IT TO TABLE
      $userstable = explode(",", $users);

      //CHECKING IF LIKING USER ISNT IN DATABASE
      foreach($userstable as $user){
        if($sendeduser == $user) {
          $communicat = "Already rated";
          return redirect("/category/$category/#$id")->with('status', $id);
        }
      }
      //ADDING NON LIKED BEFORE USER TO DB
      $usersstring = implode("," , $userstable);
      $usersstring = $usersstring.",".$sendeduser;
      DB::table('memes')->where('id', $id)->update(['likedusers' => $usersstring]);
      DB::table('memes')->where('id', $id)->update(['likes' => $likesadded]);


      return redirect("/category/$category/#$id")->with('status', $id);
    }





    public function dislikingcategory(Request $request)
    {
      $id = $request->input('dislikeid');
      $dislikes = $request->input('dislikes');
      $sendeduser = $request->input('sendeduser');
      $category = $request->input('category');
      $dislikesadded = $dislikes + 1;

      //GETTING VALUES FROM DB
      $checking = DB::table('memes')->where('id', $id)->get();
      foreach($checking as $check){
        $users =  $check->likedusers;
      }
      //SETTING IT TO TABLE
      $userstable = explode(",", $users);

      //CHECKING IF DISLIKING USER ISNT IN DATABASE
      foreach($userstable as $user){
        if($sendeduser == $user) {
          $communicat = "Already rated";
          return redirect("/category/$category/#$id")->with('status', $id);
        }
      }
      //ADDING NON LIKED BEFORE USER TO DB
      $usersstring = implode("," , $userstable);
      $usersstring = $usersstring.",".$sendeduser;
      DB::table('memes')->where('id', $id)->update(['likedusers' => $usersstring]);
      DB::table('memes')->where('id', $id)->update(['dislikes' => $dislikesadded]);

      return redirect("/category/$category/#$id")->with('status', $id);
    }


    public function addcomment(Request $request)
    {
      $memid = $request->input('memid');
      $commentauthor = $request->input('commentauthor');
      $comment = $request->input('comment');
      $date = now();

      $commentdb = DB::table('memes')->where('id', $memid)->get();

      foreach($commentdb as $onecomment) {
        $comment_numberbefore = $onecomment->comment_number;
        $comment_number = $comment_numberbefore +1;
      }

      DB::table('comments')->insert(['memid' => $memid, 'authorcomment' => $commentauthor, 'comment' => $comment, 'date' => $date ]);
      DB::table('memes')->where('id', $memid)->update(['comment_number' => $comment_number]);

      return back();
    }



    public function commentdelete(Request $request)
    {
      $memeid = $request->input('commentid');
      $realmemid = $request->input('memeid');

      $commentdb = DB::table('memes')->where('id', $realmemid)->get();

      foreach($commentdb as $onecomment) {
        $comment_numberbefore = $onecomment->comment_number;
        $comment_number = $comment_numberbefore -1;
      }

      DB::table('comments')->where('id', $memeid)->delete();
      DB::table('memes')->where('id', $realmemid)->update(['comment_number' => $comment_number]);

      return back();
    }


    public function likingonpage(Request $request)
    {
      $id = $request->input('likeid');
      $likes = $request->input('likes');
      $sendeduser = $request->input('sendeduser');
      $pageid = $request->input('pageid');
      $likesadded = $likes + 1;

      //GETTING VALUES FROM DB
      $checking = DB::table('memes')->where('id', $id)->get();
      foreach($checking as $check){
        $users =  $check->likedusers;
      }
      //SETTING IT TO TABLE
      $userstable = explode(",", $users);

      //CHECKING IF LIKING USER ISNT IN DATABASE
      foreach($userstable as $user){
        if($sendeduser == $user) {
          $communicat = "Already rated";
          return Redirect::to("/page/$pageid/#$id")->with('status', $id);;
        }
      }
      //ADDING NON LIKED BEFORE USER TO DB
      $usersstring = implode("," , $userstable);
      $usersstring = $usersstring.",".$sendeduser;
      DB::table('memes')->where('id', $id)->update(['likedusers' => $usersstring]);
      DB::table('memes')->where('id', $id)->update(['likes' => $likesadded]);


      return Redirect::to("/page/$pageid/#$id")->with('status', $id);;
    }




    public function dislikingonpage(Request $request)
    {
      $id = $request->input('dislikeid');
      $dislikes = $request->input('dislikes');
      $sendeduser = $request->input('sendeduser');
      $pageid = $request->input('pageid');
      $dislikesadded = $dislikes + 1;

      //GETTING VALUES FROM DB
      $checking = DB::table('memes')->where('id', $id)->get();
      foreach($checking as $check){
        $users =  $check->likedusers;
      }
      //SETTING IT TO TABLE
      $userstable = explode(",", $users);

      //CHECKING IF DISLIKING USER ISNT IN DATABASE
      foreach($userstable as $user){
        if($sendeduser == $user) {
          $communicat = "Already rated";
          return Redirect::to("/page/$pageid/#$id")->with('status', $id);
        }
      }
      //ADDING NON LIKED BEFORE USER TO DB
      $usersstring = implode("," , $userstable);
      $usersstring = $usersstring.",".$sendeduser;
      DB::table('memes')->where('id', $id)->update(['likedusers' => $usersstring]);
      DB::table('memes')->where('id', $id)->update(['dislikes' => $dislikesadded]);

      return Redirect::to("/page/$pageid/#$id")->with('status', $id);
    }


}
