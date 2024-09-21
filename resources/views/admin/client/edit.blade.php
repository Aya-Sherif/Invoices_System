@extends('layouts.lay')
@section('content')
<div class="main_content_container">
    <div class="main_container main_menu_open">
        <!-- Start system path -->
        <div class="home_pass hidden-xs">
            <ul>
                <li class="bring_right"><span class="glyphicon glyphicon-home"></span></li>
            </ul>
        </div>
        <!-- End system path -->
        <div class="page_content">
            <h1 class="heading_title">تعديل بيانات العميل: {{$client->name}}</h1>
            @include('layouts.message')

            <div class="form">
                <form class="form-horizontal" action="{{ route('client.update', $client->id) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <!-- Form group for "اسم العضو" -->
                    <div class="form-group">
                        <label for="input0" class="col-sm-2 control-label bring_right left_text">اسم العضو</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input0" name="الاسم" placeholder="اسم العضو"
                                value="{{ $client->name }}" disabled>
                        </div>
                    </div>

                    <!-- Form group for "رقم الهاتف" -->
                    <div class="form-group">
                        <label for="input1" class="col-sm-2 control-label bring_right left_text">رقم الهاتف</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input1" name="رقم_الهاتف"
                                value="{{ $client->phone }}">
                        </div>
                    </div>

                    <!-- Buttons Group -->
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-0">
                            <button type="submit" class="btn btn-danger pull-left">تعديل بيانات العميل</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- /End Main content container -->
@endsection
