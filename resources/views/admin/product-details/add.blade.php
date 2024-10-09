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
                <h1 class="heading_title">إضافة مقاس</h1>
                @include('layouts.message')

                <div class="form">
                    <form class="form-horizontal" action="{{ route('productdetails.store') }}" method="POST">
                        @csrf

                        <!-- Product Name Field -->
                        <div class="form-group">
                            <label for="client" class="col-sm-2 control-label bring_right left_text">اسم المنتج</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="client" name="اسم_المنتج" required>
                                    <option value="">اسم المنتج</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            {{ old('اسم_المنتج') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input0" class="col-sm-2 control-label bring_right left_text">المقاس</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input0" name="المقاس"
                                    placeholder="المقاس" value="{{ old('المقاس') }}" required>
                            </div>
                        </div>

                        <!-- Price Field -->
                        <div class="form-group">
                            <label for="input2" class="col-sm-2 control-label bring_right left_text">السعر</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="input2" name="السعر" placeholder="السعر"
                                       value="{{ old('السعر') }}" step="0.001">
                            </div>
                        </div>


                        <!-- Discount Percentage Field -->
                        <div class="form-group">
                            <label for="input3" class="col-sm-2 control-label bring_right left_text">نسبة الخصم</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="input3" name="نسبة_الخصم"
                                    placeholder="نسبة الخصم" value="{{ old('نسبة_الخصم') }}" step="0.001">
                            </div>
                        </div>

                        <!-- Quantity Field -->
                        <div class="form-group">
                            <label for="input4" class="col-sm-2 control-label bring_right left_text">الكميه</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="input4" name="الكميه"
                                    placeholder="الكميه" value="{{ old('الكميه') }}">
                            </div>
                        </div>



                        <!-- Submit Button -->
                        <div class="form-group">
                            <div class="col-sm-12 col-sm-offset-0">
                                <button type="submit" class="btn btn-danger pull-left">إضافة منتج</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/End Main content container-->

    <!-- Custom CSS for Styling the File Input -->
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
