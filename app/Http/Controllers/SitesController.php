<?php

namespace App\Http\Controllers;
use Redirect;
use Auth;
use Illuminate\Support\Facades\Input;
use Storage;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SitesController extends Controller
{
    public function throwing()
    {
      $this->middleware('auth');
      $categories = DB::table('categories')->orderBy('id', 'desc')->get();
      $types = DB::table('types')->orderBy('id', 'asc')->get();
      return view('sites.throwing', ['categories' => $categories, 'types' => $types]);
    }

    public function throwsmoke(Request $request)
    {
      $author = Auth::user()->name;
      $title = $request->input('title');
      $category = $request->input('category');
      $tags = $request->input('tags');
      $type = $request->input('type');

      //Storage::putFile('images', $request->file('meme312'));
      //$exists = Storage::disk('s3')->exists($filename);


      if(Input::hasFile('meme312')) {
      //$path = $request->file('meme312')->store('storage/images');

        $file = Input::file('meme312');
        $filename = $file->getClientOriginalName();
        $file->move('storage/images', $file->getClientOriginalName());
        //echo '<img src="storage/images/'.$file->getClientOriginalName().'" />';
      }

      DB::table('awaitingmemes')->insert(['author' => $author, 'title' =>$title, 'category' => $category, 'tags' =>$tags, 'meme' => $filename, 'type' => $type]);

      return Redirect::to('/afterthrowing');

    }


    public function checkingmemes()
    {
      $awaitingmemes = DB::table('awaitingmemes')->orderBy('id', 'desc')->get();
      return view('sites.checkingmemes', ['awaitingmemes' => $awaitingmemes]);
    }

    public function acceptmem(Request $request)
    {
      $id = $request->input('id');
      $author = $request->input('author');
      $title = $request->input('title');
      $category = $request->input('category');
      $tags = $request->input('tags');
      $meme = $request->input('meme');
      $type= $request->input('type');

      $pagesDB = DB::table('memes')->orderBy('page','desc')->get();
      $memescount = 0;
      foreach($pagesDB as $page) {
        $memescount++;
      }
      $page = floor($memescount/20);

      DB::table('memes')->insert(['author' => $author,'page' => $page, 'title' =>$title, 'category' => $category, 'tags' =>$tags, 'meme' => $meme, 'type' => $type, 'likes' => 0, 'dislikes' => 0, 'likedusers' => '']);
      DB::table('awaitingmemes')->where('id', $id)->delete();

      return back();
    }

    public function declinemem(Request $request)
    {
      $id = $request->input('id');
      $author = $request->input('author');
      $title = $request->input('title');
      $category = $request->input('category');
      $tags = $request->input('tags');
      $meme = $request->input('meme');

      DB::table('awaitingmemes')->where('id', $id)->delete();

      return back();
    }

    public function afterthrowing()
    {
      return view('sites.afterthrowing');
    }


    public function report(Request $request)
    {
      $id = $request->input('id');
      $meme = $request->input('meme');
      $title = $request->input('title');
      $memecategory = $request->input('memecategory');
      $tags = $request->input('tags');
      $reportcategories = DB::table('reportcategories')->get();
      $type = $request->input('type');
      $author = $request->input('author');
      $pageid = $request->input('pageid');



      return view('sites.report', ['id' => $id, 'pageid'=> $pageid, 'type' => $type, 'reportcategories' => $reportcategories,
      'meme' => $meme, 'title' => $title, 'memecategory' => $memecategory, 'tags' => $tags, 'author' => $author]);
    }


    public function reporting(Request $request)
    {
      $reporttext = $request->input('reporttext');
      $category = $request->input('category');
      $memeid = $request->input('memeid');
      $meme = $request->input('meme');
      $title = $request->input('title');
      $memecategory = $request->input('memecategory');
      $tags = $request->input('tags');
      $type = $request->input('type');
      $author = $request->input('author');
      $pageid = $request->input('pageid');



      DB::table('reports')->insert(['memeid' => $memeid, 'category' => $category, 'reporttext' => $reporttext,
      'meme' =>$meme, 'title' => $title, 'memecategory' => $memecategory, 'tags' => $tags, 'type' => $type, 'author' => $author]);
      return view('sites.afterreporting', ['pageid' => $pageid]);
    }

    public function adminreports()
    {
      $reports = DB::table('reports')->orderBy('id', 'desc')->get();

      return view('sites.checkingreports', ['reports' => $reports]);
    }


    public function reportdeleting(Request $request)
    {
      $id = $request->input('id');

      DB::table('reports')->where('id', $id)->delete();

      return back();
    }

    public function reportdeletingmem(Request $request)
    {
      $memeid = $request->input('memeid');
      $id = $request->input('id');

      DB::table('reports')->where('id', $id)->delete();
      DB::table('memes')->where('id', $memeid)->delete();

      return back();
    }


    public function afterreportingmethod(Request $request)
    {
      $pageid = $request->input('pageid');


      return Redirect::to("/page/$pageid");
    }



}
