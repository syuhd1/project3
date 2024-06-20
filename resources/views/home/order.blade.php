<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style>
        .box {
            background-color: white;
        }

        .cartvalue {
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
            height: 35px;
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

        .nav-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .nav-tabs button {
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            padding: 10px 20px;
            cursor: pointer;
            margin-right: 5px;
        }

        .nav-tabs button.active {
            background-color: #ddd;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        @include('home.header')
    </div>

    <div class="nav-tabs">
        <button class="tab-link active" onclick="openTab(event, 'customization-request')">Customization Request</button>
        <button class="tab-link" onclick="openTab(event, 'transaction-history')">Transaction History</button>
    </div>

    <div id="transaction-history" class="tab-content">
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
                        <th>Address</th>
                        <th>Status</th>
                        <th>Order Time</th>
                        <th>Updated At</th>
                    </tr>

                    @foreach ($order as $orders)
                    <tr>
                        <td><img width="120" src="/products/{{$orders->product->image}}" alt=""></td>
                        <td>{{$orders->product->title}}</td>
                        <td>
                            @php
                            $colorName = $orders->color;
                            $colorCode = isset($colorMapping[$colorName]) ? $colorMapping[$colorName] : 'Unknown Color';
                            @endphp
                            <div style="display: flex; align-items: center;" class="itemcenter">
                                <span style="display: inline-block; width: 20px; height: 20px; background-color: {{$colorName}}; border: 1px solid #000; margin-right: 5px;"></span>
                                <span>{{$colorName}}</span>
                            </div>
                        </td>
                        <td>{{$orders->size}}</td>
                        <td>{{$orders->quantity}}</td>
                        <td>{{$orders->total_price}}</td>
                        <td>{{$orders->address}}</td>
                        <td>{{$orders->status}}</td>
                        <td>{{$orders->created_at}}</td>
                        <td>{{$orders->updated_at}}</td>
                    </tr>

                    @endforeach
                </table>
            </div>

            <div class="div_deg pagination-wrapper">
                {{$order->onEachSide(1)->links()}}
            </div>
        </div>
        @else
        <div>
            <h5 class="shadowtxt">There is no order</h5>
        </div>
        @endif
    </div>

    <div id="customization-request" class="tab-content active">
        @if(count($quote)>=1)
        <div>
            <div class="div_deg">
                @include('home.colormap')
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Title</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Base Price</th>
                        <th>Customization Fee</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($quote as $quotes)
                    <tr>
                        <td>{{$quotes->id}}</td>
                        <td><img width="120" src="/products/{{$quotes->product->image}}" alt=""></td>
                        <td>{{$quotes->product->title}}</td>
                        <td>
                            @php
                            $colorName = $quotes->color;
                            $colorCode = isset($colorMapping[$colorName]) ? $colorMapping[$colorName] : 'Unknown Color';
                            @endphp
                            <div style="display: flex; align-items: center;" class="itemcenter">
                                <span style="display: inline-block; width: 20px; height: 20px; background-color: {{$colorName}}; border: 1px solid #000; margin-right: 5px;"></span>
                                <span>{{$colorName}}</span>
                            </div>
                        </td>
                        <td>{{$quotes->size}}</td>
                        <td>{{$quotes->quantity}}</td>
                        <td>{{$quotes->base_price}}</td>
                        <td>{{$quotes->add_price}}</td>
                        <td>{{$quotes->total_price}}</td>
                        <td>{{$quotes->status}}</td>
                        <form action="{{url('add_custom_cart', $quotes->id)}}" method="get">
                            <td>
                                <button type="submit" class="btn btn-primary">Add Cart</button>
                            </td>
                        </form>
                    </tr>

                    @endforeach
                </table>
            </div>

            <div class="div_deg pagination-wrapper">
                {{$quote->onEachSide(1)->links()}}
            </div>
        </div>
        @else
        <div>
            <h5 class="shadowtxt">There is no request</h5>
        </div>
        @endif
    </div>

    @include('home.footer')

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tab-link");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Default open tab
        document.getElementById("customization-request").style.display = "block";
    </script>
</body>

</html>
