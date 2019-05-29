@extends('layout.master')

@section('title', $title)

@section('content')
    <div class="container" style=" margin: 10px;">
        <h1>{{ $title }}</h1>
        @include('components.validationErrorMessage')
        @if( $total_amount == 0)
            您沒有未結清款項，毋須付款。
        @else
        <table border = 1px solid black>
            <tr>
                <th>商品名稱</th>
                <th>單價</th>
                <th>數量</th>
                <th>小計</th>
                <th>下單時間</th>
                <th>付款狀態</th>
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
                    <td>{{ $payment_status }}</td>
                </tr>

            @endforeach

        </table>

        {{-- 分頁頁數按鈕--}}
        {{ $TransactionPaginate->links() }}

        <form action="/transaction/payment/process" method="get">


            應付總金額為: {{ $total_amount }}<br>
            應匯入銀行帳號: 1234567890<br>
            付款帳戶後5碼: <input type="text" name="payment_number" placeholder="請填入您的匯款帳戶後5碼">
            <input type="submit" value="我已確認付款">
           @endif
        </form>
    </div>
@endsection
