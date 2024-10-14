@foreach ($data['productAttributes'] as $productAttr)
<div class="row" id="addAttr_{{ $Count }}">
    <input type="hidden" name="productAttrId[]"
        value="{{ $productAttr->id }}">

    <div class="col-sm-3">
        <select class="form-control" id="color_id"
            name="color_id[]">
            @foreach ($color as $list12)
                @if ($productAttr->color_id == $list12->id)
                    <option selected value="{{ $list12->id }}">
                        {{ $list12->name }}
                    </option>
                @else
                    <option value="{{ $list12->id }}">
                        {{ $list12->name }}
                    </option>
                @endif
            @endforeach
        </select>

    </div>
    <div class="col-sm-3">
        <select class="form-control" id="size_id"
            name="size_id[]">
            @foreach ($size as $size1)
                @if ($productAttr->size_id == $size1->id)
                    <option required value="{{ $size1->id }}">
                        {{ $size1->text }}
                    </option>
                @else
                    <option value="{{ $size1->id }}">
                        {{ $size1->text }}
                    </option>
                @endif
            @endforeach
        </select>

    </div>
    <div class="col-sm-3">
        <input type="text" value="{{ $productAttr->sku }}"
            name="sku[]" class="form-control" id="sku"
            placeholder="Enter SKU">
    </div>
    <div class="col-sm-3">
        <input type="text" value="{{ $productAttr->mrp }}"
            name="mrp[]" class="form-control" id="mrp"
            placeholder="Enter MRP">
    </div>
    <div class="col-sm-3">
        <input type="text" value="{{ $productAttr->price }}"
            name="price[]" class="form-control" id="price"
            placeholder="Enter Price">
    </div>
    <div class="col-sm-3">
        <input type="text" value="{{ $productAttr->data }}"
            name="data[]" class="form-control" id="data"
            placeholder="Enter Data">
    </div>
    <div class="col-sm-3">
        <input type="text" value="{{ $productAttr->qty }}"
            name="qty[]" class="form-control" id="qty"
            placeholder="Enter Qty">
    </div>
    <div class="col-sm-12">
        <div class="col-sm-9">
            <input type="hidden" name="imageValue[]"
                value="{{ $Count }}">
            <div class="col-sm-3">
                <button type="button" id="addAttrImages"
                    onclick="addAttrImages1('AddAttrImage_{{ $imageCount }}','{{ $imageCount }}')"
                    class="btn btn-info ">Add Image</button>
            </div>

            <div id="AddAttrImage_{{ $Count }}">
                @foreach ($productAttr['images'] as $productAttrImages)
                    <div id="AddAttrImage_{{ $imageCount }}">
                        <input type="file"
                            name="attr_image_{{ $Count }}[]"
                            value="{{ $productAttrImages->image }}"
                            class="form-control" id="photo" />


                        @if ($productAttrImages->image != '')
                            <img style="width:150px  ;object-fit:cover;"
                                src="{{ asset('/') }}{{ $productAttrImages->image }}">
                        @endif
                    </div>
                    @if ($imageCount !== 1111)
                        <button type="button" id="addAttrImage"
                            onclick="removeAttr('AddAttrImage_{{ $imageCount }}','{{ $productAttrImages->id }}','product_images')"class="btn btn-danger ">-</button>
                    @endif
                    <?php $imageCount++; ?>
                @endforeach
            </div>
        </div>

    </div>

    @if ($Count !== 1)
        <button type="button" id="AddAttributeButton" onclick="removeAttr('AddAttrImaga_{{ $Count }}','{{ $productAttr->id }}','product_attrs')"class="btn btn-danger ">Remove Attribute</button>
    @endif

</div>
<?php $Count++; ?>
<?php $imageCount++; ?>
@endforeach



</div>

</div>

</div>