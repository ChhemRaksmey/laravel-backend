<div @class(['vertical-menu'])>
    <div @class(['h-100']) data-simplebar="">
        <div id="sidebar-menu">
            <ul @class(['metismenu', 'list-unstyled' ]) id="side-menu">
                
                <li @class(['menu-title']) key="t-menu">Menu</li>   

                <li>
                    <a @class(['pt-2', 'pb-2', 'has-arrow', 'waves-effect' ]) href="javascript: void(0);">
                        <i @class(['mdi', 'mdi-application-cog' ])></i>
                        <span key="t-dashboards">Fixed Asset Setup</span>
                    </a>
                    <ul aria-expanded="false" @class(['sub-menu'])>
                        <li><a @class(['py-2']) href="/fas/accounts/list"  key="t-fas-accounts">Accounts</a></li>
                        <li><a @class(['py-2']) href="/fas/models/list"    key="t-fas-models">Models</a></li>
                        <li><a @class(['py-2']) href="/fas/suppliers/list" key="t-fas-supplier">Suppliers</a></li>
                    </ul>
                </li>

                <li>
                    <a @class(['pt-2', 'pb-2', 'has-arrow', 'waves-effect' ]) href="javascript: void(0);">
                        <i @class(['mdi', 'mdi-folder-cog-outline' ])></i>
                        <span key="t-fas-gdt">GDT</span>
                    </a>
                    <ul aria-expanded="false" @class(['sub-menu'])>
                        <li><a @class(['py-2']) href="/fas/gdt/account/list"  key="t-fas-gdt-accounts">Account</a></li>
                        <li><a @class(['py-2']) href="/fas/gdt/exchange/list" key="t-fas-gdt-exchange">Yearly Exchange</a></li>
                        <li><a @class(['py-2']) href="/fas/gdt/asset/list"    key="t-fas-gdt-asset">Asset</a></li>
                    </ul>
                </li>

                <li>
                    <a @class(['pt-2', 'pb-2', 'waves-effect']) href="/fas/recived/list">
                        <i @class(['mdi', 'mdi-application-import' ])></i>
                        <span key="t-fas-recived">Recived Assets</span>
                    </a>
                </li>
                <li>
                    <a @class(['pt-2', 'pb-2', 'waves-effect']) href="/fas/booking/list">
                        <i @class(['mdi', 'mdi-file-plus-outline' ])></i>
                        <span key="t-fas-booking">Booking</span>
                    </a>
                </li>
                <li>
                    <a @class(['pt-2', 'pb-2', 'waves-effect']) href="/fas/transfer/list">
                        <i @class(['mdi', 'mdi-bank-transfer' ])></i>
                        <span key="t-fas-transfer">Transfer</span>
                    </a>
                </li>
                <li>
                    <a @class(['pt-2', 'pb-2', 'waves-effect']) href="/fas/disposal/list">
                        <i @class(['fas', 'fa-trash-restore-alt' ])></i>
                        <span key="t-fas-disposal">Disposal</span>
                    </a>
                </li>
                <li>
                    <a @class(['pt-2', 'pb-2', 'waves-effect']) href="/fas/reverse/list">
                        <i @class(['dripicons-time-reverse' ])></i>
                        <span key="t-fas-reverse">Reverse</span>
                    </a>
                </li>
                <li>
                    <a @class(['pt-2', 'pb-2', 'waves-effect']) href="/fas/to-innventory/list">
                        <i @class(['mdi', 'mdi-application-export' ])></i>
                        <span key="t-fas-toinventory">Assets To Inventory</span>
                    </a>
                </li>

                
                
                <li>
                    <a @class(['pt-2', 'pb-2', 'waves-effect']) href="javascript: void(0);">
                        <i @class(['bx', 'bxs-report' ])></i>
                        <span key="t-reporting">Reporting</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>