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
            margin: 10;
        }

        table {
            width: 80%;
            border-collapse: collapse;
        }

        table,
        table th,
        table td {
            margin: 10;

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
            /* margin-bottom: 50; */
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

        .footer {
            margin-top: 40px;
            text-align: center;
        }

        .inv-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .inv-header .logo {
            width: 130px;
            position: relative;
            top: 20px;

            /* Adjust the value as needed to shift the logo down */
        }


        .inv-header .company-name {
            font-size: 35px;
            font-weight: bold;
            text-align: right;

        }

        .inv-header .header {
            width: 15%;
            padding: 10px;
            box-shadow: 0px 5px 15px rgba(105, 103, 103, 0.1);
            text-align: center;
            background-color: #dcd7d73d;
            font-weight: bold;
            border-bottom: 2px solid;
            /* Makes text bold */
            font-size: 24px;
            /* Change the size to your preference */
            font-family: 'Arial', sans-serif;
            /* Change the font style to your desired one */
            font-size: 30px;
            font-weight: 600;
            color: #001a3d;
        }
    </style>

    <div class="main_content_container">
        <div class="main_container main_menu_open_invoice">

            <div class="page_content">

                <div class="inv-header">
                    <div class="company-name">
                        سمارت <br>بلاست </div>

                    <!-- Invoice Summary in the center -->
                    <div class="header">
                        الفاتورة
                    </div>
                    <div class="logo">
                        <img src="{{ asset('front/images/sm_p_images/sm_p_logo.PNG') }}" alt="Logo"
                            style="width:100%;">
                    </div>

                </div>

                <!-- Company Name on the right -->
            </div>
            <div class="page_content">

                <table class="table-wrapper" style="margin-bottom: 2%">
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
                    <div class="half-width">
                        <table>
                            <tr>
                                <th>إجمالي الفاتوره :</th>
                                @if (isset($invoice))
                                    <td>{{ $invoice['total_before_discount'] }}</td>
                                @else
                                    <td>{{ $newinvoice['total_before_discount'] }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>الخصم :</th>
                                @if (isset($invoice))
                                    <td>{{ $invoice['total_before_discount'] - $invoice['total_after_discount'] }}</td>
                                @else
                                    <td>{{ $newinvoice['total_before_discount'] - $newinvoice['total_after_discount'] }}
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <th>الاجمالى بعد الخصم :</th>
                                @if (isset($invoice))
                                    <td>{{ $invoice['total_after_discount'] }}</td>
                                @endif
                            </tr>
                        </table>
                    </div>
                    <div class="half-width">
                        <table>
                            <tr>
                                <th>المبلغ المدفوع : </th>
                                @if (isset($invoice))
                                    <td>{{ $invoice['paid'] }}</td>
                                @else
                                    <td>{{ $newinvoice['paid'] }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th> المبلغ المتبقي :</th>
                                @if (isset($invoice))
                                    <td>{{ $invoice['total_after_discount'] - $invoice['paid'] }}</td>
                                @else
                                    <td>{{ $newinvoice['total_after_discount'] - $newinvoice['paid'] }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>رصيد العميل :</th> <!-- Client balance -->
                                @if (isset($invoice->client))
                                    <td>{{ $invoice->client->balance }}</td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </div>

                <style>
                    .inv-footer {
                        display: flex;
                    }

                    .inv-footer .half-width {
                        flex: 1;
                        margin-right: 10px;
                    }

                    .inv-footer table {
                        width: 100%;
                        border: 1px solid silver;
                    }

                    .inv-footer table th,
                    .inv-footer table td {
                        padding: 6px;
                        text-align: right;
                        border: 1px solid rgba(228, 209, 209, 0.049);
                    }
                </style>


            @endif



        </div>
    </div>





</body>

{{--
    <div class="footer">
        <p>شكراً لتعاملكم معنا</p>
    </div> --}}

</html>
