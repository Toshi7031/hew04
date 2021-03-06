<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\ReportCategory;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class ReportController extends Controller
{
    public function index($user_id)
    {
        $categories = ReportCategory::All();
        $user = User::find($user_id);
        return view('report',compact('categories','user_id','user'));
    }

    // 通報をDBに保存
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required|int',
            'category' => 'required|int',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($req->all);
        }

        $user = Auth::user();

        $report = new Report;
        $report->target_id = $req->id;
        $report->sender_id = $user->id;
        $report->category_id = $req->category;
        $report->detail = $req->detail;
        $report->save();

        return redirect('report/'.$req->id)->with('message', '通報完了');
    }
}
