@extends('backend.layouts.master')
@section('css')
    {{-- tagify --}}
    <link href="{{ URL::asset('backend/assets/tagify/tagify.css') }}" rel="stylesheet">

    <style>
        .tags-look .tagify__dropdown__item {
            display: inline-block;
            vertical-align: middle;
            border-radius: 3px;
            padding: .3em .5em;
            border: 1px solid #CCC;
            background: #F3F3F3;
            margin: .2em;
            font-size: .85em;
            color: black;
            transition: 0s;
        }

        .tags-look .tagify__dropdown__item--active {
            color: black;
        }

        .tags-look .tagify__dropdown__item:hover {
            background: lightyellow;
            border-color: gold;
        }

        .tags-look .tagify__dropdown__item--hidden {
            max-width: 0;
            max-height: initial;
            padding: .3em 0;
            margin: .2em 0;
            white-space: nowrap;
            text-indent: -20px;
            border: 0;
        }

        .attribute {
            width: 500px;
            padding: 10px;
        }

        .attribute_values {
            width: 500px;
            padding: 10px;
        }
    </style>
@section('title')
    {{ trans('products_trans.Edit_Product') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('products_trans.Edit_Product') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('products_trans.Edit_Product') }}</a></li>
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


                <form method="post" enctype="multipart/form-data"
                    action="{{ Route('vendor.products.update', $product->id) }}" autocomplete="off">

                    @csrf
                    @method('put')


                    <div class="row">
                        <div class="col-md-6">
                            <label> {{ trans('products_trans.Name') }} <span class="text-danger">*</span></label>
                            <div class="form-group">
                            <input name="name" autofocus required type="text"
                            value="{{ $product->name }}" class="form-control" />
                            @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6" style="display:none;">
                            <div class="form-group">
                                <label> {{ trans('products_trans.Brand_Name') }} <span
                                        class="text-danger">*</span></label>
                                <select name="brand_id" id="" class="custom-select mr-sm-2">
                                    <option value="">{{ trans('products_trans.Choose') }}</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" @selected($product->brand_id == $brand->id)>
                                        {{ $brand->name }}</option>
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
                                <select name="category_id" id="" class="custom-select mr-sm-2">
                                     <option value="">{{ trans('products_trans.Choose') }}</option> 
                                 @foreach ($categories as $category) 
                                        <option value="{{ $category->id }}" 
                                         @selected($product->category_id == $category->id) 
                                            >
                                            {{ $category->name }}</option>
                                     @endforeach 
                                </select>
                                @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6"  style="display: none">
                            <div class="form-group">
                                <label> {{ trans('products_trans.Store_Name') }} <span
                                        class="text-danger">*</span></label>
                                <select name="store_id" id="" class="custom-select mr-sm-2">
                                    {{-- <option value="">{{ trans('products_trans.Choose') }}</option> --}}
                                    {{-- @foreach ($stores as $store) --}}
                                        <option value="{{ $store->id }}" 
                                            {{-- @selected($product->store_id == $store->id) --}}
                                            >
                                            {{ $store->name }}</option>
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
                                <x-backend.form.input label="السعر النهائى" name="price"
                                    value="{{ $product->price }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <x-backend.form.input label="السعر قبل الخصم"
                                    name="compare_price" step="any" value="{{ $product->compare_price }}" class="form-control" />
                            </div>
                        </div>

                    </div>

 

                    <div class="row">
 
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-backend.form.input label="{{ trans('products_trans.Quantity') }}"
                                    value="{{ $product->quantity }}" step="any" name="quantity" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="short_description" cols="20" style="width:100%" >
                                    {{ old('content', $product->short_description) }}

                                </textarea>
								@error('short_description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea id="summernote" name="description" class="form-control" {{-- class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  --}}>
                                    {{ old('content', $product->description) }}
                                </textarea>

                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                               
                            </div>
                        </div>
                    </div><div class="row">
                        <div class="col-md-6">
        <div class="form-group">
            <label> Offer/Not Offer  <span
                class="text-danger">*</span></label>
        <select name="offer" id="" class="custom-select mr-sm-2" required>
                   <option value="{{$product->offer}}">
            @if($product->offer=="0") {{"not offer"}}
            @elseif($product->offer=="1") {{" offer"}}
            @endif
        </option>
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
               <option value="{{$product->measure}}">
        @if($product->measure=="unite") {{"وحده"}}
        @elseif($product->measure=="kg") {{"وزن بالكيلو"}}
        @else {{"وزن بالجرام"}}
        @endif
    </option>
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
<option value="{{$product->status}}">
@if($product->status=="active") {{"active"}}
@elseif($product->status=="inactive") {{" inactive"}}
@endif
</option>
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
                                        id="upload-photo" />
                                </div>
                                @error('image')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- @if ($product->image) --}}
                        <div class="col-md-6">
                            <div class="border rounded-lg text-center p-3">
                                <img src="{{ $product->image_url }}" height="200" width="200"
                                    class="img-fluid" id="frame" />
                            </div>
                        </div>
                        {{-- @else
                            <div class="col-md-6">
                                <div class="border rounded-lg text-center p-3">
                                    <img src="{{ asset('backend/assets/images/profile-avatar.jpg') }}" height="200"
                                        width="200" class="img-fluid" id="frame" />
                                </div>
                            </div>
                        @endif --}}
                    </div> 






                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('products_trans.Edit') }}</button>


                </form>




            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@push('scripts')

{{-- Tagify --}}
<script src="{{ asset('backend/assets/tagify/tagify.js') }}"></script>
<script src="{{ asset('backend/assets/tagify/tagify.polyfills.min.js') }}"></script>


<script>
    function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
    }

    var inputElm = document.querySelector('[name=tags]'),
        tagify = new Tagify(inputElm);



  
   

    $(document).ready(function() {
        $('input[name="attribute"]').on('change', function() {
            var attribute_values = $(this).val();
            var result = JSON.parse(attribute_values);
            var value = result[0].value;
            console.log(value); // "Color"
            // console.log(attribute_values);
            if (value) {
                $.ajax({
                    url: "{{ URL::to('get_attribute_value') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="class_id"]').empty();
                        $('select[name="class_id"]').append('<option selected disabled >{{ trans('Parent_trans.Choose') }}...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="class_id"]').append('<option value="' + key + '">' + value + '</option>');
                        }
                        );

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });




</script>

@endpush