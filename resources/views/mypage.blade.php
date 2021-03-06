@extends('layout.layout')

<!-- head -->
@section('title', 'Mypage')
@section('style')
<link rel="stylesheet" href="{{asset('css/mypage.css',$is_production)}}" />
<link rel="stylesheet" href="{{asset('css/link.css',$is_production)}}" />
<link rel="stylesheet" href="{{asset('css/hbg.css',$is_production)}}" />

<script src="{{ asset('js/mypage.js',$is_production) }}" defer></script>
<script src="{{ asset('js/hbg.js',$is_production) }}" defer></script>


@endsection
@include('common.head')

<!-- header -->
@include('common.header')

<!-- content -->
@section('content')
 <article id="mypage">
<div class="contents">
  <div class="img">
  </div>
  
  <div class="text">
  <button class="form-button" v-on:click='formActive = true'>プロフィール編集</button>
    @if(session('message'))
    <div class="alert mt-4 success" role="alert"><strong>{{ session('message') }}</strong></div>
    @endif
    <span class="form-text text-danger">{{$errors->first('name')}}</span>
    <span class="form-text text-danger">{{$errors->first('email')}}</span>
    <ul>
      <li><span class="value">{{ $user->name }}</span><br><span class="text-in">表示名</span></li>
      <li><span class="value">{{ $user->email }}</span><br><span class="text-in">メール</span></li>
      {{-- <li><span class="value">パスワード</span><br><span class="text-in">パスワード</span></li> --}}
      <li><span class="value">{{ number_format($user->point) }} P</span><br><span class="text-in">ポイント残高</span></li>
    </ul>
  </div>
</div>
<form action="{{ url('mypage/update',null,$is_production) }}" method="post" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="form" v-bind:class='{active:formActive}'>
    <div class="head">
      <div class="back" v-on:click='formActive = false'>
        <div class="topLine line"></div>
        <div class="borderLine line"></div>
        <div class="bottomLine line"></div>
      </div>
      <h2>プロフィールを編集</h2>
      <button type="submit">保存</button>
    </div>
    <div class="profile">
    <label for="img-form">
      <img alt="" class="account-img">
      <input type="file" id="img-form" name="image">
    </label>
    <ul>
      <li><span class="title">表示名</span><br><input type="text" value="{{ $user->name }}" name="name"></li>
      <li><span class="title">メール</span><br><input type="text" value="{{ $user->email }}" name="email"></li>
      {{-- <li><span class="title">パスワード</span><br><input type="text" value="パスワード"></li> --}}
    </ul>
    </div>
  </div>
</form>
</article>
@endsection

<!-- footer -->
@include('common.footer')

<script>
  
</script>


<style>
  
  #link-list li:nth-child(1)::before{
    background-image: url({{ asset('img/home.png',$is_production) }});
  }
  #link-list li:nth-child(2)::before{
    background-image: url({{ asset('img/hunt.png',$is_production) }});
  }
  #link-list li:nth-child(3)::before{
    background-image: url({{ asset('img/streaming.png',$is_production) }});
  }
  #link-list li:nth-child(4)::before{
    background-image: url({{ asset('img/playlist.png',$is_production) }});
  }
  #app .search{
    display: none;
  }
  
  
  .img {
    background-image: url({{ $img_path }});
  }
  .img::before{
    content: '{{ $user->name }}';
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
  }

  #app #form {
    display: none;
  }

  #app {
    width: 100%;
/*    background-color: #ff5757;*/
    position: relative;
    top: 0;
    left: 0;
    z-index: 100;
  }

  #app .menu-trigger {
    top: 22px;
    left: 30px;
  }

  #app h1 {
    padding: 20px;
    padding-left: 65px;
    padding-bottom: 20px;
    color: white;
    font-size: 1.2em;
    letter-spacing: 4px;
  }
  .success {
    background-color: #ff5757;
    color: white;
    width: 90%;
    margin: 0 auto;
  }
</style>
