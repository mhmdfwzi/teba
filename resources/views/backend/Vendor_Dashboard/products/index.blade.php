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
                
                <table  style="display: none">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('products_trans.Id') }}</th>
                            <th>{{ trans('products_trans.Name') }}</th>
                            <th>{{ trans('products_trans.Brand_Name') }}</th>
                            <th>{{ trans('products_trans.Quantity') }}</th>
                            {{-- <th>{{ trans('products_trans.Tags') }}</th> --}}
                            <th>{{ trans('products_trans.Category_Name') }}</th>
                            <th>{{ trans('products_trans.Store_Name') }}</th>
                            <th>{{ trans('products_trans.Status') }}</th>
                            <th>{{ trans('products_trans.Variants_Count') }}</th>
                            <th>{{ trans('products_trans.Add_Variant') }}</th>
                            <th>{{ trans('products_trans.Control') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td> 
                                </td>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->brand->name }}</td>
                                <td>{{ $product->quantity }}</td>
                                {{-- <td>{{ implode(',',$product->tags()->pluck('name')->toArray() ); }}</td> --}}
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->store->name }}</td>
                                <td>
                                    @if ($product->status == 'active')
                                        <span class="badge badge-rounded badge-success p-2 mb-2">
                                            {{ trans('products_trans.Active') }}
                                        </span>
                                    @else 
                                        <span class="badge badge-rounded badge-warning p-2 mb-2">
                                            {{ trans('products_trans.Draft') }}
                                        </span>
                                    
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('vendor.product_variants.show', $product->id) }}" class="btn btn-info btn-sm">
                                    {{$product->product_variants_count}}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{Route('vendor.product_variants.create',$product->id)}}" class="btn btn-primary btn-sm">
                                        {{ trans('products_trans.Add_Variant') }}
                                    </a>
                                </td>

                                <td>
                                    <a href="" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ Route('vendor.products.edit', $product->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>


                                    <form action="{{ Route('vendor.products.destroy', $product->id) }}" method="post"
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
{{----------------------------------------------------------------------------------------------------------------}}
           
                    @foreach ($products as $product)
                    <table style="width: 100%; background-color:#f4f5f7; padding:5px" >
                        <tr><td colspan="3">{{ $product->name}}</td></tr>
                        <tr><td rowspan="6" style="width: 100px" align="center">
							<img src="{{$product->image_url}}"  style="max-width: 100px; max-height:80px" alt=""></td></tr>
                        <tr><td width='60'>السعر</td>
                            <td style="text-align: right">
                                {{ $product->price }}
                        
                            
                        </td></tr>
                        <tr><td>العدد</td><td style="text-align: right">{{ $product->quantity }}</td></tr>
                        <tr><td>المبيعات</td><td style="text-align: right">230</td></tr>
                        <tr>
                            <td>
                                @if ($product->status == 'active')
                            <span class="badge badge-rounded badge-success p-2 mb-2">
                                {{ trans('products_trans.Active') }}
                            </span>
                        @elseif($product->status == 'inactive')
                            
                            <span class="badge badge-rounded badge-danger p-2 mb-2">
                               غير نشط
                            </span>
                        @endif
                            </td>
                            
                            <td style="text-align: right"><a href="{{ Route('vendor.products.edit', $product->id) }}"
                            class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                         
                        <a href="" class="btn btn-primary btn-sm">
                            <i class="fa fa-eye"></i>
                        </a>

                        <a href="{{Route('vendor.product_variants.create',$product->id)}}" class="btn btn-primary btn-sm">
                            الخصائص {{$product->product_variants_count}}
                        </a>
                    </td>
                </tr>
                        <tr><td> </td>
                            <td>
                            
                        </td></tr>

                        </table>
                        <hr style="padding-bottom: 30px">
                            @endforeach
                        

                 




                
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
