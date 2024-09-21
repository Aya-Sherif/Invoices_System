@extends('layouts.lay')
@section('content')
    <div class="home_pass hidden-xs">
        <ul>
            <li class="bring_right"><span class="glyphicon glyphicon-home "></span></li>

        </ul>
    </div>
    <!--Start Main content container-->
    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="page_content">
                <h1 class="heading_title">عرض كل المنتجات</h1>

                <div class="wrap">
                    <table class="table table-bordered">
                        <colgroup>
                            <col style="width: 5%;">
                            <col style="width: 20%;">
                            <col style="width: 20%;">
                            <col style="width: 15%;">
                            <col style="width: 15%;">
                            <col style="width: 15%;">
                            <col style="width: 15%;">
                        </colgroup>
                        @include('layouts.message')


                        <tr>
                            <td>#</td>
                            <td>اسم المنتج</td>
                            <td>مقاس المنتج</td>
                            <td>الكميه</td>
                            <td>السعر</td>
                            <td>نسبة الخصم</td>
                            <td>التحكم</td>
                        </tr>
                        @foreach ($products as $item)
                            <!-- <tr @if ($item->quantity == 0) class="table-danger" @endif> Apply red color if quantity is 0 -->
                            <tr> <!-- Apply red color if quantity is 0 -->
                                <td @if ($item->quantity == 0) class="bg-danger" @endif>{{ $loop->iteration }}</td>
                                <td @if ($item->quantity == 0) class="bg-danger" @endif>
                                    <a href="{{ route('product.edit', $item->product->id) }}">{{ $item->product->name }}</a>
                                </td>
                                <td @if ($item->quantity == 0) class="bg-danger" @endif>
                                    {{ $item->size }}
                                </td>
                                <td @if ($item->quantity == 0) class="bg-danger" @endif>
                                    {{ $item->quantity }}
                                </td>
                                <td @if ($item->quantity == 0) class="bg-danger" @endif>
                                    {{ $item->price }}
                                </td>
                                <td @if ($item->quantity == 0) class="bg-danger" @endif>
                                    {{ $item->discount_percentage }}
                                </td>
                                <td @if ($item->quantity == 0) class="bg-danger" @endif>
                                    <a href="{{ route('productdetails.edit', $item->id) }}"
                                        class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top"
                                        title="edit"></a>
                             

                                    <a href="{{ route('product.show', $item->id) }}" class="glyphicon glyphicon-eye-open"
                                        data-toggle="tooltip" data-placement="top" title="Show"></a>


                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <!--/End Main content container-->
@endsection
