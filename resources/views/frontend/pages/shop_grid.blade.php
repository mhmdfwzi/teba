<x-front-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/shop_grid.css') }} " />
    @endpush

    <x-slot name="breadcrumbs">


        <!-- Start Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">معرض المنتجات</h1>
                        </div>
                    </div>
                    {{-- <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ Route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="">Shop</a></li>
                            <li>Shop Grid</li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- End Breadcrumbs -->
    </x-slot>

    <x-frontend.alert type="error" />

    <x-frontend.alert type="success" />

    <!-- Start Product Grids -->
    <section class="product-grids section">
        <div class="container">


            <div class="row">

                <div class="col-lg-3 col-12">

                    <div class="product-sidebar">


                        <!-- Start Product search -->
                        <div class="single-widget search">
                            <form action="#">
                                <input type="text" name="search"id="search" placeholder=" ابحث عن منتج">
                                {{-- <button type="submit"><i class="lni lni-search-alt"></i></button> --}}
                            </form>
                        </div>
                        <!-- End Product search -->


                        <!-- Start Categories Filter -->
                        <div class="single-widget">




                            @if (isset($categories))


                               <!-- Start Brand Filter -->
                        <div class="single-widget condition">
                            <h3>Filter by Brand</h3>
                            <ul class="list">
                                @foreach ($categories as $category)
                                    <li>
                                        {{-- <input type="radio" class="brands" name="brand" value="{{ $brand->id }}"> --}}
                                        <input type="checkbox" value="{{ $category->id }}" name="category[]"
                                            class="category">
                                        <label>
                                            {{ $category->name }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Brand Filter -->

                            @endif
                        </div>

                        <!-- End Categories Filter -->






                      
                        <!-- End stores Filter -->


                        <!-- Start Brand Filter -->
                        <div class="single-widget condition">
                            <h3>Filter by Brand</h3>
                            <ul class="list">
                                @foreach ($brands as $brand)
                                    <li>
                                        {{-- <input type="radio" class="brands" name="brand" value="{{ $brand->id }}"> --}}
                                        <input type="checkbox" value="{{ $brand->id }}" name="brand[]"
                                            class="brand">
                                        <label>
                                            {{ $brand->name }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Brand Filter -->



                        <!-- Start Price Filter -->
                        <div class="single-widget range">
                            <h3>Price Range</h3>
                            <div class="middle">
                                <div id="multi_range">
                                    <span id="left_value">0</span><span> ~ </span><span id="right_value">10000</span>
                                </div>
                                <div class="multi-range-slider my-2">
                                    <input type="range" id="input_left" class="range_slider" min="0"
                                        max="5000" value="0" onmousemove="left_slider(this.value)">
                                    <input type="range" id="input_right" class="range_slider" min="5000"
                                        max="100000" value="100" onmousemove="right_slider(this.value)">
                                    <div class="slider">
                                        <div class="track"></div>
                                        <div class="range"></div>
                                        <div class="thumb left"></div>
                                        <div class="thumb right"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Price Filter -->



                    </div>

                </div>
                <!-- End Product Sidebar -->


                <!-- Start Products section -->
                <div class="col-lg-9 col-12">
                    <div class="product-grids-head">
                        <div class="product-grid-topbar" style="display:none ">
                            <div class="row align-items-center">

                                <div class="col-lg-7 col-md-8 col-12">
                                    <div class="product-sorting dropdown">
                                        <select class="form-control" name="sort" id="sort">
                                            <option value="default">رتب المنتجات</option>
                                            <option value="Low Price">اقل سعر</option>
                                            <option value="High Price">اعلى سعر</option>
                                            <option value="A - Z Order">ترتيب ابجدى</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-grid"
                                role="tabpanel"aria-labelledby="nav-grid-tab">

                                @if ($products->count() > 0)
                                    <div class="show_filtered_products">


                                        <div class="row show_products">
                                            @foreach ($products as $product)
                                                <div class="col-lg-4 col-md-2 col-12">
                                                    <!-- Start Single Product -->
                                                    <div class="single-product">
                                                        @if ($product->sale_percent > $product->price)
                                                            <span class="sale-tag">-
                                                                {{ $product->sale_percent }}%</span>
                                                        @endif
                                                        <div class="product-image">

                                                            <a
                                                                href="{{ Route('products.show_product', [$product->id, $product->slug]) }}">
                                                                <img src="{{ $product->image_url }}" alt="#">
                                                            </a>

                                                        </div>
                                                        <div class="product-info">
                                                            <h4 class="title">
                                                                <a
                                                                    href="{{ Route('products.show_product', [$product->id, $product->slug]) }}">{{ $product->name }}</a>
                                                            </h4>
                                                            <span class="category">
                                                                <a
                                                                    href="{{ Route('shop_grid.index', $product->category->id) }}">
                                                                    {{ $product->category->name }} </a>
                                                                من :
                                                                <a
                                                                    href="{{ Route('shop_grid.indexStore', $product->store->id) }}">
                                                                    {{ $product->store->name }}
                                                                </a>
                                                            </span>


                                                            <div class="price">
                                                                <span>{{ Currency::format($product->price) }}</span>
                                                                @if ($product->compare_price > $product->price)
                                                                    <span
                                                                        class="discount-price">{{ Currency::format($product->compare_price) }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Single Product -->
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Pagination -->
                                                <div class="pagination center">
                                                    <ul class="pagination-list">
                                                        {{-- {{ $products->links() }} --}}
                                                        <button id="seeMoreButton" class="btn btn-primary"
                                                            data-page="1">شوف باقى المنتجات </button>

                                                    </ul>
                                                </div>
                                                <!--/ End Pagination -->
                                            </div>
                                        </div>

                                    </div>
                                @else
                                    <div class="row"
                                        style="text-align: center;
                                    margin-top: 20px; ">
                                        <div class="col-md-12"
                                            style=" background-color: #30bb47;
                                        padding: 100px; ">
                                            <div class="d-flex  justify-content-center ">
                                                <p style="color: white; font-size:25px; font-weight:bold"> لا توجد
                                                    منتجات</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>



                        </div>


                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End Product Grids -->




    @push('scripts')
        <script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>
        <script>
            const input_left = document.getElementById("input_left");
            const input_right = document.getElementById("input_right");
            const thumb_left = document.querySelector(".slider > .thumb.left");
            const thumb_right = document.querySelector(".slider > .thumb.right");
            const range = document.querySelector(".slider > .range");

            const set_left_value = () => {
                const _this = input_left;
                const [min, max] = [parseInt(_this.min), parseInt(_this.max)];

                _this.value = Math.min(parseInt(_this.value), parseInt(input_right.value) - 1);

                const percent = ((_this.value - min) / (max - min)) * 100;
                thumb_left.style.left = percent + "%";
                range.style.left = percent + "%";
            };
            const set_right_value = () => {
                const _this = input_right;
                const [min, max] = [parseInt(_this.min), parseInt(_this.max)];

                _this.value = Math.max(parseInt(_this.value), parseInt(input_left.value) + 1);

                const percent = ((_this.value - min) / (max - min)) * 100;
                thumb_right.style.right = 100 - percent + "%";
                range.style.right = 100 - percent + "%";
            };

            input_left.addEventListener("input", set_left_value);
            input_right.addEventListener("input", set_right_value);

            function left_slider(value) {
                document.getElementById('left_value').innerHTML = value;
            }

            function right_slider(value) {
                document.getElementById('right_value').innerHTML = value;
            }



            $(document).ready(function() {



                function seeMore() {
                    // See More Button Click Event
                    $('#seeMoreButton').on('click', function() {
                        // Update the page number or any other parameters as needed
                        var nextPage = parseInt($(this).data('page')) + 1;
                        console.log(nextPage);

                        var category = $('.category:checked').map(function() {
                            return $(this).val();
                        }).get();
                        var brand = $('.brand:checked').map(function() {
                            return $(this).val();
                        }).get();

                        var store = $('.store:checked').map(function() {
                            return $(this).val();
                        }).get();
                        var minPrice = $('#left_value').text();
                        var maxPrice = $('#right_value').text();
                        var search = $('#search').val();
                        var sort = $('#sort').val();

                        // Make an AJAX request to get more products
                        $.ajax({
                            url: "{{ route('all_filters') }}?page=" + nextPage,
                            type: "GET",
                            data: {
                                category: category,
                                brand: brand,
                                store: store,
                                min_price: minPrice,
                                max_price: maxPrice,
                                search: search,
                                sort: sort
                            },
                            // Include other necessary parameters for filtering
                            // ...
                            success: function(response) {
                                var product_length = response.products.data.length;
                                var products = response.products.data;
                                var html = '';
                                console.log(products);


                                for (var i = 0; i < product_length; i++) {
                                    var product = products[i];
                                    // Create HTML elements to display product information
                                    var productHtml =
                                        '<div class="col-lg-4 col-md-6 col-12">' +
                                        '<!-- Start Single Product -->' +
                                        '<div class="single-product">';
                                    if (product.sale_percent > product.price) {
                                        productHtml += '<span class="sale-tag">- ' + product
                                            .sale_percent +
                                            ' %</span>';
                                    }
                                    productHtml +=
                                        '<div class="product-image">' +
                                        '<a href="' + getProductRoute(product.id, product.slug) +
                                        '">' +
                                        '<img src="' + product.image_url + '" alt="#">' +
                                        '</a>' +
                                        '</div>' +
                                        '<div class="product-info">' +
                                        '<h4 class="title">' +
                                        '<a href="' + getProductRoute(product.id, product.slug) +
                                        '">' + product.name +
                                        '</a>' +
                                        '</h4>' +
                                        '<span class="category">' +
                                        '<a href="' + getCategoryRoute(product.category_id) + '">' +
                                        (product.category ? product.category.name : '') +
                                        '</a>' +
                                        ' من:' +
                                        '<a href="' + getStoreRoute(product.store_id) + '">' +
                                        (product.store ? product.store.name : '') +
                                        '</a>' +
                                        '</span>' +

                                        '<div class="price">' +
                                        '<span>' + product.formatted_price + '</span>';

                                    if (product.formatted_compare_price > product.formatted_price) {
                                        productHtml += '<span class="discount-price">' + product
                                            .formatted_compare_price +
                                            '</span>';
                                    }

                                    productHtml +=
                                        '</div>' +
                                        '</div>' +
                                        '</div>' +
                                        '</div>' +
                                        '</div>';

                                    html += productHtml;
                                }

                                function getProductRoute(id, slug) {
                                    return "{{ route('products.show_product', ['id' => ':id', 'slug' => ':slug']) }}"
                                        .replace(':id', id).replace(':slug', slug)
                                }

                                function getCategoryRoute(categoryId) {
                                    return "{{ route('shop_grid.index', ['categoryId' => ':categoryId']) }}"
                                        .replace(':categoryId', categoryId);
                                }

                                function getStoreRoute(storeId) {
                                    return "{{ route('shop_grid.indexStore', ['storeId' => ':storeId']) }}"
                                        .replace(':storeId', storeId);
                                }

                                // Append new products to the existing grid
                                $('.show_products').append(html);

                                // Update the data-page attribute for the next request
                                $('#seeMoreButton').data('page', nextPage);

                                // Optionally, hide the "See More" button if there are no more pages
                                if (nextPage >= response.products.last_page) {
                                    $('#seeMoreButton').hide();
                                }
                            },
                        });
                    });
                }


                // apply filters function
                function applyFilters() {
                    var category = $('.category:checked').map(function() {
                        return $(this).val();
                    }).get();
                    var brand = $('.brand:checked').map(function() {
                        return $(this).val();
                    }).get();

                    var store = $('.store:checked').map(function() {
                        return $(this).val();
                    }).get();
                    var minPrice = $('#left_value').text();
                    var maxPrice = $('#right_value').text();
                    var search = $('#search').val();
                    var sort = $('#sort').val();

                    $.ajax({
                        url: "{{ route('all_filters') }}",
                        type: "GET",
                        data: {
                            category: category,
                            brand: brand,
                            store: store,
                            min_price: minPrice,
                            max_price: maxPrice,
                            search: search,
                            sort: sort
                        },
                        success: function(response) {
                            function getProductRoute(id, slug) {
                                    return "{{ route('products.show_product', ['id' => ':id', 'slug' => ':slug']) }}"
                                        .replace(':id', id).replace(':slug', slug)
                                }

                                function getCategoryRoute(categoryId) {
                                    return "{{ route('shop_grid.index', ['categoryId' => ':categoryId']) }}"
                                        .replace(':categoryId', categoryId);
                                }

                                function getStoreRoute(storeId) {
                                    return "{{ route('shop_grid.indexStore', ['storeId' => ':storeId']) }}"
                                        .replace(':storeId', storeId);
                                }


                            var product_length = response.products.data.length;
                            var products = response.products.data;
                            var html = ''; // Variable to store the updated HTML
                            for (var i = 0; i < product_length; i++) {
                                var product = products[i];
                                // Create HTML elements to display product information
                                // Create HTML elements to display product information
                                var productHtml =
                                    '<div class="col-lg-4 col-md-6 col-12">' +
                                    '<!-- Start Single Product -->' +
                                    '<div class="single-product">';
                                if (product.sale_percent > product.price) {
                                    productHtml += '<span class="sale-tag">- ' + product
                                        .sale_percent +
                                        ' %</span>';
                                }
                                productHtml +=
                                    '<div class="product-image">' +
                                    '<a href="' + getProductRoute(product.id, product.slug) + '">' +
                                    '<img src="' + product.image_url + '" alt="#">' +
                                    '</a>' +
                                    '</div>' +
                                    '<div class="product-info">' +
                                    '<h4 class="title">' +
                                    '<a href="' + getProductRoute(product.id, product.slug) + '">' + product
                                    .name +
                                    '</a>' +
                                    '</h4>' +
                                    '<span class="category">' +
                                    '<a href="' + getCategoryRoute(product.category_id) + '">' +
                                        (product.category ? product.category.name : '') +
                                    '</a>' +
                                    ' من:' +
                                    '<a href="' + getStoreRoute(product.store_id) + '">' +
                                        (product.store ? product.store.name : '') +
                                    '</a>' +
                                    '</span>' +


                                    '<div class="price">' +
                                    '<span>' + product.formatted_price + '</span>';

                                if (product.formatted_compare_price) {
                                    productHtml += '<span class="discount-price">' + product
                                        .formatted_compare_price +
                                        '</span>';
                                }

                                productHtml +=
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';

                                html += productHtml;
                            }

                            function getProductRoute(id, slug) {
                                return "{{ route('products.show_product', ['id' => ':id', 'slug' => ':slug']) }}"
                                    .replace(':id', id).replace(':slug', slug)
                            }
                            // Update the HTML with the new results
                            $('.show_products').html(html);

                            // // Update the data-page attribute for the next request
                            // $('#seeMoreButton').data('page', nextPage);

                            // // Optionally, hide the "See More" button if there are no more pages
                            // if (nextPage >= response.products.last_page) {
                            //     $('#seeMoreButton').hide();
                            // }

                            // Update pagination links
                            // $('.pagination-list').html(response.pagination_links);
                        },
                    });
                }






                // Reset filters
                $('.button').on('click', function(e) {
                    e.preventDefault();
                    $('input.category, input.brand , input.store').prop('checked', false);
                    $('#search').val('');
                    applyFilters();
                });

                // Apply search filter
                $('#search').on('keyup', function() {
                    applyFilters();
                });

                // Apply category filter
                $('input.category').on('change', function() {
                    applyFilters();
                    // seeMore();

                    // paginate();
                });

                // Apply store filter
                $('input.store').on('change', function() {
                    applyFilters();
                    // seeMore();

                    // paginate();
                });

                // Apply brand filter
                $('input.brand').on('change', function() {
                    applyFilters();
                    // seeMore();

                    // paginate();
                });

                // Apply sort filter
                $('#sort').on('change', function() {
                    applyFilters();
                    // paginate();
                });

                // Apply price range filter
                $('.range_slider').on('change', function() {
                    applyFilters();
                    // paginate();
                });

                // Initialize filters
                // applyFilters();

                // paginate();

                seeMore();



            });
        </script>
    @endpush
</x-front-layout>
