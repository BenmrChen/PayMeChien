@extends('layout.master')

@section('title', $title)

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>

        @include('components.validationErrorMessage')

        <table border = 1px solid black>
            <tr>
                <td>名稱</td>
                <td>價格</td>
                <td>剩餘數量</td>
            </tr>
            @foreach($ServicePaginate as $Service)
                <tr>
                    <td>
                        <a href="/service/{{ $Service->id }}">{{ $Service->name }}</a>
                    </td>
                    <td>
                        {{ $Service->price }}
                    </td>
                    <td>
                        {{ $Service->remain_count }}
                    </td>
                </tr>
            @endforeach
        </table>

        {{--分頁頁數按紐--}}
        {{ $ServicePaginate->links() }}
    </div>
@endsection
