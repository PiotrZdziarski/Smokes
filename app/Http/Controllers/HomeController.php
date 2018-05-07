<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Redirect;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $memes = DB::table('memes')->orderBy('id', 'desc')->get();
      $categories = DB::table('categories')->get();
      if(isset(Auth::user()->name)) {
        $user = Auth::user()->name;
        $users = DB::table('users')->where('name', $user)->get();
        return view('home' ,['memes' => $memes, 'users' => $users, 'categories' => $categories]);
      }

      return view('home' ,['memes' => $memes, 'categories' => $categories]);
    }


    public function mem($id)
    {
      $meme = DB::table('memes')->where('id', $id)->get();
      $comments = DB::table('comments')->where('memid', $id)->orderBy('id', 'desc')->get();
      $categories = DB::table('categories')->get();

      if(isset(Auth::user()->name)) {
        $loggeduser = Auth::user()->name;
        $users = DB::table('users')->where('name', $loggeduser)->get();
        return view('sites.mem', ['meme' => $meme, 'users'=> $users, 'comments' => $comments, 'categories' => $categories]);
      }

      return view('sites.mem', ['meme' => $meme, 'comments' => $comments, 'categories' => $categories]);
    }


    public function categories($category)
    {
      $memes = DB::table('memes')->where('category', $category)->orderBy('id', 'desc')->get();
      $categories = DB::table('categories')->orderBy('id', 'desc')->get();
      if(isset(Auth::user()->name)) {
        $user = Auth::user()->name;
        $users = DB::table('users')->where('name', $user)->get();
        return view('sites.category' ,['memes' => $memes, 'users' => $users, 'categories' => $categories, 'searchedcategory' => $category]);
      }

      return view('sites.category' ,['memes' => $memes, 'categories' => $categories, 'searchedcategory' => $category]);
    }


    public function page($pageid)
    {
      $memes = DB::table('memes')->where('page', $pageid)->orderBy('id', 'desc')->get();

      $backerchakerDB = DB::table('memes')->orderBy('page', 'desc')->get();
      $count= 0;
      foreach($backerchakerDB as $backerchaker) {
        $count++;
      }

      $checkerbacker = "youcanback";

      $pagenumber = floor($count / 20);
      if($pageid >= $pagenumber || is_int($count/20)) {
        $checkerbacker = "nobacking";
      }
      $categories = DB::table('categories')->orderBy('id', 'desc')->get();
      if(isset(Auth::user()->name)) {
        $user = Auth::user()->name;
        $users = DB::table('users')->where('name', $user)->get();
        return view('sites.page' ,['memes' => $memes, 'users' => $users, 'categories' => $categories, 'checkerbacker' => $checkerbacker, 'pageid' => $pageid]);
      }


      return view('sites.page' ,['memes' => $memes, 'categories' => $categories, 'checkerbacker' => $checkerbacker, 'pageid' => $pageid]);
    }



    public function previouspage(Request $request)
    {
      $pageid = $request->input('pageid');
      $pageid += 1;
      return redirect()->route('sites.page', ['pageid' => $pageid]);
    }


    public function nextpage(Request $request)
    {
      $pageid = $request->input('pageid');
      $pageid -= 1;
      return redirect()->route('sites.page', ['pageid' => $pageid]);
    }

    public function mainpage()
    {
      $countDB =DB::table('memes')->get();
      $count = 0;
      foreach($countDB as $memescount){
        $count++;
      }
      if(is_int($count/20)) {
        $mainpagenumber = floor($count/20) - 1;
        return Redirect::to("/page/$mainpagenumber");
      }
      $mainpagenumber = floor($count/20);
      return Redirect::to("/page/$mainpagenumber");
    }



}
