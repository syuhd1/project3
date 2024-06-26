<header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="{{url('/')}}">
          <span style="font-family: 'Open Sans',sans-serif">
            T-Hub: Shirt Printing Service System
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  ">
            <li class="nav-item active">
              <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="shop.html">
                Products
              </a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="why.html">
                Why Us
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="testimonial.html">
                Testimonial
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact Us</a>
            </li> -->

            <li class="nav-item">
      
              <form  class="nav-link"  action="{{url('home_search')}}" method="get" class="top-left">
                @csrf
                  <input type="search" name="search" placeholder="Search products...">
                  <!-- <input type="submit" class="btn btn-primary" value="Search"> -->
                  <button class="btn nav_search-btn" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
                </form>
         
            </li>
          </ul>
          <div class="user_option">

            @if (Route::has('login'))
              @auth

                @if (Auth::user()->usertype == 'admin')
                    <!-- Display dashboard button only for admin -->
                    <a href="{{ url('/admin/dashboard') }}">
                        <i class="fa fa-dashboard" aria-hidden="true"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                @endif

              <a href="{{url('mycart')}}">
              <i class="fa-solid fa-cart-shopping" aria-hidden="true" title="My Carts"></i>
              [{{$count}}]
              </a>
            
              <a href="{{url('myorders')}}">
                <i class="fa-solid fa-scroll" aria-hidden="true" title="My Orders"></i>
                <!-- [{{$count}}] -->
                </a>
                  
              <a href="{{url('profile')}}">
                <i class="fa solid fa-user" aria-hidden="true" title="Profile"></i>
              </a>

              <!-- <form class="form-inline ">
                <button class="btn nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button> -->
              </form>

                <form style="margin-left: 20px; padding: 10px;" method="POST" action="{{ route('logout') }}">
                      @csrf

                      <input class="btn btn-secondary" type="submit" value="logout">
                      
                </form>
  
            @else
                  <a href="{{url('/login')}}"> <!-- link to laravel inbuilt login-->
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>
                      Login
                    </span>
                  </a>

                  <a href="{{url('/register')}}"> <!-- link to laravel inbuilt register-->
                    <i class="fa fa-vcard" aria-hidden="true"></i>  <!-- vcard is icon -->
                    <span>
                      Register
                    </span>
                  </a>

              @endauth
            @endif

            
          </div>
        </div>
      </nav>
    </header>