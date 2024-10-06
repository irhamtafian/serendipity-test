<div class="topbar d-flex align-items-center">
    <nav class="navbar navbar-expand gap-3">
        <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
        </div>

       
        <div class="search-bar d-lg-block d-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
            <a href="avascript:;" class="btn d-flex align-items-center"><i class="bx bx-search"></i>Search Menu...</a>
        </div>

          <div class="top-menu ms-auto">
            <ul class="navbar-nav align-items-center gap-1">
                <li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
                    <a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
                    </a>
                </li>
                
                {{-- Biar bisa tutup sidebar --}}
                <div class="dropdown-menu dropdown-menu-end p-0">
                    <div class="app-container p-2 my-2">
                        

                    </div>
                </div>
            
                {{-- For theme mode  --}}
                <div class="header-notifications-list">  
                </div>

                <div class="header-message-list">
                </div>
              
             
            </ul>
        </div>
        <div class="user-box dropdown px-3">
            <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('assets/frontend/images/resources/profile-comments.png') }}" class="user-img" alt="user avatar">
                <div class="user-info">
                    
                    @auth
                    <p class="user-name mb-0">{{ auth()->user()->name }}</p>
                    @endauth
                    <p class="designattion mb-0">Admin</p>
                </div>
            </a>
            {{-- <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-cog fs-5"></i><span>Settings</span></a>
                </li>
                <li>
                    <div class="dropdown-divider mb-0"></div>
                </li>
                <li>
                    <form action="logout" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center">
                            <i class="bx bx-log-out fs-5"></i> <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul> --}}
        </div>
    </nav>
</div>