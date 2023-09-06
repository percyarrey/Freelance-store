 <!-- header section strats -->
    <header class="w-100 d-flex container-lg justify-content-center" style="height: 40px;z-index;30;">
        <div class="position-fixed px-1 px-lg-5 bg-light shadow-sm w-100" style="z-index:30;">
           <nav class="navbar navbar-expand-lg custom_nav-container ps-3" >
              <a class="navbar-brand d-flex" href="/"><img width="30" src="{{asset('asset/logo/favicon.png')}}" alt="logo" /><span class="mt-1 fs-2 text-success d-none d-sm-block">Freelance Store</span></a>
              <div class="d-flex align-items-center gap-2 order-lg-2">
               <div>
                  @if(auth()->user())
                 
                 <div class="dropdown">
                     <a class="btn dropdown-toggle text-success "  href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                     aria-expanded="false">
                         <i class="fas fa-user" style="scale:1.5;"></i>
                     </a>
                 
                     <ul class="dropdown-menu bg-light shadow-sm" style="right: -5rem;transition:all 1s ease">
                         
                         @if (auth()->user()?->usertype==='1')
                           <li><a class="dropdown-item" href="/redirect">Dashboard</a></li>
                           <li><a class="dropdown-item" href="/addproduct">Add Product</a></li>
                           <hr>
                         @else

                         @endif
                           <li><a class="dropdown-item" href="/recentorder">Your orders</a></li>
                           <li><a class="dropdown-item" href="/recentorder">Profile</a></li>
                           <li>
                             <a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                 Logout
                             </a>
                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                 @csrf
                             </form>
                         </li>
                     </ul>
                 </div>
                     
                  @else
                     <a href="/login" class="btn btn-success shadow-sm">Sign In</a>
                  @endif
               </div>
               <div class="d-flex justify-content-center align-items-center">
                  <a class="btn shadow-sm" href="/products"  id="scrollToTopLink"><span class="fa fa-search"></span></a>
                 </div>
               <button class="navbar-toggler" style="border: 0px solid rgba(0, 0, 0, 0) !important; " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
               </button>
                 
              </div>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                 <ul class="navbar-nav">
                    <li class="{{ request()->is('/') ? 'nav-item active' : 'nav-item' }}">
                       <a class="nav-link"  style="opacity: 0.8;"  href="/">Home</a>
                    </li>
                    <li class="{{ request()->is('products') ? 'nav-item active' : 'nav-item' }}">
                       <a class="nav-link" style="opacity: 0.8;" href="/products">Products</a>
                    </li>
                    <li  class="{{ request()->is('trackorder') ? 'nav-item active' : 'nav-item' }}">
                       <a class="nav-link" style="opacity: 0.8;" href="/trackorder">Track Order</a>
                    </li>
                    <li  class="{{ request()->is('contact') ? 'nav-item active' : 'nav-item' }}">
                       <a class="nav-link" style="opacity: 0.8;" href="/contact">Contact</a>
                    </li>
                 </ul>
              </div>
           </nav>
        </div>
     </header>

