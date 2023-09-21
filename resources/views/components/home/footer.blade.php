<footer>
    <div class="container-lg px-3">
       <div class="row">
          <div class="col-md-4">
              <div class="full">
                 <div class="logo_footer">
                    <a class="navbar-brand d-flex" href="/"><img width="30" src="{{asset('asset/logo/favicon.png')}}" alt="logo" /><span class="mt-1 fs-2 text-success">Freelance Store</span></a>
                 </div>
                 <div class="information_f">
                   <p><strong>ADDRESS:</strong> Cameroon, Buea, Molyko</p>
                   <p><strong>TELEPHONE:</strong> +237 674751815</p>
                   <p><strong>EMAIL:</strong> tanyitiku@gmail.com</p>
                 </div>
              </div>
          </div>
          <div class="col-md-8">
             <div class="row">
             <div class="col-md-7">
                <div class="row">
                   <div class="col-md-6">
                <div class="widget_menu">
                   <h3>Menu</h3>
                   <ul>
                      <li><a href="/">Home</a></li>
                      <li><a href="/products">Products</a></li>
                      <li><a href="/trackorder">Track Orders</a></li>
                      <li><a href="/contact">Contact</a></li>
                   </ul>
                </div>
             </div>
             <div class="col-md-6">
                <div class="widget_menu">
                   <h3>Account</h3>
                   <ul>
                      @if (!auth()->user())
                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Register</a></li>
                      @else
                        <li><a href="/profile">Profile</a></li>
                      @endif
                      <li><a href="/cart">Checkout</a></li>
                   </ul>
                </div>
             </div>
                </div>
             </div>     
             <div class="col-md-5">
                <div class="widget_menu">
                   <h3>Newsletter</h3>
                   <div class="information_f">
                     <p>Subscribe by our newsletter and get update protidin.</p>
                   </div>
                   <div class="form_sub">
                      <form onsubmit="handleEmailsSubmit(event,'{{ csrf_token()}}')" method="POST" action="/emailsubscribe">
                        @csrf
                         <fieldset>
                            <div class="field">
                               <input required type="email" name="email" id="email" placeholder="Enter Your Mail" name="email" />
                               <input type="submit" value="Subscribe" />
                            </div>
                         </fieldset>
                      </form>
                   </div>
                </div>
             </div>
             </div>
          </div>
       </div>
    </div>
    <div class="text-center"><span class="text-success">Copyright &copy; 2023.</span> All rights reserved.</div>
 </footer>