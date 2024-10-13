@extends('admin/layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">User Profile</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Category</li>
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
            <h6 class="mb-0 text-uppercase">Add Product</h6>
            <hr />
            <div class="col">
                <a href="{{asset('admin/manage_product')}}/0"><button type="button"  class="btn btn-outline-info px-5 radius-30" 
                    data-bs-target="#exampleModal">Add Product</button></a>
                {{-- <button type="button" onclick="saveData('0','','','')" class="btn btn-outline-info px-5 radius-30" data-bs-toggle="modal"
                data-bs-target="#exampleModal">Add Size</button> --}}
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Item Code</th>
                                    <th>Keywords</th>
                                    <th>Description</th>
                                    {{-- <th>Category </th>
                                    <th>Brand</th> --}}
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $list)
                                    <tr>
                                        <td>{{ $list->id }}</td>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->slug }}</td>
                                        <td><img src="{{URL::asset(''. $list->image )}}" alt="Image" width="150px" height="150px">
                                        </td></td>
                                        <td>{{ $list->item_code }}</td>
                                        <td>{{ $list->keywords }}</td>
                                        <td>{{ $list->description }}</td>
                                         {{-- <td>{{ $list['category']->name }}({{ $list['category']->slug }}) </td> --}}
                                        {{-- <td>{{ $list['brand']->name }}</td>  --}}

                                        <td><a href="{{url('admin/manage_product')}}/{{$list->id}}"><button type="button"
                                                class="btn btn-outline-info px-5 radius-30" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">Update</button></a>
                                            <button onclick="deleteData('{{ $list->id }}','products')"
                                                class="btn btn-outline-info px-5 radius-30">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-tile" id="exampleModalLabel">Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formSubmit" action="{{ url('admin/updateProduct') }}" method="post" enctype="multipart/form-data">

                    @csrf
                    <div class="modal-body">

                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                                </div>

                            </div>
                            <hr />
                            <div class="row mb-3">
                                <label for="enter_text" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="enter_name"
                                        placeholder="Name"required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="enter_text" class="col-sm-3 col-form-label">Slug</label>
                                <div class="col-sm-9">
                                    <input type="text" name="slug" class="form-control" id="enter_slug"
                                        placeholder="Slug"required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="enter_text" class="col-sm-3 col-form-label">Item_code</label>
                                <div class="col-sm-9">
                                    <input type="text" name="item_code" class="form-control" id="enter_item_code"
                                        placeholder="Item Code"required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="enter_text" class="col-sm-3 col-form-label">Keywords</label>
                                <div class="col-sm-9">
                                    <input type="text" name="keywords" class="form-control" id="enter_keywords"
                                        placeholder="Keywords"required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="enter_text" class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <input type="text" name="description" class="form-control" id="enter_description"
                                        placeholder="Text"required>
                                </div>
                            </div>
                           
                            {{-- <div class="row mb-3">
                                <label for="enter_text" class="col-sm-3 col-form-label">Parent Category Id</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="category_id" id="parent_category_id">
                                        @foreach ($category as $list1)
                                            <option value="{{ $list1->id }}">{{ $list1->name }}({{ $list1->slug }})
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="enter_text" class="col-sm-3 col-form-label">Parent Brand Id</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="brand_id" id="parent_brand_id">
                                        @foreach ($brand as $list2)
                                            <option value="{{ $list2->id }}">{{ $list2->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div> --}}
                            <div class="row mb-3">
                                <label for="enter_text" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" class="form-control" id="photo" />
                                </div>
                                <div id="image_key">
                                    <img src="" id="imgPreview"  height="200px" width="200px" >
                                </div>
                            </div>

                            <input type="hidden" name="id" id="enter_id">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Close</button>
                        <span id="submitButton">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </span>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        

        function saveData(id,name,slug,image,item_code,keywords,description,brand_id, category_id) {
            if (checkId != 0) {
                $('#parent_category_id option[value="' + checkId + '"]').show();
                $('#parent_brand_id option[value="' + checkId + '"]').show();

            }
            
            $('#enter_id').val(id);
            $('#enter_name').val(name);
            $('#enter_slug').val(slug);
            $('#enter_item_code').val(item_code);
            $('#enter_keywords').val(keywords);
            $('#enter_description').val(description);
           
            var checkId = id;
            $('#parent_category_id').val(category_id);
            $('#parent_brand_id').val(brand_id);

            $('#parent_category_id option[value="' + id + '"]').hide();
            $('#parent_brand_id option[value="' + id + '"]').hide();
            if(image ==''){
                var key_image="{{URL::asset('images/448383722_332513999893525_3792276178432463082_n.jpg')}}"
            }else{
                var key_image="{{URL::asset('images')}}/"+image+"";
                // $('#photo').removeAttr(require);
            }
            var html='<img src="'+key_image+'"  id="imgPreview" height="200px" width="200px" >';
            $('#image_key').html(html);
            $('#photo').html(html);

        }
    </script>
@endsection
