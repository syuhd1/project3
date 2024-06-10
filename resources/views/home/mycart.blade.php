<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <!-- box product color change from gray to white, override, didnt work -->
    <style>
        .box {
            background-color: white; /* Change the background color to white */
        }

        .cartvalue{
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;
        }
        /* /other style on css.blade.php */
    </style>
  </head>

<body>
  <div class="hero_area">
    <!-- header section strats, top menu header -->
    @include('home.header')
    <!-- end header section, top option -->



    <div class="div_deg">
        <table>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Color</th>
                <th>Size</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Remove</th>
            </tr>

            <?php
                // for count cart
                $value  = 0; 
            ?>

            @foreach ($cart as $cart)
            <tr>
                <td><img width="120" src="/products/{{$cart->product->image}}" alt=""></td>
                <td>{{$cart->product->title}}</td>
                <td>{{$cart->color}}</td>
                <td>{{$cart->product->size}}</td>
                <td>{{$cart->product->price}}</td>
                <td>{{$cart->quantity}}</td>
                <td>
                    <a class="btn btn-danger" href="{{url('delete_cart', $cart->id)}}">Remove</a>
                </td>
            </tr>

            <?php 
                $value = $value + ($cart->product->price * $cart->quantity);
            ?>
            @endforeach
        </table>
    </div>
   
     <div class="cartvalue">
        <h4>Total Price: RM {{$value}}</h4>
        <!-- didnt add url in web.php -->
        <span>
            <a class ="btn btn-primary" href="{{url('request_quote')}}">Request Quote</a>
        </span>
        <span>
            <a class ="btn btn-success" href="{{url('checkout')}}">Checkout</a>
        </span>
        
     </div>
  <!-- info section -->

  @include('home.footer')
  
</body>

</html>