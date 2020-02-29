<?php

namespace App\Http\Controllers\Admin;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Genre;
use App\Models\Music;
use App\Models\GenreMusic;
use App\Http\Controllers\Controller;
use getID3;
use getid3_lib;
use falahati\PHPMP3\MpegAudio;

class MusicUploadController extends Controller
{
  public function index()
  {
    //ジャンルの全件取得
    $genres = Genre::all();
    //アーティストの(ry
    $artists = Artist::all();
    //楽曲(ry
    $musics = Music::all();

    $page = true;
    return view('Admin/music_upload', compact('genres', 'artists', 'musics', 'page'));
  }

  public function musicStore(Request $request)
  {
    //それぞれのファイル名を取得
    $mp3_file_name = $request->file('musicfile')->getClientOriginalName();

    // アップロードされた拡張子を取得
    $mp3_extension = File::extension($request->file('musicfile')->getClientOriginalName());
    $img_extension = File::extension($request->file('imgfile')->getClientOriginalName());

    //sampleを取得するためのやつ
    $mp3 = new MpegAudio();

    //一旦ローカルに保存
    $request->file('musicfile')->storeAs('public/music', $mp3_file_name);

    //mp3から再生時間の取得
    $getID3 = new getID3();
    $getID3->setOption(array('encoding' => 'UTF-8'));
    $music_info = $getID3->analyze('storage/music/' . $mp3_file_name);
    getid3_lib::CopyTagsToComments($music_info);

    File::delete('storage/music/' . $mp3_file_name);

    $id = Music::orderby('id', 'desc')->first()->id + 1;

    //DBにぶち込む
    $music = Music::create([
      'artist_id'    => $request->artist,
      'name'         => $request->name,
      'time'         => $music_info['playtime_string'],
      'price'        => $request->price,
      'img_url'      => $id . "." . $img_extension,
      'music_url'    => $id . "." . $mp3_extension,
      'sample_url'   => "sample_" . $id . "." . $mp3_extension,
    ]);

    foreach ($request->genres as $genre) {
      GenreMusic::create([
        'music_id' => $music->id,
        'genre_id' => $genre,
      ]);
    }

    $mp3_storePath = "music/" . $music->id . "." . $mp3_extension;
    $img_storePath = "image/music/" . $music->id . "." . $img_extension;
    $sample_storePath = "music/sample/sample_" . $music->id . "." . $mp3_extension;

    Storage::disk('s3')->put($mp3_storePath, $request->file('musicfile'), 'public');
    Storage::disk('s3')->put($img_storePath, $request->file('imgfile'), 'public');
    Storage::disk('s3')->put($sample_storePath, $mp3->fromFile(Storage::disk('s3')->url($mp3_storePath))->trim(10, 30), 'public');

    return redirect()->route('admin/music_upload')->with('message', 'musicアップロード成功！');
  }

  public function genreStore(Request $request)
  {
    Genre::create([
      'name' => $request->name,
    ]);
    return redirect()->route('admin/music_upload')->with('message', 'ジャンル登録成功！');
  }

  public function artistStore(Request $request)
  {
    Artist::create([
      'genre_id'    => $request->genre,
      'name'        => $request->name,
      'description' => $request->detail,
    ]);
    return redirect()->route('/admin/music_upload')->with('message', 'アーティスト登録成功！');
  }
}
