<div class="sidebar-header">
    <div class="logo-icon">
        <img src="{{asset('theme/admin/assets/images/logo-icon.png')}}" class="logo-img" alt="">
    </div>
    <div class="logo-name flex-grow-1">
        <h5 class="mb-0">Maxton</h5>
    </div>
    <div class="sidebar-close">
        <span class="material-icons-outlined">close</span>
    </div>
</div>
<div class="sidebar-nav">
    <!--navigation-->
    <ul class="metismenu" id="sidenav">
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="material-icons-outlined">home</i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
            <ul>
                <li><a href=""><i class="material-icons-outlined">arrow_right</i>Analysis</a>
                </li>
                <li><a href=""><i class="material-icons-outlined">arrow_right</i>eCommerce</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="material-icons-outlined">widgets</i>
                </div>
                <div class="menu-title">Sản phẩm</div>
            </a>
            <ul>
                <li><a href="{{ route('admin.attributes.index') }}"><i class="material-icons-outlined">arrow_right</i>Thuộc
                        tính</a>
                </li>
                <li>
                    <a href="{{ route('admin.category.index') }}"><i class="material-icons-outlined">arrow_right</i>Danh mục</a>
                 </li>
            </ul>
        </li>


    </ul>
    </li>
    </ul>
    <!--end navigation-->
</div>
