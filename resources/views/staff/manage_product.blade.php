<!DOCTYPE html>
<html>
  <head> 
    @include('staff.css')
    <style>
      .div_deg{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 15px;
        margin-bottom: 15px;
        flex-direction: column; 
    }

    .table_deg{
      /* border: 2px solid greenyellow; */
    }

    td{
      /* color: white; */
    }

    .top-right {
            background-color: #007bff; /* Blue color */
            color: white;
            padding: 10px 20px;
            margin-left: 170px;
            text-decoration: none;
            border-radius: 5px;
            align-self: flex-end;
    }

        .top-left {
            /* display: flex; */
            /* align-items: center; */
            align-self: flex-start;
        }

        input[type='search'] {
            width: 500px;
            height: 40px;
            margin-right: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            align-self: flex-start;
        }

        .boxbtn-vertical{
          text-align: center;
          vertical-align: middle;
        }

        .pagination-wrapper {
            margin-top: 20px;
        }
    </style>
    <!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

  </head>
  <body>
  @include('staff.header')

  @include('staff.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

          <h2>Manage Product</h2>

          <div class="col-lg-12"> 
            <!-- lg is for large screen, laptop, 12 is 12 column -->
                <div class="block">
                  <!-- <div class="title"><strong>Striped table with hover effect</strong></div> -->
                 <div class="div_deg">
                  <form action="{{url('staff/product_search')}}" method="get" class="top-left">
                    @csrf
                      <input type="search" name="search" placeholder="Search...">
                      <input type="submit" class="btn btn-secondary" value="Search">
                      
                      <a class="top-right" href="{{ url('staff/add_product') }}">Add Product</a>
                    </form>
                      
                    
                    
                 </div>
                    
                  <div class="table-responsive"> 

                    <table class="table table-striped table-hover table_deg">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Category</th>
                          <th>Price (RM)</th>
                          <th>Quantity</th>
                          <th>Material</th>
                          <th>image</th>
                          <th style="text-align: center;">Action</th>
                        </tr>
                      </thead>

                      
                      <tbody>
                        <!-- foreach to call product from db each row -->
                      @foreach($product as $products) 
                      <!-- ^^this two $ must be diff, so db table name must be a lil diff than model name -add s -->
                        <tr>
                          <!-- <th scope="row">1</th> -->
                          <td>{{$products->id}}</td>
                          <td>{{$products->title}}</td>
                          <td>{!!Str::limit($products->description,50)!!}</td>
                          <td>{{$products->category}}</td>
                          <td>{{$products->price}}</td>
                          <td>{{$products->quantity}}</td>
                          <td>{{$products->material}}</td>
                          <td><img height="70" width="70" src="products/{{$products->image}}" alt=""></td>
                          <td class="boxbtn-vertical">
                            <a class="btn btn-secondary" href="{{url('staff/update_product', $products->id)}}">Update</a>
                            <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('staff/delete_product', $products->id)}}">Delete</a>

                          </td>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                    
                  </div>
                  
                  <div class="div_deg pagination-wrapper">
                    {{$product->onEachSide(1)->links()}}
                    <!-- oneach side means ... in between last and first page, 1 can be changed, change how many per page on admincontroller, in method -->
                    <!-- link back to pagination on provider/appserviceprovider, get bootstrap cdn link-->
                  </div>

                </div>
              </div>
            
        </div>   
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript"> //to make confirmation popup
      function confirmation(ev){
        ev.preventDefault(); //stop browser reload/refresh
        //get url and store to urltoredirect
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect); //print url in console

        swal({
          title:"Are you sure to delete this?",
          text: "This deletion will be permanent",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        //if click cancel
        .then((willCancel)=>{
          if(willCancel){
            window.location.href=urlToRedirect;
          }
        });
      }
    </script>
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>