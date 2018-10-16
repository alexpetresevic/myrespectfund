<nav id="sidebar">
    <div id="sidebar-scroll">
        <div class="sidebar-content">

            <div class="side-header side-content bg-white-op" style="background-color: #774b92">
                <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times"></i>
                </button>
                <div class="btn-group pull-right"></div>
                <img src="/img/logo-120.png" width="120">
            </div>

            <div class="side-content side-content-full">
                <ul class="nav-main">
                    <li>
                        <a class="active" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> <span class="sidebar-mini-hide">Dashboard</span></a>
                    </li>
                    <li class="nav-main-heading"><span class="sidebar-mini-hide">Content</span></li>
                    <li>
                        <a class="active" href="{{ route('admin.pages.index') }}"><i class="fas fa-file-alt"></i> <span class="sidebar-mini-hide">Pages</span></a>
                    </li>
                    <li>
                        <a class="active" href="{{ route('admin.faq.index') }}"><i class="fas fa-question-circle"></i> <span class="sidebar-mini-hide">FAQ</span></a>
                    </li>
                    <li>
                        <a class="active" href="{{ route('admin.news.index') }}"><i class="fas fa-newspaper"></i> <span class="sidebar-mini-hide">Press</span></a>
                    </li>
                    <li>
                        <a class="active" href="{{ route('admin.toolkit.index') }}"><i class="fas fa-archive"></i> <span class="sidebar-mini-hide">Toolkit</span></a>
                    </li>

                    <li class="nav-main-heading"><span class="sidebar-mini-hide">Blog</span></li>
                    <li>
                        <a class="active" href="{{ route('admin.blog.posts.index') }}"><i class="fas fa-thumbtack"></i> <span class="sidebar-mini-hide">Posts</span></a>
                    </li>
                    <li>
                        <a class="active" href="{{ route('admin.blog.categories.index') }}"><i class="fas fa-th"></i> <span class="sidebar-mini-hide">Categories</span></a>
                    </li>
                    <li>
                        <a class="active" href="{{ route('admin.blog.tags.index') }}"><i class="fas fa-tags"></i> <span class="sidebar-mini-hide">Tags</span></a>
                    </li>

                    <li class="nav-main-heading"><span class="sidebar-mini-hide">Site</span></li>
                    <li>
                        <a class="active" href="{{ route('admin.funeral-homes.index', ['filter' => 'partners']) }}"><i class="fas fa-briefcase"></i> <span class="sidebar-mini-hide">Partners</span></a>
                    </li>
                    <li>
                        <a class="active" href="{{ route('admin.funeral-homes.index') }}"><i class="fas fa-building"></i> <span class="sidebar-mini-hide">Funeral Homes</span></a>
                    </li>
                    <li>
                        <a class="active" href="{{ route('admin.campaigns.index') }}"><i class="fas fa-star"></i> <span class="sidebar-mini-hide">Fundraisers</span></a>
                    </li>
                    <li>
                        <a class="active" href="{{ route('admin.organization.index') }}"><i class="fas fa-id-card"></i> <span class="sidebar-mini-hide">Organisations</span></a>
                    </li>
                    <li>
                        <a class="active" href="{{ route('admin.testimonial.index') }}"><i class="fas fa-quote-right"></i> <span class="sidebar-mini-hide">Testimonials</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<header id="header-navbar" class="content-mini content-mini-full">
    <ul class="nav-header pull-right">
        <li>
            <a target="_blank" class="btn btn-default" href="{{ route('home') }}"><i class="fas fa-globe"></i></a>
        </li>
        <li>
            <div class="btn-group">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
                    <i class="fas fa-user"></i> {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a href="{{ route('admin.users.edit', ['user' => auth()->user()->id]) }}" class="dropdown-item"><i class="fas fa-edit"></i> Edit Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}" class="dropdown-item"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </li>
    </ul>

    <ul class="nav-header pull-left">
        <li>
            <a href="{{ route('admin.settings.index') }}"><i class="fas fa-cogs"></i> Settings</a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i> Users</a>
        </li>
    </ul>
</header>
