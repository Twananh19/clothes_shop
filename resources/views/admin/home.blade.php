<!DOCTYPE html>
<html   lang="en" >

<head>
	@include('admin.css')
</head>

<body class=" bg-surface">
	<main>
		<div class="app-topstrip z-40 sticky top-0 py-[15px] px-6 bg-[linear-gradient(90deg,_#0f0533_0%,_#1b0a5c_100%)]">
			<div class="flex flex-col lg:flex-row gap-4 items-center justify-between">
                <div class="md:flex hidden items-center gap-5">
                    <a href="">
                        <img src="admin/assets/images/logos/logo-wrappixel.svg" width="147" alt="logo-wrappixel" />
                    </a>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-4 justify-center">
                    <h4 class="text-sm font-normal text-white uppercase font-semibold bg-[linear-gradient(90deg,_#FFFFFF_0%,_#8D70F8_100%)] [-webkit-background-clip:text] [background-clip:text] [-webkit-text-fill-color:transparent]">Checkout Pro Version</h4>
                </div>
            </div>
		</div>
		<!--start the project-->
		<div id="main-wrapper" class="flex p-5 xl:pr-0">
			<aside id="application-sidebar-brand"
				class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full  transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed xl:top-[90px] xl:left-auto top-0 left-0 with-vertical h-screen z-[999] shrink-0  w-[270px] shadow-md xl:rounded-md rounded-none bg-white left-sidebar   transition-all duration-300" >
				<!-- ---------------------------------- -->
<!-- Start Vertical Layout Sidebar -->
<!-- ---------------------------------- -->
@include('admin.sidebar')

                <!-- ---------------------------------- -->

			</aside>
			<div class=" w-full page-wrapper xl:px-6 px-0">

				<!-- Main Content -->
				<main class="h-full  max-w-full">
					<div class="container full-container p-0 flex flex-col gap-6">
					<!--  Header Start -->
				<header class=" bg-white shadow-md rounded-md w-full text-sm py-4 px-6">
					

<!-- ========== HEADER ========== -->

    @include('admin.navigation-menu')


  <!-- ========== END HEADER ========== -->
				</header>
				<!--  Header End -->
                      @include('admin.chart')


					  </div>
                       @include('admin.chart2')
					   @include('admin.table')
					</div>


				</main>
				<!-- Main Content End -->
				
			</div>
		</div>
		<!--end of project-->
	</main>


	
<script src="admin/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="admin/assets/libs/simplebar/dist/simplebar.min.js"></script>
<script src="admin/assets/libs/iconify-icon/dist/iconify-icon.min.js"></script>
<script src="admin/assets/libs/@preline/dropdown/index.js"></script>
<script src="admin/assets/libs/@preline/overlay/index.js"></script>
<script src="admin/assets/js/sidebarmenu.js"></script>

<!-- solar icons -->
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script src="admin/assets/libs/preline/dist/preline.js"></script>

	<script src="admin/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="admin/assets/js/dashboard.js"></script>
</body>

</html>