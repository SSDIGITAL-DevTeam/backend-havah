<div class="iq-sidebar">
    <div class="iq-navbar-logo d-flex justify-content-between">
       <a href="/admin" class="header-logo">
       <img src="{{asset('html')}}/images/logo.png" class="img-fluid rounded" alt="">
       <span>Havah</span>
       </a>
       <div class="iq-menu-bt align-self-center">
          <div class="wrapper-menu">
             <div class="main-circle"><i class="ri-menu-line"></i></div>
             <div class="hover-circle"><i class="ri-close-fill"></i></div>
          </div>
       </div>
    </div>
    <div id="sidebar-scrollbar">
       <nav class="iq-sidebar-menu">
          <ul id="iq-sidebar-toggle" class="iq-menu">
             <li {{ Request::is('dashboard') ? 'active' : '' }}>
                <a href="#dashboard" class="iq-waves-effect" data-toggle="collapse" aria-expanded="true"><span class="ripple rippleEffect"></span><i class="las la-home iq-arrow-left"></i><span>Dashboard</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                <ul id="dashboard" class="iq-submenu collapse show" data-parent="#iq-sidebar-toggle">
                   <li class="active"><a href="/admin"><i class="las la-laptop-code"></i>Account Dashboard</a></li>
                </ul>
             </li>
             <li class="{{ Request::is('userList') ? 'active' : '' }}">
                <a href="#userinfo" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false"><span class="ripple rippleEffect"></span><i class="las la-user-tie iq-arrow-left"></i><span>User</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                <ul id="userinfo" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="">
                   <li><a href="/userList"><i class="las la-th-list"></i>User List</a></li>
                </ul>
             </li>
          </ul>
       </nav>
       <div class="p-3"></div>
    </div>
 </div>