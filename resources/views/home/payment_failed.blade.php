<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
       <base href="/public">
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Payment Failed - Famms</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style>
         .failed_section {
            padding: 80px 0;
            text-align: center;
         }
         .failed-icon {
            font-size: 80px;
            color: #dc3545;
            margin-bottom: 30px;
         }
         .failed-content {
            max-width: 600px;
            margin: 0 auto;
         }
         .failed-content h2 {
            color: #333;
            margin-bottom: 20px;
         }
         .failed-content p {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
         }
         .action-buttons .btn {
            margin: 10px;
            padding: 12px 30px;
            border-radius: 25px;
         }
      </style>
   </head>
   <body>
         @include('home.header')
      
      <!-- failed section -->
      <section class="failed_section layout_padding">
         <div class="container">
            <div class="failed-content">
               <div class="failed-icon">
                  <i class="fa fa-times-circle"></i>
               </div>
               
               <h2>Payment Failed</h2>
               
               <p>We're sorry, but your payment could not be processed. Please check your payment information and try again.</p>
               
               @if(session('error'))
                  <div class="alert alert-danger">
                     {{ session('error') }}
                  </div>
               @endif
               
               <div class="error-details" style="background: #f8f9fa; padding: 30px; border-radius: 10px; margin: 30px 0;">
                  <h4><i class="fa fa-info-circle"></i> What can you do?</h4>
                  <ul style="text-align: left; margin-top: 20px;">
                     <li>Check that your card details are correct</li>
                     <li>Ensure you have sufficient funds</li>
                     <li>Try a different payment method</li>
                     <li>Contact your bank if the problem persists</li>
                     <li>Contact our customer support for assistance</li>
                  </ul>
               </div>
               
               <div class="action-buttons">
                  <a href="{{ url('checkout') }}" class="btn btn-primary btn-lg">
                     <i class="fa fa-credit-card"></i> Try Again
                  </a>
                  <a href="{{ url('cart') }}" class="btn btn-secondary btn-lg">
                     <i class="fa fa-shopping-cart"></i> Back to Cart
                  </a>
               </div>
            </div>
         </div>
      </section>
      <!-- end failed section -->
      
      @include('home.footer')
      
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         </p>
      </div>

      <!-- Scripts -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <script src="home/js/bootstrap.js"></script>
   </body>
</html>
