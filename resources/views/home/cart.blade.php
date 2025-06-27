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
      <title>Shopping Cart - Famms</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style>
         .cart_section {
            padding: 40px 0;
         }
         .cart-table {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
         }
         .cart-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border: none;
         }
         .cart-table td {
            padding: 20px;
            vertical-align: middle;
            border-bottom: 1px solid #eee;
         }
         .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
         }
         .quantity-input {
            width: 70px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
         }
         .btn-remove {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
         }
         .btn-remove:hover {
            background: #c0392b;
         }
         .cart-summary {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin-top: 30px;
         }
         .total-price {
            font-size: 24px;
            font-weight: bold;
            color: #333;
         }
         .empty-cart {
            text-align: center;
            padding: 100px 20px;
         }
         .empty-cart i {
            font-size: 80px;
            color: #ddd;
            margin-bottom: 20px;
         }
         @media (max-width: 768px) {
            .cart-table {
               font-size: 14px;
            }
            .cart-table td {
               padding: 10px;
            }
         }
      </style>
   </head>
   <body>
         @include('home.header')
       
      
      <!-- cart section -->
      <section class="cart_section layout_padding">
         <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" style="margin-bottom: 30px;">
               <ol class="breadcrumb" style="background: transparent; padding: 0;">
                  <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #667eea;">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
               </ol>
            </nav>
            
            <div class="heading_container heading_center">
               <h2>
                  Shopping Cart
               </h2>
            </div>

            @if(count($cart) > 0)
               <div class="row">
                  <div class="col-12">
                     <div class="cart-table">
                        <table class="table table-responsive">
                           <thead>
                              <tr>
                                 <th>Product</th>
                                 <th>Price</th>
                                 <th>Quantity</th>
                                 <th>Total</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @php $grandTotal = 0; @endphp
                              @foreach($cart as $id => $details)
                                 @php 
                                    $price = $details['discount'] && $details['discount'] > 0 
                                           ? $details['price'] * (1 - $details['discount'] / 100)
                                           : $details['price'];
                                    $itemTotal = $price * $details['quantity'];
                                    $grandTotal += $itemTotal;
                                 @endphp
                                 <tr data-id="{{ $id }}">
                                    <td>
                                       <div style="display: flex; align-items: center;">
                                          @if($details['image'])
                                             <img src="product_images/{{ $details['image'] }}" alt="{{ $details['title'] }}" class="product-img">
                                          @else
                                             <div style="width: 80px; height: 80px; background: #f5f5f5; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fa fa-image" style="color: #ccc;"></i>
                                             </div>
                                          @endif
                                          <div style="margin-left: 15px;">
                                             <h6 style="margin: 0;">{{ $details['title'] }}</h6>
                                             <small style="color: #666;">{{ $details['category'] }}</small>
                                             @if($details['discount'] && $details['discount'] > 0)
                                                <br><small style="color: #e74c3c;">{{ $details['discount'] }}% OFF</small>
                                             @endif
                                          </div>
                                       </div>
                                    </td>
                                    <td>
                                       @if($details['discount'] && $details['discount'] > 0)
                                          <span style="text-decoration: line-through; color: #999; font-size: 12px;">
                                             ${{ number_format($details['price'], 2) }}
                                          </span><br>
                                          <span style="color: #e74c3c; font-weight: bold;">
                                             ${{ number_format($price, 2) }}
                                          </span>
                                       @else
                                          ${{ number_format($details['price'], 2) }}
                                       @endif
                                    </td>
                                    <td>
                                       <input type="number" value="{{ $details['quantity'] }}" min="1" 
                                              class="quantity-input" onchange="updateCart({{ $id }}, this.value)">
                                    </td>
                                    <td class="item-total">
                                       ${{ number_format($itemTotal, 2) }}
                                    </td>
                                    <td>
                                       <button class="btn-remove" onclick="removeFromCart({{ $id }})">
                                          <i class="fa fa-trash"></i>
                                       </button>
                                    </td>
                                 </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-8">
                     <div style="margin-top: 30px;">
                        <a href="{{ url('all_products') }}" class="btn btn-secondary btn-lg">
                           <i class="fa fa-arrow-left"></i> Continue Shopping
                        </a>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="cart-summary">
                        <h4>Cart Summary</h4>
                        <hr>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                           <span>Items:</span>
                           <span id="total-items">{{ array_sum(array_column($cart, 'quantity')) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                           <span>Subtotal:</span>
                           <span id="subtotal">${{ number_format($grandTotal, 2) }}</span>
                        </div>
                        <hr>
                        <div style="display: flex; justify-content: space-between;">
                           <strong>Total:</strong>
                           <strong class="total-price" id="grand-total">${{ number_format($grandTotal, 2) }}</strong>
                        </div>
                        <a href="{{ url('checkout') }}" class="btn btn-primary btn-lg btn-block" style="margin-top: 20px;">
                           <i class="fa fa-credit-card"></i> Proceed to Checkout
                        </a>
                     </div>
                  </div>
               </div>
            @else
               <div class="empty-cart">
                  <i class="fa fa-shopping-cart"></i>
                  <h4 style="color: #666; margin-bottom: 20px;">Your cart is empty</h4>
                  <p style="color: #999; margin-bottom: 30px;">Add some products to your cart to continue shopping.</p>
                  <a href="{{ url('all_products') }}" class="btn btn-primary btn-lg">
                     <i class="fa fa-shopping-bag"></i> Start Shopping
                  </a>
               </div>
            @endif
         </div>
      </section>
      <!-- end cart section -->
      
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
      
      <script>
         function updateCart(productId, quantity) {
            if(quantity < 1) {
               removeFromCart(productId);
               return;
            }
            
            $.ajax({
               url: '{{ url("/update_cart") }}',
               method: 'POST',
               data: {
                  product_id: productId,
                  quantity: quantity,
                  _token: '{{ csrf_token() }}'
               },
               success: function(response) {
                  location.reload(); // Reload để cập nhật tổng tiền
               },
               error: function() {
                  alert('Error updating cart');
               }
            });
         }

         function removeFromCart(productId) {
            if(confirm('Are you sure you want to remove this item from cart?')) {
               $.ajax({
                  url: '{{ url("/remove_from_cart") }}',
                  method: 'POST',
                  data: {
                     product_id: productId,
                     _token: '{{ csrf_token() }}'
                  },
                  success: function(response) {
                     location.reload(); // Reload để cập nhật cart
                  },
                  error: function() {
                     alert('Error removing item from cart');
                  }
               });
            }
         }

         // Cập nhật cart count trong header
         $(document).ready(function() {
            updateCartCount();
         });

         function updateCartCount() {
            const cartCount = {{ array_sum(array_column($cart, 'quantity')) }};
            if(cartCount > 0) {
               $('#cart-count').text(cartCount).show();
            } else {
               $('#cart-count').hide();
            }
         }
      </script>
   </body>
</html>
