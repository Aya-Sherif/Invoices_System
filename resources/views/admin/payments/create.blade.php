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
                <h1 class="heading_title">الدفع للفاتورة: {{ $invoice->invoice_identifier }}</h1>
                @include('layouts.message')

                <div class="form">
                    <form class="form-horizontal" action="{{ route('payments.process', $invoice->id) }}" method="POST">
                        @csrf

                        <!-- Payment Amount -->
                        <div class="form-group">
                            <label for="amount_paid">المبلغ المدفوع</label>
                            <input type="number" name="amount_paid" id="amount_paid" class="form-control" required min="0" placeholder="أدخل المبلغ المدفوع">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">تأكيد الدفع</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
