<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
    );
    
    // Profile Model と ProfileHistory Modelを関連付ける
    public function profile_histories()
    {
        return $this->hasMany('App\Models\ProfileHistory');
    }
}
