<x-front-layout title="{{ config('app.name') }}">

  
    <div class="container-fluid py-5" style="direction: rtl">
        <div class="container-xxl">
            <div class="d-flex justify-content-between wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="display-6 mb-5">المدونات</h1>
                <a href="{{ route('blogsNews', 'blog') }}" style="color: #e52422">عرض الكل</a>
            </div>
    
            <div class="row g-4 justify-content-center">
                @foreach ($blogs as $key => $blog)
                    @if ($key === 0)
                        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-item">
                                <div>
                                    <img class="w-100 h-100" src="{{ $blog->image_url }}"
                                        style="min-height: 300px; max-height: 300px; margin-bottom:20px" alt="">
                                </div>
                                <div class="d-flex align-items-center bg-light blog-content"
                                    style="
                                        display: flex;
                                        align-items: center;
                                        justify-content: start;
                                        padding:10px">
                                    {{-- 
                                    <div class="flex-shrink-0 p-1">
                                        <i {!! $service->icon ? $service->icon : '' !!} style="font-size:25px"></i>
                                    </div> --}}
                                    <div style="display: block">
                                        <a class="h5 mx-4 mb-0"
                                            href="{{ route('blogNewsDetails', $blog->id) }}">{{ $blog->title }}</a>
                                        <p class="mx-4 mb-0">
    
                                            {!! \Illuminate\Support\Str::words(strip_tags($blog->content), 20, '...') !!}
    
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
    
                <div class="col-lg-6 col-md-6 wow fadeInUp d-flex">
                    <div class="row" style="align-content:flex-start; gap:35px">
                        @foreach ($blogs->skip(1)->take(3) as $key => $blog)
                            <div class="d-flex mt-2" style="justify-content: flex-start; align-items:center">
    
                                <img src="{{ $blog->image_url }}" style="height: 70px; width:100px; min-width:100px"
                                    alt="">
                                <div style="display: block">
                                <div style="margin-right:25px">
                                    <a href="{{ route('blogNewsDetails', $blog->id) }}" style="color: black">
                                        <span   style="font-weight: bold ; ">{{ $blog->title }}</span>
                                    </a>
                                    <p class=" mb-0">
    
                                        {!! \Illuminate\Support\Str::words(strip_tags($blog->content), 20, '...') !!}
    
                                    </p>
                                    </div>
                                </div>
    
                            </div>
                        @endforeach
                    </div>
                </div>
    
            </div>
    
        </div>
    </div>
    
    

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
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('frontend/assets/js/cart.js') }}"></script>
    @endpush
</x-front-layout>