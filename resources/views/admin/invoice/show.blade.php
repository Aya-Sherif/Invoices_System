@extends('layouts.lay')
@section('content')
    <!--Start Main content container-->

    <style>
        @media print {
            @page {
                size: A3;
            }
        }

        ul {
            padding: 0;
            margin: 0 0 1rem 0;
            list-style: none;
        }

        body {
            font-family: "Inter", sans-serif;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        table th,
        table td {
            border: 1px solid silver;
        }

        table th,
        table td {
            text-align: right;
            padding: 8px;
        }

        h1,
        h4,
        p {
            margin: 0;
        }

        .table-wrapper {
            text-align: right;
            width: 30%;
        }

        .table-wrapper table {
            float: right;
        }

        .inv-footer {
            display: flex;
            flex-direction: row;
        }

        .inv-footer> :nth-child(1) {
            flex: 2;
        }

        .inv-footer> :nth-child(2) {
            flex: 1;
        }
    </style>

    <div class="main_content_container">
        <div class="main_container main_menu_open">
            <div class="home_pass hidden-xs">
                <ul>
                    <li class="bring_right"><span class="glyphicon glyphicon-home"></span></li>
                </ul>
            </div>
            <div class="page_content">
                <h1 class="heading_title">ملخص الفاتوره</h1>
                @include('layouts.message')



                <div class="inv-header">
                    <div>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <table class="table-wrapper">
                        <tr>
                            <th>التاريخ:</th>
                            @if (isset($invoice))
                                <td>{{ $invoice['invoice_date'] }}</td>
                            @else
                                <td>{{ $newinvoice['date'] }}
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <th>رقم الفاتوره</th>
                            @if (isset($invoice))
                                <td>{{ $invoice['invoice_identifier'] }}</td>
                            @else
                                <td>{{ $newinvoice['invoice_identifier'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            @if (isset($invoice))
                                <th>اسم العميل</th>
                                <td>{{ $invoice->client->name }}</td>
                            @else
                                <th>اسم العميل</th>
                                <td>{{ $newinvoice['client'] }}</td>
                            @endif

                        </tr>
                    </table>
                </div>

                <div class="wrap">
                    <table class="table table-bordered">
                        <colgroup>
                            <col style="width: 5%;"> <!-- ID Column -->
                            <col style="width: 20%;"> <!-- Client Name Column -->
                            <col style="width: 15%;"> <!-- Date Column -->

                            <col style="width: 20%;"> <!-- Price Column -->
                            @if (auth()->user()->role != 'stock')
                                <col style="width: 15%;"> <!-- Status Column -->
                                <col style="width: 15%;"> <!-- Actions Column -->
                            @endif
                        </colgroup>
                        <tr>
                            <td>#</td>
                            <td>البند</td>
                            <td>المقاس</td>
                            @if (auth()->user()->role != 'stock')
                                <td>السعر</td>
                            @endif
                            <td>الكميه</td>
                            @if (auth()->user()->role != 'stock')
                                <td>نسبة الخصم</td>
                                <td>السعر بعد</td>
                            @endif
                        </tr>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['size'] }}</td>
                                @if (auth()->user()->role != 'stock')
                                    <td>{{ $item['price'] }}</td>
                                @endif
                                <td>{{ $item['quantity'] }}</td>
                                @if (auth()->user()->role != 'stock')
                                    <td>{{ $item['discount'] }}</td>
                                    <td>{{ $item['price_after_discount'] }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                </div>
                @if (auth()->user()->role != 'stock')
                    <div class="inv-footer">
                        <div></div>
                        <div>
                            <table>
                                <tr>
                                    <th>السعر قبل الخصم</th>
                                    @if (isset($invoice))
                                        {{-- @dd($invoice['total_before_discount']) --}}
                                        <td>{{ $invoice['total_before_discount'] }}</td>
                                    @else
                                        <td>{{ $newinvoice['total_before_discount'] }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th> الخصم</th>
                                    @if (isset($invoice))
                                        <td>{{ $invoice['total_before_discount'] - $invoice['total_after_discount'] }}</td>
                                    @else
                                        <td>{{ $newinvoice['total_before_discount'] - $newinvoice['total_after_discount'] }}
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>السعر بعد الخصم</th>
                                    @if (isset($invoice))
                                        <td>{{ $invoice['total_after_discount'] }}</td>
                                    @else
                                        <td>{{ $newinvoice['total_after_discount'] }}</td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif
                <!-- Add Button to Redirect to Create Invoice -->
                <div style="display: flex; gap: 10px;">
                    <!-- Confirm Invoice Form -->
                    <div style="display: flex; gap: 10px;">
                        <!-- If the invoice exists, show the update form -->
                        {{-- @dd(isset($Flag)) --}}
                        @if (auth()->user()->role != 'stock' && !isset($Flag))
                            @if (isset($invoice))
                                <form action="{{ route('invoice.update', $invoice['id']) }}" method="POST">

                                    @csrf
                                    @method('PUT')
                                    <!-- Hidden Inputs for Invoice Data -->
                                    <input type="hidden" name="date" value="{{ $invoice['invoice_date'] }}">
                                    <input type="hidden" name="invoice_identifier"
                                        value="{{ $invoice['invoice_identifier'] }}">
                                    <input type="hidden" name="client" value="{{ $invoice->client->id }}">
                                    <input type="hidden" name="total_before_discount"
                                        value="{{ $invoice['total_before_discount'] }}">

                                    <input type="hidden" name="total_after_discount"
                                        value="{{ $invoice['total_after_discount'] }}">
                                    @foreach ($items as $item)
                                        <input type="hidden" name="items[{{ $loop->index }}][id]"
                                            value="{{ $item['id'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][name]"
                                            value="{{ $item['name'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][size]"
                                            value="{{ $item['size'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][price]"
                                            value="{{ $item['price'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][quantity]"
                                            value="{{ $item['quantity'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][discount]"
                                            value="{{ $item['discount'] }}">

                                        <input type="hidden" name="items[{{ $loop->index }}][price_after_discount]"
                                            value="{{ $item['price_after_discount'] }}">
                                    @endforeach
                                    <button type="submit" class="btn btn-primary">تأكيد الفاتورة</button>
                                </form>
                            @else
                                <!-- If the invoice does not exist, show the store form -->
                                <form action="{{ route('invoice.store') }}" method="POST">
                                    @csrf
                                    <!-- Hidden Inputs for Invoice Data -->
                                    <input type="hidden" name="date" value="{{ $newinvoice['date'] ?? '' }}">
                                    <input type="hidden" name="invoice_identifier"
                                        value="{{ $newinvoice['invoice_identifier'] ?? '' }}">
                                    <input type="hidden" name="client" value="{{ $newinvoice['client'] ?? '' }}">
                                    <input type="hidden" name="total_before_discount"
                                        value="{{ $newinvoice['total_before_discount'] ?? '' }}">
                                    <input type="hidden" name="total_after_discount"
                                        value="{{ $newinvoice['total_after_discount'] ?? '' }}">
                                    @foreach ($items as $item)
                                        <input type="hidden" name="items[{{ $loop->index }}][id]"
                                            value="{{ $item['id'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][name]"
                                            value="{{ $item['name'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][size]"
                                            value="{{ $item['size'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][price]"
                                            value="{{ $item['price'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][quantity]"
                                            value="{{ $item['quantity'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][discount]"
                                            value="{{ $item['discount'] }}">

                                        <input type="hidden" name="items[{{ $loop->index }}][price_after_discount]"
                                            value="{{ $item['price_after_discount'] }}">
                                    @endforeach
                                    <button type="submit" class="btn btn-primary">تأكيد الفاتوره</button>
                                </form>
                            @endif

                            <!-- Optional Edit Form Button to Redirect to the Edit Page -->

                            <!-- Edit Invoice Form -->
                            @if (isset($invoice))
                                <form action="{{ route('invoice.edit', $invoice['id']) }}" method="GET">
                                    @csrf
                                    @foreach ($items as $item)
                                        <input type="hidden" name="items[{{ $loop->index }}][id]"
                                            value="{{ $item['id'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][name]"
                                            value="{{ $item['name'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][size]"
                                            value="{{ $item['size'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][quantity]"
                                            value="{{ $item['quantity'] }}">
                                    @endforeach
                                    <button type="submit" class="btn btn-danger">تعديل الفاتوره</button>

                                </form>
                            @else
                                <form action="{{ route('invoice.edit', 0) }}" method="POST">
                                    @method('GET')
                                    @csrf
                                    <!-- Hidden Inputs to Include Invoice Data -->
                                    <input type="hidden" name="client" value="{{ $newinvoice['client'] }}">
                                    @foreach ($items as $item)
                                        <input type="hidden" name="items[{{ $loop->index }}][id]"
                                            value="{{ $item['id'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][name]"
                                            value="{{ $item['name'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][product_id]"
                                            value="{{ $item['product_id'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][size]"
                                            value="{{ $item['size'] }}">
                                        <input type="hidden" name="items[{{ $loop->index }}][quantity]"
                                            value="{{ $item['quantity'] }}">
                                    @endforeach
                                    <button type="submit" class="btn btn-danger">تعديل الفاتوره</button>

                                </form>
                            @endif
                        @elseif(isset($Flag)&&auth()->user()->role == 'stock')

                        <form action="{{ route('invoice.changeState', $invoice['invoice_identifier']) }}"
                            method="POST">
                            {{-- @method('GET') --}}
                            @csrf
                            <!-- Hidden Inputs to Include Invoice Data -->

                            <button type="submit" class="btn btn-danger"> إتمام الفاتوره</button>
                        </form>
                        @else
                        <form action="{{ route('invoice.index') }}" method="POST">
                            @method('GET')
                            @csrf
                            <!-- Hidden Inputs to Include Invoice Data -->

                            <button type="submit" class="btn btn-danger"> العوده للصفحه السابقه</button>
                        </form>
                            <a href="javascript:void(0)" id="printBtn" class="btn btn-default">
                                <i class="glyphicon glyphicon-print"></i> طباعة الفاتورة
                            </a>
                            <script>
                                document.getElementById('printBtn').addEventListener('click', function() {
                                    var printWindow = window.open('{{ url('/prnpriview', $invoice->id) }}', '_blank');
                                    printWindow.onload = function() {
                                        printWindow.print();
                                    };
                                });
                            </script>

                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>





    <!--/End Main content container-->
@endsection
