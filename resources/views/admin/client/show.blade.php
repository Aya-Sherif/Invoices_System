@extends('layouts.lay')
@section('content')
<div class="main_content_container">
    <div class="main_container main_menu_open">
        <div class="page_content">
            <h1 class="heading_title">كشف حساب  : {{ $client->name }}</h1>
        <div class="wrap">
            <table class="table table-bordered">
                <colgroup>
                    <col style="width: 5%;"> <!-- ID Column -->
                    <col style="width: 25%;"> <!-- Client Name Column -->
                    <col style="width: 25%;"> <!-- Client email Column -->

                </colgroup>
                @include('layouts.message')


                <tr>
                    <td>#</td>
                    <td>التاريخ</td>
                    <td>المبلغ المدفوع</td>
                </tr>
                @foreach ($payments as $item)
                <!-- <tr @if($item->status == 0) class="table-danger" @endif> Apply red color if status is 0 -->
                        <tr> <!-- Apply red color if status is 0 -->
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->payment_date }}</td>
                            <td>{{ $item->amount }}</td>
                            @endforeach
                        </table>

                            <div class="client_balance" style="background-color: #f8f9fa; padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 0.5px solid #dee2e6;">
                                <h3 style="font-size: 2rem; font-weight: bold; color: #007bff;">الرصيد الحالي:
                                    <span style="color: #28a745;">{{ number_format($client->balance, 2) }} جنيه</span>
                                </h3>
                            </div>
                    </div>
        </div>
    </div>
</div>
@endsection

