
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Rocker</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ url('admin/dashboard') }}" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>

        </li>
       
        <li class="menu-label">Home</li>
        <li>
            <a href="{{url('admin/home_Banner')}}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Home Banner</div>
            </a>
        </li>
        <li>
            <a href="{{url('admin/manage_size')}}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Manage Size</div>
            </a>
        </li>
        <li>
            <a href="{{url('admin/manage_color')}}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Manage Color</div>
            </a>
        </li>
        
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Atrribute</div>
            </a>
            <ul>
                <li> <a href="{{url('admin/attribute_name')}}"><i class="bx bx-right-arrow-alt"></i>Attribute Name</a>
                </li>
                <li> <a href="{{url('admin/attribute_value')}}"><i class="bx bx-right-arrow-alt"></i>Attribute Value</a>
                </li>
                <li> <a href="{{url('admin/category')}}"><i class="bx bx-right-arrow-alt"></i>Category</a>
                </li>
                <li> <a href="{{url('admin/product')}}"><i class="bx bx-right-arrow-alt"></i>Product</a>
                </li>
                <li> <a href="{{url('admin/category_attribute')}}"><i class="bx bx-right-arrow-alt"></i>Category Attribute</a>
                </li>
                <li> <a href="{{url('admin/brand')}}"><i class="bx bx-right-arrow-alt"></i>Brands</a>
                </li>
               

            </ul>
        </li>


        <li class="menu-label">Pages</li>

        <li>
            <a href="user-profile.html">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">User Profile</div>
            </a>
        </li>



    </ul>