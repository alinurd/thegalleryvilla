@php
    $masterDataMenus = [
       [
            'route' => 'admin.master.category.index',
            'title' => 'Category',
            'icon' => 'ti ti-window',
        ],
    ];
@endphp
<ul class="menu-inner py-1">
  {{-- Dashboard --}}
    <li class="menu-item {{ isActiveRoute('admin.dashboard') }}">
        <a href="{{ route('admin.dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="Dashboard">Dashboard</div>
        </a>
    </li>

    {{-- Databases --}}
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text" data-i18n="Databases">Databases</span>
  </li>
  <li class="menu-item {{ isActiveOpen(['admin.master.*']) }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons ti ti-database"></i>
      <div data-i18n="Master Data">Master Data</div>
    </a>
    <ul class="menu-sub">
      @foreach ($masterDataMenus as $item)
        <li class="menu-item {{isActiveRoute($item['route'])}}">
          <a href="{{ route($item['route']) }}" class="menu-link">
              <div data-i18n="{{$item['title']}}">{{$item['title']}}</div>
          </a>
        </li>
      @endforeach
    </ul>
  </li>




  {{-- End Master Data --}}



  {{-- User Management --}}
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text" data-i18n="User Management">User Management</span>
  </li>
  <li class="menu-item {{isActiveRoute('admin.userman.user.view')}}">
    <a href="{{ route('admin.userman.user.view') }}" class="menu-link">
      <i class="menu-icon tf-icons ti ti-users"></i>
      <div data-i18n="Users">Users</div>
    </a>
  </li>
  <li class="menu-item {{ isActiveOpen(['admin.userman.role.*', 'admin.userman.permission.*']) }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons ti ti-settings"></i>
      <div data-i18n="Roles & Permissions">Roles & Permissions</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item {{isActiveRoute('admin.userman.role.view')}}">
        <a href="{{ route('admin.userman.role.view') }}" class="menu-link">
          <div data-i18n="Roles">Roles</div>
        </a>
      </li>
      <li class="menu-item {{isActiveRoute('admin.userman.permission.view')}}">
        <a href="{{ route('admin.userman.permission.view') }}" class="menu-link">
          <div data-i18n="Permission">Permission</div>
        </a>
      </li>
    </ul>
  </li>
  {{-- End User Management --}}


  {{-- Settings --}}
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text" data-i18n="Settings">Settings</span>
  </li>
  <li class="menu-item {{isActiveRoute('admin.setting.appsetting.index')}}">
    <a href="{{ route('admin.setting.appsetting.index') }}" class="menu-link">
      <i class="menu-icon tf-icons ti ti-table-options"></i>
      <div data-i18n="App Settings">App Settings</div>
    </a>
  </li>
  {{-- End Settings --}}


  <!-- Misc -->
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text" data-i18n="Misc">Misc</span>
  </li>
  <li class="menu-item">
    <a href="javascript:;" target="_blank" class="menu-link">
      <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
      <div data-i18n="Support">Support</div>
    </a>
  </li>
  <li class="menu-item">
    <a
      href="javascript:;"
      target="_blank"
      class="menu-link">
      <i class="menu-icon tf-icons ti ti-file-description"></i>
      <div data-i18n="Documentation">Documentation</div>
    </a>
  </li>
</ul>
