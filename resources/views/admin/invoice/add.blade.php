@extends('layouts.lay')

@section('content')
{{-- @dd($items) --}}
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
            <h1 class="heading_title">إضافة فاتوره جديده</h1>
            @include('layouts.message')

            <div class="form">
                <form class="form-horizontal" action="{{ route('invoice.display') }}" method="POST">
                    @csrf
                    <!-- Client Dropdown -->
                    <div class="form-group">
                        <label for="client" class="col-sm-2 control-label bring_right left_text">العميل</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="client" name="العميل" required>
                                <option value="">بحث عن اسم العميل...</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('العميل') == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Button to Add More Items -->
                    <div class="form-group">
                        <div class="col-sm-12 left_text">
                            <button type="button" class="btn btn-success" onclick="addItem()">إضافة بند آخر</button>
                            <button type="submit" class="btn btn-danger">إضافة الفاتورة</button>
                        </div>
                    </div>
                    <!-- Add Item Section -->
                    <div id="items-container">
                        @if(old('البند'))
                            @foreach(old('البند') as $index => $itemId)
                                <div class="form-group item-row">
                                    <div class="col-sm-3">
                                        <label for="quantity" class="control-label bring_right left_text">الكميه</label>
                                        <input type="number" class="form-control" name="الكميه[]"
                                            value="{{ old('الكميه.' . $index, 1) }}" required>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="item" class="control-label bring_right left_text">البند</label>
                                        <select class="form-control item-select" name="البند[]" required>
                                            <option value="">بحث عن اسم البند...</option>
                                            @foreach ($products as $item)
                                                <option value="{{ $item->id }}" {{ $itemId == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if ($index > 0)
                                        <div class="col-sm-1">
                                            <button type="button" class="btn btn-danger btn-xs" onclick="removeItem(this)">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <!-- Initial item row -->
                            <div class="form-group item-row">
                                <div class="col-sm-3">
                                    <label for="quantity" class="control-label bring_right left_text">الكميه</label>
                                    <input type="number" class="form-control" name="الكميه[]" value="1" required>
                                </div>

                                <div class="col-sm-4">
                                    <label for="size" class="control-label bring_right left_text">المقاس</label>
                                    <select class="form-control size-select" name="المقاس[]" required>
                                        <option value="">بحث عن المقاس...</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="item" class="control-label bring_right left_text">البند</label>
                                    <select class="form-control item-select" name="البند[]" required>
                                        <option value="">بحث عن اسم البند...</option>
                                        @foreach ($products as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <!-- Initially hide the remove button for the first item -->
                                    <button type="button" class="btn btn-danger btn-xs" onclick="removeItem(this)" style="display: none;">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </form>
            </div>

            <!-- JavaScript -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                function addItem() {
                    const itemContainer = $('.item-row').first().clone();
                    // Clear values in the cloned row
                    itemContainer.find('input, select').val('');
                    itemContainer.find('.size-select').empty().append('<option value="">بحث عن المقاس...</option>');
                    // Show the remove button for the new row
                    itemContainer.find('.btn-danger').show();
                    // Append the new row to the container
                    $('#items-container').append(itemContainer);
                }

                function removeItem(button) {
                    $(button).closest('.item-row').remove();
                }

                // Event delegation for dynamically added item selects
                $(document).on('change', '.item-select', function() {
                    const itemSelect = $(this);
                    const productId = itemSelect.val();
                    const sizeSelect = itemSelect.closest('.item-row').find('.size-select');

                    // Clear previous sizes
                    sizeSelect.empty().append('<option value="">بحث عن المقاس...</option>');

                    if (productId) {
                        $.ajax({
                            url: '{{ route('fetch.sizes') }}',
                            type: 'GET',
                            data: { product_id: productId },
                            success: function(data) {
                                // Populate sizes
                                data.forEach(function(size) {
                                    sizeSelect.append('<option value="' + size.id + '">' + size.size + '</option>');
                                });
                            },
                            error: function(xhr) {
                                console.error('Failed to fetch sizes:', xhr);
                            }
                        });
                    }
                });
            </script>
        </div>
    </div>
</div>
<!--/End Main content container-->
@endsection
