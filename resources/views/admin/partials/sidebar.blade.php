<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:;" class="brand-link">
      <img src="{{asset('images/Hình ảnh CLB/huyhieu.jpg')}}" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('template/AdminLTE-master/dist/img/avatar.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ asset('template/AdminLTE-master/index.html')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ asset('template/AdminLTE-master/index2.html')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ asset('template/AdminLTE-master/index3.html')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li> --}}
          <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link ">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Tổng quan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.posts.index')}}" class="nav-link ">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Bài viết
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.categorys.index')}}" class="nav-link ">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Danh mục sản phẩm
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.products.index')}}" class="nav-link ">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Sản phẩm
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.orders.index')}}" class="nav-link ">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Đơn hàng
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>