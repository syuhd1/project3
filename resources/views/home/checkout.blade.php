<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <!-- box product color change from gray to white, override, didnt work -->
    <style type="text/css">
        .box {
            background-color: white; /* Change the background color to white */
        }

        .orderdeg{
          margin-left: 30px;

        }

        .div_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

        h1{
            /* color: white; */
        }

        label{
            display: inline-black;
            width: 100px;
            font-size: 18px!important;
            /* color: white; */
        }

        input[type='text']{
            width:300px;
            height: 30px;
        }

        textarea{
            width: 300px;
            height: 80px;
        }

        .input_deg{
            padding: 15px;
        }

        .shortbox{
            width: 200px;
            height: 80px;
        }

        .container{
          display: flex;
          flex-direction: row;
        }
    </style>
  </head>

<body>
  <div class="hero_area">
    <!-- header section strats, top menu header -->
    @include('home.header')
    <!-- end header section, top option -->
  </div>

  <h2>Checkout Item</h2>
  
  <div class="container">

    <div class="orderdeg">
      <form action="{{url('confirm_order/{id}')}}" method="Post">
          @csrf
          <div>
              <label for="">Name</label>
              <input type="text" name="name" value="{{Auth::user()->name}}">
          </div>

          <div>
              <label for="">Phone</label>
              <input type="text" name="phone" value="{{Auth::user()->phone}}">
          </div>

          <div>
              <label for="">Address</label>
              <textarea name="address" id="">{{Auth::user()->address}}</textarea>
          </div>

          <input type="hidden" name="price" value="{{$price}}">

          <div><input type="submit" value="submit"></div>
      </form>
    </div>

    <!-- flex row next , put cart here-->
   
    
  </div>
    
    <h4 class="orderdeg">Total Price: RM {{$price}}</h4>

  
    <!-- info section -->

@include('home.footer')
  
</body>

</html>