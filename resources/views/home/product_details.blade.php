<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <!-- box product color change from gray to white, override, didnt work -->
    <!-- <style>
        .box {
            background-color: white; /* Change the background color to white */
        }
    </style> -->
    <style>
        .div_center{
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .detail-box{
            padding: 5px;
        }
    </style>
  </head>

<body>
  <div class="hero_area">
    <!-- header section strats, top menu header -->
    @include('home.header')
    <!-- end header section, top option -->

  </div>
  <!-- prod details start -->
  <section class="shop_section layout_padding">
        <div class="container">
            
            <div class="heading_container heading_center">
                    <h2>
                    Latest Products
                    </h2>
            </div>
        
            <div class="row">
                
                <div class="col-md-12">
                    <div class="box">
                        
                        <div  class="div_center">
                            <img width="400" src="/products/{{$data->image}}" alt="">
                        </div>

                        <div class="detail-box">
                            <h6>{{$data->title}}</h6>
                            <h6>
                            <span>RM {{$data->price}}</span>
                            </h6>
                        </div>

                        <div class="detail-box">
                            <h6>Category: {{$data->category}}</h6>
                            <h6>Available Quantity:
                            <span>{{$data->quantity}}</span>
                            </h6>
                        </div>

                        <div class="detail-box">
                            <p>{{$data->description}}</p>
                        </div>
                        
                    
                    </div>
                </div>
            </div>
            <!--  
            <div class="btn-box">
                <a href="">
                View All Products
                </a>
            </div> -->
        </div>
    </section>
 
<!-- prod ends -->

  <!-- info section -->

  @include('home.footer')
  
</body>

</html>