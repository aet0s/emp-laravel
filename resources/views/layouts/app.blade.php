<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Riho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
      <meta name="keywords" content="admin template, Riho admin template, dashboard template, flat admin template, responsive admin template, web app">
      <meta name="author" content="pixelstrap">
      <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
      <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
      <title>Emp Portal|| Airport Authority of India</title>
      <!-- Google font-->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
      <link href="../../css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/font-awesome.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- ico-font-->
      <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/icofont.css')}}">
      <!-- Themify icon-->
      <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/themify.css')}}">
      <!-- Flag icon-->
      <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/flag-icon.css')}}">
      <!-- Feather icon-->
      <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/feather-icon.css')}}">
      <!-- Plugins css start-->
      <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/slick.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/slick-theme.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/scrollbar.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/animate.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/echart.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/date-picker.css')}}">
      <!-- Plugins css Ends-->
      <!-- Bootstrap css-->
      <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/vendors/bootstrap.css')}}">
      <!-- App css-->
      <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/style.css')}}">
      <link id="color" rel="stylesheet" href="{{asset('admin/assets/css/color-1.css')}}" media="screen">
      <!-- Responsive css-->
      <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/responsive.css')}}">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <style>
         .simplebar-content{
         margin-top: 40px;
         }
         element.style {
         display: none;
         }
         .according-menu {
         display: none;
         }
         .span-role{
         margin-left: -30px;
         }
         .sidebar-submenu a.sub-active {
         background-color: #ffffff1a;
         color: #fff !important;
         font-weight: bold;
         border-radius: 6px;
         padding-left: 25px;
         }
         .sidebar-list.open > .sidebar-submenu {
         display: block !important;
         }
         .sidebar-link.sidebar-title.active {
         background-color: #334d9b;
         color: #fff;
         border-radius: 8px;
         }
      </style>
      @yield('css')
   </head>
   <?php 
      $user = Auth::user();
      function route_check($routename ,  $user){
         $page_action = DB::table('page_action')
      ->select('page_action.*' , 'pages_permission.page_slug')
      ->join('pages_permission' , 'pages_permission.id' , 'page_action.page_id')
      ->where('role_id' ,$user->role)
      ->where('pages_permission.page_slug', $routename)
      ->where('page_action.page_action',1)
      ->first();
      
      if($page_action){
         return true;
      }else{
         return false;
      } 
      }
      
      ?>
   <body>
      <!-- loader starts-->
      <div class="loader-wrapper">
         <div class="loader">
            <div class="loader4"></div>
         </div>
      </div>
      <!-- loader ends-->
      <!-- tap on top starts-->
      <div class="tap-top"><i data-feather="chevrons-up"></i></div>
      <!-- tap on tap ends-->
      <!-- page-wrapper Start-->
      <div class="page-wrapper compact-wrapper" id="pageWrapper">
         <!-- Page Header Start-->
         <div class="page-header">
            <div class="header-wrapper row m-0">
               <form class="form-inline search-full col" action="#" method="get">
                  <div class="form-group w-100">
                     <div class="Typeahead Typeahead--twitterUsers">
                        <div class="u-posRelative">
                           <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Riho .." name="q" title="" autofocus="">
                           <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading... </span></div>
                           <i class="close-search" data-feather="x"></i>
                        </div>
                        <div class="Typeahead-menu"> </div>
                     </div>
                  </div>
               </form>
               <div class="header-logo-wrapper col-auto p-0">
                  <div class="logo-wrapper"> <a href="index.html"><img class="img-fluid for-light" src="assets/images/logo/logo_dark.png" alt="logo-light"><img class="img-fluid for-dark" src="assets/images/logo/logo.png" alt="logo-dark"></a></div>
                  <div class="toggle-sidebar"> <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
               </div>
               <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
                  <div>
                     <a class="toggle-sidebar" href="#"> <i class="iconly-Category icli"> </i></a>
                     <div class="d-flex align-items-center gap-2 ">
                        <h4 class="f-w-600">{{Auth::user()->name}}</h4>
                        <img class="mt-0" src="{{asset('admin/assets/images/hand.gif')}}" alt="hand-gif">
                     </div>
                  </div>
                  <div class="welcome-content d-xl-block d-none"><span class="text-truncate col-12">Here’s what’s happening today. </span></div>
               </div>
               <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
                  <ul class="nav-menus">
                     <li class="profile-nav onhover-dropdown">
                        <div class="media profile-media">
                           <img class="b-r-10" src="assets/images/dashboard/profile.png" alt="">
                           <div class="media-body d-xxl-block d-none box-col-none">
                              <div class="d-flex align-items-center gap-2"> <span>{{Auth::user()->name}} </span><i class="middle fa fa-angle-down"> </i></div>
                              <p class="mb-0 font-roboto">
                                 @if(Auth::user()->role == 1)
                                 Super Admin
                                 @elseif(Auth::user()->role == 2)
                                 Nodal Officer / Admin
                                 @endif
                              </p>
                           </div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div">
                           <li><a href="user-profile.html"><i data-feather="user"></i><span>My Profile</span></a></li>
                           <li><a href="letter-box.html"><i data-feather="mail"></i><span>Inbox</span></a></li>
                           <li> <a href="edit-profile.html"> <i data-feather="settings"></i><span>Settings</span></a></li>
                           <li><a class="btn btn-pill btn-outline-primary btn-sm" href="{{route('signout')}}">Log Out</a></li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper" data-layout="stroke-svg">
               <div class="logo-wrapper">
                  <a href="index.html">
                     <center><img class="img-fluid" src="{{ asset('admin/assets/images/logo/logo.png') }}" alt="" style="width: 7em; border-radius: 0.3em;background-color:#fff;"></center>
                  </a>
                  <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
                  <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
               </div>
               <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="{{ asset('admin/assets/images/logo/logo.png') }}" alt="" style="width: 7em; border-radius: 0.3em;background-color:#fff;"></a></div>
           @php
    $isTerminalActive = request()->is('aaisports-list');
@endphp
<!-- @php
    $isTerminalActive = request()->is('aaisports-list') || 
                        request()->is('add-item') || 
                        request()->is('claims.review') || 
                        request()->is('reports') || 
                        request()->is('subcategory-list');
@endphp
 -->

               <nav class="sidebar-main" style="margin-top:10px;">
                  <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                  <div id="sidebar-menu">
                     <ul class="sidebar-links" id="simple-bar">
                        <li class="back-btn">
                           <a href="{{route('login')}}"><img class="img-fluid" src="assets/images/logo/logo-icon.png" alt=""></a>
                           <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                        </li>
                        <li class="pin-title sidebar-main-title">
                           <div>
                              <h6></h6>
                           </div>
                        </li>
                        @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                        <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i><a href="{{route('dashboard')}}" class="sidebar-link sidebar-title" href="#">
                           <i class="fa fa-home" aria-hidden="true"></i>
                           <span class="lan-3">Dashboard</span></a>
                        </li>
                        @endif
                        @php
                        $id = 1;
                        @endphp
                        @if(route_check('role_permission', $user) == 1)
                        <li class="sidebar-list {{ request()->routeIs('role') || request()->routeIs('role_permission_edit') ? 'active' : '' }}">
                           <i class="fa fa-thumb-tack"></i>
                           <a class="sidebar-link sidebar-title" href="#">
                              <svg class="stroke-icon">
                                 <use href="assets/svg/icon-sprite.svg#stroke-user"></use>
                              </svg>
                              <svg class="fill-icon">
                                 <use href="assets/svg/icon-sprite.svg#fill-user"></use>
                              </svg>
                              <span class="span-role">Role & Permissions</span>
                           </a>
                           <ul class="sidebar-submenu">
                              <li>
                                 <a class="{{ request()->routeIs('role') ? 'active' : '' }}" href="{{ route('role') }}">Role</a>
                              </li>
                              <li>
                                 <a class="{{ request()->routeIs('role_permission_edit') ? 'active' : '' }}" href="{{ route('role_permission_edit', $id) }}">Permissions</a>
                              </li>
                           </ul>
                        </li>
                        @endif
                        @if(Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 2))
                            <li class="sidebar-list {{ $isTerminalActive ? 'active open' : '' }}">
                                <a class="sidebar-link sidebar-title {{ $isTerminalActive ? 'active' : '' }}" href="javascript:void(0)">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-user') }}"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                                    </svg>
                                    <span class="span-role">Add Contant</span>
                                </a>
                                <ul class="sidebar-submenu" style="{{ $isTerminalActive ? 'display:block;' : 'display:none;' }}">
                                    <li>
                                        <a class="{{ request()->is('aaisports-list') ? 'aaisports-list-active' : '' }}" href="{{ url('aaisports-list') }}">Aai Sports</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                     </ul>
                     <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                  </div>
               </nav>
            </div>
            <!-- Page Sidebar Ends-->
            @yield('content')
            <!-- footer start-->
            <footer class="footer">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-12 footer-copyright text-center">
                        <p class="mb-0">Copyright 2025 © Solarmantech  </p>
                     </div>
                  </div>
               </div>
            </footer>
         </div>
      </div>
      <!-- latest jquery-->
      <script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
      <!-- Bootstrap js-->
      <script src="{{asset('admin/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
      <!-- feather icon js-->
      <script src="{{asset('admin/assets/js/icons/feather-icon/feather.min.js')}}"></script>
      <script src="{{asset('admin/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
      <!-- scrollbar js-->
      <script src="{{asset('admin/assets/js/scrollbar/simplebar.js')}}"></script>
      <script src="{{asset('admin/assets/js/scrollbar/custom.js')}}"></script>
      <!-- Sidebar jquery-->
      <script src="{{asset('admin/assets/js/config.js')}}"></script>
      <!-- Plugins JS start-->
      <script src="{{asset('admin/assets/js/sidebar-menu.js')}}"></script>
      <script src="{{asset('admin/assets/js/sidebar-pin.js')}}"></script>
      <script src="{{asset('admin/assets/js/slick/slick.min.js')}}"></script>
      <script src="{{asset('admin/assets/js/slick/slick.js')}}"></script>
      <script src="{{asset('admin/assets/js/header-slick.js')}}"></script>
      <script src="{{asset('admin/assets/js/chart/apex-chart/apex-chart.js')}}"></script>
      <script src="{{asset('admin/assets/js/chart/apex-chart/stock-prices.js')}}"></script>
      <script src="{{asset('admin/assets/js/chart/apex-chart/moment.min.js')}}"></script>
      <script src="{{asset('admin/assets/js/chart/echart/esl.js')}}"></script>
      <script src="{{asset('admin/assets/js/chart/echart/config.js')}}"></script>
      <script src="{{asset('admin/assets/js/chart/echart/pie-chart/facePrint.js')}}"></script>
      <script src="{{asset('admin/assets/js/chart/echart/pie-chart/testHelper.js')}}"></script>
      <script src="{{asset('admin/assets/js/chart/echart/pie-chart/custom-transition-texture.js')}}"></script>
      <script src="{{asset('admin/assets/js/chart/echart/data/symbols.js')}}"></script>
      <!-- calendar js-->
      <script src="{{asset('admin/assets/js/datepicker/date-picker/datepicker.js')}}"></script>
      <script src="{{asset('admin/assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
      <script src="{{asset('admin/assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
      <script src="{{asset('admin/assets/js/dashboard/dashboard_3.js')}}"></script>
      <script src="{{asset('admin/assets/js/costom.js')}}"></script>
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="{{asset('admin/assets/js/script.js')}}"></script>
      <script>
         $('.sidebar-title').click(function() {
          $(this).parent().toggleClass('open');
         });
         
      </script>
   </body>
</html>