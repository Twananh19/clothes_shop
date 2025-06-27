<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style type="text/css">
        .div_center {
            text-align: center;
            margin: 40px;
        }
        .font_size {
            font-size: 40px;
            font-weight: 600;
            color: #0f0533;
        }

        .table_center {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
        }

        .product_table {
            border-radius: 12px !important;
            overflow: hidden;
            background-color: #f8fafc !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            margin: 0 auto;
        }

        .product_table th {
            border-bottom: 2px solid #10b981 !important;
            background-color: #e2e8f0 !important;
            padding: 16px 12px;
            text-align: center;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
            text-transform: uppercase;
        }

        .product_table td {
            background-color: #f1f5f9 !important;
            padding: 16px 12px;
            text-align: center;
            font-size: 14px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        .product_table tbody tr:hover td {
            background-color: #e2e8f0 !important;
        }

        .product_image {
            width: 80px !important;
            height: 80px !important;
            object-fit: cover !important;
            border-radius: 8px !important;
            border: 2px solid #e2e8f0 !important;
            display: block !important;
            margin: 0 auto !important;
        }

        .image_placeholder {
            width: 80px !important;
            height: 80px !important;
            background-color: #f3f4f6 !important;
            border-radius: 8px !important;
            border: 2px solid #e2e8f0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 auto !important;
        }

        .product_title {
            font-weight: 600;
            color: #1f2937;
            max-width: 200px;
            word-wrap: break-word;
        }

        .product_description {
            max-width: 250px;
            word-wrap: break-word;
            color: #6b7280;
        }

        .product_price {
            font-weight: 600;
            color: #059669;
            font-size: 16px;
        }

        .product_quantity {
            font-weight: 600;
            color: #1f2937;
        }

        .product_category {
            background-color: #3b82f6;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .product_discount {
            background-color: #ef4444;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .delete_btn {
            background-color: #dc2626 !important;
            color: white !important;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 2px;
            display: inline-block;
        }

        .delete_btn:hover {
            background-color: #b91c1c !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(220, 38, 38, 0.3);
        }

        .update_btn {
            background-color: #10b981 !important;
            color: white !important;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 2px;
            display: inline-block;
        }

        .update_btn:hover {
            background-color: #059669 !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(16, 185, 129, 0.3);
        }

        .action_buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .no_products {
            text-align: center;
            color: #6b7280;
            font-size: 18px;
            padding: 40px;
        }

        @media (max-width: 1024px) {
            .product_table {
                font-size: 12px;
            }
            
            .product_image {
                width: 60px;
                height: 60px;
            }
            
            .product_title,
            .product_description {
                max-width: 150px;
            }
        }
    </style>
</head>

<body class="bg-surface">
    <main>
        <div class="app-topstrip z-40 sticky top-0 py-[15px] px-6 bg-[linear-gradient(90deg,_#0f0533_0%,_#1b0a5c_100%)]">
            <div class="flex flex-col lg:flex-row gap-4 items-center justify-between">
                <div class="md:flex hidden items-center gap-5">
                    <a href="">
                        <img src="{{ asset('admin/assets/images/logos/logo-wrappixel.svg') }}" width="147"
                            alt="logo-wrappixel" />
                    </a>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-4 justify-center">
                    <h4
                        class="text-sm font-normal text-white uppercase font-semibold bg-[linear-gradient(90deg,_#FFFFFF_0%,_#8D70F8_100%)] [-webkit-background-clip:text] [background-clip:text] [-webkit-text-fill-color:transparent]">
                        Checkout Pro Version</h4>
                </div>
            </div>
        </div>
        <!--start the project-->
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            <aside id="application-sidebar-brand"
                class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed xl:top-[90px] xl:left-auto top-0 left-0 with-vertical h-screen z-[999] shrink-0 w-[270px] shadow-md xl:rounded-md rounded-none bg-white left-sidebar transition-all duration-300">
                <!-- ---------------------------------- -->
                <!-- Start Vertical Layout Sidebar -->
                <!-- ---------------------------------- -->
                @include('admin.sidebar')
                <!-- ---------------------------------- -->
            </aside>

            <div class="w-full page-wrapper xl:px-6 px-0">
                <!-- Main Content -->
                <main class="h-full max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">
                        <!--  Header Start -->
                        <header class="bg-white shadow-md rounded-md w-full text-sm py-4 px-6">
                            <!-- ========== HEADER ========== -->
                            @include('admin.navigation-menu')
                            <!-- ========== END HEADER ========== -->
                        </header>
                        <!--  Header End -->

                        <!-- Content Area Start -->
                        <div class="div_center">
                            <h1 class="font_size">All Products</h1>

                            @if(session('message'))
                                <div class="alert alert-success" style="background-color: #10b981; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-weight: 600; box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);">
                                    {{ session('message') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger" style="background-color: #ef4444; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-weight: 600; box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <!-- Products Table -->
                            @if(count($products) > 0)
                                <div class="mt-8 table_center">
                                    <div class="overflow-x-auto shadow-lg rounded-xl" style="width: 95%; max-width: 1400px;">
                                        <table class="w-full product_table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 6%;">ID</th>
                                                    <th style="width: 10%;">Image</th>
                                                    <th style="width: 15%;">Title</th>
                                                    <th style="width: 20%;">Description</th>
                                                    <th style="width: 10%;">Price</th>
                                                    <th style="width: 8%;">Quantity</th>
                                                    <th style="width: 11%;">Category</th>
                                                    <th style="width: 8%;">Discount</th>
                                                    <th style="width: 12%;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($products as $product)
                                                    <tr>
                                                        <td class="product_quantity">{{ $product->id }}</td>
                                                        <td>
                                                            @if($product->image && file_exists(public_path('product_images/' . $product->image)))
                                                                <img src="/product_images/{{ $product->image }}" 
                                                                     alt="{{ $product->title }}" 
                                                                     class="product_image"
                                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                                <div class="image_placeholder" style="display: none;">
                                                                    <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                </div>
                                                            @else
                                                                <div class="image_placeholder">
                                                                    <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td class="product_title">{{ $product->title }}</td>
                                                        <td class="product_description">
                                                            {{ Str::limit($product->description, 80) }}
                                                        </td>
                                                        <td class="product_price">${{ number_format($product->price, 2) }}</td>
                                                        <td class="product_quantity">{{ $product->quantity }}</td>
                                                        <td>
                                                            <span class="product_category">{{ $product->category }}</span>
                                                        </td>
                                                        <td>
                                                            @if($product->discount && $product->discount > 0)
                                                                <span class="product_discount">{{ $product->discount }}%</span>
                                                            @else
                                                                <span class="text-gray-400">-</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="action_buttons">
                                                                <a href="{{ url('update_product', $product->id) }}" 
                                                                   class="update_btn" 
                                                                   title="Edit Product">
                                                                    Edit
                                                                </a>
                                                                <a href="{{ url('delete_product', $product->id) }}" 
                                                                   onclick="return confirm('Are you sure you want to delete this product?')"
                                                                   class="delete_btn"
                                                                   title="Delete Product">
                                                                    Delete
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="mt-8 table_center">
                                    <div class="bg-white rounded-lg shadow-lg p-8" style="max-width: 600px;">
                                        <div class="no_products">
                                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                            </svg>
                                            <h3 class="text-xl font-semibold text-gray-600 mb-2">No Products Found</h3>
                                            <p class="text-gray-500">There are no products in the database yet.</p>
                                            <a href="{{ url('view_product') }}" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                                                Add First Product
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- Content Area End -->

                    </div>
                </main>
                <!-- Main Content End -->
            </div>
        </div>
        <!--end of project-->
    </main>

    <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/iconify-icon/dist/iconify-icon.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/@preline/dropdown/index.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/@preline/overlay/index.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sidebarmenu.js') }}"></script>

    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="{{ asset('admin/assets/libs/preline/dist/preline.js') }}"></script>

    <script src="{{ asset('admin/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
</body>

</html>