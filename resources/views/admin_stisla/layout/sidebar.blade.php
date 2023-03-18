<ul class="sidebar-menu">
    <!-- Begin Main Navigation -->
    <li class="menu-header">{{ trans('admin.dashboard') }}</li>
    <li id="menu-dashboard" class="nav-item"><a href="/admin/dashboard"><i class="fas fa-fire"></i><span>{{ trans('admin.dashboard') }}</span></a></li>
    @if($Admin->type == 'admin' || in_array('manager', $Access))
        <li id="menu-manager" class="nav-item dropdown">
            <a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>{{ trans('admin.Managers') }}</span></a>
            <ul id="dropdown-manager" class="dropdown-menu">
                <li><a href="/admin/manager/list">{{ trans('admin.list') }}</a></li>
                <li><a href="/admin/manager/new">{{ trans('admin.new') }}</a></li>
            </ul>
        </li>
    @endif
     @if($Admin->type == 'admin' || in_array('staff', $Access))
        <li id="menu-user" class="nav-item">
            <a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>{{ trans('admin.staff') }}</span></a>
            <ul id="dropdown-user" class="dropdown-menu">
                <li><a href="/admin/staff/list"><span>{{ trans('admin.list') }}</span></a></li>
                <li><a href="/admin/staff/new"><span>{{ trans('admin.new') }}</span></a></li>
            </ul>
        </li>
    @endif
    @if($Admin->type == 'admin' || in_array('garage', $Access))
        <li id="menu-user" class="nav-item">
            <a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>{{ trans('admin.doctors') }}</span></a>
            <ul id="dropdown-user" class="dropdown-menu">
                <li><a href="/admin/doctor/new"><span>{{ trans('admin.new') }}</span></a></li>
                <li><a href="/admin/doctor/list"><span>{{ trans('admin.list') }}</span></a></li>
            </ul>
        </li>
        <li id="menu-user" class="nav-item">
            <a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>{{ trans('admin.students') }}</span></a>
            <ul id="dropdown-user" class="dropdown-menu">
                <li><a href="/admin/student/new"><span>{{ trans('admin.new') }}</span></a></li>
                <li><a href="/admin/student/list"><span>{{ trans('admin.list') }}</span></a></li>
            </ul>
        </li>
        <li id="menu-user" class="nav-item">
            <a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>{{ trans('admin.acadmic-year') }}</span></a>
            <ul id="dropdown-user" class="dropdown-menu">
                {{-- <li><a href="/admin/year/new"><span>{{ trans('admin.new') }}</span></a></li> --}}
                <li><a href="/admin/year/list"><span>{{ trans('admin.list') }}</span></a></li>
            </ul>
        </li>
        <li id="menu-user" class="nav-item">
            <a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>{{ trans('admin.subject') }}</span></a>
            <ul id="dropdown-user" class="dropdown-menu">
                <li><a href="/admin/subject/new"><span>{{ trans('admin.new') }}</span></a></li>
                <li><a href="/admin/subject/list"><span>{{ trans('admin.list') }}</span></a></li>
            </ul>
        </li>
        <li id="menu-user" class="nav-item">
            <a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>{{ trans('admin.class_room') }}</span></a>
            <ul id="dropdown-user" class="dropdown-menu">
                {{-- <li><a href="/admin/year/new"><span>{{ trans('admin.new') }}</span></a></li> --}}
                <li><a href="/admin/class/list"><span>{{ trans('admin.list') }}</span></a></li>
            </ul>
        </li>
    @endif
        <li class="menu-header">{{ trans('admin.commercial') }}</li>
    @if($Admin->type == 'admin' || in_array('project', $Access))
        <li id="menu-project" class="nav-item">
            <a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-cart-plus"></i><span>{{ trans('admin.project') }}</span></a>
            <ul id="dropdown-product" class="dropdown-menu">
                <li><a href="/admin/project/new">{{ trans('admin.new') }}</a></li>
                <li><a href="/admin/project/list">{{ trans('admin.list') }}</a></li>
                <li><a href="/admin/project/report">{{ trans('admin.reports') }}</a></li>
                {{-- <li><a href="/admin/project/online">{{ trans('admin.online') }}</a></li> --}}
                <li><a href="/admin/project/category">{{ trans('admin.grouping') }}</a></li>
                {{-- <li><a href="/admin/project/category/online">{{ trans('admin.online_categorization') }}</a></li> --}}
                {{-- <li><a href="/admin/project/budget">{{ trans('admin.the_budget') }}</a></li> --}}
                <li><a href="/admin/project/language">{{ trans('admin.language') }}</a></li>
                <li><a href="/admin/project/text">{{ trans('admin.text_type') }}</a></li>
                <li><a href="/admin/project/tag">{{ trans('admin.tag') }}</a></li>
                {{-- <li><a href="/admin/project/price">{{ trans('admin.price_list') }}</a></li> --}}
            </ul>
        </li>
    @endif
    {{-- @if($Admin->type == 'admin' || in_array('document', $Access))
        <li id="menu-document" class="nav-item"><a href="javascript:void(0)" class="nav-link has-dropdown"><i class="fas fa-file-alt"></i><span>{{ trans('admin.documents') }}</span></a>
            <ul id="dropdown-document" class="dropdown-menu">
                <li><a href="/admin/document/list">{{ trans('admin.list') }}</a></li>
                <li><a href="/admin/document/new">{{ trans('admin.document_registration') }}</a></li>
            </ul>
        </li>
    @endif --}}
    {{-- @if($Admin->type == 'admin' || in_array('transaction', $Access))
        <li id="menu-transaction" class="nav-item"><a href="/admin/transaction/list"><i class="fas fa-check-circle"></i><span>{{ trans('admin.transaction') }}</span></a></li>
    @endif --}}
    {{-- @if($Admin->type == 'admin' || in_array('withdraw', $Access))
        <li id="menu-withdraw" class="nav-item"><a href="/admin/withdraw/list"><i class="fas fa-wallet"></i><span>{{ trans('admin.deposit_request') }}</span></a></li>
    @endif
    @if($Admin->type == 'admin' || in_array('bank', $Access))
            <li id="menu-bank"><a href="/admin/bank/list" class="nav-item"><i class="fas fa-piggy-bank"></i><span>{{ trans('admin.bank_accounts') }}</span></a></li>
        @endif
    <li class="menu-header">{{ trans('admin.connections') }}</li> --}}
    @if($Admin->type == 'admin' || in_array('support', $Access))
        <li id="menu-support" class="nav-item"><a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-life-ring"></i><span>{{ trans('admin.support') }}</span></a>
            <ul id="dropdown-support" class="dropdown-menu">
                <li><a href="/admin/support/list">{{ trans('admin.list') }}</a></li>
                <li><a href="/admin/support/category/list">{{ trans('admin.department') }}</a></li>
                <li><a href="/admin/support/setting">{{ trans('admin.settings') }}</a></li>
            </ul>
        </li>
    @endif
    @if($Admin->type == 'admin' || in_array('chat', $Access))
        <li id="menu-chat" class="nav-item"><a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-comment"></i><span>{{ trans('admin.chat') }}</span></a>
            <ul id="dropdown-chat" class="dropdown-menu">
                <li><a href="/admin/chat/filter">{{ trans('admin.word_filter') }}</a></li>
                <li><a href="/admin/chat/report">{{ trans('admin.reports') }}</a></li>
            </ul>
        </li>
    @endif
    {{-- @if($Admin->type == 'admin' || in_array('revision', $Access))
        <li id="menu-revision"><a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-balance-scale"></i><span>{{ trans('admin.review') }}</span></a>
            <ul id="dropdown-revision" class="dropdown-menu">
                <li><a href="/admin/revision/list">{{ trans('admin.list') }}</a></li>
                <li><a href="/admin/revision/category/list">{{ trans('admin.difficulties') }}</a></li>
            </ul>
        </li>
    @endif --}}
    @if($Admin->type == 'admin' || in_array('notification', $Access))
        <li id="menu-notification" class="nav-item"><a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-bell"></i><span>{{ trans('admin.notices') }}</span></a>
            <ul id="dropdown-notification" class="dropdown-menu">
                <li><a href="/admin/notification/list">{{ trans('admin.list') }}</a></li>
                <li><a href="/admin/notification/new">{{ trans('admin.new_announcement') }}</a></li>
                <li><a href="/admin/notification/setting">{{ trans('admin.automatic_notification') }}</a></li>
                <li><a href="/admin/notification/admin/list">{{ trans('admin.admin') }}</a></li>
            </ul>
        </li>
    @endif
    {{-- @if($Admin->type == 'admin' || in_array('newsletter', $Access))
            <li id="menu-newsletter" class="nav-item"><a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-newspaper"></i><span>{{ trans('admin.newsletters') }}</span></a>
                <ul id="dropdown-newsletter" class="dropdown-menu">
                    <li><a href="/admin/newsletter/list">{{ trans('admin.list') }}</a></li>
                    <li><a href="/admin/newsletter/new">{{ trans('admin.new') }}</a></li>
                </ul>
            </li>
        @endif --}}
    {{-- <li class="menu-header">{{ trans('admin.content') }}</li>
    @if($Admin->type == 'admin' || in_array('blog', $Access))
        <li id="menu-blog" class="nav-item"><a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fab fa-wordpress"></i><span>{{ trans('admin.weblog') }}</span></a>
            <ul id="dropdown-blog" class="dropdown-menu">
                <li><a href="/admin/blog/list">{{ trans('admin.list') }}</a></li>
                <li><a href="/admin/blog/new">{{ trans('admin.new') }}</a></li>
                <li><a href="/admin/blog/category">category </a></li>
            </ul>
        </li>
    @endif --}}
    {{-- @if($Admin->type == 'admin' || in_array('page', $Access))
        <li id="menu-page" class="nav-item"><a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-pager"></i><span>{{ trans('admin.pages') }}</span></a>
            <ul id="dropdown-page" class="dropdown-menu">
                <li><a href="/admin/page/list">{{ trans('admin.list') }}</a></li>
                <li><a href="/admin/page/new">{{ trans('admin.new') }}</a></li>
            </ul>
        </li>
    @endif --}}
    {{-- @if($Admin->type == 'admin' || in_array('blog', $Access))
            <li id="menu-comment" class="nav-item"><a href="/admin/comment"><i class="fas fa-comment-alt"></i><span>{{ trans('admin.comments') }}</span></a></li>
        @endif --}}
    <li class="menu-header dropdown">{{ trans('admin.profile') }}</li>
    @if($Admin->type == 'admin' || in_array('setting', $Access))
        <li id="menu-setting" class="nav-item"><a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-cogs"></i><span>{{ trans('admin.settings') }}</span></a>
            <ul id="dropdown-setting" class="dropdown-menu">
                <li><a href="/admin/setting/main">{{ trans('admin.main') }}</a></li>
                {{-- <li><a href="/admin/setting/bank">{{ trans('admin.fi/nancial') }}</a></li> --}}
                {{-- <li><a href="/admin/setting/project">{{ trans('admin.project') }}</a></li> --}}
                {{-- <li><a href="/admin/setting/user">{{ trans('admin.users') }}</a></li> --}}
                <li><a href="/admin/setting/content">{{ trans('admin.content') }}</a></li>
                <li><a href="/admin/setting/index">{{ trans('admin.main_page') }}</a></li>
                <li><a href="/admin/setting/document">{{ trans('admin.documents') }}</a></li>
                <li><a href="/admin/setting/header">{{ trans('admin.header') }}</a></li>
                <li><a href="/admin/setting/footer">{{ trans('admin.footer') }}</a></li>
                <li><a href="/admin/setting/firebase">{{ trans('admin.firebase') }}</a></li>
                <li><a href="/admin/setting/sms">{{ trans('admin.SMS_templates') }}</a></li>
                {{-- <li><a href="/admin/setting/text">{{ trans('admin.user_guide') }}</a></li> --}}
                <li><a href="/admin/setting/profile">{{ trans('admin.profile') }}</a></li>
            </ul>
        </li>
    @endif
    <li><a href="/admin/logout" class="nav-item"><i class="fas fa-times"></i><span>{{ trans('admin.exit') }}</span></a></li>
</ul>
