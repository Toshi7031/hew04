@extends('layout.layout')

<!-- head -->
@section('title', 'PlaylistMusics')
@section('style')
<link rel="stylesheet" href="{{asset('css/link.css',$is_production)}}" />
<link rel="stylesheet" href="{{asset('css/hbg.css',$is_production)}}" />
<link rel="stylesheet" href="{{asset('css/playlist-in.css',$is_production)}}" />
<link rel="stylesheet" href="{{asset('css/audio.css',$is_production)}}" />

<script src="{{ asset('js/audio.min.js',$is_production) }}"></script>
<script src="{{ asset('js/library.js',$is_production) }}" defer type="application/javascript"></script>
<script src="{{ asset('js/hbg.js',$is_production) }}" defer></script>

@endsection
@include('common.head')

<!-- header -->
@include('common.header')

<!-- content -->
@section('content')
<section class="playlist-in">
 
  <div class="playlist-img">
     <img src="{{ $playlist['img1'] }}" alt="">
     <img src="{{ $playlist['img2'] }}" alt="">
     <img src="{{ $playlist['img3'] }}" alt="">
     <img src="{{ $playlist['img4'] }}" alt="">
  </div>
  
  <div class="play-btn"></div>
  
  <div class="playlist-value">
  
  <h2>{{ $playlist->name }}</h2>
  <div class="playlist-info">
    <div class="info">
      <p><img src="{{ Storage::disk('s3')->url('image/user/' . $playlist->user()->first()->img_url) }}" alt=""></p>
      <ul>
        <li>プレイリスト</li>
      <li><span>{{ $playlist->musics()->count() }}</span>曲</li>
      </ul>
    </div>
    <div class="info-btn">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  
  <div class="play-lists">
    @foreach ($musics as $music)
      <div class="music-content">
<!--       <a data-src="{{ asset('img/mp3/03.mp3',$is_production) }}">-->
        <p><img src="{{ Storage::disk('s3')->url('image/music/' . $music->img_url) }}" alt=""></p>
        <ul>
        <li class="title">{{ $music->name }}</li>
        <li class="artist">{{ $music->artist()->first()->name }}・{{ substr($music->time, 0, 5) }}</li>
        </ul>
<!--        </a>-->
      </div>
    @endforeach
  </div>

  </div>
  
  <div class="cd">
    <ol>
       
       <!--オーディオ繰り返し プレイリストの順番で-->
       <!-- 最後の要素にclass="last"必ずいります -->
        <li><a data-src="{{ asset('img/mp3/01.mp3',$is_production) }}"></a></li>
        <li><a data-src="{{ asset('img/mp3/02.mp3',$is_production) }}"></a></li>
        <li class="last"><a data-src="{{ asset('img/mp3/03.mp3',$is_production) }}"></a></li>
    </ol>
  </div><!-- end of .cd -->

  
</section>
<script>
  /*
    let playlist = new Vue({
      el: '#play-lists',
      data: function() {
        return {
          items: [{
              title: 'Anarchy In The U.K',
              artist: 'sex pistols',
              time: '3:32'
            },
            {
              title: 'God Save The Queen',
              artist: 'sex pistols',
              time: '3:19'
            },
            {
              title: 'T.N.T',
              artist: 'AC/DC',
              time: '3:34'
            },
            {
              title: 'Hammer To Fall',
              artist: 'Queen',
              time: '3:40'
            },
            {
              title: 'Poison',
              artist: 'Alice Cooper',
              time: '4:30'
            }
          ]
        }
      }
    })
    */
</script>

@endsection

<!-- footer -->
@include('common.footer')


<style type="text/css">

  h1{
    display: none;
  }
  
  #link-list li:nth-child(4) {
    background: rgba(0, 0, 0, 0.1);
  }

  #link-list li:nth-child(4) .link-title {
    color: #ff5757;
  }

  #link-list li:nth-child(1)::before {
    background-image: url({{ asset('img/home.png',$is_production)}});
  }
  
  #link-list li:nth-child(2)::before {
    background-image: url({{ asset('img/hunt.png',$is_production)}});
  }
  
  #link-list li:nth-child(3)::before {
    background-image: url({{ asset('img/streaming.png',$is_production)}});
  }
  
  #link-list li:nth-child(4)::before {
    background-image: url({{ asset('img/playlist-active.png',$is_production)}});
  }
  
  #app .search{
    display: none;
  }
  
  * {
    margin: 0;
    padding: 0;
  }

  #wrapper {
    width: 100%;
    height: 100vh;
    background-color: #FFEBE0;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: scroll;
  }

  #app #form {
    display: none;
  }

  #app {
    width: 100%;
    background-color: transparent;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 50;
  }

  #app .menu-trigger {
    top: 22px;
    left: 30px;
  }

  #app h1 {
    padding: 20px;
    padding-left: 65px;
    padding-bottom: 40px;
    color: white;
    font-size: 1.2em;
    letter-spacing: 2px;
  }

</style>