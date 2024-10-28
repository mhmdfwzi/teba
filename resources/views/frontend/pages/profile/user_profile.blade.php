<x-front-layout title="">

    @push('styles')
        <style>
                .custom_table_1 {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px;
        }

        .custom_table_1 th,
        .custom_table_1 td {
            border: 1px solid #ddd;
            padding: 2px;
            text-align: right;
        }
        .custom_table_2 td { 
            padding: 4px; 
        }
      
       
            .tab {
                
                float: left;
                /* border: 1px solid #ccc; */
                background-color: #f1f1f1;
                width: 95%;
                /* height: 300px; */
            }

            /* Style the buttons inside the tab */
            .tab button {
                display: inline;
                background-color: inherit;
                color: black;
                padding: 10px 16px;
                width: 35%;
                border: none;
                outline: none;
                text-align: left;
                cursor: pointer;
                transition: 0.3s;
                font-size: 17px;
            }

            /* Change background color of buttons on hover */
            .tab button:hover {
                background-color: #ddd;
            }

            /* Create an active/current "tab button" class */
            .tab button.active {
                background-color: #ccc;
            }

            /* Style the tab content */
            .tabcontent {
                float: left;
                /* padding: 0px 12px; */
                border: 1px solid #ccc;
                width: 100%;
                border-left: none;
                /* height: 300px; */
            }

            @media (min-width: 1025px) {
                .h-custom {
                    height: 100vh !important;
                }
            }

            .horizontal-timeline .items {
                border-top: 2px solid #ddd;
            }

            .horizontal-timeline .items .items-list {
                position: relative;
                margin-right: 0;
            }

            .horizontal-timeline .items .items-list:before {
                content: "";
                position: absolute;
                height: 8px;
                width: 8px;
                border-radius: 50%;
                background-color: #ddd;
                top: 0;
                margin-top: -5px;
            }

            .horizontal-timeline .items .items-list {
                padding-top: 15px;
            }
        </style>
    @endpush

    <x-slot name="breadcrumbs">
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title"></h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href=""><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="">Shop</a></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-frontend.alert type="error" />

    <x-frontend.alert type="success" />
    <section class="user-profile" style="position: relative; height:1300px;">

        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'orders')"  id="defaultOpen">orders</button>
            <button class="tablinks" onclick="openCity(event, 'profile')">Profile</button>
            
            {{-- <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button> --}}
        </div>



        <div id="orders" class="tabcontent" style="overflow-y: scroll; max-height: 1300px;">
            <div class="container py-5 h-100">





     
            @php
                            $groupedOrders = $orders->groupBy('cart_id');
                        @endphp

                        @foreach ($groupedOrders as $cartId => $ordersGroup)
						<hr>
						<table class="custom_table_2" border='1'style=" direction:rtl; width:100%; padding:4px">
	<tr ><td style="width:30%" style="padding:4px">رقم الطلب</td><td>{{ $ordersGroup[0]->id }}</td></tr>
	<tr><td style="padding:4px">حالة الطلب</td><td>
		{{$ordersGroup[0]->status}}
	 
		</td></tr>
							
        <tr><td colspan ="2"> 
							
	 @foreach ($ordersGroup[0]->products as $product)					
                         
                                   
										<table class="custom_table_1" style="width:100%">
											<tr><td colspan="3">{{ $product->order_item->product_name }} </td>
												  </tr>
											<tr><td style="width:25%">الكمية</td><td> 
												  {{ $product->order_item->quantity }} 

                                                  <td rowspan="3" style="text-align: center" width="25%"> 
                                                    <img src="{{$product->image_url}}" 
                                                
                                                    style="max-height:60px;max-width:100%;"
                                                    alt="{{ $product->order_item->product_name }}"><br>
                                                    {{Currency::format( $product->order_item->price)}}</td>
												</td></tr>
											<tr><td>الخصائص</td><td>
												@if(isset($product->order_item->color))
												اللون : {{ $product->order_item->color}}/
												@endif

                                                @if($product->measure != "unite")
												الوزن :  {{ $product->order_item->measure }} /
												@endif
											 
											 
												@if(isset($product->order_item->size))
												القياس : {{ $product->order_item->size}}
												@endif
											 
												 

												</td></tr>
											<tr><td>التاجر</td><td>
                                            {{ $ordersGroup[0]->store->name }}
												
												 </td></tr>
                                                 
	
  
                                        
                                    @endforeach	

                     @foreach ($ordersGroup->skip(1) as $additionalOrder)

                      

                                    @foreach ($additionalOrder->products as $product)
                                    <tr><td colspan="3">{{ $product->order_item->product_name }} </td>
												 </tr>
											<tr><td style="width:25%">الكمية</td><td> 
												  {{ $product->order_item->quantity }} 
												</td>
                                                <td rowspan="3" style="text-align: center" width="25%"> 
                                                    <img src="{{$product->image_url}}" 
                                                
                                                    style="max-height:60px;max-width:100%;"
                                                    alt="{{ $product->order_item->product_name }}"><br>
                                                    {{Currency::format( $product->order_item->price)}}</td>
                                            </tr>
											<tr><td>الخصائص</td><td>
												@if(isset($product->order_item->color))
												اللون : {{ $product->order_item->color}}/
												@endif
                                                @if($product->measure != "unite")
												الوزن :  {{ $product->order_item->measure }} /
												@endif
												@if(isset($product->order_item->size))
												القياس : {{ $product->order_item->size}}
												@endif
											 
												 

												</td></tr>
											<tr><td>التاجر</td><td>
                                            {{ $additionalOrder->store->name }}
												 </td></tr>
                                    @endforeach
                                    
                                    
                               
                                  


                                </td>
                            </tr>
                        @endforeach
                        </table>





                                    <table class="custom_table_1" style="width:100%">
                                                <tr><td colspan="2">اجمالى المنتجات</td><td  width="25%">{{Currency::format($ordersGroup[0]->total)}} </td></tr>
                                                 <tr><td colspan="2">الخصم</td><td  width="25%"> </td></tr>
                                                 <tr><td colspan="2">الشحن</td><td>{{Currency::format($ordersGroup[0]->shipping )}} </td></tr>
                                                 <tr><td colspan="2">اجمالى الطلب</td><td>{{Currency::format($ordersGroup[0]->total+ $ordersGroup[0]->shipping)}} </td></tr>
        </table>						
							
</td>
</tr>

</table>
@endforeach




 

            </div>
        </div>










        <div id="profile" class="tabcontent">

            <!-- Start Account Profile Area -->
            <div class="account-login section">

                <div class="container" >
                    <div class="row">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="col-lg-12 col-md-12 offset-md-1 col-12">
                            <div class="register-form">

                                <div class="title">
                                    <h3>Profile Update</h3>
                                    <p>Update User Information</p>
                                </div>

                                <form method="post" enctype="multipart/form-data"  action="{{ route('profile.update') }}" style="direction: rtl">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="reg-fn">First Name</label>
                                            <input class="form-control" type="text" value="{{ $user->first_name }}"
                                                name="first_name" id="reg-fn" >
                                            @error('first_name')
                                                <div class="alert alert-danger">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="reg-fn">Last Name</label>
                                            <input class="form-control" type="text" value="{{ $user->last_name }}"
                                                name="last_name" id="reg-fn" >
                                        </div>
                                        @error('last_name')
                                            <div class="alert alert-danger">
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Gender<span class="text-danger">*</span></label>
                                            <select name="gender" id="" class="custom-select mr-sm-2">
                                                {{-- <option value="">{{ trans('attribute_values_trans.Choose') }}</option> --}}
                                                <option value="male" @selected($user->gender == 'male')> Male </option>
                                                <option value="female" @selected($user->gender == 'female')> Female </option>
                                            </select>
                                            @error('gener')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="reg-email">E-mail Address</label>
                                            <input class="form-control" type="email"
                                                value="{{ $user->email_address }}" name="email_address" id="reg-email"
                                                >
                                            @error('email')
                                                <div class="alert alert-danger">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="reg-pass">Password</label>
                                            <input class="form-control" type="password" name="password" id="reg-pass">
                                        </div>
                                        @error('password')
                                            <div class="alert alert-danger">
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>

                               
                                


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> governorate<span class="text-danger">*</span></label>
                                                <select name="governorate_id" class="form-control" id="" class="custom-select mr-sm-2">
                                                    <option disabled selected>أختار من القائمة </option>
                                                    @foreach ($destinations as $destination)
                                                        @if ($destination->rank == '1')
                                                            <option value="{{ $destination->id }}"
                                                                @selected($destination->id == $user->governorate_id)
                                                                  >
                                                                {{ $destination->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('parent_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>


                                

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> city<span class="text-danger">*</span></label>
                                                <select name="city_id" id="" class="form-control custom-select mr-sm-2">                                                    
                                                    <option disabled selected>أختار من القائمة </option>
                                                    @foreach ($destinations as $destination)
                                                    @if ($destination->rank == '2')
                                                        <option value="{{ $destination->id }}"
                                                            @selected($destination->id == $user->city_id)>
                                                            {{ $destination->name }}</option>
                                                            @endif
                                                @endforeach
                                                </select>
                                                @error('parent_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> neighburhood<span class="text-danger">*</span></label>
                                                <select name="neighborhood_id" id=""
                                                    class="custom-select mr-sm-2 form-control" >

                                                    <option disabled selected>أختار من القائمة </option>
                                                    @foreach ($destinations as $destination)
                                                        @if ($destination->rank == '3')
                                                        <option value="{{ $destination->id }}"
                                                            @selected($destination->id == $user->neighborhood_id)>
                                                            {{ $destination->name }}</option>
                                                        @endif
                                                    @endforeach  
                                                </select>
                                                @error('parent_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>


 


                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="reg-email">Street Address</label>
                                            <input class="form-control" type="text"
                                                value="{{ $user->street_address }}" name="street_address">
                                            @error('street_address')
                                                <div class="alert alert-danger">
                                                    <span class="text-danger">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="button">
                                        <button class="btn" type="submit"> Update</button>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Account Profile Area -->
        </div>

   

    </section>


    @push('scripts')
        <script>
            function openCity(evt, cityName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();

            $(document).ready(function() {
                // When the "governorate" dropdown value changes
                $('select[name="governorate"]').on('change', function() {
                    var governorateId = $(this).val(); // Get the selected governorate ID

                    console.log(governorateId);

                    // Make an AJAX request to fetch cities based on the selected governorate
                    $.ajax({
                        url: '/user/get-cities',
                        method: 'GET',
                        data: {
                            governorate_id: governorateId
                        },
                        success: function(response) {
                            // Clear the current city options
                            $('select[name="city"]').empty();
                            $('select[name="city"]').append(
                                '<option disabled selected>أختار من القائمة</option>');

                            $.each(response.cities, function(key, city) {
                                $('select[name="city"]').append('<option value="' + city
                                    .id + '">' + city.name + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });

                // When the "city" dropdown value changes
                $('select[name="city"]').on('change', function() {
                    var cityId = $(this).val(); // Get the selected city ID

                    console.log(cityId);

                    // Make an AJAX request to fetch neighborhoods based on the selected governorate
                    $.ajax({
                        url: '/user/get-neighborhoods',
                        method: 'GET',
                        data: {
                            city_id: cityId
                        },
                        success: function(response) {
                            // Clear the current neighborhood options
                            $('select[name="neighborhood"]').empty();
                            $('select[name="neighborhood"]').append(
                                '<option disabled selected>أختار من القائمة</option>');

                            $.each(response.neighborhoods, function(key, neighborhood) {
                                $('select[name="neighborhood"]').append('<option value="' +
                                    neighborhood.id + '">' + neighborhood.name +
                                    '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
            });
        </script>
    @endpush

</x-front-layout>
