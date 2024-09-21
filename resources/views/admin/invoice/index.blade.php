@extends('layouts.lay')
@section('content')
    <!--Start Main content container-->

    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="home_pass hidden-xs">
                <ul>
                    <li class="bring_right"><span class="glyphicon glyphicon-home"></span></li>
                </ul>
            </div>

            <div class="page_content">
                <h1 class="heading_title">عرض كل الفواتير</h1>

                <!-- Filter Form Container -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">تصفية الفواتير</h3>
                    </div>
                    <div class="panel-body text-right" style="direction: rtl;">
                        <form action="{{ route('invoice.index') }}" method="GET" class="form-inline">

                            <!-- Date Filter -->
                            <div class="form-group">
                                <label for="filter_date">التاريخ:</label>
                                <input type="date" name="filter_date" id="filter_date" class="form-control"
                                    value="{{ request('filter_date') }}">
                            </div>

                            <!-- Status Filter -->
                            <div class="form-group">
                                <label for="filter_status">الحالة:</label>
                                <select name="filter_status" id="filter_status" class="form-control">
                                    <option value="">كل الحالات</option>
                                    <option value="shipped" {{ request('filter_status') == 'shipped' ? 'selected' : '' }}>
                                        تم التسليم</option>
                                    <option value="draft" {{ request('filter_status') == 'draft' ? 'selected' : '' }}>قيد
                                        التنفيذ
                                    </option>
                                    <option value="approved" {{ request('filter_status') == 'approved' ? 'selected' : '' }}>
                                        تم التأكيد</option>
                                </select>
                            </div>

                            <!-- Client Filter -->
                            <div class="form-group">
                                <label for="filter_client">العميل:</label>
                                <select name="filter_client" id="filter_client" class="form-control">
                                    <option value="">كل العملاء</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}"
                                            {{ request('filter_client') == $client->id ? 'selected' : '' }}>
                                            {{ $client->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">تصفية</button>
                        </form>
                    </div>
                </div>
                <!-- End of Filter Form Container -->

                <div class="wrap">
                    <table class="table table-bordered">
                        <colgroup>
                            <col style="width: 5%;"> <!-- ID Column -->
                            <col style="width: 10%;"> <!-- Invoice Identifier Column -->
                            <col style="width: 20%;"> <!-- Client Name Column -->
                            <col style="width: 20%;"> <!-- Date Column -->
                            <col style="width: 20%;"> <!-- Price Column -->
                            <col style="width: 15%;"> <!-- Status Column -->
                            <col style="width: 15%;"> <!-- Actions Column -->
                        </colgroup>
                        <tr>
                            <td>#</td>
                            <td>رقم الفاتورة</td>
                            <td>اسم العميل</td>
                            <td>التاريخ</td>
                            <td>السعر</td>
                            <td>الحالة</td>
                            <td>التحكم</td>
                        </tr>
                        @foreach ($invoices as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->invoice_identifier }}</td>
                                <td>{{ $item->client->name }}</td>
                                <td>{{ $item->invoice_date }}</td>
                                <td>{{ $item->total_after_discount }}</td>
                                <td
                                    class="
                                @if ($item->status == 'shipped') status-shipped
                                @elseif ($item->status == 'draft')
                                    status-draft
                                @elseif ($item->status == 'approved')
                                    status-approved @endif">
                                    @if ($item->status == 'shipped')
                                        تم التسليم
                                    @elseif ($item->status == 'draft')
                                        قيد التنفيذ
                                    @elseif ($item->status == 'approved')
                                        تم التأكيد
                                    @endif
                                </td>
                                <td>
                                    @if ((auth()->user()->role == 'admin' || auth()->user()->role == 'accounts') && $item->status == 'draft')
                                        <a href="{{ route('invoice.edit', $item->id) }}" class="glyphicon glyphicon-pencil"
                                            data-toggle="tooltip" data-placement="top" title="edit"></a>
                                        <a href="javascript:void(0);" class="glyphicon glyphicon-ok" data-toggle="tooltip"
                                            data-placement="top" title="Done"
                                            onclick="event.preventDefault(); document.getElementById('change-state-form-{{ $item->invoice_identifier }}').submit();"></a>

                                        <!-- Hidden form for change state action -->
                                        <form id="change-state-form-{{ $item->invoice_identifier }}"
                                            action="{{ route('invoice.changeStateToApproved', $item->invoice_identifier) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            {{-- @method('PUT') <!-- or the HTTP method your route expects --> --}}
                                        </form>
                                    @elseif ($item->status != 'draft')
                                        <a href="{{ route('invoice.displayForStock', $item->id) }}"
                                            class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top"
                                            title="display"></a>
                                    @elseif (auth()->user()->role == 'stock')
                                        <a href="{{ route('invoice.displayForStock', $item->id) }}"
                                            class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top"
                                            title="display"></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
