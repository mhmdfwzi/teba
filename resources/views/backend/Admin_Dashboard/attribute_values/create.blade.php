@extends('backend.layouts.master')
@section('css')

@section('title')
    {{ trans('attribute_values_trans.Create_Attribute_Value') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('attribute_values_trans.Create_Attribute_Value') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('attribute_values_trans.Create_Attribute_Value') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('attribute_values_trans.Attribute_Values') }}</li>
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


                <form method="post" enctype="multipart/form-data" action="{{ Route('admin.attribute_values.store') }}"
                    autocomplete="off">

                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> {{ trans('attribute_values_trans.Attribute_Name') }} <span
                                        class="text-danger">*</span></label>
                                <select name="attribute_id" id="" class="custom-select mr-sm-2">
                                    <option value="">{{ trans('attribute_values_trans.Choose') }}</option>
                                    @foreach ($attributes as $attribute)
                                        <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                    @endforeach
                                </select>
                                @error('attribute_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <x-backend.form.input
                                    label="{{ trans('attribute_values_trans.Attribute_Value_Name') }}" name="name"
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <x-backend.form.input label="{{ trans('attribute_values_trans.Value') }}"
                                    name="value" class="form-control" />
                            </div>
                        </div>
                    </div>





                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('attribute_values_trans.Add') }}</button>


                </form>




            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@push('scripts')
@section('js')
<script>
    function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endpush
