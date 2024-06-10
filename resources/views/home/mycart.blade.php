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
                <!-- <td>{{$cart->quantity}}</td> -->
                <td>
                    <div class="quantity-wrapper">
                            <form method="POST" action="{{ url('update_cart', $cart->id) }}" id="cart-form-{{$cart->id}}">
                                @csrf
                                <button type="button" class="btn-decrement" data-id="{{$cart->id}}">-</button>
                                <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" >
                                <button type="button" class="btn-increment" data-id="{{$cart->id}}">+</button>
                            </form>
                    </div>
                </td>
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

  <script>
            // for + - quant button
            document.querySelectorAll('.btn-decrement').forEach(button => {
                button.addEventListener('click', function() {
                    let form = document.getElementById('cart-form-' + this.dataset.id);
                    let input = form.querySelector('input[name="quantity"]');
                    if (parseInt(input.value) > 1) {
                        input.value = parseInt(input.value) - 1;
                        form.submit();
                    }
                });
            });

            document.querySelectorAll('.btn-increment').forEach(button => {
                button.addEventListener('click', function() {
                    let form = document.getElementById('cart-form-' + this.dataset.id);
                    let input = form.querySelector('input[name="quantity"]');
                    input.value = parseInt(input.value) + 1;
                    form.submit();
                });
            });

            // for manually typed quant input
            document.querySelectorAll('input[name="quantity"]').forEach(input => {
                input.addEventListener('change', function() {
                    let form = document.getElementById('cart-form-' + this.closest('form').id.split('-').pop());
                    form.submit();
                });
            });
        </script>
  
</body>

</html>