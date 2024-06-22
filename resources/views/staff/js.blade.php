<!-- sweet alert confirmation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript"> //to make confirmation popup
      function confirmation(ev){
        ev.preventDefault(); //stop browser reload/refresh
        //get url and store to urltoredirect
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect); //print url in console

        swal({
          title:"Are you sure to delete this?",
          text: "This deletion will be permanent",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })

        .then((willCancel)=>{
          if(willCancel){
            window.location.href=urlToRedirect;
          }
        }),
      }
    </script>
   