<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="/student/dashboard">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/student/update_profile">
        <i class="mdi mdi-account-settings menu-icon"></i>
        <span class="menu-title">Update Profile</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-hostel" aria-expanded="false" aria-controls="ui-hostel">
        <i class="mdi mdi-home-outline menu-icon"></i>
        <span class="menu-title">Hostel</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-hostel">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/student/book_for_hostel">Book for Hostel</a></li>
          <li class="nav-item"> <a class="nav-link" href="/student/my_hostels">My Hostels</a></li>
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