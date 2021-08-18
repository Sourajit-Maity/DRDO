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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'title' => 'CAS-DRDO',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'logo' => '<b><i>CAS-DRDO</i></b>',
    'logo_img' => 'vendor/adminlte/dist/img/RR-logo.png', 
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'CAS-DRDO',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => true,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-light-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-blue navbar-dark',
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => '/',
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
    |
    */

 

   
    
    'menu' => [
        [
            'text' => 'search',
            'search' => false,
            'topnav' => false,
        ],
       
        
        // ['header' => 'account_settings'],
        [
            'text'    => 'Admin',
            'icon'    => 'fas fa-users-cog',
            'can'  => ['isSuperAdmin', 'isAdmin'],
            'submenu' => 
            [
                [                
                    'text'    => 'Configurations',
                    'icon'    => 'fas fa-users',
                    'url'     => '#',
                    'can'  => ['isSuperAdmin', 'isAdmin'],
                    'shift'   => 'ml-2',

                    'submenu' => 
                    [
                        [
                            'text' => 'District/State',
                            'icon'    => 'fas fa-globe-asia',
                            'url'     => '#',
                            'shift'   => 'ml-3',
                            'submenu' => 
                            [
                                                       
                                
                                                
                                [
                                    'text' => 'District',
                                    'icon'    => 'fas fa-award',
                                    'url'  => 'view-district',
                                    'shift'=> 'ml-4',
                                    
                                ], 
                                [
                                    'text' => 'State',
                                    'icon'    => 'fas fa-award',
                                    'url'  => 'view-state',
                                    'shift'=> 'ml-4',
                                    
                                ], 
                              
                            ],      
                        ],
                                              
                         [                
                            'text'    => 'Organization',
                            'icon'    => 'fas fa-building',
                            'url'     => 'view-company',
                            'shift'   => 'ml-3',
                                           
                        ],
                        [                
                            'text'    => 'Feedback Master',
                            'icon'    => 'fas fa-building',
                            'url'     => 'all-feedback',
                            'shift'   => 'ml-3',
                                           
                        ],
                        [
                            'text' => 'Assets',
                            'icon'    => 'fas fa-award',
                            'url'     => 'view-assets',
                            'shift'   => 'ml-3',
                        ],
                        [
                            'text' => 'Subject',
                            'icon'    => 'fas fa-award',
                            'url'     => 'view-subject',
                            'shift'   => 'ml-3',
                        ],
                       
                        [                
                            'text'    => 'Job',
                            'icon'    => 'fas fa-user-md',
                            'url'     => '#',
                            'shift'   => 'ml-3',
                            'submenu' => 
                            [
                                                      
                              
                                [
                                    'text' => 'Employment Type',
                                    'icon'    => 'fas fa-user-md',
                                    'url'  => 'view-employee-type',
                                    'shift'=> 'ml-4',
                                    
                                ],                  
                               
                                [
                                    'text' => 'Work Shifts',
                                    'icon'    => 'fas fa-business-time',
                                    'url'  => 'view-workshift',
                                    'shift'=> 'ml-4',
                                    
                                ], 
                            ],                    
                           
                        ], 
                        [
                            'text' => 'Qualification',
                            'icon'    => 'fas fa-user-graduate',
                            'url'     => '#',
                            'shift'   => 'ml-3',
                            'submenu' => 
                            [
                                                       
                                
                                                
                                [
                                    'text' => 'Education',
                                    'icon'    => 'fas fa-book-open',
                                    'url'  => 'view-education',
                                    'shift'=> 'ml-4',
                                    
                                ], 
                                [
                                    'text' => 'Skills',
                                    'icon'    => 'fas fa-award',
                                    'url'  => 'view-skills',
                                    'shift'=> 'ml-4',
                                    
                                ], 
                            ],      
                        ], 
                        [
                            'text' => 'Religions',
                            'icon'    => 'fas fa-praying-hands',
                            'url'     => 'all-religion',
                            'shift'   => 'ml-3',
                        ],
                        [
                            'text' => 'Nationalities',
                            'icon'    => 'fas fa-globe-asia',
                            'url'     => 'all-nationality',
                            'shift'   => 'ml-3',
                        ],
                        [
                            'text' => 'Language',
                            'icon'    => 'fas fa-praying-hands',
                            'url'     => 'view-language',
                            'shift'   => 'ml-3',
                        ], 
                      
                        [
                            'text' => 'Bank',
                            'icon'    => 'fas fa-praying-hands',
                            'url'     => 'view-banks',
                            'shift'   => 'ml-3',
                        ],  
                        [
                            'text' => 'Advance Type',
                            'icon'    => 'fas fa-praying-hands',
                            'url'     => 'view-advancetype',
                            'shift'   => 'ml-3',
                        ], 
                        [
                            'text' => 'Grade Master',
                            'icon'    => 'fas fa-praying-hands',
                            'url'     => 'view-grade-master',
                            'shift'   => 'ml-3',
                        ], 
                        [
                            'text' => 'Vaccine Master',
                            'icon'    => 'fas fa-praying-hands',
                            'url'     => 'view-vaccine-master',
                            'shift'   => 'ml-3',
                        ], 
                        [
                            'text' => 'Cadre Master',
                            'icon'    => 'fas fa-praying-hands',
                            'url'     => 'view-jobtype',
                            'shift'   => 'ml-3',
                        ], 
                        [
                            'text' => 'Salary Slab',
                            'icon'    => 'fas fa-praying-hands',
                            'url'     => 'view-salary-slab',
                            'shift'   => 'ml-3',
                        ], 
                        [
                            'text' => 'Leave Configure',
                            'icon' => 'fas fa-level-down-alt',
                            'url'  => '#',
                            'shift'=> 'ml-3',
                            'submenu' => 
                            [
                                [
                                    'text' => 'Leave Period',
                                    'icon'    => 'fas fa-sign-out-alt',
                                    'url'  => 'view-leave-period',
                                    'shift'=> 'ml-4',
                                    
                                ],                        
                                [
                                    'text' => 'Leave Type',
                                    'icon'    => 'fas fa-sign-out-alt',
                                    'url'  => 'view-leave-type',
                                    'shift'=> 'ml-4',
                                        
                                ],
                                [
                                    'text' => 'Leave Concession Type',
                                    'icon'    => 'fas fa-praying-hands',
                                    'url'     => 'view-leave-travel-concession-type',
                                    'shift'   => 'ml-4',
                                ], 
                                [
                                    'text' => 'Entitlements',
                                    'icon'    => 'fas fa-binoculars',
                                    'url'  => 'view-leave-entitlement',
                                    'shift'=> 'ml-4',
                                    
                                 ], 
                                 [
                                    'text' => 'Ta/Da Entitlements',
                                    'icon'    => 'fas fa-binoculars',
                                    'url'  => 'view-tadaentitlement',
                                    'shift'=> 'ml-4',
                                    
                                 ],
                                 [
                                    'text' => 'Travel Details',
                                    'icon'    => 'fas fa-binoculars',
                                    'url'  => 'view-crm',
                                    'shift'=> 'ml-4',
                                    
                                 ],
                                [
                                    'text' => 'Work week',
                                    'icon'    => 'fas fa-binoculars',
                                    'url'  => 'view-work-week',
                                    'shift'=> 'ml-4',
                                    
                                ], 
                                [
                                  'text' => 'Holidays',
                                  'icon'    => 'fas fa-binoculars',
                                  'url'  => 'view-holiday',
                                  'shift'=> 'ml-4',
                                  
                              ],                        
                                
                            ],  
                            
                        ],   
                          
                                     
                        
                    ],                    
                   
                ],
            
                [                
                    'text'    => 'User Management',
                    'icon'    => 'fas fa-users',
                    'url'     => '#',
                    'can'  => ['isSuperAdmin', 'isAdmin'],
                    'shift'   => 'ml-2',

                    'submenu' => 
                    [
                        [
                            'text' => 'User',
                            'icon'    => 'fas fa-user',
                            'url'  => 'view-user',
                            'shift'=> 'ml-3',
                            
                        ], 
                                              
                        [
                            'text' => 'Designation',
                            'icon'    => 'fas fa-user-tag',
                            'url'  => 'view-role',
                            'shift'=> 'ml-3',
                                
                        ],
                        [
                            'text' => 'Job Role',
                            'icon'    => 'far fa-user-circle',
                            'url'  => 'view-sub-role',
                            'shift'=> 'ml-3',
                            
                        ],                        
                        
                    ],                    
                   
                ],
                [
                    'text' => 'Employee List',
                    'icon'    => 'fas fa-street-view',
                    'url'  => 'view-employee',
                    'can'  => ['isSuperAdmin', 'isAdmin'],
                    'shift'=> 'ml-2',
                    
                ],  
                
          
            ],
        ],
        [
            'text'    => 'e-Service Book',
            'icon'    => 'fas fa-users-cog',
            
            'submenu' => 
            [
                        [
                            'text' => 'Personal Information',
                            'url'  => 'view-employee',
                            'icon' => 'fas fa-info-circle',
                            'shift'   => 'ml-2',
                        
                        ],
                        [
                            'text' => 'PIM',
                            'url'  => 'add-info-tab',
                            'icon' => 'fas fa-info-circle',
                            'shift'   => 'ml-2',
                           
                        ],
                        [
                            'text' => 'Nomination/Insurance',
                            'url'  => '#',
                            'icon' => 'fas fa-business-time',
                            'shift'   => 'ml-2',
                            'submenu' => 
                            [   
                                            
                                [
                                      'text' => 'Nomination Insurance',
                                      'icon'    => 'fas fa-sign-out-alt',
                                      'url'  => 'view-addnominationinsurance',
                                      
                                      'shift'=> 'ml-3',
                                      
                                  ],  
                               
                                  [
                                    'text' => 'Group Insurance',
                                    'icon' => 'fas fa-level-down-alt',
                                    'url'  => 'view-addinsurance',
                                    'shift'=> 'ml-3',
                                    
                                ],   
                   
                          ],
                           
                        ],
                        [
                            'text' => 'Leave Record',
                            'icon' => 'fas fa-level-down-alt',
                            'url'  => 'leave',
                            'shift'=> 'ml-2',
                            
                          ], 
                          [
                            'text' => 'Leave Travel Details',
                            'icon' => 'fas fa-level-down-alt',
                            'url'  => 'view-leave-travel-apply',

                            'shift'=> 'ml-2',
                            
                          ], 
                        [
                            'text' => 'Attendance',
                            'icon'    => 'fas fa-globe-asia',
                            'url'     => 'my-attandance',
                            'shift'   => 'ml-2',
                                  
                        ],
                                         
                       
                        [                
                            'text'    => 'Feedback',
                            'icon'    => 'fas fa-building',
                            'url'     => 'my-feedback',
                            'shift'   => 'ml-2',
                                           
                        ],
                        
                        [                
                            'text'    => 'All Feedbacks',
                            'icon'    => 'fas fa-building',
                            'can'  => ['isSuperAdmin', 'isAdmin'],
                            'url'     => 'view-all-employee-feedback',
                            'shift'   => 'ml-2',
                                           
                        ],
                        [
                            'text' => 'Warning Letter',
                            'icon'    => 'fas fa-award',
                            'url'     => 'my-warning',
                            'shift'   => 'ml-2',
                        ],

                    ],                    
                   
                ], 
       
        [
            'text' => 'Organization Structure',
            'url'  => 'my-team',
            'icon' => 'fas fa-business-time',
           
        ],
        [
            'text' => 'Vaccination Details',
            'url'  => 'view-vaccine-employee',
            'icon' => 'fas fa-business-time',
           
        ],


       
        [
            'text' => 'TA-DA',
            'url'  => '#',
            'icon' => 'fas fa-level-down-alt',
            'submenu' => 
            
                [   
                                
                    [
                          'text' => 'Apply TA-DA',
                          'icon' => 'fas fa-level-down-alt',
                          'url'  => 'add-employeetada',
                          'shift'=> 'ml-2',
                          
                      ],  
                      [
                        'text' => 'TA-DA Details',
                        'icon' => 'fas fa-level-down-alt',
                        'url'  => 'view-employeetada',
                       // 'can'  => ['isSuperAdmin', 'isAdmin'],
                        'shift'=> 'ml-2',
                        
                      ],                         
                  
                                     
                      [
                          'text' => 'Employee TA-DA',
                          'icon' => 'fas fa-level-down-alt',
                          'url'  => '#',
                          'can'  => ['isSuperAdmin', 'isAdmin',],
                          'shift'=> 'ml-2',
                          'submenu' => 
                          [
                            [
                                'text' => 'Employee TA-DA List',
                                'icon' => 'fas fa-sign-out-alt',
                                'url'  => 'view-employeetada',
                                'can'  => ['isSuperAdmin', 'isAdmin'],
                                'shift'=> 'ml-3',
                                
                            ],                        
                    
                            
                        ],  
                          
                      ], 

              ],
   
        ],
        [
            'text' => 'Leave Management',
            'url'  => '#',
            'icon' => 'fas fa-level-down-alt',
            'submenu' => 
            
                [   
                                
                    [
                          'text' => 'Apply Leave Travel',
                          'icon' => 'fas fa-level-down-alt',
                          'url'  => 'add-leave-travel-apply',
                          'shift'=> 'ml-2',
                          
                      ], 
                      [
                        'text' => 'Apply Leave',
                        'icon' => 'fas fa-level-down-alt',
                      
                        'url'  => 'leave/create',
                        'shift'=> 'ml-2',
                        
                    ],  
                      [
                      //  'text' => 'Leave Travel Details',
                       // 'icon' => 'fas fa-level-down-alt',
                       // 'url'  => 'view-leave-travel-apply',
                       // 'can'  => ['isSuperAdmin', 'isAdmin'],
                       // 'shift'=> 'ml-2',
                        
                      ],                         

              ],
   
        ],
        [
            'text' => 'Claim Apply Details',
            'url'  => 'view-employeeclaim',
            'icon' => 'fas fa-business-time',
           
        ],
        [
            'text' => 'Certificate Attestation',
            'url'  => 'view-certificateattestation',
            'icon' => 'fas fa-business-time',
           
        ],
        [
            'text' => 'Nomination Certificate',
            'url'  => 'view-employee-nomini',
            'icon' => 'fas fa-business-time',
           
        ],
        [
            'text' => 'Service Details',
            'url'  => 'view-servicedetails',
            'icon' => 'fas fa-business-time',
           
        ],

        [
            'text' => 'Attendance',
            'url'  => '#',
            'icon' => 'fas fa-business-time',
            'submenu' => 
            [   
                            
                [
                      'text' => 'Check Out',
                      'icon'    => 'fas fa-sign-out-alt',
                      'url'  => 'my-attandance-checkout',
                      
                      'shift'=> 'ml-2',
                      
                  ],  
               
                  [
                    'text' => 'Daily Attendance',
                    'icon' => 'fas fa-level-down-alt',
                    'url'  => 'my-attandance',
                    'shift'=> 'ml-2',
                    
                ],   
   
          ],
           
        ],
        [
            'text' => 'Reports',
            'url'  => 'view-all-doc',
            'icon' => 'fas fa-business-time',
           
        ],
        [
            'text' => 'DGP',
            'url'  => '#',
            'icon' => 'fas fa-business-time',
           
        ],

          
                [
                    'text' => 'Salary',
                    'url'  => '#',
                    
                    'icon' => 'fas fa-level-down-alt',
                    'submenu' => 
                    
                        [   
                            [
                                'text' => 'My Salary',
                                'url'  => 'my-salary',
                                'icon' => 'fas fa-info-circle',
                                'shift'=> 'ml-2',
                               
                            ],
                            [
                                'text' => 'Remuneration',
                                'url'  => 'my-remuneration',
                                'icon' => 'fas fa-business-time',
                                'shift'=> 'ml-2',
                               
                            ],
                            [
                                'text' => 'Employee Salary',
                                //'url'  => 'view-salary-details',
                                'url'  => 'view-all-salary',
                                'can'  => ['isSuperAdmin', 'isAdmin'],
                                'icon' => 'fas fa-info-circle',
                                'shift'=> 'ml-2',
                               
                            ], 

                      ],
         
                ],
       
      
       
        [
            'text' => 'Notification',
            'url'  => '#',
            'icon' => 'fas fa-info-circle',
            'submenu' => 
            [   
                            
                [
                      'text' => 'All Notification',
                      'icon' => 'fas fa-level-down-alt',
                      'url'  => 'view-all-notification',
                      'can'  => ['isSuperAdmin', 'isAdmin'],
                      'shift'=> 'ml-2',
                      
                  ],  
                  [
                    'text' => 'New Notification',
                    'icon' => 'fas fa-level-down-alt',
                    'url'  => 'view-new-notification',
                    'can'  => ['isSuperAdmin', 'isAdmin'],
                    'shift'=> 'ml-2',
                    
                ], 
                  
   
          ],
           
        ],
        [
            'text' => 'Announcement',
            'url'  => '#',
            'can'  => ['isSuperAdmin', 'isAdmin'],
            'icon' => 'fas fa-info-circle',
            'submenu' => 
            [   
                            
                [
                      'text' => 'Announcement',
                      'icon' => 'fas fa-level-down-alt',
                      'url'  => 'view-announcements',
                      'can'  => ['isSuperAdmin', 'isAdmin'],
                      'shift'=> 'ml-2',
                      
                  ],  
  
          ],
           
        ],

     
       
        [
            'text'    => 'Activity',
            'icon'    => 'fas fa-users-cog',
            
            'submenu' => 
            [
                [
                    'text' => 'My Activity',
                    'url'  => '#',
                    'icon' => 'fas fa-business-time',
                    'shift'   => 'ml-2',
                    'submenu' => 
                    
                    [    
                        
                                    
                        [
                              'text' => 'View Feedback',
                              'icon' => 'fas fa-level-down-alt',
                              'can'  => ['isSuperAdmin', 'isAdmin','isClusterHead','isECRM','isBDM','isTeamLeader',''],
                              'url'  => 'given-feedback',
                              
                              'shift'=> 'ml-3',
                              
                          ],  
                          [
                            'text' => 'View Complain',
                            'icon' => 'fas fa-level-down-alt',
                            'url'  => 'given-complain',
                          
                            'shift'=> 'ml-3',
                            
                          ],    

                  ],
                   
                ],
                [
                    'text' => 'Employee Activity',
                    'url'  => '#',
                    'can'  => ['isSuperAdmin', 'isAdmin'],
                    'icon' => 'fas fa-business-time',
                    'shift'   => 'ml-2',
                    'submenu' => 
                    
                    [    
          
                        [
                              'text' => 'Employee Feedback',
                              'icon' => 'fas fa-level-down-alt',
                              'url'  => 'view-all-employee-feedback',
                              
                              'shift'=> 'ml-3',
                              
                          ],  
                          [
                            'text' => 'Employee Complain',
                            'icon' => 'fas fa-level-down-alt',
                            'url'  => 'view-complain',
                          
                            'shift'=> 'ml-3',
                            
                          ],                                 
                        [
                            'text' => 'Employee Warning',
                            'icon' => 'fas fa-level-down-alt',
                            'url'  => 'view-all-warning ',
                          
                            'shift'=> 'ml-3',
                            
                          ],           
                     
        
                  ],
                   
                ],
            
                [                
                    'text'    => 'Give Evaluation',
                    'icon'    => 'fas fa-users',
                    'url'     => '#',
                    
                    'shift'   => 'ml-2',

                    'submenu' => 
                    [
                                [
                                    'text' => 'Feedback',
                                    'icon'    => 'fas fa-user-md',
                                    'can'  => ['isSuperAdmin', 'isAdmin','isClusterHead','isECRM','isBDM','isTeamLeader',''],
                                    'url'  => 'add-employee-feedback',
                                    'shift'=> 'ml-3',
                                    
                                ],  
                             
                              [
                                'text' => 'Complain',
                                'url'  => '#',
                                'icon' => 'fas fa-level-down-alt',
                                'shift'=> 'ml-3',
                                'submenu' => 
                                
                                    [   
                                                    
                                        [
                                              'text' => 'Apply Complain',
                                              'icon' => 'fas fa-level-down-alt',
                                              'url'  => 'add-complain',
                                              'shift'=> 'ml-4',
                                              
                                          ],  
                                                                
                                     
                        
                                  ],
                               
                                
                            ],
       
                               
                    ],                    
                   
                ],
                
                
          
            ],
        ],
        

       
        [
            'text' => 'Projects',
            'url'  => 'view-project',
            'can'  => ['isSuperAdmin'],
            'icon' => 'fas fa-business-time',
           
        ],
        
        
      
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    */

    'livewire' => false,
];
