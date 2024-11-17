@extends('backend.layouts.master')

@section('title')
    المدونات / الأخبار
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> المدونات / الأخبار</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">لوحة التحكم</a></li>
                    <li class="breadcrumb-item active"> المدونات / الأخبار</li>
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
                    <table id="custom_table" class="display">
                        <thead>
                            <tr>

                                <th>Id</th>
                                <th>الصورة</th>
                                <th>عنوان</th>
                                <th>الصفحة الرئيسية</th>
                                <th> النوع</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogsNews as $blogNews)
                                <tr>

                                    <td>{{ $blogNews->id }}</td>
                                    <td> 
                                        <img src="{{ $blogNews->image_url }}" height="50" width="50" alt="">
                                    </td>

                                    <td>{{ $blogNews->title }}</td>

                                    <td>
                                        @if ($blogNews->main_page == 1)
                                            <span class="text-success">عرض</span>
                                        @else
                                            <span class="text-danger">إخفاء</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($blogNews->type == 'blog')
                                            <span class="text-success">مدونة</span>
                                        @else
                                            <span class="text-danger">أخبار</span>
                                        @endif
                                    </td>


                                    <td>
                                       
                                        <a href="{{ route('admin.blogsNews.edit', $blogNews->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>


                                        <form action="{{ Route('admin.blogsNews.destroy', $blogNews->id) }}" method="post"
                                            style="display:inline">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>


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
                oLanguage: {
                    sSearch: 'البحث',
                    sInfo: "Got a total of _TOTAL_ entries to show (_START_ to _END_)",
                    sZeroRecords: 'لا يوجد سجل متتطابق',
                    sEmptyTable: 'لا يوجد بيانات في الجدول',
                    oPaginate: {
                        sFirst: "First",
                        sLast: "الأخير",
                        sNext: "التالى",
                        sPrevious: "السابق"
                    },
                },
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
                            columns: [1, 2, 3]
                        }
                    },

                    'colvis'
                ],
                responsive: true
            });


        });
    </script>
@endpush
