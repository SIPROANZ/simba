<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => '',
    'title_prefix' => 'SiproAPP | ',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>SIPRO</b>App',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo1.png',
    'logo_img_class' => 'brand-image img-circle elevation-5',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'SigANZ Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo1.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 80,
            'height' => 80,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo1.png',
            'alt' => 'SIPROapp Preloader Image',
            'effect' => 'animation__shake',
            'width' => 150,
            'height' => 150,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-success',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-dark',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-dark',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-dark navbar-dark',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-dark',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-dark',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // CENTRO DE GESTION
        ['header' => 'PANEL DE GESTION '],
        [
            'text'    => '   Administrar Sistema',
            'icon'    => '	fas fa-database',
            'icon_color' => 'success',
            
            'submenu' => [
                //SOLICITUDES
                [
                    'text'    => 'Solicitudes',
                    'icon'    => 'far fa-edit',
                    'icon_color' => 'warning',
                    'url'     => '#',
                    'can' => 'admin.solicitudes',
                    'submenu' => [
                        [
                            'text' => 'Requisiciónes',
                            'icon'    => 'fas fa-fw fa-tasks',
                            'icon_color' => 'white',
                            'route'  => 'requisiciones.index',
                            'can' => 'admin.solicitudes',
                           
                        ],
                        [
                            'text' => 'Tipos Requisiciones',
                            'icon'    => 'fas fa-fw fa-indent', //<i class="fas fa-indent"></i>
                            'icon_color' => 'white',
                            'route'  => 'tipossgps.index',
                            'can' => 'admin.solicitudes',
                        ],


                        [
                            'text' => 'Reportes De Requisiones ',
                            'icon'    => 'fas fa-file-import', 
                            'icon_color' => 'success',
                            'route'  => 'requisiciones.reportes',
                        ],

                                           
                                            
              

                    ],
                ],
                //<i class="fas fa-clipboard-check"></i>
                 //AYUDA SOCIAL <i class="fas fa-file-alt"></i> <i class="fas fa-tasks"></i><i class="fas fa-edit"></i>
                 [
                    'text'    => 'Ayuda Social',
                    'icon'    => '	fas fa-calendar-check', //<i class="fas fa-thumbs-up"></i>
                    'icon_color' => 'danger',
                    'url'     => '#',
                    'can' => 'admin.ayudas',
                    'submenu' => [
                        [
                            'text' => 'Ayudas Sociales',
                            'icon'    => 'fas fa-fw fa-clipboard-check',
                            'icon_color' => 'white',
                            'route'  => 'ayudassociales.index',
                            'can' => 'admin.ayudas',
                            
                        ],
                        [
                            'text' => 'Reporte De Ayudas Sociales',
                            'icon'    => 'fas fa-file-import',
                            'icon_color' => 'success',
                            'route'  => 'ayudassociales.reportes',
                            'can' => 'admin.ayudas',
                            
                        ],
                    ],
                ],

                //COMPRAS Y SERVICIOS
                [
                    'text'    => 'Compras y Servicios',
                    'icon'    => 'fas fa-wallet', //<i class="fas fa-dolly-flatbed"></i>
                    'icon_color' => 'lightblue',
                    'url'     => '#',
                    'can' => 'admin.analisis',
                    'submenu' => [
                        [
                            'text' => 'Analisis de Cotizaciones',
                            'icon'    => 'fas fa-fw fa-file-invoice', //<i class="fas fa-file-invoice"></i>
                            'icon_color' => 'white',
                            'route'  => 'analisis.index',
                            'can' => 'admin.analisis',
                        ],
                   /*     [
                            'text' => 'Detalles Analisis',
                            'icon'    => 'fas fa-fw fa-file-invoice', //<i class="fas fa-file-invoice"></i>
                            'icon_color' => 'white',
                            'route'  => 'detallesanalisis.index',
                        ], */
                        [
                            'text' => 'Criterios de Cotizacion',
                            'icon'    => 'fas fa-fw fa-file-signature', // <i class="fas fa-file-signature"></i>
                            'icon_color' => 'white',
                            'route'  => 'criterios.index',
                            'can' => 'admin.compras',
                        ],
                        [
                            'text' => 'Ordenes de Compras y Servicios',
                            'icon'    => 'fas fa-fw fa-file-invoice-dollar', //<i class="fas fa-file-invoice-dollar"></i>
                            'icon_color' => 'white',
                            'route'  => 'compras.index',
                            'can' => 'admin.compras',
                        ],
                         [
                            'text' => 'Reporte de Ordenes de Compras y Servicios',
                            'icon'    => 'fas fa-file-import', //<i class="fas fa-file-invoice-dollar"></i>
                            'icon_color' => 'success',
                            'route'  => 'compras.reportes',
                            'can' => 'admin.compras'
                        ], 
                    ],
                ],
                
   
                //COMPROMISOS
                [
                    'text' => 'Precompromisos',
                    'icon'    => 'fas fa-chalkboard-teacher', // <i class="fas fa-praying-hands"></i>
                    'icon_color' => 'primary',
                    'route'  => 'precompromisos.index',
                    'can' => 'admin.precompromisos',
                ],
                [
                    'text' => 'Reportes Precompromisos',
                    'icon'    => 'fas fa-file-import', 
                    'icon_color' => 'success',
                    'route'  => 'precompromisos.reportes',
                    'can' => 'admin.precompromisos',
                ],


                [
                    'text'    => 'Compromisos',
                    'icon'    => 'fas fa-hands-helping', //<i class="fab fa-readme"></i>
                    'icon_color' => 'warning',
                    'url'     => '#',
                    'can' => 'admin.compromisos',
                    'submenu' => [
                     
                        [
                            'text' => 'Compromisos',
                            'icon'    => 'fas fa-hands-helping', // <i class="fas fa-praying-hands"></i>
                            'icon_color' => 'white',
                            'route'  => 'compromisos.index',
                            'can' => 'admin.compromisos',
                            
                        ],
                        [
                            'text' => 'Tipos de Compromisos',
                            'icon'    => 'fas fa-fw fa-poll-h', //<i class="fas fa-poll-h"></i>
                            'icon_color' => 'white',
                            'route'  => 'tipodecompromisos.index',
                            'can' => 'admin.compromisos',
                        ],
                       
                        [
                            'text' => 'Reporte de Compromisos',
                            'icon'    => 'fas fa-file-import', //<i class="fas fa-indent"></i>
                            'icon_color' => 'success',
                            'route'  => 'compromisos.reportes',
                            'can' => 'admin.compromisos',
                        ],
                 
                    ],
                ],
                [
                    'text' => ' Ajuste De  Compromisos',
                    'icon'    => 'far fa-handshake', //<i class="fas fa-hammer"></i>
                    'icon_color' => 'info',
                    'route'  => 'ajustescompromisos.index',
                    'can' => 'admin.ajustecompromiso',
                ],

                //CAUSADO
                [
                    'text'    => ' Causado',
                    'icon'    => 'fas fa-paste', //<i class="fas fa-book-reader"></i>
                    'icon_color' => 'danger',
                    'url'     => '#',
                    'can' => 'admin.causados',
                    'submenu' => [
              
                        [
                            'text' => 'Ordenes de Pago',
                            'icon'    => 'fas fa-fw fa-briefcase', //<i class="fas "></i>
                            'icon_color' => 'white',
                            'route'  => 'ordenpagos.index',
                            'can' => 'admin.causados',
                        ],
                   
                        [
                            'text' => 'Retenciones',
                            'icon'    => 'fas fa-fw fa-clone', // <i class="fas fa-chalkboard-teacher"></i>
                            'icon_color' => 'white',
                            'route'  => 'retenciones.index',
                            'can' => 'admin.causados',
                        ],



                        [
                            'text' => 'Tipo de Retenciones',
                            'icon'    => 'fas fa-fw fa-clipboard-list', // <i class="fas fa-chalkboard-teacher"></i>
                            'icon_color' => 'white',
                            'route'  => 'tiporetenciones.index',
                            'can' => 'admin.causados',
                        ],
                        [
                            'text' => ' Reportes Ordenes de Pago',
                            'icon'    => 'fas fa-file-import', //<i class="fas "></i>
                            'icon_color' => 'success',
                            'route'  => 'ordenpagos.reportes',
                            'can' => 'admin.causados',
                        ],
              
                     
                   


                    ],
                ],

                 //PAGADO
                 [
                    'text'    => 'Pagado',
                    'icon'    => 'fas fa-fw fa-landmark', //<i class="fas fa-landmark"></i>
                    'icon_color' => 'info',
                    'url'     => '#',
                    'can' => 'admin.pagados',
                    'submenu' => [
                        [
                            'text' => 'Pagado',
                            'icon'    => 'fas fa-fw fa-donate', // <i class="fas fa-chalkboard-teacher"></i>
                            'icon_color' => 'white',
                            'route'  => 'pagados.index',
                            'can' => 'admin.pagados',
                        ],
  
    
                        [
                            'text' => 'Notas de Credito',
                            'icon'    => 'fas fa-fw fa-clipboard-list', // <i class="fas fa-chalkboard-teacher"></i>
                            'icon_color' => 'white',
                            'route'  => 'notasdecreditos.index',
                            'can' => 'admin.pagados',
                        ],
                  
                        [
                            'text' => 'Notas de Debito',
                            'icon'    => 'fas fa-fw fa-clipboard-check', // <i class="fas fa-chalkboard-teacher"></i>
                            'icon_color' => 'white',
                            'route'  => 'notasdedebitos.index',
                            'can' => 'admin.pagados',
                        ],
                        [
                            'text' => 'Transferencias',
                            'icon'    => 'fas fa-fw fa-atlas', // <i class="fas fa-chalkboard-teacher"></i>
                            'icon_color' => 'white',
                            'route'  => 'transferencias.index',
                            'can' => 'admin.pagados',
                        ],
                        [
                            'text' => 'Reporte De Notas De Credito',
                            'icon'    => 'fas fa-file-import', //<i class="fas fa-indent"></i>
                            'icon_color' => 'success',
                            'route'  => 'notasdecreditos.reportes',
                            'can' => 'admin.pagados',
                             ],
                        [
                            'text' => 'Reportes de Notas de Debito',
                            'icon'    => 'fas fa-file-import', // <i class="fas fa-chalkboard-teacher"></i>
                            'icon_color' => 'success',
                            'route'  => 'notasdedebitos.reportes',

                            'can' => 'admin.pagados',
                        ],
                        [
                            'text' => 'Reporte de Pagado',
                            'icon'    => 'fas fa-file-import', // <i class="fas fa-chalkboard-teacher"></i>
                            'icon_color' => 'success',
                            'route'  => 'pagados.reportes',
                            'can' => 'admin.pagados',
                        ],
            
                        [
                            'text' => 'Reportes de Transferencias',
                            'icon'    => 'fas fa-file-import', // <i class="fas fa-chalkboard-teacher"></i>
                            'icon_color' => 'success',
                            'route'  => 'transferencias.reportes',
                            'can' => 'admin.pagados',
                        ],
                        [
                            'text' => 'Transferencias entre cuentas',
                            'icon'    => 'fas fa-fw fa-align-justify', // <i class="fas fa-chalkboard-teacher"></i>
                            'icon_color' => 'white',
                            'route'  => 'transferenciaentrecuentas.index',
                            'can' => 'admin.pagados',
                        ],
   
                        //configuración
                        [
                            'text' => ' Configuración de Bancos',
                            'icon'    => 'fas fa-city',
                            'url'  => '#',
                            'submenu' => [
                                [
                                    'text' => 'Bancos',
                                    'icon'    => 'fas fa-city', // <i class="fas fa-chalkboard-teacher"></i>
                                    'icon_color' => 'white',
                                    'route'  => 'bancos.index',
                                    'can' => 'admin.bancos',
                                ],
                                [
                                    'text' => 'Cuentas Bancarias',
                                    'icon'    => 'fas fa-fw fa-check', // <i class="fas fa-chalkboard-teacher"></i>
                                    'icon_color' => 'white',
                                    'route'  => 'cuentasbancarias.index',
                                    'can' => 'admin.bancos',
                                ],
               
                                [
                                    'text' => 'Tipo de Movimiento Bancario',
                                    'icon'    => 'fas fa-fw fa-check', // <i class="fas fa-chalkboard-teacher"></i>
                                    'icon_color' => 'white',
                                    'route'  => 'tipomovimientos.index',
                                    'can' => 'admin.bancos',
                                ],


                            ],
                        ],

                    ],
                ],


            ],
        ],
        //EJECUCION
        ['header' => '  EJECUCION PRESUPUESTARIA',
        'can' => 'admin.ejecuciones',
        ],
        [
             'text' => 'Ejecución',
             'icon' => 'fas fa-chart-line', //<i class="far fa-calendar-check"></i>
             'icon_color' => 'success',
             'route'  => 'ejecuciones.index',
             'can' => 'admin.ejecuciones',
        ],

        [
            'text' => 'Beneficiarios', //<i class="fas fa-users"></i>
            'icon' => 'fas fa-street-view',
            'icon_color' => 'secondary',
            'route'  => 'beneficiarios.index',
            'can' => 'admin.beneficiarios',
        ],

        ['header' => 'CONFIGURACIÓN DEL SISTEMA'],
        //Configuracion
        [
            'text' => 'Configuración',
            'icon' => 'fa fa-cog',
            'icon_color' => 'success',
            'url'  => '#',
            'submenu' => [
                //Plan Operativo Anual
                    [
                    'text' => 'Plan Operativo Anual',
                    'icon' => 'fas fa-fw fa-sitemap',
                    'icon_color' => 'lightblue', //<i class="fas fa-sitemap"></i>
                    'url'  => '#',
                    'can' => 'admin.poa',
                    'submenu' => [
                        [
                            'text' => 'Plan Operativo Anual', //<i class="fas fa-calendar-alt"></i>
                            'icon'    => 'fas fa-fw fa-calendar-alt',
                            'icon_color' => 'white',
                            'route'  => 'poas.index',
                            'can' => 'admin.poa',
                        ],
                        [
                            'text' => 'Metas', //<i class="fas fa-calendar-alt"></i>
                            'icon'    => 'fas fa-fw fa-calendar-alt',
                            'icon_color' => 'white',
                            'route'  => 'metas.index',
                            'can' => 'admin.poa',
                        ],
                        [
                            'text' => 'Objetivos Históricos', //<i class="fas fa-hourglass"></i>
                            'icon'    => 'fas fa-fw fa-hourglass',
                            'icon_color' => 'white',
                            'route'  => 'objetivoshistoricos.index',
                            'can' => 'admin.poa',
                        ],
                        [
                            'text' => 'Objetivos Nacionales', //<i class="fas fa-balance-scale"></i>
                            'icon'    => 'fas fa-fw fa-balance-scale',
                            'icon_color' => 'white',
                            'route'  => 'objetivonacionales.index',
                            'can' => 'admin.poa',
                        ],
                        [
                            'text' => 'Objetivos Estrategicos', //<i class="fas fa-layer-group"></i>
                            'icon'    => 'fas fa-fw fa-layer-group',
                            'icon_color' => 'white',
                            'route'  => 'objetivosestrategicos.index',
                            'can' => 'admin.poa',
                        ],
                        [
                            'text' => 'Objetivos PEI', //<i class="fas fa-envelope-open-text"></i>
                            'icon'    => 'fas fa-fw fa-envelope-open-text',
                            'icon_color' => 'white',
                            'route'  => 'objetivopeis.index',
                            'can' => 'admin.poa',
                        ],
                        [
                            'text' => 'Objetivo municipales', //<i class="fas fa-poll-h"></i>
                            'icon'    => 'fas fa-fw fa-poll-h',
                            'icon_color' => 'white',
                            'route'  => 'objetivomunicipales.index',
                            'can' => 'admin.poa',
                        ],
                        [
                            'text' => 'Objetivo Generales', // <i class="fas fa-check-double"></i>
                            'icon'    => 'fas fa-fw fa-check-double',
                            'icon_color' => 'white',
                            'route'  => 'objetivogenerales.index',
                            'can' => 'admin.poa',
                        ],
                    ]
                ],

                //bos
                [
                    'text' => 'BOS ( Bienes , Obras, Servicios )',
                    'icon' => 'fas fa-fw fa-boxes', //<i class="fas fa-boxes"></i>
                    'icon_color' => 'lightblue',
                    'url'  => '#',
                    'can' => 'admin.bos',
                    'submenu' => [
                        [
                            'text' => 'BOS',
                            'icon' => 'fas fa-fw fa-box-open', //<i class="fas fa-box-open"></i>
                            'icon_color' => 'white',
                            'route'  => 'bos.index',
                            'can' => 'admin.bos',

                        ],
                        [
                            'text' => 'Tipo BOS',
                            'icon' => 'fas fa-fw fa-grip-horizontal', //<i class="fas fa-grip-horizontal"></i>
                            'icon_color' => 'white',
                            'route'  => 'tipobos.index',
                            'can' => 'admin.bos',
                        ],
                        [
                            'text' => 'Segmentos',
                            'icon' => 'fas fa-fw fa-layer-group', //<i class="fas fa-layer-group"></i>
                            'icon_color' => 'white',
                            'route'  => 'segmentos.index',
                            'can' => 'admin.bos',
                        ],
                        [
                            'text' => 'Familias',
                            'icon' => 'fas fa-fw fa-list-ul', //<i class="fas fa-list-ul"></i>
                            'icon_color' => 'white',
                            'route'  => 'familias.index',
                            'can' => 'admin.bos',
                        ],
                        [
                            'text' => 'Clases',
                            'icon' => 'fas fa-fw fa-solar-panel', //<i class="fas fa-solar-panel"></i>
                            'icon_color' => 'white',
                            'route'  => 'clases.index',
                            'can' => 'admin.bos',
                        ],
                        [
                            'text' => 'Productos',
                            'icon' => 'fas fa-fw fa-luggage-cart', //<i class="fas fa-luggage-cart"></i>
                            'icon_color' => 'white',
                            'route'  => 'productos.index',
                            'can' => 'admin.bos',
                        ],
                        [
                            'text' => 'Productos CP',
                            'icon' => 'fas fa-fw fa-box-open', //<i class="fas fa-box-open"></i>
                            'icon_color' => 'white',
                            'route'  => 'productoscps.index',
                            'can' => 'admin.bos',
                        ],
                        [
                            'text' => 'Unidades de Medida',
                            'icon' => 'fas fa-fw fa-people-carry', //<i class="fas fa-people-carry"></i>
                            'icon_color' => 'white',
                            'route'  => 'unidadmedidas.index',
                            'can' => 'admin.bos',
                        ],

                    ]
                ],

                    //Institucion, estado, municipio
               [
                    'text' => 'Instituciones',
                    'icon' => 'fas fa-fw fa-landmark', //<i class="fas fa-landmark"></i>
                            'icon_color' => 'lightblue',
                    'url'  => '#',
                    'can' => 'admin.instituciones',
                    'submenu' => [
                        [
                            'text' => 'Instituciones',
                            'icon' => 'fas fa-fw fa-landmark', //<i class="fas fa-people-carry"></i>
                            'icon_color' => 'white',
                            'route'  => 'instituciones.index',
                            'can' => 'admin.instituciones',
                        ],
                        [
                            'text' => 'Estados Del Pais',
                            'icon' => 'fas fa-fw fa-map-marked', //fa-map-marked
                            'icon_color' => 'white',
                            'route'  => 'estados.index',
                            'can' => 'admin.instituciones',
                        ],
                        [
                            'text' => 'Municipios Del Estado',
                            'icon' => 'fas fa-fw fa-map-marked-alt', //<i class="fas fa-map-marked-alt"></i>
                            'icon_color' => 'white',
                            'route'  => 'municipios.index',
                            'can' => 'admin.instituciones',
                        ],
                    ]
                ],

                [
                    'text' => 'Ejecución Presupuestaria',
                    'icon' => 'fas fa-fw fa-calendar-check', //<i class="fas fa-calendar-check"></i>
                    'icon_color' => 'lightblue',
                    'url'  => '#',
                    'can' => 'admin.ejecuciones',
                    'submenu' => [
 
                    [
                        'text' => 'Formular',
                        'icon' => 'fas fa-fw fa-landmark', //<i class="fas fa-landmark"></i>
                        'icon_color' => 'white',
                        'route'  => 'ejecuciones.formular',
                        'can' => 'admin.ejecuciones',
                    ],
                    [
                        'text' => 'Clasificador Presupuestario',
                        'icon' => 'fas fa-fw fa-chart-bar', //<i class="fas fa-chart-bar"></i>
                        'icon_color' => 'white',
                        'route'  => 'clasificadorpresupuestarios.index',
                        'can' => 'admin.ejecuciones',
                    ],
                    [
                        'text' => 'Ejercicio Fiscal',
                        'icon' => 'fas fa-fw fa-map-marked-alt', //<i class="fas fa-calendar-check"></i>
                        'icon_color' => 'white',
                        'route'  => 'ejercicios.index',
                        'can' => 'admin.ejecuciones',
                    ],
                    [
                        'text' => 'Financiamiento',
                        'icon' => 'fas fa-fw fa-landmark', //<i class="fas fa-landmark"></i>
                        'icon_color' => 'white',
                        'route'  => 'financiamientos.index',
                        'can' => 'admin.ejecuciones',
                    ],
                  /*  [
                        'text' => 'Iniciar Proceso de Ejecución',
                        'icon' => 'fas fa-fw fa-play-circle', //<i class="fas fa-play-circle"></i>
                        'icon_color' => 'white',
                        'url'  => '#',
                    ], */
                    ]
                ],


                [
                    'text' => 'Unidad Administrativa',
                    'icon' => 'fas fa-fw fa-building', //<i class="fas fa-map-marked-alt"></i>
                    'icon_color' => 'lightblue',
                    'route'  => 'unidadadministrativas.index', //<i class="fas fa-building"></i>
                    'can' => 'admin.ejecuciones',
                ],

                [
                    'text' => 'configuraciones',
                    'icon' => 'fas fa-cogs', //<i class="fas fa-map-marked-alt"></i>
                    'icon_color' => 'success',
                    'route'  => 'configuraciones.index', //<i class="fas fa-building"></i>
                    'can' => 'admin.administrador',
                ],


            ],
        ],

         //Modificaciones Presupuestarias
         //Seguridad
         [
             'text' => 'Modificación Presupuestaria',
             'icon' => 'fa fa-fw fa-edit',
             'icon_color' => 'warning',
            'url'  => '#',
            'can' => 'admin.modificacionpresupuestaria',
            'submenu' => [
                [
                    'text'       => 'Realizar Modificación',
                    'icon' => 'fa fa-fw fa-edit',
                    'icon_color' => 'primary',
                    'route'  => 'modificaciones.index',
                    'can' => 'admin.modificacionpresupuestaria',
                ],
                [
                    'text' => 'Tipo de Modificación',
                    'icon' => 'fa fa-fw fa-check',
                    'icon_color' => 'primary',
                    'route'  => 'tipomodificaciones.index',
                    'can' => 'admin.modificacionpresupuestaria',
                ],
              
            ],
        ],


         //Fin
         



    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
