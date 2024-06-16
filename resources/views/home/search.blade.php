<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <!-- box product color change from gray to white, override, didnt work -->
    <style>
        .box {
            background-color: white; /* Change the background color to white */
        }
    </style>
  </head>

<body>
  <div class="hero_area">
    <!-- header section strats, top menu header -->
    @include('home.header')
    <!-- end header section, top option -->
    
    <section class="shop_section" style="margin-bottom: 20px;">
    <div class="container">
      
      <div class="row">
      <!-- code for display all product from db -->
      @foreach($product as $products)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="{{url('product_details', $products->id)}}">
              <div class="img-box">
                <img src="products/{{$products->image}}" alt="">
              </div>
              <div class="detail-box">
                <h6>{{$products->title}}</h6>
                <h6>
                  
                  <span>RM {{$products->price}}</span>
                </h6>
              </div>

              <div style="padding: 15px" >
                <a class="btn btn-primary" href="{{url('add_cart', $products->id)}}">Add to Cart</a>
              </div>
              
            </a>
          </div>
        </div>

        @endforeach
      </div>
      <!--  
      <div class="btn-box">
        <a href="">
          View All Products
        </a>
      </div> -->
    </div>
  </section>
  </div>
  <!-- end hero area -->

  <!-- shop section -->
  
  <!-- end shop section -->


  <!-- info section -->

  @include('home.footer')
  
</body>

</html>