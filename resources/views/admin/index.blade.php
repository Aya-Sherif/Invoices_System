@extends('layouts.lay')
@section('content')


        <!--Start Main content container-->
        <div class="main_content_container">
            <div class="main_container  main_menu_open">
                <!--Start system bath-->
                <div class="home_pass hidden-xs">
                    <ul>
                        <li class="bring_right"><span class="glyphicon glyphicon-home "></span></li>
                        <li class="bring_right"><a href="">الصفحة الرئيسية للوحة تحكم الموقع</a></li>
                    </ul>
                </div>
                <!--/End system bath-->
                <div class="page_content">
                    <div class="page_content">
                        <div class="quick_links text-center">
                            <h1 class="heading_title">الوصول السريع</h1>
                            <a href="{{ route('client.index') }}" style="background-color: #c0392b">
                                <h4>استعراض العملاء</h4>
                            </a>
                            <a href="{{ route('contacts.index') }}" style="background-color: #2980b9">
                                <h4>استعراض الرسائل </h4>
                            </a>
                            <a href="{{ route('user.index') }}" style="background-color: #8e44ad">
                                <h4>عرض الاعضاء</h4>
                            </a>
                            <a href="{{ route('invoice.index') }}" style="background-color: #d35400">
                                <h4>استعراض الفواتير</h4>
                            </a>
                            <a href="{{ route('productdetails.index') }}" style="background-color: #2c3e50">
                                <h4> استعراض المنتجات</h4>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <!--/End Main content container-->

@endsection
