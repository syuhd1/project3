<!DOCTYPE html>
<html>

<head>
    @include('home.css')
  </head>

<body>
  <div class="hero_area">
    <!-- header section strats, top menu header -->
    @include('home.header')
    <!-- end header section, top option -->
    <!-- slider section, banner -->
    @include('home.slider')
    
    <!-- end slider section -->
  </div>
  <!-- end hero area -->

  <!-- shop section -->
  @include('home.product')
  <!-- end shop section -->







  <!-- contact section -->
  @include('home.contact')

  <!-- end contact section -->

   

  <!-- info section -->

  @include('home.footer')
  
</body>

</html>