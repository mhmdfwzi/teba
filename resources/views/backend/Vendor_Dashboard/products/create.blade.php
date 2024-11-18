@extends('backend.layouts.master')
@section('css')
<link href="{{ URL::asset('backend/assets/tagify/tagify.css') }}" rel="stylesheet">

@section('title')
    {{ trans('products_trans.Create_Product') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('products_trans.Create_Product') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('products_trans.Create_Product') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('products_trans.Products') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
                <form method="post" enctype="multipart/form-data" action="{{ Route('vendor.products.store') }}"
                    autocomplete="off">

                    @csrf


                    <div class="row">
                        <div class="col-md-6"> 
                            <div class="form-group">
		  <x-backend.form.input label="اسم المنتج" name="name" required autofocus="autofocus" autofocus type="text" class="form-control" />
                            
                            </div>
                        </div>

                        <div class="col-md-6" style="display:none;">
                            <div class="form-group">
                                <label> {{ trans('products_trans.Brand_Name') }} <span
                                        class="text-danger">*</span></label>
                                <select name="brand_id" id="" class="custom-select mr-sm-2">
                                    <option value="">{{ trans('products_trans.Choose') }}</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label> {{ trans('products_trans.Category_Name') }} <span
                                        class="text-danger">*</span></label>
                                <select name="category_id" id="" class="custom-select mr-sm-2" required>
                                    <option value=''>{{ trans('products_trans.Choose') }}</option> 
                                    @foreach ($categories as $category) 
                                        <option value="{{ $category->id }}">{{ $category->name }} </option>
                                     @endforeach 
                                </select>
                                @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6" style="display: none">
                            <div class="form-group">
                                <label> {{ trans('products_trans.Store_Name') }} <span
                                        class="text-danger">*</span></label>
                                <select name="store_id" id="" class="custom-select mr-sm-2" required>
                                    {{-- <option value="">{{ trans('products_trans.Choose') }}</option> --}}
                                    {{-- @foreach ($stores as $store) --}}
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    {{-- @endforeach --}}
                                </select>
                                @error('store_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>





                    </div>

                    {{-- price and compare_price --}}
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <x-backend.form.input label="السعر النهائى" required name="price"
                                type="number"  step="any" class="form-control" required/>
                            </div>
                        </div>
					</div>
					<div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <x-backend.form.input label="السعر قبل الخصم"
                                type="number" step="any" name="compare_price" class="form-control" required/>
                            </div>
                        </div>

                    </div>



                    <div class="row">
 

                    </div>


                    <div class="row">


                        <div class="col-md-6" style="display:none;">
                            <div class="form-group">
                                <x-backend.form.input label="{{ trans('products_trans.Quantity') }}" 
                                type="number" value="1" name="quantity" class="form-control" required/>
                            </div>
                        </div>
 

                    </div>

                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
 
                                <x-backend.form.textarea name="short_description"  label="وصف قصير للمنتج" required />
								@error('short_description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


    


                    <div class="row">
                        <div class="col-md-12">
							<div class="form-group"><label>وصف طويل للمنتج</label>
                                <textarea id="summernote" name="description" 
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 
                                dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:border-blue-500"
                                  name="content" required>
                                    {{-- {{ old('content') }} --}}
                                </textarea>

                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                                {{-- <x-backend.form.textarea label="{{ trans('products_trans.Description') }}"
                                    name="description" /> --}}
                            </div>
                        </div>
                    </div>
					                       
                    <div class="row">
                        <div class="col-md-6">
        <div class="form-group">
            <label> Offer/Not Offer  <span
                class="text-danger">*</span></label>
        <select name="offer" id="" class="custom-select mr-sm-2" required>
            <option value="0">not offer</option>
            <option value="1"> offer</option>
        </select>
            @error('offer')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>



                        
					<div class="row">
					                        <div class="col-md-6">
                            <div class="form-group">
                                <label>وحده / وزن <span
                                        class="text-danger">*</span></label>
                                <select name="measure" id="" class="custom-select mr-sm-2" required>
                                    <option value="unite">وحده</option>
                                    <option value="kg">وزن بالكيلو</option>
                                    <option value="gram">وزن بالجرام</option>
                                      
                                </select>
                                @error('measure')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
					</div>
                    <div class="row">
                        <div class="col-md-6">
                    <div class="form-group">
                    <label> Status <span
                    class="text-danger">*</span></label>
                    <select name="status" id="" class="custom-select mr-sm-2" required>
                    <option value="active">active</option>
                    <option value="inactive"> inactive</option>
                    </select>
                    @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    </div>
                    </div>


                    {{-- Image input --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> {{ trans('products_trans.Image') }}<span class="text-danger">*</span></label>
                                <div class="avatar-img">
                                    {{-- <label class="avatar-label circle" for="upload-photo" >+</label>
                                    <img class="avatar" src="{{URL::asset('assets/images/user.png')}}" alt=""> --}}
                                    <input onchange="preview()" type="file" name="image" accept="image/*"
                                        id="upload-photo" required />
                                </div>
                                @error('image')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-lg text-center p-3">
                                <img src="{{ asset('backend/assets/images/profile-avatar.jpg') }}" height="200"
                                    width="200" class="img-fluid" id="frame" />
                            </div>
                        </div>
                    </div>






                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('products_trans.Add') }}</button>


                </form>
                
            </div>
        </div>
    </div>
</div>


<!-- row closed -->
@endsection

@push('scripts')
{{-- Tagify --}}
<script src="{{ asset('backend/assets/tagify/tagify.js') }}" ></script>
<script src="{{ asset('backend/assets/tagify/tagify.polyfills.min.js') }}" ></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $('#summernote').summernote({
        placeholder: 'Hello ..!',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'video']],
            ['view', ['codeview', 'help']]
        ]
    });
</script>
<script>
    function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
    }

    var inputElm = document.querySelector('[name=tags]'),
    tagify = new Tagify (inputElm);


    
</script>

{{-- Color enable & disabled --}}
<script>
    $('input[name="colors_active"]').on('change', function() {
        if ($('input[name="colors_active"]').is(':checked')) {
            $('#colors-selector').prop('disabled', false);
            $('#sku_combination').show();
        } else {
            $('#colors-selector').prop('disabled', true);
            $('#sku_combination').hide();
        }
    });
</script>
@endpush
