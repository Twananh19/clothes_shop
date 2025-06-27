<!DOCTYPE html>
<html lang="en">

<head>

    <base href="/public">
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

        .form_container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .form_grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form_group {
            display: flex;
            flex-direction: column;
        }

        .form_group_full {
            grid-column: 1 / -1;
        }

        .form_label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form_input {
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form_input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form_textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form_select {
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background-color: white;
            transition: all 0.3s ease;
        }

        .form_select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .submit_btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 14px 32px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .submit_btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        .cancel_btn {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 14px 32px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .cancel_btn:hover {
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
        }

        @media (max-width: 768px) {
            .form_grid {
                grid-template-columns: 1fr;
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
                            @if(session()->has('message'))
                                <div class="bg-gradient-to-r from-green-400 to-green-600 text-white p-4 rounded-lg shadow-2xl flex items-center justify-between mb-4 border-l-4 border-green-700" role="alert" style="background-color: green;">
                                    <div class="flex items-center">
                                        <svg class="w-8 h-8 mr-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="font-bold text-xl">{{ session('message') }}</span>
                                    </div>
                                    <button type="button" class="text-2xl font-extrabold leading-none opacity-80 hover:opacity-100" onclick="this.parentElement.style.display='none'" aria-label="Close">
                                        &times;
                                    </button>
                                </div>
                            @endif

                            @if(session()->has('error'))
                                <div class="bg-gradient-to-r from-red-400 to-red-600 text-white p-4 rounded-lg shadow-2xl flex items-center justify-between mb-4 border-l-4 border-red-700" role="alert" style="background-color: red;">
                                    <div class="flex items-center">
                                        <svg class="w-8 h-8 mr-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="font-bold text-xl">{{ session('error') }}</span>
                                    </div>
                                    <button type="button" class="text-2xl font-extrabold leading-none opacity-80 hover:opacity-100" onclick="this.parentElement.style.display='none'" aria-label="Close">
                                        &times;
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="bg-gradient-to-r from-red-400 to-red-600 text-white p-4 rounded-lg shadow-2xl mb-4 border-l-4 border-red-700" role="alert">
                                    <div class="font-bold text-lg mb-2">Validation Errors:</div>
                                    <ul class="list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <h2 class="font_size">Update Product</h2>

                            <!-- Product Update Form -->
                            <div class="form_container">
                                <form action="{{ url('edit_product', $product->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form_grid">
                                        <div class="form_group">
                                            <label class="form_label">Product Title</label>
                                            <input type="text" name="title" class="form_input" placeholder="Enter product title" value="{{ old('title', $product->title) }}" required>
                                            @error('title')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form_group">
                                            <label class="form_label">Price ($)</label>
                                            <input type="number" name="price" class="form_input" placeholder="0.00" step="0.01" min="0" value="{{ old('price', $product->price) }}" required>
                                            @error('price')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form_group">
                                            <label class="form_label">Quantity</label>
                                            <input type="number" name="quantity" class="form_input" placeholder="0" min="0" value="{{ old('quantity', $product->quantity) }}" required>
                                            @error('quantity')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form_group">
                                            <label class="form_label">Category</label>
                                            <select name="category" class="form_select" required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->category_name }}" {{ old('category', $product->category) == $category->category_name ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form_group">
                                            <label class="form_label">Discount (%)</label>
                                            <input type="number" name="discount" class="form_input" placeholder="0" step="0.01" min="0" max="100" value="{{ old('discount', $product->discount) }}">
                                            @error('discount')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form_group">
                                            <label class="form_label">Product Image (optional)</label>
                                            <input type="file" name="image" class="form_input" accept="image/*">
                                            <small style="color: #6b7280; font-size: 12px;">Leave empty to keep current image</small>
                                            @error('image')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form_group form_group_full">
                                            <label class="form_label">Product Description</label>
                                            <textarea name="description" class="form_input form_textarea" placeholder="Enter product description" required>{{ old('description', $product->description) }}</textarea>
                                            @error('description')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        @if($product->image)
                                            <div class="form_group form_group_full">
                                                <label class="form_label">Current Product Image</label>
                                                <div style="text-align: center; margin-top: 10px;">
                                                    <img src="/product_images/{{ $product->image }}" alt="Current Product Image" style="max-width: 200px; max-height: 200px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); border: 3px solid #e5e7eb;">
                                                    <p style="color: #6b7280; font-size: 12px; margin-top: 5px; font-style: italic;">Current: {{ $product->image }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 30px;">
                                        <a href="{{ url('show_product') }}" class="cancel_btn">Cancel</a>
                                        <button type="submit" class="submit_btn">Update Product</button>
                                    </div>
                                </form>
                            </div>
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