@extends('layout.master') 
<!-- 指定繼承母模版: 放在layout資料夾下的master.blade.php -->

@section('title',$title)
<!-- 傳送資料到母模版(該模版內的section被命名為title) 傳送的資料為$title -->

@section('content')
<!-- 傳送資料到母模版(該模版內的section被命名為content) 傳送的資料為被section和end.section夾起來的部份 -->
  <div class="container">
    <h1>{{ $title }}</h1>
    
    <!-- 錯誤訊息模板元件 -->
    @include('components.validationErrorMessage')

    <form action="/user/auth/sign-up" method="post">
      <label for="">
        暱稱: <input type="text" name="nickname" placeholder="暱稱" value="{{ old('nickname') }}">
      </label>  
      <label for="">
        Email: <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
      </label>
      <label for="">
        密碼: <input type="password" name="password" placeholder="密碼">
      </label>
      <label for="">
        確認密碼: <input type="password" name="password_confirmation" placeholder="確認密碼">
      </label>
      <label for="">
        帳號類型: 
        <select name="type" id="">
          <option value="G">一般會員</option>
          <option value="A" disabled="disabled">管理者</option>
        </select>
      </label>
      {!! csrf_field() !!}
      <button type="submit">註冊</button>
    </form>
  </div>
  @include('components.socialButtons')

  @endsection



