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
        <h3>Register</h3>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- username input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Username</label>
            <input type="text" id="username" class="form-control form-control-base" type="text" name="username" :value="old('username')" required autofocus autocomplete="username"
              placeholder="Enter username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
          </div>

          <!-- name input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Name</label>
            <input type="text" id="name" class="form-control form-control-base" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
              placeholder="Enter name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
          </div>

          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Email address</label>
            <input type="email" id="email" class="form-control form-control-base" type="email" name="email" :value="old('email')" required autofocus autocomplete="email"
              placeholder="Enter a valid email address" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>

          <!-- phone input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Phone</label>
            <input type="text" id="phone" class="form-control form-control-base" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone"
              placeholder="Enter phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
          </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-3">
                <label class="form-label" for="form3Example4">Password</label>  
                <input type="password" id="password" class="form-control form-control-base"  type="password"
                            name="password" required autocomplete="new-password"
                            placeholder="Enter password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" /> 
            </div>

            <!-- Confirm Password  -->
            <div data-mdb-input-init class="form-outline mb-3">
                <label class="form-label" for="form3Example4">Confirm Password</label>  
                <input type="password" id="password_confirmation" class="form-control form-control-base"  type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Enter password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> 
            </div>


          <div class="text-center text-lg-start mt-4 pt-2">
       
            <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">{{ __('Register') }}</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Already registered? <a href="{{ route('login') }}"
                class="link-danger">Login</a></p>
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