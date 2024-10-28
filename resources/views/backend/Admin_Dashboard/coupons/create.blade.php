@extends('backend.layouts.master')
@section('css')

@section('title')
    {{ trans('coupons_trans.Create_Coupon') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('coupons_trans.Create_Coupon') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('coupons_trans.Create_Coupon') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('coupons_trans.Coupons') }}</li>
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


                <form method="post" enctype="multipart/form-data" action="{{ Route('admin.coupons.store') }}"
                    autocomplete="off">

                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <x-backend.form.input label="{{ trans('coupons_trans.Coupon_Name') }}" name="name"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-backend.form.input label="{{ trans('coupons_trans.Code') }}" name="code"
                                    class="form-control" />
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <x-backend.form.textarea label="{{ trans('coupons_trans.Description') }}"
                                    name="description" />
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <x-backend.form.input label="{{ trans('coupons_trans.Discount_Amount') }}"
                                    name="discount_amount" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <x-backend.form.input label="{{ trans('coupons_trans.Discount_Percentage') }}"
                                    name="discount_percentage" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('coupons_trans.Status') }}<span class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="active">
                                    <label class="form-check-label">
                                        {{ trans('coupons_trans.Active') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="inactive"
                                        checked>
                                    <label class="form-check-label">
                                        {{ trans('coupons_trans.Inactive') }}
                                    </label>
                                </div>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> {{ trans('coupons_trans.Expiration_Date') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="datepicker-action" data-date-format="yyyy-mm-dd"
                                    {{-- type="datetime-local"  --}} name="expiration_date">
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> {{ trans('coupons_trans.Store_Name') }} <span
                                        class="text-danger">*</span></label>
                                <select name="store_id" id="" class="custom-select mr-sm-2">
                                    <option value="">{{ trans('coupons_trans.Choose') }}</option>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                                @error('store_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <x-backend.form.input label="{{ trans('coupons_trans.Usage_Limit') }}"
                                    name="usage_limit" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-backend.form.input label="{{ trans('coupons_trans.Usage_Count') }}"
                                    name="usage_count" class="form-control" value="0" />
                            </div>
                        </div>
                    </div>







                    <button type="submit"
                        class="btn btn-success btn-md nextBtn btn-lg ">{{ trans('coupons_trans.Add') }}</button>


                </form>




            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@push('scripts')
<script>
    function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endpush
