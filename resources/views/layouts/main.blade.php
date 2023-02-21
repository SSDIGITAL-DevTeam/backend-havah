<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>FinDash - Responsive Bootstrap 4 Admin Dashboard Template</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('html/images/favicon.ico')}}" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{asset('html/css/bootstrap.min.css')}}">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{asset('html/css/typography.css')}}">
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{asset('html/css/style.css')}}">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{asset('html/css/responsive.css')}}">
      <!-- Full calendar -->
      <link href="{{ asset('html/fullcalendar/core/main.css')}}" rel='stylesheet' />
      <link href="{{ asset('html/fullcalendar/daygrid/main.css')}}" rel='stylesheet' />
      <link href="{{ asset('html/fullcalendar/timegrid/main.css') }}" rel='stylesheet' />
      <link href="{{ asset('html/fullcalendar/list/main.css') }}" rel='stylesheet' />

      <link rel="stylesheet" href="{{asset('html')}}/css/flatpickr.min.css">

   </head>
   <body>
      <!-- loader Start -->
      {{-- <div id="loading">
         <div id="loading-center">
         </div>
      </div> --}}
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
         @include('partials.sidebar')
         <!-- TOP Nav Bar -->
         @include('partials.navbar')
         <!-- TOP Nav Bar END -->

         <!-- Page Content  -->
         @yield('container')
      </div>
      <!-- Wrapper END -->
      <!-- Footer -->
      <footer class="iq-footer">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-6">
                  <ul class="list-inline mb-0">
                     <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                     <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                  </ul>
               </div>
               <div class="col-lg-6 text-right">
                  Copyright 2020 <a href="#">FinDash</a> All Rights Reserved.
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer END -->
     
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="{{asset('html')}}/js/jquery.min.js"></script>
      <script src="{{asset('html')}}/js/popper.min.js"></script>
      <script src="{{asset('html')}}/js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="{{asset('html')}}/js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="{{asset('html')}}/js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="{{asset('html')}}/js/waypoints.min.js"></script>
      <script src="{{asset('html')}}/js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="{{asset('html')}}/js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="{{asset('html')}}/js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="{{asset('html')}}/js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="{{asset('html')}}/js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="{{asset('html')}}/js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="{{asset('html')}}/js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="{{asset('html')}}/js/smooth-scrollbar.js"></script>
      <!-- lottie JavaScript -->
      <script src="{{asset('html')}}/js/lottie.js"></script>
      <!-- am core JavaScript -->
      <script src="{{asset('html')}}/js/core.js"></script>
      <!-- am charts JavaScript -->
      <script src="{{asset('html')}}/js/charts.js"></script>
      <!-- am animated JavaScript -->
      <script src="{{asset('html')}}/js/animated.js"></script>
      <!-- am kelly JavaScript -->
      <script src="{{asset('html')}}/js/kelly.js"></script>
      <!-- am maps JavaScript -->
      <script src="{{asset('html')}}/js/maps.js"></script>
      <!-- am worldLow JavaScript -->
      <script src="{{asset('html')}}/js/worldLow.js"></script>
      <!-- Raphael-min JavaScript -->
      <script src="{{asset('html')}}/js/raphael-min.js"></script>
      <!-- Morris JavaScript -->
      <script src="{{asset('html')}}/js/morris.js"></script>
      <!-- Morris min JavaScript -->
      <script src="{{asset('html')}}/js/morris.min.js"></script>
      <!-- Flatpicker Js -->
      <script src="{{asset('html')}}/js/flatpickr.js"></script>
      <!-- Style Customizer -->
      <script src="{{asset('html')}}/js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="{{asset('html')}}/js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="{{asset('html')}}/js/custom.js"></script>
   </body>
</html>