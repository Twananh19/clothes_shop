<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>All Products - Fashion Store</title>
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
            padding: 60px 0;
         }
         .filter_section {
            background-color: #f8f9fa;
            padding: 30px 0;
            margin-bottom: 40px;
         }
         .filter_box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
         }
         .back_to_home {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 30px;
            transition: all 0.3s ease;
         }
         .back_to_home:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
         }
         .product_grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
         }
      </style>
   </head>
   <body>
      <!-- header section strats -->
      @include('home.header')
      <!-- end header section -->

      <section class="product_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <a href="{{ url('/') }}" class="back_to_home">
                     <i class="fa fa-arrow-left"></i> Back to Home
                  </a>
               </div>
            </div>
            
            <div class="heading_container heading_center">
               <h2>
                  All <span>Products</span>
               </h2>
               <p>Discover our complete collection of fashion items</p>
            </div>

            <!-- Filter Section -->
            <div class="filter_section">
               <div class="container">
                  <div class="filter_box">
                     <div class="row">
                        <div class="col-md-3">
                           <h6>Filter by Category:</h6>
                           <select class="form-control" id="categoryFilter">
                              <option value="">All Categories</option>
                              @php
                                 $categories = $product->pluck('category')->unique();
                              @endphp
                              @foreach($categories as $category)
                                 <option value="{{ $category }}">{{ $category }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-3">
                           <h6>Filter by Price:</h6>
                           <select class="form-control" id="priceFilter">
                              <option value="">All Prices</option>
                              <option value="0-50">Under $50</option>
                              <option value="50-100">$50 - $100</option>
                              <option value="100-200">$100 - $200</option>
                              <option value="200+">Above $200</option>
                           </select>
                        </div>
                        <div class="col-md-3">
                           <h6>Sort by:</h6>
                           <select class="form-control" id="sortFilter">
                              <option value="">Default</option>
                              <option value="price_low">Price: Low to High</option>
                              <option value="price_high">Price: High to Low</option>
                              <option value="name">Name: A to Z</option>
                           </select>
                        </div>
                        <div class="col-md-3">
                           <h6>Search:</h6>
                           <input type="text" class="form-control" id="searchFilter" placeholder="Search products...">
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row" id="productContainer">
               @if(count($product) > 0)
                  @foreach($product as $products)
                     <div class="col-sm-6 col-md-4 col-lg-3 product-item" 
                          data-category="{{ $products->category }}" 
                          data-price="{{ $products->price }}" 
                          data-name="{{ strtolower($products->title) }}">
                        <div class="box" style="margin-bottom: 30px;">
                           <div class="option_container">
                              <div class="options">
                                 <a href="" class="option1">
                                    {{ Str::limit($products->title, 20) }}
                                 </a>
                                 <a href="" class="option2">
                                    Buy Now
                                 </a>
                              </div>
                           </div>
                           <div class="img-box">
                              @if($products->image)
                                 <img src="product_images/{{ $products->image }}" alt="{{ $products->title }}" style="width: 100%; height: 250px; object-fit: cover;">
                              @else
                                 <div style="width: 100%; height: 250px; background-color: #f5f5f5; display: flex; align-items: center; justify-content: center; color: #999;">
                                    <i class="fa fa-image" style="font-size: 60px;"></i>
                                 </div>
                              @endif
                           </div>
                           <div class="detail-box">
                              <h5 title="{{ $products->title }}">
                                 {{ Str::limit($products->title, 25) }}
                              </h5>
                              <p style="font-size: 12px; color: #666; margin: 5px 0;">
                                 {{ Str::limit($products->description, 60) }}
                              </p>
                              <h6>
                                 @if($products->discount && $products->discount > 0)
                                    <span style="text-decoration: line-through; color: #999; margin-right: 10px; font-size: 14px;">
                                       ${{ number_format($products->price, 2) }}
                                    </span>
                                    <span style="color: #e74c3c; font-weight: bold;">
                                       ${{ number_format($products->price * (1 - $products->discount / 100), 2) }}
                                    </span>
                                    <small style="background-color: #e74c3c; color: white; padding: 2px 6px; border-radius: 3px; margin-left: 5px; font-size: 10px;">
                                       -{{ $products->discount }}%
                                    </small>
                                 @else
                                    ${{ number_format($products->price, 2) }}
                                 @endif
                              </h6>
                              <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                                 @if($products->quantity > 0)
                                    <small style="color: #27ae60; font-weight: bold;">In Stock ({{ $products->quantity }})</small>
                                 @else
                                    <small style="color: #e74c3c; font-weight: bold;">Out of Stock</small>
                                 @endif
                                 <small style="background-color: #3498db; color: white; padding: 3px 8px; border-radius: 12px; font-size: 10px;">
                                    {{ $products->category }}
                                 </small>
                              </div>
                           </div>
                        </div>
                     </div>
                  @endforeach
               @else
                  <div class="col-12 text-center">
                     <div style="padding: 100px 20px;">
                        <i class="fa fa-shopping-bag" style="font-size: 80px; color: #ddd; margin-bottom: 20px;"></i>
                        <h4 style="color: #666; margin-bottom: 20px;">No products available</h4>
                        <p style="color: #999;">Please check back later for new arrivals!</p>
                     </div>
                  </div>
               @endif
            </div>

            @if(count($product) > 0)
               <div class="row">
                  <div class="col-12 text-center" style="margin-top: 40px;">
                     <h5>Total Products: <span style="color: #667eea;">{{ count($product) }}</span></h5>
                  </div>
               </div>
            @endif
         </div>
      </section>

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->

      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>

      <script>
         $(document).ready(function() {
            // Filter and search functionality
            function filterProducts() {
               var category = $('#categoryFilter').val();
               var priceRange = $('#priceFilter').val();
               var sortBy = $('#sortFilter').val();
               var searchTerm = $('#searchFilter').val().toLowerCase();

               var products = $('.product-item');
               var visibleProducts = [];

               products.each(function() {
                  var product = $(this);
                  var productCategory = product.data('category');
                  var productPrice = parseFloat(product.data('price'));
                  var productName = product.data('name');
                  
                  var showProduct = true;

                  // Category filter
                  if (category && productCategory !== category) {
                     showProduct = false;
                  }

                  // Price filter
                  if (priceRange) {
                     if (priceRange === '0-50' && productPrice >= 50) showProduct = false;
                     if (priceRange === '50-100' && (productPrice < 50 || productPrice >= 100)) showProduct = false;
                     if (priceRange === '100-200' && (productPrice < 100 || productPrice >= 200)) showProduct = false;
                     if (priceRange === '200+' && productPrice < 200) showProduct = false;
                  }

                  // Search filter
                  if (searchTerm && !productName.includes(searchTerm)) {
                     showProduct = false;
                  }

                  if (showProduct) {
                     product.show();
                     visibleProducts.push(product);
                  } else {
                     product.hide();
                  }
               });

               // Sort products
               if (sortBy && visibleProducts.length > 0) {
                  var container = $('#productContainer');
                  visibleProducts.sort(function(a, b) {
                     if (sortBy === 'price_low') {
                        return parseFloat(a.data('price')) - parseFloat(b.data('price'));
                     } else if (sortBy === 'price_high') {
                        return parseFloat(b.data('price')) - parseFloat(a.data('price'));
                     } else if (sortBy === 'name') {
                        return a.data('name').localeCompare(b.data('name'));
                     }
                     return 0;
                  });

                  container.children('.product-item').detach();
                  visibleProducts.forEach(function(product) {
                     container.append(product);
                  });
               }
            }

            // Bind filter events
            $('#categoryFilter, #priceFilter, #sortFilter').change(filterProducts);
            $('#searchFilter').on('input', filterProducts);
         });
      </script>
   </body>
</html>
