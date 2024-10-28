@extends('backend.layouts.master')
@section('css')

@section('title')
    {{ trans('attributes_trans.Edit_Attribute') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('attributes_trans.Edit_Attribute') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('attributes_trans.Edit_Attribute') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('attributes_trans.Attributes') }}</li>
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
                    action="{{ Route('admin.attributes.update', $attribute->id) }}" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-backend.form.input value="{{ $attribute->name }}"
                                    label="{{ trans('attributes_trans.Attribute_Name') }}" name="name"
                                    class="form-control" />
                            </div>
                        </div>
                    </div>


                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('attributes_trans.Edit') }}</button>


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
        frame.src = URL.EditObjectURL(event.target.files[0]);
    }
</script>
@endpush
