@extends('layout.master')

@section('title', $title)

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        @include('components.validationErrorMessage')

        <table class="table" border = 1px solid black>
            <tr>
                <th>商品名稱</th>
                <th>單價</th>
                <th>數量</th>
                <th>總金額</th>
                <th>訂閱時間</th>
            </tr>
            @foreach($TransactionPaginate as $Transaction)
                <tr>
                    <td>
                        <a href="/service/{{ $Transaction->Service->id }}">
                            {{ $Transaction->Service->name }}
                        </a>
                    </td>
                    <td>{{ $Transaction->price }}</td>
                    <td>{{ $Transaction->buy_count }}</td>
                    <td>{{ $Transaction->total_price }}</td>
                    <td>{{ $Transaction->created_at }}</td>
                </tr>
            @endforeach
        </table>

        {{-- 分頁頁數按鈕--}}
        {{ $TransactionPaginate->links() }}
    </div>
@endsection
