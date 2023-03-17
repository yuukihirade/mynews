<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

use App\Models\ProfileHistory;

use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $cond_name = $request->cond_name;
        if($cond_name != ''){
            // 検索されたら検索結果を取得する
            $posts = Profile::where('name', $cond_name)->get();
        } else {
            // それ以外は全てのニュースを取得する
            $posts = Profile::all();
        }
        return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
    }
    //
    public function add()
    {
        // $profile = new Profile;

        // $profile->name = "麻生太郎";
        // $profile->gender = "男";
        // $profile->hobby = "ゴルフ";
        // $profile->introduction = "よろしく";
        
        // $profile->save();
        //dd("addが動いた");
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        // $this->validate($request, Profile::$rules);
        
        $profile = new Profile;
        // $form = $request->all();
        
        // unset($form['_token']);
        
        // $profile->fill($form);
        $profile->name = $request->hoge;
        $profile->gender = $request->gender;
        $profile->hobby = $request->hobby;
        $profile->introduction = $request->introduction;
        $profile->save();
        //dd("createが動いた");
        return redirect('admin/profile');
    }
    
    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        if(empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }
    
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Profile::$rules);
        // News Modelからデータをを取得する
        $profile = Profile::find($request->id);
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();
        unset($profile_form['_token']);
        
        // 該当するデータを上書きして保存する
        $profile->fill($profile_form)->save();
        
        //編集履歴を表示
        $profile_history = new ProfileHistory();
        $profile_history->profile_id = $profile->id;
        $profile_history->edited_at = Carbon::now();
        $profile_history->save();
        
        return redirect('admin/profile');
    }
    
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $profile = Profile::find($request->id);
        
        // 削除する
        $profile->delete();
        
        return redirect('admin/profile/');
    }
}