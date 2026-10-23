<!DOCTYPE html>
<html lang="en">
    <head>
        <x-partials.styles />
        @stack('styles')
    </head>

    <body @class(['vertical-enable']) data-keep-enlarged="true" data-sidebar="dark" data-bs-theme="light">
        
        <div id="layout-wrapper">

            <x-partials.naviagtion />
            <x-partials.sidebar />
        
            <div @class(['main-content'])>
                <div @class(['page-content'])>
                    <div @class(['container-fluid', 'font-size-12'])>
                        @yield('contents')
                    </div>
                </div>
            </div>

        </div>
        
        <div @class(['right-bar'])></div>
        
        <div @class(['rightbar-overlay'])></div>
        
        <x-partials.scripts />
        @stack('scripts')

    </body>
</html>
