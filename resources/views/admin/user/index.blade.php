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
            <h1 class="heading_title">عرض كل الموظفين</h1>

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
                        <td>اسم الموظف</td>
                        <td>البريد الالكتروني</td>
                        <td>الوظيفه</td>
                        <td>التحكم</td>
                    </tr>
                    @foreach ($users as $item)
                        <!-- <tr @if($item->status == 0) class="table-danger" @endif> Apply red color if status is 0 -->
                        <tr> <!-- Apply red color if status is 0 -->
                            <td @if($item->status == 0) class="bg-danger" @endif>{{ $loop->iteration }}</td>
                            <td @if($item->status == 0) class="bg-danger" @endif>
                                {{ $item->name }}
                            </td>
                            <td @if($item->status == 0) class="bg-danger" @endif>{{ $item->email }}</td>
                            <td @if($item->status == 0) class="bg-danger" @endif>
                                @if($item->role == 'sales')
                                    مندوب
                                @elseif($item->role == 'accounts')
                                    الحسابات
                                @elseif($item->role == 'stock')
                                    مخازن
                                @elseif($item->role == 'admin')
                                    أدمن
                                @endif
                            </td>
                            <td @if($item->status == 0) class="bg-danger" @endif>
                                <a href="{{ route('user.edit', $item->id) }}" class="glyphicon glyphicon-pencil"
                                    data-toggle="tooltip" data-placement="top" title="edit"></a>

                                <a href="javascript:void(0);" class="glyphicon glyphicon-remove" data-toggle="tooltip"
                                    data-placement="top" title="delete" onclick="confirmDelete({{ $item->id }})"></a>

                                <!-- Hidden form for delete action -->
                                <form id="delete-form-{{ $item->id }}" action="{{ route('user.destroy', $item->id) }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: "هل أنت متأكد من ازالة هذا الموظف؟ ",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "نعم"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
                Swal.fire({
                    title: "تم تجميد الهميل",
                    icon: "success"
                });
            }
        });
    }
</script>
<!--/End Main content container-->
@endsection
