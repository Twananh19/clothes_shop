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
      <title>Payment Success - Famms</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style>
         .success_section {
            padding: 80px 0;
            text-align: center;
         }
         .success-icon {
            font-size: 80px;
            color: #28a745;
            margin-bottom: 30px;
         }
         .success-content {
            max-width: 600px;
            margin: 0 auto;
         }
         .success-content h2 {
            color: #333;
            margin-bottom: 20px;
         }
         .success-content p {
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
      
      <!-- success section -->
      <section class="success_section layout_padding">
         <div class="container">
            <div class="success-content">
               <div class="success-icon">
                  <i class="fa fa-check-circle"></i>
               </div>
               
               <h2>Payment Successful!</h2>
               
               <p>Thank you for your purchase! Your payment has been processed successfully and your order has been confirmed.</p>
               
               @if(session('success'))
                  <div class="alert alert-success">
                     {{ session('success') }}
                  </div>
               @endif
               
               <div class="order-details" style="background: #f8f9fa; padding: 30px; border-radius: 10px; margin: 30px 0;">
                  <h4><i class="fa fa-info-circle"></i> What's Next?</h4>
                  <ul style="text-align: left; margin-top: 20px;">
                     <li>You will receive an order confirmation email shortly.</li>
                     <li>We will process your order and prepare it for shipping.</li>
                     <li>You will receive a tracking number once your order ships.</li>
                     <li>Estimated delivery time: 3-5 business days.</li>
                  </ul>
               </div>
               
               <div class="action-buttons">
                  <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
                     <i class="fa fa-home"></i> Continue Shopping
                  </a>
                  <a href="{{ url('all_products') }}" class="btn btn-secondary btn-lg">
                     <i class="fa fa-shopping-bag"></i> Browse Products
                  </a>
               </div>
            </div>
         </div>
      </section>
      <!-- end success section -->
      
      @include('home.footer')
      
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         </p>
      </div>

      <!-- Scripts -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <script src="home/js/bootstrap.js"></script>
      
      <script>
         // Cập nhật cart count về 0 sau khi thanh toán thành công
         $(document).ready(function() {
            $('#cart-count').hide();
         });
      </script>
   </body>
</html>
