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

  @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
          
          <h2>Add Staff</h2>

          <div class="div_deg">
          <form action="{{url('upload_staff')}}" method="post" enctype="multipart/form-data">
                        @csrf 
                        
                        <div class="input_deg">
                            <label for="name">Name</label>
                            <input type="text" name="name" required>
                        </div>

                        

                        
                        <!-- 
                        <div class="input_deg">
                            <label for="acc_status">Account Status</label>
                            <select name="acc_status">
                                <option value="">Select status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                            </select>
                        </div> -->

                        <div class="input_deg">
                            <label for="name">Phone</label>
                            <input type="text" name="phone">
                        </div>

                        <div class="input_deg">
                            <label for="">Address</label>
                            <textarea name="address"></textarea>
                        </div>

                        <div class="input_deg">
                            <label for="department">Department</label>
                            <select name="department">
                                <option value="">Select a department</option>
                                    <option value="sales">Sales</option>
                                    <option value="design">Design</option>
                                    <option value="production">Production</option>

                            </select>
                        </div>

                        <div class="input_deg">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date">
                        </div>

                        <!-- <div class="input_deg">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date">
                        </div> -->

                        <div class="input_deg">
                            <label for="image">Image</label>
                            <input type="file" name="image">
                        </div>

                        <div class="input_deg">
                            <label for="email">Email</label>
                            <input type="email" name="email" required>
                        </div>

                        <div class="input_deg">
                            <label for="username">Username</label>
                            <input type="text" name="username" required>
                        </div>

                        <div class="input_deg">
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                        </div>

                        <!-- Add more input fields for other staff details -->
                        
                        <div class="input_deg">
                            <button class="btn btn-danger" type="button" onclick="window.history.back()">Cancel</button>
                            <input class="btn btn-success" type="submit" value="Add Staff">
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