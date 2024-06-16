<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <!-- box product color change from gray to white, override, didnt work -->
    <style>
        .box {
            background-color: white; /* Change the background color to white */
        }

        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        .h-custom {
            height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
        }

        h3{
            padding: 15px;
            margin-top: 10px;
            text-align: center;
        }
    </style>
  </head>

<body>
  <div class="hero_area">
    <!-- header section strats, top menu header -->
    @include('home.header')
    <!-- end header section, top option -->
     <!-- login -->
      
     <section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <h3>Login</h3>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Email address</label>
            <input type="email" id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
              placeholder="Enter a valid email address" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-3">
          <label class="form-label" for="form3Example4">Password</label>  
          <input type="password" id="password" class="form-control form-control-lg"  type="password"
                    name="password" required autocomplete="current-password"
                    placeholder="Enter password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input id="remember_me" class="form-check-input me-2" type="checkbox" value="" />
              <label class="form-check-label" for="form2Example3">Remember me</label>
            </div>

            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-body">Forgot password?</a>
            @endif
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
          <!-- <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button> -->
            <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">{{ __('Log in') }}</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{ route('register') }}"
                class="link-danger">Register</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
  
</section>
    
  </div>
  <!-- end hero area -->




  <!-- info section -->
  
</body>

</html>