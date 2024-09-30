<!-- resources/views/admin/invoice/edit.blade.php -->
@extends('layouts.lay')

@section('content')
<div class="main_content_container">
    <div class="main_container main_menu_open">
        <div class="page_content">
            <div class="home_pass hidden-xs">
                <ul>
                    <li class="bring_right"><span class="glyphicon glyphicon-home"></span></li>
                </ul>
            </div>

            <!-- Title -->
            <h1 class="heading_title">{{ isset($invoice) ? 'تعديل فاتورة' : 'إضافة فاتورة جديدة' }}</h1>
            @include('layouts.message')

            <!-- Form Container -->
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
                                    <option value="{{ $client->id }}"
                                        {{ isset($invoice) && $invoice->client_id == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @if (isset($invoice))
                        <input type="hidden" name="id" value="{{ $invoice['id'] }}">
                    @endif

                    <!-- Button to Add More Items -->
                    <div class="form-group">
                        <div class="col-sm-12 left_text">
                            <button type="button" class="btn btn-success" onclick="addItem()">إضافة بند آخر</button>
                            <button type="submit"
                                class="btn btn-danger">{{ isset($invoice) ? 'تحديث الفاتورة' : 'إضافة الفاتورة' }}</button>
                        </div>
                    </div>

                    <!-- Add Item Section -->
                    <div id="items-container">
                        @if(isset($invoice))
                            <!-- Pre-fill the form with existing items -->
                            @foreach($items as $i => $item)
                                @include('admin.invoice.item-row', ['i' => $i, 'item' => (object) $item, 'products' => $products])
                            @endforeach
                        @else
                            <!-- Initial empty item row -->
                            @foreach($items as $i => $item)
                                @include('admin.invoice.item-row', ['i' => $i, 'item' => (object) $item, 'products' => $products])
                            @endforeach
                        @endif
                    </div>
                </form>
            </div>

            <!-- JavaScript -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script>
                function addItem() {
                    // Clone the first item row
                    const itemContainer = document.querySelector('.item-row').cloneNode(true);

                    // Clear the input and select values in the cloned row
                    itemContainer.querySelectorAll('input').forEach(function (input) {
                        input.value = ''; // Clear the input fields
                    });

                    itemContainer.querySelectorAll('select').forEach(function (select) {
                        select.selectedIndex = 0; // Reset the select to the default option
                    });

                    // Show the remove button in the cloned row
                    const removeButton = itemContainer.querySelector('.btn-danger');
                    if (removeButton) {
                        removeButton.style.display = 'inline-block'; // Ensure the button is shown
                    }

                    // Update the ids of the cloned row elements
                    let index = document.querySelectorAll('.item-row').length;
                    itemContainer.querySelectorAll('input, select').forEach(function (element) {
                        const id = element.id;
                        if (id) {
                            element.id = id.replace(/\d+$/, '') + index; // Update IDs to make them unique
                        }
                    });

                    // Append the cloned row to the items container
                    document.getElementById('items-container').appendChild(itemContainer);

                    // Re-attach the remove event listener to the new remove button
                    removeButton.addEventListener('click', function () {
                        removeItem(this);
                    });
                }

                function removeItem(button) {
                    // Remove the closest item row to the clicked delete button
                    button.closest('.item-row').remove();
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
@endsection
