<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="/admin/dashboard">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-pencil-box-outline menu-icon"></i>
        <span class="menu-title">Blocks | Rooms</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/admin/add_hall">Add Hall</a></li>
          <li class="nav-item"> <a class="nav-link" href="/admin/manage_hall">Manage Hall</a></li>
          <li class="nav-item"> <a class="nav-link" href="/admin/add_block">Add Block</a></li>
          <li class="nav-item"> <a class="nav-link" href="/admin/manage_block">Manage Block</a></li>
          <li class="nav-item"> <a class="nav-link" href="#">Add Rooms</a></li>
          <li class="nav-item"> <a class="nav-link" href="#">Manage Rooms</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/update_session">
        <i class="mdi mdi-calendar menu-icon"></i>
        <span class="menu-title">Update Session</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-student" aria-expanded="false" aria-controls="ui-student">
        <i class="mdi mdi-account-search menu-icon"></i>
        <span class="menu-title">Student</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-student">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/admin/upload_student">Upload Student</a></li>
          <li class="nav-item"> <a class="nav-link" href="/admin/manage_student">Manage Student</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-warden" aria-expanded="false" aria-controls="ui-warden">
        <i class="mdi mdi-account-settings menu-icon"></i>
        <span class="menu-title">Warden</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-warden">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/admin/warden_registration">Add Warden</a></li>
          <li class="nav-item"> <a class="nav-link" href="/admin/manage_warden/warden">Manage Warden</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/logout">
        <i class="mdi mdi-logout menu-icon"></i>
        <span class="menu-title">Logout</span>
      </a>
    </li>
  </ul>
</nav>