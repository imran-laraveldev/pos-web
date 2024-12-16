@php
  $current_route=\Request::route()->getName();
@endphp
<ul class="navbar-nav" id="navbar-nav">
    <li class="menu-title"><span data-key="t-menu-system">System Navs</span></li>
    <?php $current_route = \Request::route()->getName(); ?>
{{--    {!! UserMenu($current_route) !!}--}}

    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-menu">FAST</span></li>
    <li class="nav-item">
        <?php
        $aclArray = ['schools.students','schools.students.test'];
        $acl_active = (in_array($current_route, $aclArray)) ? 'active' : '';
        $acl_show = (in_array($current_route, $aclArray)) ? 'show' : '';
        ?>
        <a class="nav-link menu-link {{ $acl_active }}" href="#sidebarPages-0" data-bs-toggle="collapse" role="button"
           aria-expanded="{{ in_array($current_route, $aclArray) ? 'true' : 'false' }}" aria-controls="sidebarPages-0">
            <i class="ri-account-circle-line"></i> <span data-key="t-pages">Student Management</span>
        </a>
        <div class="collapse menu-dropdown {{ $acl_show }}" id="sidebarPages-0">
            <ul class="nav nav-sm flex-column {{ $acl_show }}">
                <li class="nav-item">
                    <a href="{{ route('schools.students.listing') }}" data-key="t-users"
                       class="nav-link {{ $current_route == 'schools.students.listing' ? 'active' : '' }}" > Students </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('schools.students.test') }}" data-key="t-users"
                       class="nav-link {{ $current_route == 'schools.students.test' ? 'active' : '' }}" > Test Students </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-menu">Static Navs</span></li>
    <li class="nav-item">
        <?php
        $aclArray = ['roles','acl.user.listing', 'acl.permission.listing','reports.dashboard'];
        $acl_active = (in_array($current_route, $aclArray)) ? 'active' : '';
        $acl_show = (in_array($current_route, $aclArray)) ? 'show' : '';
        ?>
        <a class="nav-link menu-link {{ $acl_active }}" href="#sidebarPages-0" data-bs-toggle="collapse" role="button"
           aria-expanded="{{ in_array($current_route, $aclArray) ? 'true' : 'false' }}" aria-controls="sidebarPages-0">
            <i class="ri-account-circle-line"></i> <span data-key="t-pages">User Management</span>
        </a>
        <div class="collapse menu-dropdown {{ $acl_show }}" id="sidebarPages-0">
            <ul class="nav nav-sm flex-column {{ $acl_show }}">
                <li class="nav-item">
                    <a href="{{ route('acl.user.listing') }}" data-key="t-users"
                       class="nav-link {{ $current_route == 'acl.user.listing' ? 'active' : '' }}" > Users </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('roles') }}" data-key="t-users"
                       class="nav-link {{ $current_route == 'roles' ? 'active' : '' }}" > Roles </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('acl.permission.listing') }}" data-key="t-permission"
                       class="nav-link {{ $current_route == 'acl.permission.listing' ? 'active' : '' }}" > Permissions </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reports.dashboard') }}" data-key="t-permission"
                       class="nav-link {{ $current_route == 'reports.dashboard' ? 'active' : '' }}" > Reporting Dashboard </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item d-none">
        <?php
            $settingArray = ['reports', 'inventory','reports.sales'];
            $setting_active = (in_array($current_route, $settingArray)) ? 'active' : '';
            $setting_show = (in_array($current_route, $settingArray)) ? 'show' : '';
        ?>
        <a class="nav-link menu-link {{ $setting_active }}" href="#sidebarPages-2" data-bs-toggle="collapse" role="button"
           aria-expanded="{{ in_array($current_route, $settingArray) ? 'true' : 'false' }}" aria-controls="sidebarPages-2">
            <i class="ri-layout-3-fill"></i> <span data-key="t-pages">Reports</span>
        </a>
        <div class="collapse menu-dropdown {{ $setting_show }}" id="sidebarPages-2">
            <ul class="nav nav-sm flex-column {{ $setting_show }}">

                <li class="nav-item">
                    <a href="{{ route('reports') }}" class="nav-link {{ $current_route == 'reports' ? 'active' : '' }}" data-key="t-budget_types"> {{ __('label.reports') }} </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reports.sales') }}" class="nav-link {{ $current_route == 'reports.sales' ? 'active' : '' }}" data-key="t-budget_types"> {{ __('label.sales-report') }} </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('inventory') }}" class="nav-link {{ $current_route == 'inventory' ? 'active' : '' }}" data-key="t-grants"> {{ __('label.inventory-report') }} </a>
                </li>

            </ul>
        </div>
    </li>

    <li class="nav-item">
        <?php
        $settingArray = ['products','dynamic_forms'];
        $setting_active = (in_array($current_route, $settingArray)) ? 'active' : '';
        $setting_show = (in_array($current_route, $settingArray)) ? 'show' : '';
        ?>
        <a class="nav-link menu-link {{ $setting_active }}" href="#sidebarPages-3" data-bs-toggle="collapse" role="button"
           aria-expanded="{{ in_array($current_route, $settingArray) ? 'true' : 'false' }}" aria-controls="sidebarPages-3">
            <i class=" ri-settings-5-line"></i> <span data-key="t-pages">Settings</span>
        </a>
        <div class="collapse menu-dropdown {{ $setting_show }}" id="sidebarPages-3">
            <ul class="nav nav-sm flex-column {{ $setting_show }}">
                <li class="nav-item">
                    <a href="{{ route('products') }}" class="nav-link {{ $current_route == 'products' ? 'active' : '' }}" data-key="t-budget_types"> {{ __('label.products') }} </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dynamic_forms') }}" class="nav-link {{ $current_route == 'dynamic_forms' ? 'active' : '' }}" data-key="t-budget_types"> {{ __('label.dynamic_forms') }} </a>
                </li>

            </ul>
        </div>
    </li>

</ul>
