<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
        
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
     </div>
    <ul class="metismenu" id="menu">
        <li class="menu-label">Articles & Mails</li>
        <li>
            <a href="/admin/users">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title">Users</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-file'></i>
                </div>
                <div class="menu-title">Articles</div>
            </a>
            <ul>
                <li> <a href="/admin/articles"><i class='bx bx-radio-circle'></i>Articles</a>
                </li>
                <li> <a href="/admin/articles/categories"><i class='bx bx-radio-circle'></i>Categories</a>
                </li>
                <li> <a href="/admin/articles/comments"><i class='bx bx-radio-circle'></i>Comments</a>
            </ul>
        </li>
        
        <li class="menu-label">Others</li>
        <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="parent-icon">
                    <i class='bx bx-log-out'></i>
                </div>
                <div class="menu-title">Logout</div>
            </a>
            
            <form id="logout-form" action="logout" method="post" style="display: none;">
                @csrf
            </form>
        </li>
       
       
    </ul>
    <!--end navigation-->
</div>