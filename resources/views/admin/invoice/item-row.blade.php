<!-- resources/views/invoice/item-row.blade.php -->
{{-- @dd($item->product->id ) --}}

<div class="form-group item-row">
    <!-- Quantity Input -->
    <div class="col-sm-3">
        <label for="quantity-{{ $i }}" class="control-label bring_right left_text">الكميه</label>
        <input type="number" id="quantity-{{ $i }}" class="form-control" name="الكميه[]" value="{{ $item->quantity ?? 1 }}" required>
    </div>

    <!-- Size Dropdown (Dynamic, Populated via AJAX) -->
    <div class="col-sm-3">
        <label for="size-{{ $i }}" class="control-label bring_right left_text">المقاس</label>
        <select id="size-{{ $i }}" class="form-control size-select" name="المقاس[]" required>
            <option value="">بحث عن المقاس...</option>
            @if(isset($item->size))
                <option value="{{ $item->product_size_id }}" selected>{{ $item->size }}</option>
            @endif
        </select>
    </div>

    <!-- Item Dropdown -->
    <div class="col-sm-4">
        <label for="item-{{ $i }}" class="control-label bring_right left_text">البند</label>
        <select id="item-{{ $i }}" class="form-control item-select" name="البند[]" required>
            <option value="">بحث عن اسم البند...</option>
            @foreach ($products as $itemOption)
                <option value="{{ $itemOption->id }}" {{ $item->product->product_id == $itemOption->id ? 'selected' : '' }}>
                    {{ $itemOption->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Remove Button -->
    <div class="col-sm-1">
        <button type="button" class="btn btn-danger btn-xs" onclick="removeItem(this)">
            <span class="glyphicon glyphicon-remove"></span>
        </button>
    </div>
</div>
