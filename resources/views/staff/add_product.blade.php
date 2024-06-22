<!DOCTYPE html>
<html>
  <head> 
    @include('staff.css')
  </head>
  <body>
  @include('staff.header')

  <style type="text/css">
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
        width: 200px;
        font-size: 18px!important;
        /* color: white; */
    }

    input[type='text']{
        width:450px;
        height: 50px;
    }

    textarea{
        width: 450px;
        height: 80px;
    }

    .input_deg{
        padding: 15px;
    }

    .shortbox{
        width: 200px;
        height: 80px;
    }
  </style>

  @include('staff.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
          
          <h2>Add Product</h2>

          <div class="div_deg">
            <form action="{{url('staff/upload_product')}}" method="Post" enctype="multipart/form-data">
                @csrf 
                <div class="input_deg">
                    <label for="">Product Title</label>
                    <input type="text" name="title" required>
                </div>

                <div class="input_deg">
                    <label for="">Description</label>
                    <textarea name="description"></textarea>
                </div>

                <div class="input_deg">
                    <label for="category">Category</label>
                    <select name="category">
                        <option value="">Select a category</option>
                        <option value="t-shirt">T-Shirt</option>
                        <option value="polo">Polo</option>
                        <option value="dress-shirt">Dress Shirt</option>
                        <option value="casual-shirt">Casual Shirt</option>
                        <option value="sweatshirt">Sweatshirt</option>
                        <!-- Add more categories as needed -->
                    </select>
                </div>

                <div class="input_deg">
                    <label for="price">Price</label>
                    <input type="text" name="price">
                </div>

                <div class="input_deg">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" value="">
                </div>

                <div class="input_deg">
                    <label for="material">Material</label>
                    <select name="material">
                        <option value="">Select a material</option>
                        <option value="cotton">Cotton</option>
                        <option value="polyester">Polyester</option>
                        <option value="wool">Wool</option>
                        <option value="silk">Silk</option>
                        <option value="linen">Linen</option>
                        <option value="denim">Denim</option>
                        <!-- Add more materials as needed -->
                    </select>
                </div>

                <div class="input_deg">
                    <label for="image">Image</label>
                    <input type="file" name="image">
                </div>

                <div class="input_deg">
                    <button class="btn btn-danger" type="button" onclick="window.history.back()">Cancel</button>
                    <input class="btn btn-success" type="submit" value="Add Product">
                </div>
            </form>
          </div>

        </div>   
      </div>
    </div>
    <!-- JavaScript files-->
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