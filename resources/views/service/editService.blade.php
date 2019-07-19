@extends('layout.master')

@section('title', $title)

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>

        @include('components.validationErrorMessage')

        <form action="/service/{{ $Service->id }}" method="post" enctype="multipart/form-data">
            {{ method_field('put') }}
            <label for="">
                商品狀態: 
                <select name="status">
                    <option value="C"
{{--                    @if(old('status', $Service->status) == 'C')--}}
{{--                    這個是書上的 why?--}}
                    @if($Service->status == 'C')
                    selected
                    @endif
                    >
                        建立中
                    </option>
                    <option value="S"
{{--                    @if(old('status',$Service->status) == 'S')--}}
                    @if($Service->status == 'S')
                    selected
                    @endif
                    >
                        可販售
                    </option>
                </select>
            </label>

            <label>
                服務名稱
                <input type="text" name="name" placeholder="服務名稱" value=" {{$Service->name}}">
            </label>

            <label>
                服務介紹
                <input type="text" name = "introduction" placeholder="服務介紹" value=" {{ $Service->introduction }}">
            </label>

            <label for="">
                服務價格
                <input type="text" name="price" placeholder="服務價格" value=" {{$Service->price}}">
            </label>

            <label for="">
                服務剩餘數量
                <input type="text" name="remain_count" placeholder="服務剩餘數量" value=" {{$Service->remain_count}}">
            </label>

            <label for="">
                付款方式
                <select name="payment_method" >
                    <option value="轉帳">轉帳</option>
                    <option value="現金" disabled="disabled">現金</option>
                </select>
            </label>

            <button type="submit" class="btn-default">更新服務內容</button>
            {{ csrf_field() }}
        </form>
    </div>
@endsection
