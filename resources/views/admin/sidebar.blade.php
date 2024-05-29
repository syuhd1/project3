<div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="{{asset('admincss/img/avatar-6.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">Mark Stephen</h1>
            <p>Web Designer</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="active"><a href="index.html"> <i class="icon-home"></i>Home </a></li>

                <li>
                    <a href="{{url('view_category')}}"> <i class="icon-grid"></i>Category</a>
                </li>

                <li>
                    <a href="{{url('manage_product')}}"> <i class="icon-list-1"></i>Manage Product</a>
                </li>
                <li>
                    <a href="{{url('manage_order')}}"> <i class="icon-paper-and-pencil"></i>Manage Order</a>
                </li>
                <li>
                    <a href="{{url('manage_profile')}}"> <i class="icon-user"></i>Manage Profile</a>
                </li>
                <li>
                    <a href="{{url('manage_staff')}}"> <i class="icon-user-1"></i>Manage Staff</a>
                </li>
                <li>
                    <a href="{{url('manage_report')}}"> <i class="icon-page"></i>Manage Report</a>
                </li>

                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Example dropdown </a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="#">Pagea></li>
                    <li><a href="#">Pag</e</a></li>
                    <li><a href="#">Page</a></li>
                  </ul>
                </li>
                
      </nav>