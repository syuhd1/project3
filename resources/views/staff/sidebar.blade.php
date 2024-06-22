<div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <!-- <div class="avatar"><img src="/profiles/{{asset('admincss/img/avatar-6.jpg')}}" alt="..." class="img-fluid rounded-circle"></div> -->
          @if($identity->picture !== null)
          <div class="avatar">
            <img src="/profiles/{{$identity->picture}}" alt="..." class="img-fluid rounded-circle">
          </div>
          @else
          <div class="avatar">
            <img src="/profiles/avatar.jpg" alt="" class="img-fluid rounded-circle">
          </div>
          @endif
          <div class="title">
            <h1 class="h5" value="">{{$identity->name}}</h1>
            <p>Staff</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="active"><a href="{{url('staff/dashboard')}}"> <i class="icon-home"></i>Home</a></li>
                  <!-- change index.html to route home -->
                  <!-- NEED TO MONITOR!  -->
                <!-- <li>
                    <a href="{{url('staff/view_category')}}"> <i class="icon-grid"></i>Category</a>
                </li> -->

                <li>
                    <a href="{{url('staff/manage_product')}}"> <i class="icon-list-1"></i>Manage Product</a>
                </li>

                <!-- <li>
                    <a href="{{url('staff/manage_staff')}}"> <i class="icon-user-1"></i>Manage Staff</a>
                </li> -->
                <li>
                    <a href="{{url('staff/manage_order')}}"> <i class="icon-paper-and-pencil"></i>Manage Order</a>
                </li>

                <li>
                    <a href="{{url('staff/manage_quotation')}}"> <i class="icon-paper-and-pencil"></i>Manage Quotation</a>
                </li>

                <li>
                    <a href="{{url('profile')}}"> <i class="icon-user"></i>Manage Profile</a>
                </li>
              
                <!-- <li>
                    <a href="{{url('staff/generate_report')}}"> <i class="icon-page"></i>Manage Report</a>
                </li> -->
                <!--  
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Products</a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                  <li>
                    <a href="{{url('staff/manage_product')}}"> <i class="icon-list-1"></i>Manage Product</a>
                </li>
                    <li><a href="{{url('staff/add_product')}}">Add Products</li>
                    <li><a href="{{url('staff/update_product')}}">Update Products</li>
                    <li><a href="{{url('staff/delete_product')}}">Delete Products</a></li>
                  </ul>
                </li>
                -->
                
                <!--  
                
                -->

                
                
      </nav>