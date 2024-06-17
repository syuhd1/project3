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
   
  </div>

  <h2>Transaction History</h2>
    @if(count($order)>=1)
    <div>
        <div class="div_deg">
            @include('home.colormap')
            <table>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Adress</th>
                    <th>Status</th>
                    <th>Order Time</th>
                    <th>Updated At</th>
                </tr>

                @foreach ($order as $orders)
                <tr>
                    <td><img width="120" src="/products/{{$orders->product->image}}" alt=""></td>
                    <td>{{$orders->product->title}}</td>
                    <td>
                        <!-- {{$orders->color}} -->
                        @php
                            $colorName = $orders->color;
                            $colorCode = isset($colorMapping[$colorName]) ? $colorMapping[$colorCode] : 'Unknown Color';
                        @endphp
                        <div style="display: flex; align-items: center;" class="itemcenter">
                            <span style="display: inline-block; width: 20px; height: 20px; background-color: {{$colorName}}; border: 1px solid #000; margin-right: 5px;"></span>
                            <span>{{$colorName}}</span>
                        </div>
                    </td>
                    <td>{{$orders->size}}</td>
                    <td>{{$orders->quantity}}</td>
                    <td>{{$orders->price}}</td>
                    <td>{{$orders->address}}</td>
                    <td>{{$orders->status}}</td>
                    <td>{{$orders->created_at}}</td>
                    <td>{{$orders->updated_at}}</td>

                    
                    <!-- <td>
                        <a class="btn btn-danger" href="{{url('delete_cart', $orders->id)}}">Remove</a>
                    </td> -->
                </tr>

                @endforeach
            </table>
        </div>

        <div class="div_deg pagination-wrapper">
            {{$order->onEachSide(1)->links()}}
            <!-- oneach side means ... in between last and first page, 1 can be changed, change how many per page on admincontroller, in method -->
            <!-- link back to pagination on provider/appserviceprovider, get bootstrap cdn link-->
        </div>
    </div>
  <!-- end hero area -->
 
  @else
  <div><h5 class="shadowtxt">There is no order</h5></div>
  @endif
  <!-- info section -->

  @include('home.footer')
  
</body>

</html>