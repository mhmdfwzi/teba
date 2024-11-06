<x-front-layout title="{{ config('app.name') }}">

    <!-- Start Slider Area -->
    <section class="hero-area">
              <div class="container">
                        <x-frontend.alert type="info" />

                        <div class="row">
                                  <div class="col-lg-12 col-12">
                                            <div class="slider-head">
                                                      <!-- Start Hero Slider -->
                                                      <div class="hero-slider">
                                                     
                                                                <!-- Start Single Slider -->
                                                                @foreach ($offers as $offer)
                                                                
                                                                <div class="single-slider" style="padding-right:13px; ">
                                                                    <div class="content">
                                                                  <div class='img'  >
                                                                      <br>
                                                                  <img src="storage/{{$offer->image }}" class='im' alt="">


                                                                  </div>
                                                                  <div class="info" >
                                                                    <h1>
                                                                        <a href="{{ Route('products.show_product',  [$offer->id, $offer->slug])  }}">{{ $offer->name }} </a>
                                                                    </h1>
                                                                    <div class="price" style="direction: ltr ;padding-top:10px;font-size:20px">
                                                                        price <span>{{ Currency::format($offer->price) }}</span>
                                                                        @if ($offer->compare_price>$offer->price)
                                                                            <span class="discount-price">{{ Currency::format($offer->compare_price) }}</span>
                                                             
                                                                        @endif
                                                                    </div>
                                                                     
 
                                                                    <div class="button cart-button">
                                                                        <a href="{{ Route('products.show_product',  [$offer->id, $offer->slug])  }}">
                                                                        <button class="btn" type="submit" style="width: 100%;"> 
                                                                            
                                                                            Get this Offer 
                                                                            @if ($offer->compare_price > $offer->price)
                                                                            <span class="sale-tag">
                                                                                Save({{$offer->sale_percent }}%)</span>
                                                                            @endif
                                                                        </button>
                                                                    </a>
                                                                    </div>
                                                                     
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                                @endforeach
                                                                <!-- End Single Slider -->
                                                      </div>
                                                      <!-- End Hero Slider -->
                                            </div>
                                  </div>
                        </div>
              </div>
    </section>
    <!-- End Slider Area -->

    <!-- Start Most viewed Area -->
    <section class="trending-product section">
              <div class="container">
                        <div class="row">
                                  <div class="col-12">
                                            <div class="section-title">
                                                      <h2>Most viewed  Products</h2>
                                            </div>
                                  </div>
                        </div>
                        <div class="row">
                                  @foreach ($products_mostViewed as $product)
                                  <div class="col-lg-3 col-md-6 col-12">
                                            <x-frontend.product-card :product="$product" />
                                  </div>
                                  @endforeach
                        </div>
              </div>
    </section>
    <!-- End Trending Product Area -->

       <!-- Start Trending Product Area -->
       <section class="trending-product section">
        <div class="container">
                  <div class="row">
                            <div class="col-12">
                                      <div class="section-title">
                                                <h2>Trending Product</h2>
                                      </div>
                            </div>
                  </div>
                  <div class="row">
                            @foreach ($products as $product)
                            <div class="col-lg-3 col-md-6 col-12">
                                      <x-frontend.product-card :product="$product" />
                            </div>
                            @endforeach
                  </div>
        </div>
</section>
<!-- End Trending Product Area -->
    <!-- Start Brands Area -->
    <div class="brands" style="direction: ltr">
        <div class="container">
                  <div class="row">
                            <div class="col-lg-6 offset-lg-3 col-md-12 col-12">
                                <div class="section-title">
                                    <h2>Categories</h2>
                          </div>
                                   
                            </div>
                  </div>

                  <div class="brands-logo-wrapper">
                            <div
                                      class="brands-logo-carousel d-flex align-items-center justify-content-between">
                                      @foreach ($main_categories as $main_category)
                                      <div class="brand-logo">
                                          <a href="{{ Route('shop_grid.index', $main_category->id) }}">
                                                          <img src="{{ $main_category->image_url }}" alt="#">
                                                          <p>{{ $main_category->name }}</p>
                                                </a>
                                      </div>
                                      @endforeach
                            </div>
                  </div>
        </div>
</div>
<!-- End Brands Area -->

    <!-- Start Shipping Info -->
    <section class="shipping-info">
              <div class="container">
                        <ul>
                                  <!-- Free Shipping -->
                                  <li>
                                            <div class="media-icon">
                                                      <i class="lni lni-delivery"></i>
                                            </div>
                                            <div class="media-body">
                                                      <h5>Free Shipping</h5>
                                                      <span>On order over $99</span>
                                            </div>
                                  </li>
                                  <!-- Money Return -->
                                  <li>
                                            <div class="media-icon">
                                                      <i class="lni lni-support"></i>
                                            </div>
                                            <div class="media-body">
                                                      <h5>24/7 Support.</h5>
                                                      <span>Live Chat Or Call.</span>
                                            </div>
                                  </li>
                                  <!-- Support 24/7 -->
                                  <li>
                                            <div class="media-icon">
                                                      <i class="lni lni-credit-cards"></i>
                                            </div>
                                            <div class="media-body">
                                                      <h5>Online Payment.</h5>
                                                      <span>Secure Payment Services.</span>
                                            </div>
                                  </li>
                                  <!-- Safe Payment -->
                                  <li>
                                            <div class="media-icon">
                                                      <i class="lni lni-reload"></i>
                                            </div>
                                            <div class="media-body">
                                                      <h5>Easy Return.</h5>
                                                      <span>Hassle Free Shopping.</span>
                                            </div>
                                  </li>
                        </ul>
              </div>
    </section>
    <!-- End Shipping Info -->

    @push('scripts')
    <script type="text/javascript">
    //========= Hero Slider
    tns({
              container: '.hero-slider',
              slideBy: 'page',
              autoplay: true,
              autoplayButtonOutput: false,
              mouseDrag: true,
              gutter: 8,
              items: 1,
              nav: false,
              controls: true,
              controlsText: ['<i class="lni lni-chevron-left"></i>',
                        '<i class="lni lni-chevron-right"></i>'
              ],
    });

    //======== Brand Slider
    tns({
              container: '.brands-logo-carousel',
              autoplay: true,
              autoplayButtonOutput: false,
              mouseDrag: true,
              gutter: 0,
              nav: false,
              controls: false,
              responsive: {
                        0: {
                                  items: 1
                        },
                        540: {
                                  items: 3
                        },
                        768: {
                                  items: 5
                        },
                        992: {
                                  items: 6
                        }
              }
    });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('frontend/assets/js/cart.js') }}"></script>
    @endpush
</x-front-layout>