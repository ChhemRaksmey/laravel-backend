<header id="page-topbar">
    <div @class(['navbar-header'])>

        <div @class(['d-flex'])>

            <div @class(['navbar-brand-box'])>
                <a @class(['logo', 'logo-dark' ]) href="javascript: void(0);">
                    <span @class(['logo-sm'])><img alt="" height="22" src="/assets/images/logo.svg" /></span>
                    <span @class(['logo-lg'])><img alt="" height="17" src="/assets/images/logo-dark.png" /></span>
                </a>
                <a @class(['logo', 'logo-light' ]) href="javascript: void(0);">
                    <span @class(['logo-sm'])><img alt="" height="22" src="/assets/images/logo-light.svg" /></span>
                    <span @class(['logo-lg'])><img alt="" height="19" src="/assets/images/logo-light.png" /></span>
                </a>
            </div>

            <button @class(['btn', 'btn-sm' , 'px-3' , 'font-size-16' , 'header-item' , 'waves-effect' ]) id="vertical-menu-btn" type="button">
                <i @class(['fa', 'fa-fw' , 'fa-bars' ])></i>
            </button>

        </div>

        <div @class(['d-flex'])>
            
            <div @class(['dropdown', 'd-inline-block' , 'd-lg-none' , 'ms-2' ])>
                <button aria-expanded="false" aria-haspopup="true" @class(['btn', 'header-item' , 'noti-icon', 'waves-effect' ]) data-bs-toggle="dropdown" id="page-header-search-dropdown" type="button">
                    <i @class(['mdi', 'mdi-magnify' ])></i>
                </button>
                <div aria-labelledby="page-header-search-dropdown" @class(['dropdown-menu', 'dropdown-menu-lg', 'dropdown-menu-end' , 'p-0' ])>
                    <form @class(['p-3'])>
                        <div @class(['form-group', 'm-0' ])>
                            <div @class(['input-group'])>
                                <input aria-label="Recipient's username" @class(['form-control'])
                                    placeholder="Search ..." type="text" />
                                <div @class(['input-group-append'])>
                                    <button @class(['btn', 'btn-primary' ]) type="submit">
                                        <i @class(['mdi', 'mdi-magnify' ])></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div @class(['dropdown', 'd-inline-block' ])>
                <button aria-expanded="false" aria-haspopup="true" @class(['btn', 'header-item' , 'waves-effect' ]) data-bs-toggle="dropdown" id="page-header-user-dropdown" type="button">
                    <span @class(['d-none', 'd-xl-inline-block' , 'ms-1' ]) key="t-StarCode Kh">StarCode Kh</span>
                    <i @class(['mdi', 'mdi-chevron-down' , 'd-none' , 'd-xl-inline-block' ])></i>
                </button>
                <div @class(['dropdown-menu', 'dropdown-menu-end' ])>
                    <a @class(['dropdown-item']) href="#">
                        <i @class(['bx', 'bx-user' , 'font-size-16' , 'align-middle' , 'me-1' ])></i>
                        <span key="t-profile">Profile</span>
                    </a>
                    <a @class(['dropdown-item']) href="#">
                        <i @class(['bx', 'bx-wallet' , 'font-size-16' , 'align-middle' , 'me-1' ])></i>
                        <span key="t-my-wallet">My Wallet</span>
                    </a>
                    <a @class(['dropdown-item', 'd-block' ]) href="#">
                        <span @class(['badge', 'bg-success' , 'float-end' ])>11</span>
                        <i @class(['bx', 'bx-wrench' , 'font-size-16' , 'align-middle' , 'me-1' ])></i>
                        <span key="t-settings">Settings</span>
                    </a>
                    <a @class(['dropdown-item']) href="#">
                        <i @class(['bx', 'bx-lock-open' , 'font-size-16' , 'align-middle' , 'me-1' ])></i>
                        <span key="t-lock-screen">Lock screen</span>
                    </a>
                    <div @class(['dropdown-divider'])>
                    </div>
                    <a @class(['dropdown-item', 'text-danger' ]) href="#">
                        <i @class(['bx', 'bx-power-off' , 'font-size-16' , 'align-middle' , 'me-1' , 'text-danger' ])></i>
                        <span key="t-logout">Logout</span>
                    </a>
                </div>
            </div>
            
            <div @class(['dropdown', 'd-inline-block' ])>
                <button aria-expanded="false" aria-haspopup="true" @class(['btn', 'header-item' , 'waves-effect' ]) data-bs-toggle="dropdown" type="button">
                    <img alt="Header Language" height="16" id="header-lang-img" src="/assets/images/flags/us.jpg" />
                </button>
                <div @class(['dropdown-menu', 'dropdown-menu-end' ])>
                    <a @class(['dropdown-item', 'notify-item' , 'language' ]) data-lang="en" href="javascript:void(0);">
                        <img alt="user-image" @class(['me-1']) height="12" src="/assets/images/flags/us.jpg" />
                        <span @class(['align-middle'])>English</span>
                    </a>
                    <a @class(['dropdown-item', 'notify-item' , 'language' ]) data-lang="sp" href="javascript:void(0);">
                        <img alt="user-image" @class(['me-1']) height="12" src="/assets/images/flags/spain.jpg" />
                        <span @class(['align-middle'])>Spanish</span>
                    </a>
                    <a @class(['dropdown-item', 'notify-item' , 'language' ]) data-lang="gr" href="javascript:void(0);">
                        <img alt="user-image" @class(['me-1']) height="12" src="/assets/images/flags/germany.jpg" />
                        <span @class(['align-middle'])>German</span>
                    </a>
                    <a @class(['dropdown-item', 'notify-item' , 'language' ]) data-lang="it" href="javascript:void(0);">
                        <img alt="user-image" @class(['me-1']) height="12" src="/assets/images/flags/italy.jpg" />
                        <span @class(['align-middle'])>Italian</span>
                    </a>
                    <a @class(['dropdown-item', 'notify-item' , 'language' ]) data-lang="ru" href="javascript:void(0);">
                        <img alt="user-image" @class(['me-1']) height="12" src="/assets/images/flags/russia.jpg" />
                        <span @class(['align-middle'])>Russian</span>
                    </a>
                </div>
            </div>
            
        </div>

    </div>
</header>