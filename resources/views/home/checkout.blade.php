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

  <h2>Checkout Item</h2>
  
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
                <th>Customization</th>
            </tr>

            <?php
                // for count cart
                $value  = 0; 
            ?>

            @foreach ($cart as $carts)
            <tr>
                <td><img width="80" src="/products/{{$carts->product->image}}" alt=""></td>
                <td>{{$carts->product->title}}</td>
                <td>
                    <!-- {{$carts->color}} -->
                    @php
                        $colorName = $carts->color;
                        $colorCode = isset($colorMapping[$colorName]) ? $colorMapping[$colorCode] : 'Unknown Color';
                    @endphp
                    <div style="display: flex; align-items: center;" class="itemcenter">
                        <span style="display: inline-block; width: 20px; height: 20px; background-color: {{$colorName}}; border: 1px solid #000; margin-right: 5px;"></span>
                        <span>{{$colorName}}</span>
                    </div>
                </td>
                <td>{{$carts->size}}</td>
                <td>{{$carts->base_price}}</td>
                <!-- <td>{{$carts->quantity}}</td> -->
                <td>
                    {{$carts->quantity}}
                    <!-- <div class="quantity-wrapper">
                            <form method="POST" action="{{ url('update_cart', $carts->id) }}" id="cart-form-{{$carts->id}}">
                                @csrf
                                <button type="button" class="btn-decrement" data-id="{{$carts->id}}">-</button>
                                <input type="number" name="quantity" value="{{ $carts->quantity }}" min="1" >
                                <button type="button" class="btn-increment" data-id="{{$carts->id}}">+</button>
                            </form>
                    </div> -->
                </td>
                <td>
                    @if ($carts->quote_id !== null)
                    <a href="{{url('myorders')}}">Quotation ID: {{$carts->quote_id}}</a>
                    @else
                    None
                    @endif
                </td>
                <!-- <td>
                    <a class="btn btn-danger" href="{{url('delete_cart', $carts->id)}}">Remove</a>
                </td> -->
            </tr>

            <?php 
                if($carts->quote_id == null){
                    $value = $value + ($carts->product->price * $carts->quantity);
                }else{
                    $value = $value + ($carts->base_price * $carts->quantity);
                }

                $value = number_format($value,2,'.','');
            ?>
            @endforeach
        </table>
    </div>
    <div> 
        <h4 class="orderdeg">Total Price: RM {{$value}}</h4>
    </div>
  </div>

  <!-- new row -->
  <div class="orderdeg">
      <form action="{{url('stripe', $value)}}" method="POST" id="payment-form">
          @csrf
          <div class="input_deg">
              <label for="">Name:</label>
              <input type="text" name="name" id="name" value="{{Auth::user()->name}}">
          </div>

          <div class="input_deg">
              <label for="">Phone:</label>
              <input type="text" name="phone" id="phone" value="{{Auth::user()->phone}}">
          </div>

          <div class="input_deg">
              <label for="">Address:</label>
              <textarea name="address" id="address">{{Auth::user()->address}}</textarea>
          </div>

          <!-- <div class="input_deg">
              <label for="">Remarks:</label>
              <textarea name="remarks" id="remarks"></textarea>
          </div> -->

          <!-- <div class="input_deg">
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
          <input type="hidden" name="delivery_m" id="delivery_method_hidden" value="">

          <!-- <input type="hidden" name="delivery_fee" id="delivery_fee_hidden" value="15"> -->
                
          <input type="hidden" name="stripeToken" id="stripeToken">
          <div>
            <span>
            <button class="btn btn-danger" type="button" onclick="window.history.back()">Cancel</button>
            </span>

            <span>
            <input class="btn btn-primary" type="submit" value="Place Order">

            </span>
          </div>
          
      </form>
    </div>
  </div>
    

  
    <!-- info section -->

@include('home.footer')
  
<!-- scripts -->
<script src="https://js.stripe.com/v3/"></script>
<script>
function updateDeliveryMethod() {
            // var deliveryMethodElement = document.getElementById('delivery-method');
            var deliveryMethodHiddenElement = document.getElementById('delivery_method_hidden');
            var deliveryMethod = document.querySelector('input[name="delivery_method"]:checked').value;
            
            if (deliveryMethod === 'delivery') {
                // deliveryMethodElement.textContent = 'RM15';
                deliveryMethodHiddenElement.value = 'Delivery';
            } else {
                // deliveryMethodElement.textContent = 'RM0';
                deliveryMethodHiddenElement.value = 'Pick Up';
            }
        }
</script>
<script>
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Display error.message in your UI
                console.error(result.error.message);
            } else {
                // Send the token to your server
                document.getElementById('stripeToken').value = result.token.id;
                form.submit();
            }
        });
    });
</script>
<script>
function updateDeliveryFee() {
            var deliveryFeeElement = document.getElementById('delivery-fee');
            var deliveryFeeHiddenElement = document.getElementById('delivery_fee_hidden');
            var deliveryMethod = document.querySelector('input[name="delivery_method"]:checked').value;
            
            if (deliveryMethod === 'delivery') {
                deliveryFeeElement.textContent = 'RM15';
                deliveryFeeHiddenElement.value = '15';
            } else {
                deliveryFeeElement.textContent = 'RM0';
                deliveryFeeHiddenElement.value = '0';
            }
        }
</script>

</body>

</html>