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
      <title>Checkout - Famms</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style>
         .checkout_section {
            padding: 40px 0;
         }
         .checkout-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
         }
         .order-summary {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
         }
         .form-group {
            margin-bottom: 20px;
         }
         .form-control {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
         }
         .card-element {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: white;
         }
         .payment-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
         }
         .btn-pay {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 5px;
            width: 100%;
         }
         .btn-pay:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
         }
         .btn-pay:disabled {
            opacity: 0.6;
            cursor: not-allowed;
         }
         .order-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
         }
         .order-item:last-child {
            border-bottom: none;
         }
         .total-section {
            border-top: 2px solid #667eea;
            padding-top: 15px;
            margin-top: 15px;
         }
      </style>
   </head>
   <body>
         @include('home.header')
      
      <!-- checkout section -->
      <section class="checkout_section layout_padding">
         <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" style="margin-bottom: 30px;">
               <ol class="breadcrumb" style="background: transparent; padding: 0;">
                  <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #667eea;">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ url('cart') }}" style="color: #667eea;">Cart</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Checkout</li>
               </ol>
            </nav>
            
            <div class="heading_container heading_center">
               <h2>Checkout</h2>
            </div>

            <div class="row">
               <!-- Order Summary -->
               <div class="col-md-5">
                  <div class="order-summary">
                     <h4><i class="fa fa-shopping-cart"></i> Order Summary</h4>
                     <hr>
                     @foreach($cart as $id => $details)
                        @php 
                           $price = $details['discount'] && $details['discount'] > 0 
                                  ? $details['price'] * (1 - $details['discount'] / 100)
                                  : $details['price'];
                           $itemTotal = $price * $details['quantity'];
                        @endphp
                        <div class="order-item">
                           <div style="display: flex; align-items: center;">
                              @if($details['image'])
                                 <img src="product_images/{{ $details['image'] }}" alt="{{ $details['title'] }}" 
                                      style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                              @endif
                              <div style="margin-left: 15px; flex: 1;">
                                 <h6 style="margin: 0; font-size: 14px;">{{ $details['title'] }}</h6>
                                 <small style="color: #666;">Qty: {{ $details['quantity'] }}</small>
                              </div>
                              <div style="text-align: right;">
                                 @if($details['discount'] && $details['discount'] > 0)
                                    <small style="text-decoration: line-through; color: #999;">
                                       ${{ number_format($details['price'], 2) }}
                                    </small><br>
                                 @endif
                                 <strong>${{ number_format($itemTotal, 2) }}</strong>
                              </div>
                           </div>
                        </div>
                     @endforeach
                     
                     <div class="total-section">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                           <span>Subtotal:</span>
                           <span>${{ number_format($grandTotal, 2) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                           <span>Shipping:</span>
                           <span>Free</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: bold;">
                           <span>Total:</span>
                           <span>${{ number_format($grandTotal, 2) }}</span>
                        </div>
                     </div>
                  </div>
               </div>

               <!-- Checkout Form -->
               <div class="col-md-7">
                  <div class="checkout-form">
                     <h4><i class="fa fa-user"></i> Billing Information</h4>
                     <hr>
                     
                     <form id="payment-form" action="{{ url('process_payment') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="customer_name">Full Name *</label>
                                 <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="customer_email">Email Address *</label>
                                 <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="customer_phone">Phone Number *</label>
                                 <input type="text" class="form-control" id="customer_phone" name="customer_phone" required>
                              </div>
                           </div>
                        </div>

                        <div class="form-group">
                           <label for="customer_address">Address *</label>
                           <textarea class="form-control" id="customer_address" name="customer_address" rows="3" required></textarea>
                        </div>

                        <div class="payment-section">
                           <h4><i class="fa fa-credit-card"></i> Payment Information</h4>
                           <p style="color: #666; margin-bottom: 20px;">This is a demo payment system. Use the test card numbers below:</p>
                           
                           <!-- Demo Test Card Info -->
                           <div class="alert alert-info" style="margin-bottom: 20px;">
                              <h6><i class="fa fa-info-circle"></i> Test Card Numbers:</h6>
                              <ul style="margin: 10px 0; padding-left: 20px;">
                                 <li><strong>Success:</strong> 4242 4242 4242 4242</li>
                                 <li><strong>Decline:</strong> 4000 0000 0000 0002</li>
                                 <li><strong>Expired:</strong> 4000 0000 0000 0069</li>
                              </ul>
                              <small>Expiry: Any future date | CVC: Any 3 digits</small>
                           </div>
                           
                           <!-- Simplified Card Form -->
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="card_number">Card Number *</label>
                                    <input type="text" class="form-control" id="card_number" name="card_number" 
                                           placeholder="4242 4242 4242 4242" maxlength="19" required>
                                 </div>
                              </div>
                           </div>
                           
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="expiry">Expiry Date *</label>
                                    <input type="text" class="form-control" id="expiry" name="expiry" 
                                           placeholder="MM/YY" maxlength="5" required>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="cvc">CVC *</label>
                                    <input type="text" class="form-control" id="cvc" name="cvc" 
                                           placeholder="123" maxlength="4" required>
                                 </div>
                              </div>
                           </div>

                           <div class="form-group">
                              <label for="cardholder_name">Cardholder Name *</label>
                              <input type="text" class="form-control" id="cardholder_name" name="cardholder_name" 
                                     placeholder="John Doe" required>
                           </div>

                           <button type="submit" id="submit-button" class="btn-pay">
                              <i class="fa fa-lock"></i> Pay ${{ number_format($grandTotal, 2) }}
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end checkout section -->
      
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
         // Format card number
         document.getElementById('card_number').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formattedValue;
         });

         // Format expiry date
         document.getElementById('expiry').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
               value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
         });

         // Only allow numbers for CVC
         document.getElementById('cvc').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
         });

         // Handle form submission
         document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitButton = document.getElementById('submit-button');
            const cardNumber = document.getElementById('card_number').value.replace(/\s/g, '');
            
            // Disable button and show processing
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';
            
            // Simulate payment processing
            setTimeout(function() {
               // Check test card numbers
               if (cardNumber === '4242424242424242') {
                  // Success case
                  document.getElementById('payment-form').submit();
               } else if (cardNumber === '4000000000000002') {
                  // Decline case
                  alert('Payment Declined: Your card was declined. Please try a different card.');
                  submitButton.disabled = false;
                  submitButton.innerHTML = '<i class="fa fa-lock"></i> Pay ${{ number_format($grandTotal, 2) }}';
               } else if (cardNumber === '4000000000000069') {
                  // Expired card
                  alert('Payment Failed: Your card has expired. Please use a different card.');
                  submitButton.disabled = false;
                  submitButton.innerHTML = '<i class="fa fa-lock"></i> Pay ${{ number_format($grandTotal, 2) }}';
               } else {
                  // Invalid card
                  alert('Invalid Card: Please use one of the test card numbers provided above.');
                  submitButton.disabled = false;
                  submitButton.innerHTML = '<i class="fa fa-lock"></i> Pay ${{ number_format($grandTotal, 2) }}';
               }
            }, 2000); // 2 second delay to simulate processing
         });
      </script>
   </body>
</html>
