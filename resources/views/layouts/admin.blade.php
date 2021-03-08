<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>crud_practice</title>
    
  </head>
  <body>
  <div class="main-site">
  @include('layouts.admin-header')
  <main class="site-body">
  @yield('content')
  </main>
   
  <footer class="site-footer">
      <div class="container">
        <div class="row align-items-center">
          <div class="col footer-col_left">
            <a href=""><img src="{{ asset('images/phone-icn-white.svg') }}"> 1 800 200 456</a>  &nbsp; |&nbsp;  <a href=""><img src="{{ asset('images/email-icn.svg') }}"> info@mybizzhive.com</a>
            <nav class="footer--nav">
              <a href="">About us</a> |  
              <a href="">How it works</a>  |  
              <a href="">FAQ</a>
            </nav>
          </div>
          <div class="col footer-col_right">
            <div class="social-btns"><a href=""><img src="{{ asset('images/facebook-icn.svg') }}"></a> <a href=""><img src="{{ asset('images/google-plus-icn.svg') }}"></a> <a href=""><img src="{{ asset('images/twitter-icn.svg') }}"></a></div>
            <div class="copyright">Copyright 2020 MyBizzHive</div>
          </div>
        </div>
      </div>
    </footer>  
      
    </div>   

    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- Custome JavaScript -->
    <script>
        $(window).bind("resize", function () {
            console.log($(this).width())
            if ($(this).width() < 991) {
                $('.main-card--collapse').addClass('collapse')
                $('.mbl-tabbing').addClass('tab-pane fade')
                $('.leads-col_body').addClass('collapse')
            } else {
                $('.main-card--collapse').removeClass('collapse')
                $('.mbl-tabbing').removeClass('tab-pane fade')
                $('.leads-col_body').removeClass('collapse')
            }
        }).trigger('resize');
    </script>
    <script type="text/javascript">

function CalculatePrice()
{

    var P_price = document.getElementById('lbl_product_price').innerText;
    var P_quantity = document.getElementById('txt_quantity').value;
// alert(P_price);
// alert(P_quantity);
if (!isNaN(P_quantity)) {
        document.getElementById('lbl_total_price').innerText=(P_price)*parseInt(P_quantity);
document.getElementById('hdn_total_price').value=(P_price)*parseInt(P_quantity);

    }

else{
    alert('Quantity must be an integer');
}
}
</script>

  </body>
</html>
