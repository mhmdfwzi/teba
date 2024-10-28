@extends('backend.layouts.master')

@section('title')
    {{ trans('orders_trans.Orders') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{ trans('orders_trans.Orders') }} {{ $status }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#"
                            class="default-color">{{ trans('orders_trans.All_Orders') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('orders_trans.Orders') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <x-backend.alert type="info" />

    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <table id="custom_table" class="display">
                        <thead>
                            <tr>
                                <th>{{ trans('orders_trans.Id') }}</th>
                                <th>{{ trans('orders_trans.User_Name') }}</th>
                                <th>{{ trans('orders_trans.Store_Name') }}</th>
                                <th>{{ trans('orders_trans.Category_Name') }}</th>
                                <th>{{ trans('orders_trans.Product_Name') }}</th>
                                <th>{{ trans('orders_trans.Status') }}</th>
                                @if ($status != 'completed')
                                    <th>{{ trans('orders_trans.Change_Status') }}</th>
                                @endif
                                <th>{{ trans('orders_trans.Order_Number') }}</th>
                                <th>{{ trans('orders_trans.Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>

                                    <td>{{ $order->id }}</td>

                                    <td>
                                        {{ $order->user->first_name }}
                                    </td>

                                    <td>{{ $order->store->name }}</td>

                                    <td>
                                        @foreach ($order->products as $product)
                                            {{ $product->category->name }}
                                        @endforeach
                                    </td>

                                    <td>
                                        @foreach ($order->products as $product)
                                            {{ $product->order_item->product_name }} {
                                            {{ $product->order_item->quantity }} }

                                            {{-- {{ $product->name }} { {{ $product->quantity }} } --}}
                                        @endforeach
                                    </td>

                                    <td>
                                        @if ($order->status == 'pending')
                                            <span class="badge badge-rounded badge-warning p-2 mb-2">
                                                {{ trans('orders_trans.Pending') }}
                                            </span>
                                        @elseif($order->status == 'processing')
                                            <span class="badge badge-rounded badge-primary p-2 mb-2">
                                                {{ trans('orders_trans.Processing') }}
                                            </span>
                                        @elseif($order->status == 'delivering')
                                            <span class="badge badge-rounded badge-info p-2 mb-2">
                                                {{ trans('orders_trans.Delivering') }}
                                            </span>
                                        @elseif($order->status == 'completed')
                                            <span class="badge badge-rounded badge-success p-2 mb-2">
                                                {{ trans('orders_trans.Completed') }}
                                            </span>
                                        @elseif($order->status == 'cancelled')
                                            <span class="badge badge-rounded badge-danger p-2 mb-2">
                                                {{ trans('orders_trans.Cancelled') }}
                                            </span>
                                        @elseif($order->status == 'refunded')
                                            <span class="badge badge-rounded badge-danger p-2 mb-2">
                                                {{ trans('orders_trans.Refunded') }}
                                            </span>
                                        @endif
                                    </td>

                                    @if ($order->status != 'completed')
                                        <td>
                                            <a href="{{ Route('admin.orders.changeStatus', [$order->id, $order->status]) }}"
                                                class="btn btn-warning btn-sm">
                                                Change to next process
                                            </a>
                                        </td>
                                    @endif

                                    <td>{{ $order->number }}</td>

                                    <td>
                                        @php
                                            $totalPrice = 0;
                                        @endphp

                                        @foreach ($order->products as $product)
                                            @php
                                                $totalPrice += $product->price;
                                            @endphp
                                        @endforeach

                                        {{ Currency::format($totalPrice) }}
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


            var datatable = $('#custom_table').DataTable({
                stateSave: true,
                sortable: true,
                responsive: true,
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },

                    'colvis'
                ]
            });

            $('#assign_delivery').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var orderId = button.data(
                    'order-id'); // Extract the order ID from the button data attribute
                $('#order_id').val(orderId); // Set the value of the hidden input field with the order ID
            });

        });
    </script>
@endpush
