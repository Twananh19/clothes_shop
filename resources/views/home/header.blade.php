<header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="{{ url('/') }}"><img width="250" src="images/logo.png" alt="#" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item active">
                           <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                       <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span class="caret"></span></a>
                           <ul class="dropdown-menu">
                              <li><a href="#">About</a></li>
                              <li><a href="#">Testimonial</a></li>
                           </ul>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{ url('all_products') }}">Products</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#">Blog</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#">Contact</a>
                        </li>

                        <form class="form-inline">
                           <a href="{{ url('all_products') }}" class="btn my-2 my-sm-0 nav_search-btn">
                           <i class="fa fa-search" aria-hidden="true"></i>
                           </a>
                        </form>

                        <div class="cart-icon" style="margin-left: 15px;">
                           <a href="{{ url('cart') }}" style="color: black; position: relative;">
                              <i class="fa fa-shopping-cart" style="font-size: 20px;"></i>
                              <span class="cart-count" id="cart-count" style="
                                 position: absolute;
                                 top: -8px;
                                 right: -8px;
                                 background: #e74c3c;
                                 color: white;
                                 border-radius: 50%;
                                 padding: 2px 6px;
                                 font-size: 10px;
                                 min-width: 15px;
                                 text-align: center;
                                 display: none;
                              ">0</span>
                           </a>
                        </div>

                        <script>
                           // Cập nhật cart count khi trang load
                           $(document).ready(function() {
                              updateCartCount();
                           });

                           function updateCartCount() {
                              $.ajax({
                                 url: '{{ url("/get_cart_count") }}',
                                 method: 'GET',
                                 success: function(response) {
                                    const count = response.cart_count;
                                    if(count > 0) {
                                       $('#cart-count').text(count).show();
                                    } else {
                                       $('#cart-count').hide();
                                    }
                                 }
                              });
                           }
                        </script>

                        @if (Route::has('login'))
                        
                        @auth
                        <li class="nav-item">
                           <x-app-layout>
    
                            </x-app-layout>
                        </li>

                        @else

                        <li class="nav-item">
                           <a class="btn btn-primary" id="logincss" href="{{ route('login') }}">Login</a>
                        </li>
                        
                        <li class="nav-item">
                           <a class="btn btn-success" href="{{ route('register') }}">Register</a>
                        </li>
                        @endauth

                        @endif
                        
                        
                     </ul>
                  </div>
               </nav>
            </div>
         </header>