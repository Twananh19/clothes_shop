<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
	<style type="text/css">
		.div_center {
			text-align: center;
			margin: 40px;
		}

		.div_center h2 {
			font-size: 30px;
			font-weight: 600;
			color: #0f0533;
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
                            @include('admin.navigation-menu')
                        </header>
                        <!--  Header End -->
						<div class="div_center">
							@if(session()->has('message'))
								<div class="bg-gradient-to-r from-green-400 to-green-600 text-white p-4 rounded-lg shadow-2xl flex items-center justify-between mb-4 border-l-4 border-green-700" role="alert" style="background-color: green;">
									<div class="flex items-center">
										<svg class="w-8 h-8 mr-4" fill="currentColor" viewBox="0 0 20 20">
											<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
										</svg>
										<span class="font-bold text-xl" >{{ session('message') }}</span>
									</div>
									<button type="button" class="text-2xl font-extrabold leading-none opacity-80 hover:opacity-100" onclick="this.parentElement.style.display='none'" aria-label="Close">
										&times;
									</button>
								</div>
							@endif
							<h2>Category

							</h2>

							<form action="{{ url('add_category') }}" method="POST" class="mt-4">
								@csrf
								<div class="flex items-center justify-center gap-2">
									<input type="text" name="category" placeholder="Write category name"
										class="text-black border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
									<button type="submit"
										class="bg-blue-600 text-white rounded-md py-2 px-4 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
										Add Category
									</button>
								</div>
							</form>
						</div>

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