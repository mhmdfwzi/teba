<x-front-layout title="{{$blogNews->title}}">

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
                            <li><a href="{{ Route('blogsNews') }}">التدوينات</a></li>
                            <li>{{$blogNews->title}}</li>
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
                        <div class="col-lg-8 col-12">
                            <div class="info-body custom-responsive-margin">
                                <div style=" padding:15px 0px" class="blogdetails">
                                <h1>{{ $blogNews->title }}</h1>
                                </div>
                                    <div class="blogdatailsimage"  >
                                        <img class="blog-image" src="{{ $blogNews->image_url }}"  
                                            alt="{{ $blogNews->title }}">
                                    </div>
                    
                    
                                    {!! $blogNews->content !!}
                                    <div class="sharethis-inline-share-buttons" style="margin-top: 30px"></div>
                               
                            
                            </div>
                        </div>
                        <div class="col-lg-4 col-12"   >
                            <div class="info-body">
                                
                                <h4>تدوينات   أخرى</h4>
                                @foreach ($popularBlogNews as $popular)
                                    <div class="d-flex mt-5" style="justify-content: flex-start; align-items:center">
                
                                        <img src="{{ $popular->image_url }}" style="height: 50px; width:100px" alt="">
                                        <a href="{{ route('blogNewsDetails', $popular->id) }}" style="color: black">
                                            <span class="mx-4">{{ $popular->title }}</span>
                                        </a>
                
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
