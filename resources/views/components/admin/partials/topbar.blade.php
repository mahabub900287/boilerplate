 <!-- ic-top-heading-wrapper -->
 <div class="ic-headeing">
     <!-- common -->
     <!-- ic-top-heading-wrapper -->
     <div class="ic-top-heading ">


         <div class="ic-left-content-wrapper">
             <div class="ic-toggle-btn">
                 <div class="ic-toggle-btn-icon">

                     <span></span>
                     <span></span>
                     <span></span>

                 </div>
             </div>
             <div class="ic-intro">
                 <h3 class="ic-title">Dashboard</h3>
                 @if (Request::routeIs('company.dashboard') || Request::routeIs('admin.dashboard'))
                     <p class="ic-des">An Overview of your business</p>
                 @else
                     <x-admin.partials.breadcumb :title="getbreadcumb()"></x-admin.partials.breadcumb>
                 @endif
             </div>
         </div>


         <div class="ic-notification-profile-wrapper">

             <div class="ic-searchbar">
                 <input type="text" placeholder="Search...">
                 <div class="ic-serach-btn">
                     <i class="ri-search-line"></i>
                 </div>
             </div>
             <div class="ic-fullscreen" id="ic-fullscreen">
                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                     <path d="M8 3V5H4V9H2V3H8ZM2 21V15H4V19H8V21H2ZM22 21H16V19H20V15H22V21ZM22 9H20V5H16V3H22V9Z"
                         fill="#1D2939" />
                 </svg>
             </div>
             <div class="ic-profile-wrapper ic-dropdown-btn">
                 <div class="ic-profile">
                     <div class="ic-image">
                         <img class="img-fluid ic_logo"
                             src="{{ Auth::User()->avatar == null ? get_default_image('user') : asset('storage/user') . '/' . Auth::User()->avatar }}"
                             alt="{{ Auth::User()->first_name }}">
                     </div>
                     <span
                         class="ic-name">{{ ucfirst(Auth::User()->first_name) . ' ' . ucfirst(Auth::User()->last_name) }}<i
                             class="ri-arrow-down-s-line ms-2 "></i></span>
                 </div>

                 <ul class="ic-dropdown-menu ">
                     <p class="heding">Account</p>
                     <li>
                         <a class="ic-dropdown-item"
                             href="{{ auth()->user()->type == 'admin' ? route('admin.profile.edit', auth()->user()->id) : route('company.profile.edit', auth()->user()->id) }}">
                             <i class="ri-user-3-fill"></i>
                             My Profile </a>
                     </li>
                     <li>

                         <form action="{{ route('logout') }}" method="post">
                             @csrf
                             <button type="submit" class="ic-dropdown-item">
                                 <i class="ri-shut-down-fill"></i>
                                 Logout </button>

                         </form>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </div>
