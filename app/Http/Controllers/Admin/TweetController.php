<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tweet;

use App\Models\TweetHistory;

use Carbon\Carbon;

class TweetController extends Controller
{
   public function add()
   {
       //dd("addが動いた");
       return view('admin.tweet.create');
   }
   
   public function create(Request $request)
   {
      // dd($request);
      $this->validate($request, Tweet::$rules);
      // dd($form);
      $tweet = new Tweet;
      $form = $request->all();
      
      // フォームから画像が送信されてきたら、保存して、$tweet->image_pathに画像のパスを保存する
      if (isset($form['image'])) {
         $path = $request->file('image')->store('public/image');
         $tweet->image_path = basename($path);
      } else {
         $tweet->image_path = null;
      }
      // フォームから送信されてきた_tokenを削除する
      unset($tweet['_token']);
      // フォームから送信されてきたimageを削除する
      unset($tweet['image']);
      // dd($tweet);
      $tweet->fill($form);
      $tweet->save();
      
      return redirect('admin/tweet/create');
   }
   
   public function index(Request $request)
   {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
         // 検索されたら検索結果を取得する
         $posts = Tweet::where('title', $cond_title)->get();
      } else {
         // それ以外は全てのニュースを取得する
         $posts = Tweet::all();
      }
      
      return view('admin.tweet.index', ['posts'=> $posts, 'cond_title'=> $cond_title]);
   }
   //
   
   public function edit(Request $request)
   {
      // Tweet Modelからデータを取得する
      $tweet = Tweet::find($request->id);
      if (empty($tweet)) {
         abort(404);
      }
      return view('admin.tweet.edit', ['tweet_form' => $tweet]);
   }
   
   public function update(Request $request)
   {
      // Validationをかける
      $this->validate($request, Tweet::$rules);
      //Tweet Modelからデータを取得する
      $tweet = Tweet::find($request->id);
      // 送信されてきたフォームデータを格納する
      $tweet_form = $request->all();
      
      if ($request->remove == 'true') {
          $tweet_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = $request->file('image')->store('public/image');
          $tweet_form['image_path'] = basename($path);
      } else {
          $tweet_form['image_path'] = $tweet->image_path;
      }

      unset($tweet_form['image']);
      unset($tweet_form['remove']);
      unset($tweet_form['_token']);
      
      // 該当するデータを上書きして保存する
      $tweet->fill($tweet_form)->save();
      
      $tweet_history = new TweetHistory;
      $tweet_history->tweet_id = $tweet->id;
      $tweet_history->edited_at = Carbon::now();
      $tweet_history->save();
      
      return redirect('admin/tweet');
   }
   
   public function delete(Request $request)
   {
      // 該当するTweet Modelを取得
      $tweet = Tweet::find($request->id);
      
      // 削除する
      $tweet->delete();
      
      return redirect('admin/tweet');
   }
}
