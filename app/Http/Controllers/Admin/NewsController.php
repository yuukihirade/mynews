<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //以下を追記した
    public function add()
    {
        // dd('addが動いた');
        return view('admin.news.create');
    }
    
    public function create()
    {
        // dd('createが動いた');
        return redirect('admin/news/create');
    }
}
