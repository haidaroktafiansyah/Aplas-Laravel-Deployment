<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('lte/dist/img/logo-aplas.png')}}" alt="APLAS logo" class="brand-image elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">WebApps</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('lte/dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Administrator</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{URL::to('admin/topics')}}" class="nav-link">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Learning Topics
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('admin/tasks')}}" class="nav-link">
              <i class="nav-icon fas fa-spinner"></i>
              <p>
                Learning Tasks
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('admin/learning')}}" class="nav-link">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Learning Files
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('admin/resources')}}" class="nav-link">
              <i class="nav-icon fas fa-chevron-circle-right"></i>
              <p>
                Topic Resources
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('admin/testfiles')}}" class="nav-link">
              <i class="nav-icon fas fa-rocket"></i>
              <p>
                Test Files
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('admin/assignteacher')}}" class="nav-link">
              <i class="nav-icon fas fa-hand-pointer"></i>
              <p>
                Assign Teacher
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
