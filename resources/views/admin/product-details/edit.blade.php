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

            <h1 class="heading_title">تعديل بيانات المنتج  {{$product->product->name}}</h1>
            @include('layouts.message')




            <div class="form">
                <form class="form-horizontal" action="{{ route('productdetails.update',$product->id) }}" method="POST" >
                @method('PUT')
                @csrf

                    <!-- Product Name Field -->
                    <div class="form-group">
                        <label for="input0" class="col-sm-2 control-label bring_right left_text">اسم المنتج</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input0" name="اسم_المنتج" placeholder="اسم المنتج" value="{{ $product->product->name}}" disabled>
                        </div>
                    </div>

                    <!-- Product Code Field -->
                    <div class="form-group">
                        <label for="input1" class="col-sm-2 control-label bring_right left_text">المقاس</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input1" name="المقاس" placeholder="المقاس" value="{{ $product->size}}">
                        </div>
                    </div>

                    <!-- Price Field -->
                    <div class="form-group">
                        <label for="input2" class="col-sm-2 control-label bring_right left_text">السعر</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="input2" name="السعر" placeholder="السعر" value="{{$product->price}}" step="0.001">
                        </div>
                    </div>

                    <!-- Discount Percentage Field -->
                    <div class="form-group">
                        <label for="input3" class="col-sm-2 control-label bring_right left_text">نسبة الخصم</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="input3" name="نسبة_الخصم" placeholder="نسبة الخصم" value="{{ $product->discount_percentage}}" step="0.001">
                        </div>
                    </div>

                    <!-- Quantity Field -->
                    <div class="form-group">
                        <label for="input4" class="col-sm-2 control-label bring_right left_text">الكميه</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="input4" name="الكميه" placeholder="الكميه" value="{{ $product->quantity}}">
                        </div>
                    </div>

                    <input type="hidden" name="id" value="{{ $product->product_id }}">


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
