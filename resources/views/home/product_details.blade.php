<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include your CSS and other meta tags -->
    @include('home.css')

    <!-- Additional custom styles -->
    <style>
        .div_center {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .detail-container {
            display: flex;
            flex-direction: column;
            padding: 20px;
            max-width: 600px; /* Adjust max-width as needed */
            margin-left: auto; /* Push to the right */
        }

        .product-image {
            max-width: 100%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .detail-box {
            margin-bottom: 10px;
        }

        .quantity {
            display: flex;
            align-items: center;
        }

        .quantity input {
            width: 50px; /* Adjust width as needed */
            text-align: center;
            margin: 0 10px; /* Adjust margin as needed */
        }

        .quantity .btn {
            cursor: pointer;
        }

        .color-selector {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            margin-top: 10px;
        }

        .color-option {
            width: 40px; /* Adjust width as needed */
            height: 40px; /* Adjust height as needed */
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid grey; /* Initially transparent border */
        }

        .color-option.selected {
            border-color: blue; /* Border color for selected option */
        }
        
    </style>

    @include('home.colorcss')
</head>

<body>
    <div class="hero_area">
        <!-- Include your header -->
        @include('home.header')
    </div>

    <!-- Product details section -->
    <section class="shop_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Product image -->
                    <div class="div_center">
                        <img class="product-image" src="/products/{{$data->image}}" alt="Product Image">
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Product details -->
                    <div class="detail-container">
                        <div>
                            <h3>{{$data->title}}</h3>
                        </div>
                        <div class="detail-box">
                            <h5>Price: RM {{$data->price}}</h5>
                        </div>
                        <div class="detail-box">
                            <h6>Category: {{$data->category}}</h6>
                            <h6>Material: {{$data->material}}</h6>
                            <h6>Available Quantity: <span>{{$data->quantity}}</span></h6>
                        </div>
                        <div class="detail-box">
                            <p>{{$data->description}}</p>
                        </div>
                        
                        <form action="" method="POST" id="product-form">
                            @csrf
                            <!-- Color selection -->
                            <div class="color-selector">
                                <div class="color-option" data-color="#ffffff" title="White"></div>
                                <div class="color-option" data-color="#000000" title="Black"></div>
                                <div class="color-option" data-color="#ff0000" title="Red"></div>
                                <div class="color-option" data-color="#00ff00" title="Green"></div>
                                <div class="color-option" data-color="#0000ff" title="Blue"></div>
                                <div class="color-option" data-color="#ffff00" title="Yellow"></div>
                                <div class="color-option" data-color="#ff00ff" title="Magenta"></div>
                                <div class="color-option" data-color="#ffa500" title="Orange"></div>
                            </div>
                            <div class="color-selector">
                                <div class="color-option" data-color="#ffc0cb" title="Pink"></div>
                                <div class="color-option" data-color="#800080" title="Purple"></div>
                                <div class="color-option" data-color="#ee82ee" title="Violet"></div>
                                <div class="color-option" data-color="#a52a2a" title="Brown"></div>
                                <div class="color-option" data-color="#d2b48c" title="Light Brown"></div>
                                <div class="color-option" data-color="#f5f5dc" title="Beige"></div>
                                <div class="color-option" data-color="#808080" title="Grey"></div>
                                <div class="color-option" data-color="#00ffff" title="Cyan" ></div>
                            </div>
                            <input type="hidden" name="color" id="selected-color" value="">

                            <!-- End Color selection -->

                            <!-- <div class="input_deg">
                                <label for="color">Color</label>
                                <select name="color">
                                    <option value="">Select color</option>
                                    <option value="white">White</option>
                                    <option value="black">Black</option>
                                    <option value="red">Red</option>
                                    <option value="green">Green</option>
                                    <option value="blue">Blue</option>
                                    <option value="yellow">Yellow</option>
                                    <option value="magenta">Magenta</option>
                                    <option value="orange">Orange</option>
                                </select>
                            </div> -->

                            <div class="input_deg" style="padding: 15px;">
                                <label for="size">Size</label>
                                <select name="size">
                                    <option value="">Select Size</option>
                                    <option value="XS">XS (81-86 cm)</option>
                                    <option value="S">S (86-91 cm)</option>
                                    <option value="M">M (96-101 cm)</option>
                                    <option value="L">L (106-111 cm)</option>
                                    <option value="XL">XL (116-121 cm)</option>
                                    <option value="XXL">XXL (127-132 cm)</option>
                                    <option value="XXXL">XXXL (137-142 cm)</option>
                                </select>
                            </div>

                            <div class="quantity mb-3" style="padding: 15px;">
                                <button class="btn btn-sm btn-minus rounded-circle bg-light border" type="button">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <input type="text" class="form-control form-control-sm text-center border-0" name="quantity" id="quantity" value="1">
                                <button class="btn btn-sm btn-plus rounded-circle bg-light border" type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>

                            <div class="button-container">
                                <span>
                                    <button class="btn btn-primary" type="submit" onclick="submitForm('request_quote')">Request Quote</button>
                                </span>
                                <span>
                                    <!-- <a class="btn btn-success" href="{{url('add_cart', $data->id , $data->color,  $data->size, $data->quantity)}}">Add to Cart</a> -->
                                    <!-- <a class="btn btn-success" type="submit">Add to Cart</a> -->
                                    <button type="submit"  class="btn btn-success" onclick="submitForm('add_cart2')">Add to Cart</button>
                                    <!-- href="{{url('add_cart2', $data->id)}}" -->
                                </span>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End product details section -->

    <!-- Include your footer -->
    @include('home.footer')

    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Custom JavaScript for Quantity Increment and Decrement -->
    <script>
        $(document).ready(function() {
            // Increment button click
            $(document).on('click', '.btn-plus', function() {
                var input = $(this).prev();
                var value = parseInt(input.val(), 10);
                input.val(value + 1);
            });

            // Decrement button click
            $(document).on('click', '.btn-minus', function() {
                var input = $(this).next();
                var value = parseInt(input.val(), 10);
                if (value > 1) {
                    input.val(value - 1);
                }
            });
        });

        $(document).ready(function() { //pas color title name
            // Color selection handling
        $('.color-option').click(function() {
            $('.color-option').removeClass('selected');
            $(this).addClass('selected');
            var selectedColor = $(this).attr('title');
            $('#selected-color').val(selectedColor); // Update hidden input value
            });
        });

        // $(document).ready(function() { //pas color code
        //     // Color selection handling
        // $('.color-option').click(function() {
        //     $('.color-option').removeClass('selected');
        //     $(this).addClass('selected');
        //     var selectedColor = $(this).attr('data-color');
        //     $('#selected-color').val(selectedColor); // Update hidden input value
        //     });
        // });
    </script>

<script>
    function submitForm(action) {
        var form = document.getElementById('product-form');
        if (action === 'request_quote') {
            form.action = "{{ url('request_quote', $data->id) }}";
        } else if (action === 'add_cart2') {
            form.action = "{{ url('add_cart2', $data->id) }}";
        }
        form.submit();
    }

    $(document).ready(function() {
        $('.color-option').click(function() {
            $('.color-option').removeClass('selected');
            $(this).addClass('selected');
            var selectedColor = $(this).attr('title');
            $('#selected-color').val(selectedColor); // Update hidden input value
        });
    });
</script>


</body>

</html>



