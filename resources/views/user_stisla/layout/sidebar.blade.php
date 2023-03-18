<nav class="sidebar-menu">
    @if($User->confirm_sms == 0 && $User->confirm_email == 0)
    <li class="nav-item" id="menu-dashboard"><a href="/user/dashboard" class="nav-link"><i class="fas fa-fire"></i><span>{{ trans('admin.dashboard') }}</span></a></li>
    <li class="nav-item" id="menu-project">
        <a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-folder"></i><span>{{ trans('admin.project') }}</span></a>
        <ul id="dropdown-project" class="dropdown-menu">
            <li><a href="/user/project/list">{{ trans('admin.list') }}</a></li>
            <li><a href="/user/project/new">{{ trans('admin.register_a_new_project') }}</a></li>
            <li><a href="/user/project/yours">{{ trans('admin.your_projects') }}</a></li>
            <li><a href="/user/project/offer">{{ trans('admin.your_suggestions') }}</a></li>
            <li><a href="/user/project/revision">{{ trans('admin.review_requests') }}</a></li>
        </ul>
    </li>
    <li class="nav-item" id="menu-online">
        <a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-globe"></i><span>{{ trans('admin.online_project') }}</span></a>
        <ul id="dropdown-online" class="dropdown-menu">
            <li><a href="/user/online/new">{{ trans('admin.new') }}</a></li>
            <li><a href="/user/online/projects">{{ trans('admin.list') }}</a></li>
            @if($User->online == 1)
            <li><a href="/user/online/contractor">{{ trans('admin.contractor') }}</a></li>
            @endif
        </ul>
    </li>
    <li class="nav-item" id="menu-financial">
        <a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fab fa-google-wallet"></i><span>{{ trans('admin.financial') }}</span></a>
        <ul id="dropdown-financial" class="dropdown-menu">
            <li><a href="/user/financial/report"><span>{{ trans('admin.financial_reports') }}</span></a></li>
            <li><a href="/user/financial/transaction/list"><span>{{ trans('admin.list_of_transactions') }}</span></a></li>
            <li><a href="/user/financial/wallet"><span>{{ trans('admin.increase_credit') }}</span></a></li>
            <li><a href="/user/financial/bank">{{ trans('admin.bank_accounts') }}</a></li>
            <li><a href="/user/financial/withdraw">{{ trans('admin.deposit_request') }}</a></li>
        </ul>
    </li>
    <li class="nav-item" id="menu-support"><a href="/user/support" class="nav-link"><i class="fas fa-life-ring"></i><span>{{ trans('admin.support') }}</span></a></li>
    <li class="nav-item" id="menu-notification"><a href="/user/notification/list" class="nav-link"><i class="fas fa-bell"></i><span>{{ trans('admin.announcement') }}‌</span></a></li>
    @else
        <li class="nav-item" id="menu-active"><a href="/user/dashboard" class="nav-link"><i class="fas fa-lock"></i><span>{{ trans('admin.account_activation') }}</span></a></li>
    @endif
    <li class="nav-item" id="menu-blog"><a href="/user/blog" class="nav-link"><i class="fab fa-wordpress"></i><span>{{ trans('admin.blog') }}</span></a></li>
    <li class="nav-item" id="menu-profile">
        <a href="javascript:void(0);" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>{{ trans('admin.user') }}</span></a>
        <ul id="dropdown-profile" class="dropdown-menu">
            <li><a href="/user/profile/view/{!! $User->id !!}">{{ trans('admin.my_profile') }}</a></li>
            <li><a href="/user/profile/setting">{{ trans('admin.edit_Profile') }}</a></li>
            <li><a href="/user/account">{{ trans('admin.subscription') }}</a></li>
            @if($User->online == 0)
            <li><a href="/user/profile/online">{{ trans('admin.online_presenter') }}</a></li>
            @endif
        </ul>
    </li>
    <li class="nav-item" id="menu-learn"><a href="/user/learn" class="nav-link"><i class="fas fa-question-circle"></i><span>{{ trans('admin.education') }}</span></a></li>
    <li class="nav-item"><a href="/user/logout" class="nav-link"><i class="fas fa-times"></i><span>{{ trans('admin.exit') }}</span></a></li>
</nav>
