@extends('layouts.lay')
@section('content')
<div class="main_content_container">
    <div class="main_container main_menu_open">
        <!--Start system bath-->
        <div class="home_pass hidden-xs">
            <ul>
                <li class="bring_right"><span class="glyphicon glyphicon-home"></span></li>
            </ul>
        </div>
        <!--/End system bath-->
        <div class="page_content">
            <h1 class="heading_title" style="font-size: 2.5rem; margin-bottom: 20px;">بيانات المنتج: {{$product->product->name}}</h1>
            @include('layouts.message')

            <!-- Creating a card-like component with Bootstrap 3 -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <!-- Panel heading for the product title -->
                        <div class="panel-heading">
                            <h3 class="panel-title" style="font-size: 1.75rem;">{{ $product->product->name }}</h3>
                        </div>
                        <!-- Panel body for the image and details -->
                        <div class="panel-body">
                            <!-- Displaying the product image -->

                            @if($product->product->image)
                                <img class="img-responsive center-block" src="{{ asset('images/products/' .$product1->image) }}" alt="Product image" style="max-height: 200px; margin-bottom: 20px;">
                            @else
                                <img class="img-responsive center-block" src="{{ asset('images/default.png') }}" alt="Default image" style="max-height: 200px; margin-bottom: 20px;">
                            @endif

                            <!-- Displaying product details -->
                            <ul class="list-unstyled" style="margin-top: 20px; font-size: 1.5rem;">
                                <li><strong>اسم المنتج:</strong> {{ $product->product->name ." " .$product->size  }} </li>
                                <li><strong>السعر:</strong> {{ $product->price }} جنيه</li>
                                <li><strong>نسبة الخصم:</strong> {{ $product->discount_percentage }}%</li>
                                <li><strong>الكمية:</strong> {{ $product->quantity }}</li>
                                {{-- <li><strong>آخر تحديث:</strong> {{ $product->updated_at->diffForHumans() }}</li> --}}
                            </ul>

                            <!-- Redirect button -->
                            <div class="text-center" style="margin-top: 20px;">
                                <a href="{{ route('productdetails.index') }}" class="btn btn-primary">العودة إلى القائمة الرئيسية</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
