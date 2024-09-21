@extends('layouts.lay')
@section('content')
<!--Start Main content container-->
<div class="main_content_container">
    <div class="main_container main_menu_open">
        <div class="page_content">
            <h1 class="heading_title">عرض كل الرسائل</h1>

            <div class="wrap">
                <table class="table table-bordered">
                    <colgroup>
                        <col style="width: 5%;"> <!-- ID Column -->
                        <col style="width: 20%;"> <!-- Name Column -->
                        <col style="width: 20%;"> <!-- Phone Column -->
                        <col style="width: 20%;"> <!-- Subject Column -->
                        <col style="width: 30%;"> <!-- Message Column -->
                    </colgroup>
                    @include('layouts.message')

                    <tr>
                        <td>#</td>
                        <td>اسم المرسل</td>
                        <td>رقم الهاتف</td>
                        <td>الموضوع</td>
                        <td>الرسالة</td>
                    </tr>
                    @foreach ($contacts as $contact) <!-- Adjust variable to match your data -->
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->message }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<!--/End Main content container-->
@endsection
