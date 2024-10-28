@extends('backend.layouts.master')
@section('css')

@section('title')
    {{ trans('products_trans.Products') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('products_trans.Products') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#"
                        class="default-color">{{ trans('products_trans.All_Products') }}</a></li>
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

                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('products_trans.Id') }}</th>
                            <th>{{ trans('products_trans.Name') }}</th>
                            <th>{{ trans('products_trans.Brand_Name') }}</th>
                            <th>{{ trans('products_trans.Quantity') }}</th>
                            <th>{{ trans('products_trans.Tags') }}</th>
                            <th>{{ trans('products_trans.Category_Name') }}</th>
                            <th>{{ trans('products_trans.Store_Name') }}</th>
                            <th>{{ trans('products_trans.Status') }}</th>
                            <th>{{ trans('products_trans.Control') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($store->products as $product)
                            <tr>
                                <td>
                                    <img src="{{$product->image_url}}" height="50" width="50" alt="">
                                </td>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->brand->name }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ implode(',',$product->tags()->pluck('name')->toArray() ); }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->store->name }}</td>
                                <td>
                                    @if ($product->status == 'active')
                                        <span class="badge badge-rounded badge-success p-2 mb-2">
                                            {{ trans('products_trans.Active') }}
                                        </span>
                                    @elseif($product->status == 'draft')
                                        <span class="badge badge-rounded badge-warning p-2 mb-2">
                                            {{ trans('products_trans.Draft') }}
                                        </span>
                                    @elseif($product->status == 'archvied')
                                        <span class="badge badge-rounded badge-danger p-2 mb-2">
                                            {{ trans('products_trans.Archvied') }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <a href="" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ Route('admin.products.edit', $product->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>


                                    <form action="{{ Route('admin.products.destroy', $product->id) }}" method="post"
                                        style="display:inline">
                                        @csrf
                                        @method('delete')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                    {{-- <a href="" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> 
                                    
                                </a>     --}}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>
@endpush
