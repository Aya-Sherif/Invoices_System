<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <!-- Stylesheets -->
    <link href="{{ asset('admin') }}/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ asset('admin') }}/css/icon.css" rel="stylesheet"> --}}
    <link href="{{ asset('admin') }}/css/style.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/css/ar.css" rel="stylesheet" class="lang_css arabic">

    <!-- SweetAlert2 -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    <!-- Select2 CSS -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> --}}

    <!-- jQuery (necessary for Select2 to work) -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

    <!-- Select2 JavaScript -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}



    <!-- HTML5 shim and Respond.js for IE8 support -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Header Section -->
    <style>
        @media print {
            @page {
                size: A3;
            }
        }

        ul {
            padding: 0;
            margin: 4 5 1rem 0;
            list-style: none;
        }

        body {
            font-family: "Inter", sans-serif;
            margin: 0;
        }

        table {
            width: 80%;
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
            padding: 6px;
        }

        h1,
        h4,
        p {
            margin: 0;
        }

        .table-wrapper {
            text-align: right;
            width: 20%;
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
        <div class="main_container main_menu_open_invoice">
            <div class="home_pass hidden-xs">
                <ul>
                    <li class="bring_right"><span class="glyphicon glyphicon-home"></span></li>
                </ul>
            </div>
            <div class="page_content">
                <h1 class="heading_title">ملخص الفاتوره</h1>

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
                                <td>{{ \Carbon\Carbon::parse($newinvoice['date'])->format('Y, M, d') }}
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
                                        <td>{{ $invoice['total_before_discount'] - $invoice['total_after_discount'] }}
                                        </td>
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



            </div>
        </div>
    </div>






</body>

</html>
