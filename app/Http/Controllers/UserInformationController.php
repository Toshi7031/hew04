<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Information;
use App\Models\User;
use DB;

class UserInformationController extends Controller
{
    public function index()
    {
        $data = Information::select()->join('user_informations','user_informations.information_id','=','informations.id')->where('user_informations.user_id',Auth::user()->id)->orwhere('user_informations.user_id',0)->get();
        return view('userinformation');
    }
}