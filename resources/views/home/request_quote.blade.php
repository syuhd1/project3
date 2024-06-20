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
          padding: 20px;
          text-align: center; 
        }

        .div_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 0px;
            max-width: 600px;
            padding: 20px;
            /* flex-direction: column; */
        }

        .right-column{
          display: flex;
          justify-content: top;
          align-items: center;
          margin-top: 0px;
          max-width: 600px;
          padding: 0px;
          flex-direction: column;
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

        input[type= 'email']{
            width:300px;
            height: 30px;
        }

        input[type= 'date']{
            width:300px;
            height: 30px;
        }

        textarea{
            width: 300px;
            height: 80px;
        }

        .input_deg{
            padding: 5px;
        }

        .shortbox{
            width: 200px;
            height: 80px;
        }

        .container{
          display: flex;
          flex-direction: row-reverse;
          justify-content: center;
          /* align-items: center; */
        }

        .cartvalue{
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;
        }

        .quantity-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-wrapper input {
            width: 40px; 
            height: 35px;/* Adjust this width as needed */
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 2px;
        }

        .quantity-wrapper button {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            cursor: pointer;
        }
        .itemcenter{
            text-align: center; 
            align-items:center;
        }

        .td{
          max-width: 35px;
        }
    </style>
  </head>

<body>
  <div class="hero_area">
    <!-- header section strats, top menu header -->
    @include('home.header')
    <!-- end header section, top option -->
  </div>

  <h2>Request Customization</h2>
  
  <div class="container">

    <!-- flex row next , put cart here-->
  <div class="right-column">
    <div class="div_deg">
        @include('home.colormap')

        <table>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Color</th>
                <th>Size</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>

            <?php
                // for count cart
                $value  = 0; 
            ?>

            
            <tr>
                <td><img width="80" src="/products/{{$product->image}}" alt=""></td>
                <td>{{$product->title}}</td>
                <td>
                    <!-- {{$product->color}} -->
                    @php
                        $colorName = $color;
                        $colorCode = isset($colorMapping[$colorName]) ? $colorMapping[$colorCode] : 'Unknown Color';
                    @endphp
                    <div style="display: flex; align-items: center;" class="itemcenter">
                        <span style="display: inline-block; width: 20px; height: 20px; background-color: {{$colorName}}; border: 1px solid #000; margin-right: 5px;"></span>
                        <span>{{$colorName}}</span>
                    </div>
                </td>
                <td>{{$size}}</td>
                <td>{{$price}}</td>
                <!-- <td>{{$product->quantity}}</td> -->
                <td>
                    {{$quantity}}
                    <!-- <div class="quantity-wrapper">
                            <form method="POST" action="{{ url('update_cart', $product->id) }}" id="cart-form-{{$product->id}}">
                                @csrf
                                <button type="button" class="btn-decrement" data-id="{{$product->id}}">-</button>
                                <input type="number" name="quantity" value="{{ $product->quantity }}" min="1" >
                                <button type="button" class="btn-increment" data-id="{{$product->id}}">+</button>
                            </form>
                    </div> -->
                </td>
                <!-- <td>
                    <a class="btn btn-danger" href="{{url('delete_cart', $product->id)}}">Remove</a>
                </td> -->
            </tr>

            <?php 
                $value = $value + ($product->price * $quantity);
            ?>
          
        </table>
    </div>
    <div> 
        <h4 class="orderdeg">Base Price: RM {{$value}}</h4>
    </div>
  </div>

  <!-- new row -->
  <div class="orderdeg">
      <form action="{{url('send_quote', $product->id)}}" method="Post" id="payment-form" enctype="multipart/form-data">
          @csrf
          <div class="input_deg">
              <label for="">Name:</label>
              <input type="text" name="name" value="{{Auth::user()->name}}">
          </div>

          <div class="input_deg">
              <label for="">Phone:</label>
              <input type="text" name="phone" value="{{Auth::user()->phone}}">
          </div>

          <div class="input_deg">
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{Auth::user()->email}}" >
            </div>

          <div class="input_deg">
              <label for="">Address:</label>
              <textarea name="address" id="">{{Auth::user()->address}}</textarea>
          </div>

          <div class="input_deg">
              <label for="">Description:</label>
              <textarea name="description" id="description"></textarea>
          </div>

          <div class="input_deg">
                <label for="">Deadline (optional):</label>
                <input type="date" name="deadline">
            </div>

            <div>
                <label for="image">Reference</label>
                <input type="file" name="reference">
            </div>

            <!-- Hidden fields for price and any other necessary data -->
            <input type="hidden" name="value" value="{{ $value }}">
            <input type="hidden" name="color" value="{{ $color }}">
            <input type="hidden" name="size" value="{{ $size }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">

          <!-- <div>
            <label for="">Delivery Method:</label>
            <div>
                <input type="radio" id="delivery" name="delivery_method" value="delivery" checked >
                <label for="delivery">Delivery</label>
            </div> -->
            <!--onclick="updateDeliveryFee()" -->
            <!-- <div>
                <input type="radio" id="pickup" name="delivery_method" value="pickup">
                <label for="pickup">Pickup from Shop</label>
            </div>
          </div> -->

        <!-- <div>
            <label for="">Delivery Fee:</label>
            <span id="delivery-fee">RM15</span>
        </div> -->

          
          <input type="hidden" name="price" value="{{$price}}">
          <!-- <input type="hidden" name="delivery_fee" id="delivery_fee_hidden" value="15"> -->
                
          <!-- <input type="hidden" name="stripeToken" id="stripeToken"> -->
          <div>
            <span>
            <button class="btn btn-danger" type="button" onclick="window.history.back()">Cancel</button>
            </span>

            <span>
            <input class="btn btn-primary" type="submit" value="Send Quotation">

            </span>
          </div>
          
      </form>
    </div>
  </div>
    

  
    <!-- info section -->

@include('home.footer')
  
<!-- scripts -->
<script src="https://js.stripe.com/v3/"></script>

</body>

</html>