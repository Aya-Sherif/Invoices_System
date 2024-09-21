@extends('layouts.lay')
@section('content')
<div class="main_content_container">
    <div class="main_container  main_menu_open">
        <!--Start system bath-->
        <div class="home_pass hidden-xs">
            <ul>
                <li class="bring_right"><span class="glyphicon glyphicon-home "></span></li>

            </ul>
        </div>
        <!--/End system bath-->
        <div class="page_content">

            <h1 class="heading_title">إضافة عميل جديد</h1>
            @include('layouts.message')




            <div class="form">
                <form class="form-horizontal" action="{{ route('client.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="input0" class="col-sm-2 control-label bring_right left_text">اسم العضو</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input0" name="الاسم" placeholder="اسم العضو"
                                value="{{old('الاسم')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input2" class="col-sm-2 control-label bring_right left_text"> رقم التليفون</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input2" name="رقم_الهاتف"
                                placeholder="رقم التليفون" value="{{ old('رقم_الهاتف') }}">
                        </div>
                    </div>
                
                    <!-- Submit and Reset Buttons -->
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-0">
                            <button type="submit" class="btn btn-danger">إضافة عميل</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!--/End Main content container-->
@endsection
