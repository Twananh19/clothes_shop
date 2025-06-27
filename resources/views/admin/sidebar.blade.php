<div class="p-4">
  
  <a href="../" class="text-nowrap">
    <img
      src="admin/assets/images/logos/logo-light.svg"
      alt="Logo-Dark"
    />
  </a>


</div>
<div class="scroll-sidebar" data-simplebar="">
  <nav class=" w-full flex flex-col sidebar-nav px-4 mt-5">
    <ul id="sidebarnav" class="text-gray-600 text-sm">
      <li class="text-xs font-bold pb-[5px]">
        <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
        <span class="text-xs text-gray-400 font-semibold">HOME</span>
      </li>

      <li class="sidebar-item">
        <a class="sidebar-link gap-3 py-2.5 my-1 text-base  flex items-center relative  rounded-md text-gray-500  w-full"
          href="./index.html">
          <i class="ti ti-layout-dashboard ps-2  text-2xl"></i> <span>Dashboard</span>
        </a>
      </li>


      <li class="sidebar-item">
        <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full"
          href="{{url('view_category')}}">
          <i class="ti ti-article ps-2 text-2xl"></i> <span>Category</span>
        </a>
      </li>

      
      <div class="hs-accordion-group">
        <div class="hs-accordion sidebar-item" id="hs-basic-with-title-and-arrow-stretched-heading-ecommerce">
          <button
            class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative  rounded-md text-gray-500  w-full hs-accordion-toggle hs-accordion-active:text-blue-600 justify-between"
            aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-ecommerce">
            <div class="flex items-center gap-3">
              <i class="ti ti-basket ps-2 text-2xl"></i>
              <span>Product</span>
            </div>
            <div class="mr-5">
              <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="m6 9 6 6 6-6"></path>
              </svg>
              <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="m18 15-6-6-6 6"></path>
              </svg>
            </div>
          </button>
          <div id="hs-basic-with-title-and-arrow-stretched-collapse-ecommerce"
            class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region"
            aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-ecommerce">
            <a class="gap-4 py-2.5 my-1 px-[14px] text-sm flex items-center justify-between relative  rounded-md text-gray-500  w-full"
                href="{{url('view_product')}}">
              <div class="flex items-center gap-4">
                <i class="ti ti-circle text-xs"></i> <span>Add Product</span>
              </div>
              <span class="text-white bg-blue-700 rounded-3xl px-2 text-xs py-0.5">Pro</span>
            </a>
            <a class="gap-4 py-2.5 my-1 px-[14px] text-sm flex items-center justify-between relative  rounded-md text-gray-500  w-full"
                href="{{url('/show_product')}}">
              <div class="flex items-center gap-4">
                <i class="ti ti-circle text-xs"></i> <span>Show Product</span>
              </div>
              <span class="text-white bg-blue-700 rounded-3xl px-2 text-xs py-0.5">Pro</span>
            </a>
            
          </div>
        </div>
      </div>

      <li class="sidebar-item">
        <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full"
          href="{{url('admin/orders')}}">
          <i class="ti ti-shopping-cart ps-2 text-2xl"></i> <span>Orders</span>
        </a>
      </li>

      

    </ul>
  </nav>
</div>