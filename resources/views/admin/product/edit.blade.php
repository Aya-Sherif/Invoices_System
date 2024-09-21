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

            <h1 class="heading_title">تعديل بيانات المنتج  {{$product->name}}</h1>
            @include('layouts.message')




            <div class="form">
                <form class="form-horizontal" action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                    <!-- Product Name Field -->
                    <div class="form-group">
                        <label for="input0" class="col-sm-2 control-label bring_right left_text">اسم المنتج</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input0" name="الاسم" placeholder="اسم المنتج" value="{{ $product->name}}">
                        </div>
                    </div>




                    <!-- Image Upload Field -->
                 
                    <!-- Submit Button -->
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-0">
                            <button type="submit" class="btn btn-danger pull-left">تعديل المنتج</button>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
<!--/End Main content container-->
<style>
    .styled-file-input {
        display: block;
        width: 100%;
        height: calc(3rem + 6px);
        padding: 0.375rem 0.75rem;
        font-size: 1.25rem;
        line-height: 2.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.5rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .styled-file-input::file-selector-button {
        display: none;
    }
</style>

@endsection
