<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Campaign;
use App\Models\Music;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    public function index($music_id)
    {
        $music = Music::find($music_id)->first();
        if (Campaign::where('music_id',$music->id)->exists()) {
            // キャンペーン情報を取得
            $campaign = Campaign::where('music_id',$music->id)->first();
            // キャンペーン期間中であるか
            if ($campaign->end_date_time > Carbon::now()){
                $music->price -= round($music->price * ($campaign->discount / 100),-1);
            }
            // キャンペーンが終了している場合レコード物理削除
            else {
                Campaign::where('music_id',$music->id)->delete();
            }
        }

        $music->img_url = Storage::disk('s3')->url('image/music/' . $music->img_url);

        return view('music-detail',compact('music'));
    }
  
    public function rtmp()
    {
      return view('rtmp');
    }
}
