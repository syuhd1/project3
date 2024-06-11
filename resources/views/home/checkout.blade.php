<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <!-- box product color change from gray to white, override, didnt work -->
    <style>
        .box {
            background-color: white; /* Change the background color to white */
        }

        .orderdeg{

        }
    </style>
  </head>

<body>
  <div class="hero_area">
    <!-- header section strats, top menu header -->
    @include('home.header')
    <!-- end header section, top option -->
  </div>
  
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

    <h4>Total Price: RM {{$price}}</h4>


  <!-- info section -->

  @include('home.footer')
  
</body>

</html>