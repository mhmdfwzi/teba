<x-front-layout title="التدوينات">

    <x-slot name="breadcrumbs">
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                           
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ Route('home') }}"><i class="lni lni-home"></i> الرئيسيه</a></li>
                            <li><a href="#">التدوينات</a></li> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
 
    <x-frontend.alert type="error" />

    <x-frontend.alert type="success" />

    <!-- Start Item Details -->
    <section class="item-details section">
        <div class="container">
 
 
            <div class="product-details-info">
                <div class="single-block">
                    <div class="row">
                        <div class="col-lg-7 col-12">
                           <!-- last blog -->
                           @foreach ($blogs as $key => $blog)
                           @if ($key === 0) 
                                   <div class="service-item" data-wow-delay="0.1s">
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
                              
                           @endif
                       @endforeach
                        </div>
                        <div class="col-lg-5 col-12"   >
                            <div class="info-body">
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
            
        
        </div>
    </section>
    <section>
       
    </section>
    <!-- End Item Details -->

    <!-- Add Review Modal -->



   


 
   


    @push('scripts')
    
         
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
         
 
          <script type="text/javascript"
          src="https://platform-api.sharethis.com/js/sharethis.js#property=6566f0433bcaed00121fca65&product=inline-share-buttons&source=platform"
          async="async"></script>
  
    @endpush
    
</x-front-layout>
