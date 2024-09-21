@extends('layouts.lay')
@section('content')
<!--Start Main content container-->
<div class="main_content_container">
    <div class="main_container main_menu_open">
        <div class="page_content">
            <h1 class="heading_title">عرض كل العملاء</h1>

            <div class="wrap">
                <table class="table table-bordered">
                    <colgroup>
                        <col style="width: 5%;"> <!-- ID Column -->
                        <col style="width: 25%;"> <!-- Client Name Column -->
                        <col style="width: 25%;"> <!-- Client email Column -->
                        <col style="width: 15%;"> <!-- Role Column -->
                        <col style="width: 15%;"> <!-- Actions Column -->
                    </colgroup>
                    @include('layouts.message')


                    <tr>
                        <td>#</td>
                        <td>الرقم التعريفي</td>
                        <td>اسم العميل</td>
                        <td>رقم الهاتف</td>
                        <td>الحساب</td>
                        <td>التحكم</td>
                    </tr>
                    @foreach ($clients as $item)
                        <!-- <tr @if($item->status == 0) class="table-danger" @endif> Apply red color if status is 0 -->
                        <tr> <!-- Apply red color if status is 0 -->
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->client_identifier }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->balance }}</td>
                            <td>
                                <a href="{{ route('client.edit', $item->id) }}" class="glyphicon glyphicon-pencil"
                                    data-toggle="tooltip" data-placement="top" title="Edit"></a>
                                <a href="{{ route('client.show', $item->id) }}" class="glyphicon glyphicon-eye-open"
                                    data-toggle="tooltip" data-placement="top" title="Show"></a>
                                    <a href="{{ route('clients.balance.edit', $item->id) }}"
                                        class="glyphicon glyphicon-plus" title="تسديد حساب"></a>

                                <!-- <a href="javascript:void(0);" class="glyphicon glyphicon-remove" data-toggle="tooltip"
                                            data-placement="top" title="delete" onclick="confirmDelete({{ $item->id }})"></a> -->

                                <!-- Hidden form for delete action -->
                                <!-- <form id="delete-form-{{ $item->id }}" action="{{ route('client.destroy', $item->id) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td> -->
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    function confirmDelete(clientId) {
        Swal.fire({
            title: "هل أنت متأكد من ازالة هذا العميل؟ ",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "نعم"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + clientId).submit();
                Swal.fire({
                    title: "تم تجميد الهميل",
                    icon: "success"
                });
            }
        });
    }
</script> -->
<!--/End Main content container-->
@endsection
