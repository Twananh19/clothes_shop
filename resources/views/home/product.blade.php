<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>
            </div>
            <div class="row">
               @if(count($product) > 0)
                  @foreach($product as $products)
                     <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box">
                           <div class="option_container">
                              <div class="options">
                                 <a href="{{url('/product_details',$products->id)}}" class="option1">
                                    Product Details
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
                                 <img src="images/product-placeholder.png" alt="No Image" style="width: 100%; height: 250px; object-fit: cover; background-color: #f5f5f5;">
                              @endif
                           </div>
                           <div class="detail-box">
                              <h5>
                                 {{ $products->title }}
                              </h5>
                              <h6>
                                 @if($products->discount && $products->discount > 0)
                                    <span style="text-decoration: line-through; color: #999; margin-right: 10px;">
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
                              @if($products->quantity > 0)
                                 <small style="color: #27ae60;">In Stock ({{ $products->quantity }})</small>
                              @else
                                 <small style="color: #e74c3c;">Out of Stock</small>
                              @endif
                           </div>
                        </div>
                     </div>
                  @endforeach
               @else
                  <div class="col-12 text-center">
                     <div style="padding: 60px 20px;">
                        <h4 style="color: #666; margin-bottom: 20px;">No products available at the moment</h4>
                        <p style="color: #999;">Please check back later for new arrivals!</p>
                     </div>
                  </div>
               @endif
            </div>
            <div class="btn-box">
               <a href="{{ url('all_products') }}">
               View All products
               </a>
            </div>
         </div>
      </section>