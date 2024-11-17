@extends('backend.layouts.master')

@section('title')
    تعديل مدونة / أخبار
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">تعديل مدونة / أخبار</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">لوحة التحكم</a></li>
                    <li class="breadcrumb-item active">تعديل مدونة / أخبار</li>
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
                        action="{{ Route('admin.blogsNews.update', $blogNews->id) }}" autocomplete="off">

                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">العنوان </label>
                                    <input name="title" id="title" type="text" value="{{ $blogNews->title }}"
                                        class="form-control" />
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="keywords">keywords</label>
                                    <input type="text" class="form-control" value="{{ $blogNews->keywords }}"
                                        id="keywords" name="keywords" />
                                    @error('keywords')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type"> نوع مدونة / أخبار</label>
                                    <select name="type" id="" class="custom-select mr-sm-2">
                                        <option value="blog">مدونة</option>
                                        <option value="news">أخبار</option>
                                    </select>
                                    @error('type')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="active"> نشط </label>
                                    <select name="active" id="active" class="custom-select mr-sm-2">
                                        <option value="1" @selected($blogNews->active == '1')>نشط</option>
                                        <option value="0" @selected($blogNews->active == '0')>غير نشط</option>
                                    </select>
                                    @error('active')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="main_page"> الصفحة الرئيسية </label>
                                    <select name="main_page" id="main_page" class="custom-select mr-sm-2">
                                        <option value="1" @selected($blogNews->main_page == '1')>عرض</option>
                                        <option value="0" @selected($blogNews->main_page == '0')> أخفاء</option>
                                    </select>
                                    @error('main_page')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea id="summernote"
                                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        name="content">
                            {{ $blogNews->content }}
                        </textarea>
                                    @error('content')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        {{-- Image input --}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>الصورة<span class="text-danger">*</span></label>
                                    <div class="avatar-img">

                                        <input onchange="preview()" type="file" name="image" accept="image/*"
                                            id="upload-photo" />
                                    </div>
                                    @error('image')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded-lg text-center p-3">
                                    <img src="{{ $blogNews->image_url }}" height="200" width="200" class="img-fluid"
                                        id="frame" />
                                </div>
                            </div>
                        </div>






                        <button type="submit" class="btn btn-success btn-md nextBtn btn-lg ">تعديل مدونة / أخبار</button>


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
