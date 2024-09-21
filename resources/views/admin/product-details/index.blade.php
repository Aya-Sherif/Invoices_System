@extends('layouts.lay')

@section('content')
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <!--Start system path-->
            <div class="home_pass hidden-xs">
                <ul>
                    <li class="bring_right"><span class="glyphicon glyphicon-home"></span></li>
                </ul>
            </div>
            <!--/End system path-->
            <div class="page_content">
                <h1 class="heading_title">عرض كل المنتجات</h1>

                @include('layouts.message')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">بحث عن منتج</h3>
                    </div>
                    <div class="panel-body text-right" style="direction: rtl;">
                        <form method="GET" action="{{ route('productdetails.index') }}" id="productFilterForm" class="form-inline">

                            <!-- Product Filter -->
                            <div class="form-group">
                                <label for="product" style="margin-left: 10px;">اسم المنتج:</label>
                                <select id="product" name="product" class="form-control">
                                    <option value="">كل المنتجات</option>
                                    @foreach ($productsNames as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Size Filter -->
                            <div class="form-group">
                                <label for="size" style="margin-left: 10px;">كل المقاسات:</label>
                                <select id="size" name="size" class="form-control">
                                    <option value="">اختر المقاس</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">تصفية</button>
                        </form>
                    </div>
                </div>

                <!-- Products Table -->
                <div class="wrap">
                    <table class="table table-bordered">
                        <colgroup>
                            <col style="width: 5%;">
                            <col style="width: 20%;">
                            <col style="width: 20%;">
                            <col style="width: 15%;">
                            <col style="width: 15%;">
                            <col style="width: 15%;">
                            @if (auth()->user()->role == 'admin')
                                <col style="width: 15%;">
                            @endif
                        </colgroup>
                        <tr>
                            <td>#</td>
                            <td>اسم المنتج</td>
                            <td>مقاس المنتج</td>
                            <td>الكميه</td>
                            <td>السعر</td>
                            <td>نسبة الخصم</td>
                            @if (auth()->user()->role == 'admin')
                                <td>التحكم</td>
                            @endif
                        </tr>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->size }}</td>
                                <td style="background-color: {{ $item->quantity == 0 ? 'red' : 'transparent' }};">
                                    {{ $item->quantity }}
                                </td>
                                                      <td>{{ $item->price }}</td>
                                <td>{{ $item->discount_percentage }}</td>
                                @if (auth()->user()->role == 'admin' || auth()->user()->role =='accounts')
                                    <td>
                                        <a href="{{ route('productdetails.edit', $item->id) }}"
                                            class="glyphicon glyphicon-pencil" title="تعديل"></a>
                                        <a href="{{ route('productdetails.editQuantity', $item->id) }}"
                                            class="glyphicon glyphicon-plus" title="إضافة كميه"></a>
                                        <a href="{{ route('product.show', $item->id) }}"
                                            class="glyphicon glyphicon-eye-open" title="عرض بيانات"></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#product').change(function() {
                var productId = $(this).val();
                var sizeSelect = $('#size');
                sizeSelect.empty().append('<option value="">اختر المقاس</option>');

                if (productId) {
                    $.ajax({
                        url: '{{ route('fetch.sizes') }}',
                        type: 'GET',
                        data: {
                            product_id: productId
                        },
                        success: function(data) {
                            data.forEach(function(size) {
                                sizeSelect.append('<option value="' + size.id + '">' +
                                    size.size + '</option>');
                            });
                        },
                        error: function(xhr) {
                            console.error('Failed to fetch sizes:', xhr);
                        }
                    });
                }
            });
        });
    </script>
@endsection
