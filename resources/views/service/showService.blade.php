@extends('layout.master')

@section('title', $title)

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>

        @include('components.validationErrorMessage')
        @if(session()->has('user_id'))
            <table border= 1px solid black>
                <tr>
                    <th>名稱</th>
                    <td>{{ $Service->name }}</td>
                </tr>

                <tr>
                    <th>價格</th>
                    <td>{{ $Service->price }}</td>
                </tr>

                <tr>
                    <th>剩餘數量</th>
                    <td>{{ $Service->remain_count }}</td>
                </tr>
                <tr>
                    <th>介紹</th>
                    <td>
                        {{ $Service->introduction }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <form action="/service/{{ $Service->id }}/buy" method="post">
                            購買數量
                            <select name="buy_count">
                                @for($count = 0; $count <= $Service->remain_count; $count++)
                                    <option value="{{ $count }}">
                                        {{ $count }}
                                    </option>
                                @endfor
                            </select>
                            <button type="submit">
                                購買
                            </button>
                            {{ csrf_field() }}
                        </form>
                    </td>
                </tr>
            </table>
        @else
            <table border= 1px solid black>
                <tr>
                    <th>名稱</th>
                    <td>{{ $Service->name }}</td>
                </tr>

                <tr>
                    <th>價格</th>
                    <td>{{ $Service->price }}</td>
                </tr>

                <tr>
                    <th>剩餘數量</th>
                    <td>{{ $Service->remain_count }}</td>
                </tr>
                <tr>
                    <th>介紹</th>
                    <td>
                        {{ $Service->introduction }}
                    </td>
                </tr>

            </table>
        @endif
    </div>
@endsection
