      <div class="main-sidebar sidebar-style-2">
          <aside id="sidebar-wrapper">
              <div class="sidebar-brand">
                  <a href="index.html"> <img alt="image" src="{{ url('admin/assets/img/logo.png') }}"
                          class="header-logo" /> <span class="logo-name">{{ Auth::user()->name }}</span>
                  </a>
              </div>
              <ul class="sidebar-menu">
                  <li class="menu-header">Main</li>
                  <li class="dropdown active">
                      <a href="{{ route('home') }}" class="nav-link"><i
                              data-feather="monitor"></i><span>Dashboard</span></a>
                  </li>

                  <li class="dropdown">
                      <a href="#" class="menu-toggle nav-link has-dropdown"><i
                              data-feather="briefcase"></i><span>Post</span></a>
                      <ul class="dropdown-menu">
                          <li><a class="nav-link" href="{{ route('post.create') }}">Add</a></li>
                          <li><a class="nav-link" href="{{ route('post.index') }}">View</a></li>
                      </ul>
                  </li>

                  <li class="dropdown">
                      <a href="#" class="menu-toggle nav-link has-dropdown"><i
                              data-feather="briefcase"></i><span>Tag</span></a>
                      <ul class="dropdown-menu">
                          <li><a class="nav-link" href="{{ route('tag.create') }}">Add</a></li>
                          <li><a class="nav-link" href="{{ route('tag.index') }}">View</a></li>
                      </ul>
                  </li>
              </ul>
          </aside>
      </div>
