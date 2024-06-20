<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
  </head>
  <body>
  @include('admin.header')

  <style type="text/css">
    .div_deg{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    h1{
        /* color: white; */
    }

    h6{
        padding: 10px;/
        margin-top: 10px;
        text-align: center;
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
  </style>

  @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
          
          <h3>Quotation Details</h3>

          <div class="div_deg">

          </div>
          <!-- start cust table -->
           <h6>--------------[Customer Detail]--------------</h6>
          <div class="table-responsive">
                <table class="table table-striped table-hover table_deg" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Requested At</th>
                        </tr>
                    </thead>
                    <tbody>
                     
                        <tr>
                            <td>{{ $data->user->id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->phone }}</td>
                            <td>{{ $data->user->email }}</td>
                            <td>{{ $data->address }}</td>
                            <td>{{$data->created_at}}</td>
                        </tr>
                   
                    </tbody>
                </table>
            </div>
            <!-- end cust table -->

            <!-- start prod table -->
             <h6>--------------[Product Details]--------------</h6>
          <div class="table-responsive">
                <table class="table table-striped table-hover table_deg" >
                     @include('admin.colormap')
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Base Price (RM)</th>
                            <th>Base Value (RM)</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                     
                        <tr>
                            <td>{{ $data->product->id }}</td>
                            <td>
                                <span>{{ $data->product->title }}</span>
                                <img height="70" width="70" src="products/{{$data->product->image}}" alt="" />
                            </td>
                            <td>{{ $data->quantity }}</td>
                            <td>{{ $data->size }}</td>
                            <td> 
                                @php
                                    $colorName = $data->color;
                                    $colorCode = isset($colorMapping[$colorName]) ? $colorMapping[$colorCode] : 'Unknown Color';
                                @endphp
                                <div style="display: flex; align-items: center;" class="itemcenter">
                                    <span style="display: inline-block; width: 20px; height: 20px; background-color: {{$colorName}}; border: 1px solid #000; margin-right: 5px;"></span>
                                    <span>{{$colorName}}</span>
                                </div>
                            </td>
                            <td>{{ $data->product->price }}</td>
                            <td>{{ $data->base_price * $data->quantity }}</td>
                        </tr>
                   
                    </tbody>
                </table>
            </div>
            <!-- end prod table -->

            <!-- start desc table -->
          <div class="table-responsive">
            <h6>--------------[Customization Details]--------------</h6>
                @include('admin.colormap')
                <table class="table table-striped table-hover table_deg" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Deadline</th>
                            <th>Reference</th>
                            <th>Customization </br>Fee(1 pcs)</th>
                            <th>Total Value (RM)</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                     
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->deadline}}</td>
                            <td>{{ $data->reference }}</td>
                            <td>{{ $data->add_price }}</td>
                            <td>{{ $data->total_price }}</td>
                            <td>{{$data->updated_at}}</td>
                        </tr>
                   
                    </tbody>
                </table>
            </div>

          <div class="div_deg">
            <form action="{{url('upload_quotation', $data->id)}}" method="Post" enctype="multipart/form-data">
                @csrf 
                <div class="input_deg">
                    <label for="">Update Customization Fee (1 pcs): </label>
                    <input type="number" name="add_price" value="{{$data->add_price}}" required>
                </div>

                <div class="input_deg">
                    <a class="btn btn-danger" type="button" href="{{url('manage_quotation')}}">Cancel</a>
                    <input class="btn btn-success" type="submit" value="Update Quotation">
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