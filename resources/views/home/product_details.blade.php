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
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style>
         .product_section {
            padding: 40px 0;
         }
         .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            color: #999;
         }
         .img-box img {
            max-height: 500px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
         }
         .detail-box {
            padding: 20px;
         }
         .detail-box h3 {
            color: #333;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
         }
         .price_color {
            font-size: 1.8rem;
            font-weight: bold;
            margin: 20px 0;
         }
         .original-price {
            color: #999;
            text-decoration: line-through;
            margin-right: 10px;
         }
         .discount-price {
            color: #e74c3c;
         }
         .description {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #666;
            margin: 20px 0;
         }
         .product-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
         }
         .info-item {
            margin-bottom: 10px;
            font-size: 1rem;
         }
         .info-item strong {
            color: #333;
         }
         .text-success {
            color: #28a745 !important;
         }
         .text-danger {
            color: #dc3545 !important;
         }
         .quantity-selector label {
            font-weight: bold;
            margin-right: 10px;
         }
         .action-buttons .btn {
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 25px;
            margin-right: 10px;
            margin-bottom: 10px;
         }
         .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
         }
         .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
         }
         .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            border: none;
         }
         @media (max-width: 768px) {
            .detail-box h3 {
               font-size: 2rem;
            }
            .action-buttons .btn {
               width: 100%;
               margin-bottom: 10px;
               margin-right: 0;
            }
            .img-box img {
               max-height: 300px;
            }
         }
      </style>
   </head>
   <body>
      <div class="hero_area" style="margin-bottom: none; ">
         @include('home.header')
      </div>
      
      <!-- product details section -->
      <section class="product_section layout_padding">
         <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" style="margin-bottom: 30px;">
               <ol class="breadcrumb" style="background: transparent; padding: 0;">
                  <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #667eea;">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ url('all_products') }}" style="color: #667eea;">Products</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
               </ol>
            </nav>
            
            <div class="heading_container heading_center">
               <h2>
                  Product Details
               </h2>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="img-box">
                     @if($product->image)
                        <img src="product_images/{{ $product->image }}" alt="{{ $product->title }}" class="img-fluid">
                     @else
                        <img src="home/images/p1.png" alt="No Image" class="img-fluid">
                     @endif
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="detail-box">
                     <h3>{{ $product->title }}</h3>
                     <div class="price">
                        @if($product->discount && $product->discount > 0)
                           <h6 class="price_color">
                              <span class="original-price">${{ number_format($product->price, 2) }}</span>
                              <span class="discount-price">${{ number_format($product->price * (1 - $product->discount / 100), 2) }}</span>
                           </h6>
                        @else
                           <h6 class="price_color">${{ number_format($product->price, 2) }}</h6>
                        @endif
                     </div>
                     <p class="description">{{ $product->description }}</p>
                     <div class="product-info">
                        <div class="info-item">
                           <strong>Category:</strong> {{ $product->category }}
                        </div>
                        <div class="info-item">
                           <strong>Quantity Available:</strong> 
                           <span class="{{ $product->quantity > 0 ? 'text-success' : 'text-danger' }}">
                              {{ $product->quantity > 0 ? $product->quantity . ' items' : 'Out of Stock' }}
                           </span>
                        </div>
                        @if($product->discount && $product->discount > 0)
                        <div class="info-item">
                           <strong>Discount:</strong> 
                           <span class="text-danger">{{ $product->discount }}% OFF</span>
                        </div>
                        @endif
                        <div class="info-item">
                           <strong>Product ID:</strong> #{{ $product->id }}
                        </div>
                     </div>
                     
                     @if($product->quantity > 0)
                     <div class="product-actions mt-4">
                        <div class="quantity-selector mb-3">
                           <label for="quantity">Quantity:</label>
                           <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->quantity }}" class="form-control" style="width: 100px; display: inline-block;">
                        </div>
                        <div class="action-buttons">
                           <button class="btn btn-primary btn-lg mr-2" onclick="addToCart()">
                              <i class="fa fa-shopping-cart"></i> Add to Cart
                           </button>
                           <a href="{{ url('all_products') }}" class="btn btn-secondary btn-lg">
                              <i class="fa fa-arrow-left"></i> Back to Products
                           </a>
                        </div>
                     </div>
                     @else
                     <div class="product-actions mt-4">
                        <div class="action-buttons">
                           <button class="btn btn-danger btn-lg mr-2" disabled>
                              <i class="fa fa-times"></i> Out of Stock
                           </button>
                           <a href="{{ url('all_products') }}" class="btn btn-secondary btn-lg">
                              <i class="fa fa-arrow-left"></i> Back to Products
                           </a>
                        </div>
                     </div>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end product details section -->
      
      <!-- related products section -->
      <section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  You Might Also Like
               </h2>
               <p>More products from the same category</p>
            </div>
            <div class="row">
               @php
                  $relatedProducts = App\Models\Product::where('category', $product->category)
                                                      ->where('id', '!=', $product->id)
                                                      ->limit(4)
                                                      ->get();
               @endphp
               @if($relatedProducts->count() > 0)
                  @foreach($relatedProducts as $related)
                  <div class="col-sm-6 col-md-4 col-lg-3">
                     <div class="box">
                        <div class="option_container">
                           <div class="options">
                              <a href="{{ url('product_details', $related->id) }}" class="option1">
                                 View Details
                              </a>
                           </div>
                        </div>
                        <div class="img-box">
                           @if($related->image)
                              <img src="product_images/{{ $related->image }}" alt="{{ $related->title }}">
                           @else
                              <img src="home/images/p1.png" alt="No Image">
                           @endif
                        </div>
                        <div class="detail-box">
                           <h5>{{ Str::limit($related->title, 20) }}</h5>
                           <h6>
                              @if($related->discount && $related->discount > 0)
                                 <span style="text-decoration: line-through; color: #999; margin-right: 10px;">
                                    ${{ number_format($related->price, 2) }}
                                 </span>
                                 <span style="color: #e74c3c; font-weight: bold;">
                                    ${{ number_format($related->price * (1 - $related->discount / 100), 2) }}
                                 </span>
                              @else
                                 ${{ number_format($related->price, 2) }}
                              @endif
                           </h6>
                        </div>
                     </div>
                  </div>
                  @endforeach
               @else
                  <div class="col-12 text-center">
                     <p style="color: #999; font-style: italic;">No related products found in this category.</p>
                  </div>
               @endif
            </div>
         </div>
      </section>
      <!-- end related products section -->
      
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
         function addToCart() {
            const quantity = document.getElementById('quantity').value;
            const productId = {{ $product->id }};
            
            $.ajax({
               url: '{{ url("/add_to_cart") }}',
               method: 'POST',
               data: {
                  product_id: productId,
                  quantity: quantity,
                  _token: '{{ csrf_token() }}'
               },
               success: function(response) {
                  if(response.success) {
                     alert(response.message);
                     // Cập nhật cart count trong header
                     $('#cart-count').text(response.cart_count).show();
                  }
               },
               error: function() {
                  alert('Error adding product to cart');
               }
            });
         }

         // Cập nhật cart count khi trang load
         $(document).ready(function() {
            updateCartCount();
         });

         function updateCartCount() {
            // Lấy cart count từ session
            $.ajax({
               url: '{{ url("/cart") }}',
               method: 'GET',
               success: function(data) {
                  // Extract cart count from response (sẽ implement sau)
               }
            });
         }
      </script>
   </body>
</html>