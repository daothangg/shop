@extends('admin/layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Forms</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Product</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                        <button type="button"
                            class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                                href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                                link</a>
                        </div>
                    </div>
                </div>
            </div>

            <!--end row-->
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h6 class="mb-0 text-uppercase">Horizontal Form</h6>
                    <hr />
                    <div class="card border-top border-0 border-4 border-info">
                        <form id="formSubmit" action="{{ url('admin/updateProduct') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="card-title d-flex align-items-center">
                                        <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                                        </div>
                                        <h5 class="mb-0 text-info">Product</h5>
                                    </div>
                                    <hr />
                                    <input type="hidden" name="id" id="id" value="{{ $id }}" />
                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Product Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" id="name"
                                                value="{{ $data->name }}" placeholder="Enter Your Name">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Product Slug</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="slug" id="inputPhoneNo2"
                                                value="{{ $data->slug }}" placeholder="Product Slug">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="enter_text" class="col-sm-3 col-form-label">Product Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="image" class="form-control" id="photo" />
                                        </div>
                                        @if ($data->image != '')
                                            <img style="width:150px;object-fit:cover;position: relative;top: 10px;left: 50%;right: 50%;"
                                                src="{{ asset('/') }}{{ $data->image }}">
                                        @endif
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Item Code</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $data->item_code }}"
                                                name="item_code" id="inputChoosePassword2" placeholder="Item Code">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputConfirmPassword2" class="col-sm-3 col-form-label">Keywords</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="keywords" value="{{ $data->keywords }}"
                                                class="form-control" id="inputConfirmPassword2"
                                                placeholder="Confirm Password">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputAddress4" class="col-sm-3 col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="description" value="{{ $data->description }}" id="description" rows="3"
                                                placeholder="short desc"><?php echo $data->description; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="category" class="col-sm-3 col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="category_id" id="category">
                                                @foreach ($category as $cateList)
                                                    <option value="{{ $cateList->id }}">
                                                        {{ $cateList->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($data->category != '')
                                                <option value="{{ $cateList->id }}">
                                                    {{ $cateList->name }}
                                                </option>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="Attribute" id="Attribute"
                                            class="col-sm-3 col-form-label">Attribute</label>
                                        <div class="col-sm-9">
                                            <span id="multiAttr">
                                                @if (isset($data['attribute'][0]->id))
                                                    <select name="attribute_id[]" id="attribute_id" class="form-control"
                                                        multiple>
                                                        @foreach ($data['attribute'] as $attributeList)
                                                            <option value="{{ $attributeList['attribute_values']->id }}"
                                                                selected>
                                                                {{ $attributeList['attribute_values']->value }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif

                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputAddress4" class="col-sm-3 col-form-label">Brand</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="brand_id" id="brand">

                                                @foreach ($brand as $cateList1)
                                                    <option value="{{ $cateList1->id }}">
                                                        {{ $cateList1->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row mb-3">
                                            <label for="enter_text" class="col-sm-3 col-form-label">Product
                                                Attribute</label>

                                            <div class="col-sm-9">
                                                <div class="col-sm-3">
                                                    <button type="button" id="AddAttributeButton"
                                                        class="btn btn-info ">Add Attribute</button>
                                                </div>
                                                @php
                                                    $Count = 1;
                                                    $imageCount = 1;
                                                @endphp
                                                <div id="addAttr">
                                                    @foreach ($data['productAttributes'] as $productAttr)
                                                        <div class="row" id="addAttr_{{ $Count }}">
                                                            <input type="hidden" name="productAttrId[]"
                                                                value="{{ $productAttr['id'] }}">

                                                            <div class="col-sm-3">
                                                                <select class="form-control" id="color_id"
                                                                    name="color_id[]">
                                                                    @foreach ($color as $list12)
                                                                        @if ($productAttr['color_id'] == $list12->id)
                                                                            <option selected value="{{ $list12->id }}">
                                                                                {{ $list12->name }}</option>
                                                                        @else
                                                                            <option value="{{ $list12->id }}">
                                                                                {{ $list12->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <select class="form-control" id="size_id"
                                                                    name="size_id[]">
                                                                    @foreach ($size as $size1)
                                                                        @if ($productAttr['size_id'] == $size1->id)
                                                                            <option required value="{{ $size1->id }}">
                                                                                {{ $size1->text }}</option>
                                                                        @else
                                                                            <option value="{{ $size1->id }}">
                                                                                {{ $size1->text }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <input type="text" value="{{ $productAttr['sku'] }}"
                                                                    name="sku[]" class="form-control" id="sku"
                                                                    placeholder="Enter SKU">
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="text" value="{{ $productAttr['mrp'] }}"
                                                                    name="mrp[]" class="form-control" id="mrp"
                                                                    placeholder="Enter MRP">
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="text" value="{{ $productAttr['price'] }}"
                                                                    name="price[]" class="form-control" id="price"
                                                                    placeholder="Enter Price">
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="text" value="{{ $productAttr['data'] }}"
                                                                    name="data[]" class="form-control" id="data"
                                                                    placeholder="Enter Data">
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="text" value="{{ $productAttr['qty'] }}"
                                                                    name="qty[]" class="form-control" id="qty"
                                                                    placeholder="Enter Qty">
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="col-sm-9">
                                                                    <input type="hidden" name="imageValue[]"
                                                                        value="{{ $Count }}">
                                                                    <div class="col-sm-3">
                                                                        <button type="button" id="addAttrImages"
                                                                            onclick="addAttrImages1('AddAttrImage_{{ $Count }}','{{ $Count }}')"
                                                                            class="btn btn-info">Add Image</button>
                                                                    </div>

                                                                    <div id="AddAttrImage_{{ $Count }}">
                                                                        @if (isset($productAttr['images'][0]))
                                                                            @foreach ($productAttr['images'] as $productAttrImages)
                                                                                <div
                                                                                    id="AddAttrImage_{{ $imageCount }}">
                                                                                    <input type="file"
                                                                                        name="attr_image_{{ $Count }}[]"
                                                                                        value="{{ $productAttrImages->image }}"
                                                                                        class="form-control"
                                                                                        id="photo" />

                                                                                    @if ($productAttrImages->image != '')
                                                                                        <img style="width:150px; object-fit:cover;"
                                                                                            src="{{ asset('/') }}{{ $productAttrImages->image }}">
                                                                                    @endif
                                                                                </div>
                                                                                @if ($imageCount !== 1)
                                                                                    <button type="button"
                                                                                        id="addAttrImage"
                                                                                        onclick="removeAttr('AddAttrImage_{{ $imageCount }}','{{ $productAttrImages->id }}','product_images')"
                                                                                        class="btn btn-danger">-</button>
                                                                                @endif
                                                                    </div>
                                                                    <?php $imageCount++; ?>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        @if ($Count !== 1)
                                            <button type="button" id="AddAttributeButton"
                                                onclick="removeAttr('AddAttrImaga_{{ $Count }}','{{ $productAttr->id }}','product_attrs')"
                                                class="btn btn-danger">Remove Attribute</button>
                                        @endif
                                    </div>
                                    <?php $Count++; ?>
                                    <?php $imageCount++; ?>
                                    @endforeach

                                </div>
                            </div>

                    </div>

                </div>


                <div class="row">
                    <label class="col-sm-3 col-form-label"></label>
                    <span id="submitButton">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </span>
                </div>

            </div>
        </div>
    </div>
    </form>
    </div>
    </div>
    </div>
    <!--end row-->
    </div>
    </div>
    <script>
        //     var editor = CKEDITOR.replace('description');
        //     CKFinder.setupCKEditor(editor);
        // 
    </script>
    <script>
        var imagee = 1;

        var imageCount = 1;

        function addAttrImages1(id, Count) {
            imagee++;
            imageCount++;
            var deleteimage = 'AddAttrImage_' + imageCount + '';
            // var image='AddAttrImage_'+$Count+''
            var html = '<div id="AddAttrImage_' + imageCount +
                '"> <div id="AddAttrImage_' + imageCount +
                '" class="AddAttrImage"><input type="file" name="attr_image_' + Count +
                '[]"  class="form-control" id="photo" /><button type="button" id="addAttrImage" onclick="removeAttr(\'' +
                deleteimage + '\')"class="btn btn-danger ">-</button></div></div></div>';
            $('#' + id + '').append(html);

        }

        // function removeimage(id) {
        //     $('#' + id + '').remove();
        // }

        function removeAttr(id, attrId = '', type = '') {
            $('#' + id + '').remove();
            if (type != '') {
                removeAttrId(attrId, type);

            }

        }

        function removeAttrId(id, type) {

            var url = "{{ url('admin/removeAttrId') }}";
            $.ajax({
                url: url,
                headers: {

                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                data: {
                    'id': id,
                    'type': type
                },

                type: 'post',
                success: function(result) {

                    if (result.status == 'success') {


                    } else {
                        showAlter(result.status, result.message); // Hiển thị thông báo lỗi
                    }
                },
                error: function(result) {
                    // Handle errors and log them for debugging
                    console.error(result);
                    showAlter(result.responseJSON.status, result.responseJSON.message);
                }
            });
        };
    </script>
    <script>
        var Count = 1999;

        $('#AddAttributeButton').click(function(e) {
            Count++
            var html = '';
            var id = 'addAttr_' + Count + '';
            imageCount++
            var ImageAttr = 'AddAttrImage_' + Count + '';
            var SizeData = $('#size_id').html();
            var ColorData = $('#color_id').html();

            html += '<div class="row" id="addAttr_' + Count +
                '"><input type="hidden" name="productAttrId[]" value="0" >';
            html += '<div class="col-sm-3"><select name="color_id[]" id="color_id" class="form-control">' +
                ColorData +
                ' </select></div>'
            html += '<div class="col-sm-3"><select name="size_id[]"  id="size_id"class="form-control">' + SizeData +
                ' </select></div>';

            html +=
                ' <div class="col-sm-3"><input type="text" name="sku[]" class="form-control" id="sku" placeholder="Enter SKU"></div>'
            html +=
                ' <div class="col-sm-3"><input type="text" name="mrp[]" class="form-control" id="mrp" placeholder="Enter MRP"></div>'
            html +=
                ' <div class="col-sm-3"><input type="text" name="price[]" class="form-control" id="price" placeholder="Enter Price"></div>'
            html +=
                ' <div class="col-sm-3"><input type="text" name="data[]" class="form-control" id="data" placeholder="Enter Data"></div>'
            html +=
                ' <div class="col-sm-3"><input type="text" name="qty[]" class="form-control" id="qty" placeholder="Enter QTY"></div>'
            html +=
                ' <div class="row col-sm-12"><div class="col-sm-9">  <input type="hidden"name="imageValue[]" value="' +
                Count + '"><button type="button" id="addAttrImages"onclick="addAttrImages1(\'' +
                ImageAttr + '\',\'' + Count +
                '\')" class="btn btn-info ">Add Image</button><div id="AddAttrImage_' + Count +
                '" ><div id="AddAttrImage_' + Count +
                '" class="AddAttrImage" ><input type="file"  name="attr_image_' + Count +
                '[]"class="form-control" id="photo" /></div></div></div><button type="button" id="addAttrImage" onclick="removeAttr(\'' +
                id + '\')"class="btn btn-danger ">remove</button></div></div>'
            $('#addAttr').append(html)
        })
    </script>
    <script>
        $("#category").change(function() {
            var category_id = $('#category').val();
            var html = '';
            var url = "{{ url('admin/getAttributes') }}";
            $.ajax({
                url: url,
                headers: {

                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                data: {
                    category_id: category_id

                },

                type: 'post',
                success: function(result) {
                    console.log(result); // Log the result for debugging




                    if (result.status == 'Success') {
                        html +=
                            '<select class="form-control" name="attribute_id[]" id="attribute_id" multiple>';

                        jQuery.each(result.data.data, function(key, val) {

                            jQuery.each(val.values, function(attrKey, attrVal) {

                                html += '<option value="' + attrVal.id + '">' + val
                                    .attribute.name +
                                    '-(' + attrVal.value + ')</option>';
                            })
                        })
                        html += '</select>';

                        // Cập nhật DOM với select mới và khởi tạo multiSelect
                        $('#multiAttr').html(html);
                        $('#attribute_id').multiSelect();

                        console.log(html);
                    } else {
                        showAlter(result.status, result.message); // Hiển thị thông báo lỗi
                    }
                },
                error: function(result) {
                    // Handle errors and log them for debugging
                    console.error(result);
                    showAlter(result.responseJSON.status, result.responseJSON.message);
                }
            });

        });
    </script>




@endsection
