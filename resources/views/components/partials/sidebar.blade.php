<div @class(['vertical-menu'])>
    <div @class(['h-100']) data-simplebar="">
        <div id="sidebar-menu">
            <ul @class(['metismenu', 'list-unstyled' ]) id="side-menu">
                
                <li @class(['menu-title']) key="t-menu">Menu</li>


                <li>
                    <a @class(['pt-1', 'pb-2', 'has-arrow', 'waves-effect' ]) href="javascript: void(0);">
                        <i @class(['mdi', 'mdi-application-cog' ])></i>
                        <span key="t-sys">Core Setup</span>
                    </a>
                    <ul aria-expanded="false" @class(['sub-menu'])>
                        <li><a @class(['py-2']) href="javascript: void(0);" key="t-sys-UserReports">User Reports</a></li>
                        <li><a @class(['py-2']) href="javascript: void(0);" key="t-sys-UserTrivileges">User Privileges</a></li>
                        <li><a @class(['py-2']) href="javascript: void(0);" key="t-sys-User">User Setup</a></li>
                    </ul>
                </li>

                <li>
                    <a @class(['pt-1', 'pb-2', 'has-arrow', 'waves-effect' ]) href="javascript: void(0);">
                        <i @class(['mdi', 'mdi-application-cog' ])></i>
                        <span key="t-aml-setup">System Setup</span>
                    </a>
                    <ul aria-expanded="false" @class(['sub-menu'])>
                        <li><a @class(['py-2']) href="/aml/risk-countries"     key="t-aml-setup-riskcountries">Risk Countries</a></li>
                        <li><a @class(['py-2']) href="/aml/risk-level"         key="t-aml-setup-tisklevel">Risk Level</a></li>
                        <li><a @class(['py-2']) href="/aml/risk-customer-role" key="t-aml-setup-customerroles">Customer Roles</a></li>
                        <li><a @class(['py-2']) href="/aml/resources"          key="t-aml-setup-resources">Sanction Resource</a></li>
                    </ul>
                </li>
                <li>
                    <a @class(['pt-1', 'pb-2', 'has-arrow', 'waves-effect' ]) href="javascript: void(0);">
                        <i @class(['mdi', 'mdi-application-cog' ])></i>
                        <span key="t-aml-sanction">Sanction Maintenance</span>
                    </a>
                    <ul aria-expanded="false" @class(['sub-menu'])>
                        <li><a @class(['py-2']) href="/aml/sanction-onboard" key="t-aml-sanction-onboardscanning">Onboard Scanning</a></li>
                        <li><a @class(['py-2']) href="/aml/sanction-blacklist" key="t-aml-sanction-blacklist">Blacklist</a></li>
                        <li><a @class(['py-2']) href="/aml/sanction-watchlist" key="t-aml-sanction-watchlist">Watchlist</a></li>
                        <li><a @class(['py-2']) href="/aml/sanction-whitelist" key="t-aml-sanction-whitelist">Whitelist</a></li>
                    </ul>
                </li>

                <li>
                    <a @class(['pt-1', 'pb-2', 'waves-effect']) href="javascript: void(0);">
                        <i @class(['bx', 'bxs-report' ])></i>
                        <span key="t-aml-customeralert">Customer Alert</span>
                    </a>
                </li>
                
                <li>
                    <a @class(['pt-1', 'pb-2', 'waves-effect']) href="javascript: void(0);">
                        <i @class(['bx', 'bxs-report' ])></i>
                        <span key="t-reporting">Reporting</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>