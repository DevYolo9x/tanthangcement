<?php
return [
    //Quản lý chuyên gia
    'experts' => [
        'title' => "Quản lý Chuyên gia",
        'route' => 'experts.index',
        'can' => 'experts_index',
        'menu' => ['experts'],
        'dropdown' => true,
        'active' => true

    ],
    //Khách hàng
    'customers' => [
        'title' => ' Quản lý khách hàng',
        'data' => [
            'customer_categories' =>  [
                'title' => 'Nhóm khách hàng',
                'can' => 'customer_categories',
                'route' => 'customer_categories.index',
                'menu' => ['customer-categories'],
                'dropdown' => false,
                'active' => true
            ],
            'customers' =>  [
                'can' => 'customers',
                'route' => 'customers.index',
                'menu' => ['customers', 'customers/order/index'],
                'dropdown' => true,
                'active' => true
            ],
            'customer_logs' =>  [
                'can' => 'customer_logs',
                'route' => 'customer_logs.index',
                'menu' => ['customer-logs'],
                'dropdown' => true,
                'active' => true
            ],
        ]
    ],
    
    //Bài viết
    'articles' => [
        'title' => 'Quản lý Bài viết',
        'data' => [
            'category_articles' =>  [
                'can' => 'category_articles',
                'route' => 'category_articles.index',
                'menu' => ['category-articles'],
                'dropdown' => true,
                'active' => true
            ],
            'articles' =>  [
                'can' => 'articles',
                'route' => 'articles.index',
                'menu' => ['articles'],
                'dropdown' => true,
                'active' => true
            ],
        ]
    ],
    
    //Bệnh nhân
    'patients' => [
        'title' => 'Quản lý Bệnh nhân',
        'data' => [
            'patients' =>  [
                'can' => 'patients_index',
                'route' => 'patients.index',
                'menu' => ['patients'],
                'dropdown' => true,
                'active' => true
            ],
            /*
            'patients_log' => [
                'title' => 'Log',
                'can' => 'patients_index',
                'route' => 'patients.log',
                'menu' => ['patients-log'],
                'dropdown' => false,
                'active' => true
            ],*/
        ]
    ],

    'patient_payments' => [
        'title' => 'Đơn hàng đại lý',
        'can' => 'patient_payments',
        'route' => 'patient_payments.index',
        'menu' => ['patient_payments'],
        'dropdown' => false,
        'active' => true
    ],

    // Câu hỏi
    'questions' => [
        'title' => 'Quản lý Câu hỏi',
        'data' => [
            'category_questions' =>  [
                'can' => 'category_questions',
                'route' => 'category_questions.index',
                'menu' => ['category-questions'],
                'dropdown' => true,
                'active' => true
            ],
            'questions' =>  [
                'can' => 'questions',
                'route' => 'questions.index',
                'menu' => ['questions'],
                'dropdown' => true,
                'active' => true
            ],
        ]
    ],
    //Sản phẩm
    'products' => [
        'title' => "Quản lý sản phẩm",
        'data' => [
            //Danh mục sản phẩm
            'category_products' => [
                'can' => 'category_products_index',
                'route' => 'category_products.index',
                'menu' => ['category-products'],
                'dropdown' => true,
                'active' => true
            ],
            //Sản phẩm
            'products' => [
                'can' => 'products_index',
                'route' => 'products.index',
                'menu' => ['products'],
                'dropdown' => true,
                'active' => true

            ],
            //'Sản phẩm - Nhập hàng'
            'product_purchases' => [
                'can' => 'product_purchases_index',
                'route' => 'product_purchases.index',
                'menu' => ['product-purchases'],
                'dropdown' => true,
                'active' => true

            ],
            //Thương hiệu
            'brands' => [
                'can' => 'brands_index',
                'route' => 'brands.index',
                'menu' => ['brands'],
                'dropdown' => true,
                'active' => true
            ],
            //Nhà cung cấp'
            'suppliers' => [
                'can' => 'suppliers_index',
                'route' => 'suppliers.index',
                'menu' => ['suppliers', 'suppliers-categories'],
                'dropdown' => true,
                'active' => true
            ],
            //Nhóm nhà cung cấp'
            'suppliers_categories' => [
                'can' => 'suppliers_categories',
                'route' => 'suppliers_categories.index',
                'menu' => ['suppliers-categories'],
                'dropdown' => true,
                'active' => false
            ],
            // 'Sản phẩm mua kèm'
            'product_deals' => [
                'can' => 'product_deals',
                'route' => 'product_deals.index',
                'menu' => ['product-deals'],
                'dropdown' => true,
                'active' => true
            ],
            // Mã giảm giá
            'coupons' => [
                'can' => 'coupons',
                'route' => 'coupons.index',
                'menu' => ['coupons'],
                'dropdown' => true,
                'active' => true
            ]
        ]
    ],
    //Thuộc tính
    'attributes' => [
        'title' => "Quản lý Thuộc tính",
        'data' => [
            'category_attributes' => [
                'title' => 'Nhóm thuộc tính',
                'can' => 'category_attributes_index',
                'route' => 'category_attributes.index',
                'menu' => ['category-attributes'],
                'dropdown' => true,
                'active' => true
            ],
            'attributes' => [
                'title' => 'Danh sách',
                'can' => 'attributes',
                'route' => 'attributes.index',
                'menu' => ['attributes'],
                'dropdown' => true,
                'active' => true
            ],

        ]
    ],

    //Đơn hàng
    'orders' => [
        'title' => "Quản lý Đơn hàng",
        'data' => [
            'orders' => [
                'title' => 'Danh sách đơn hàng',
                'can' => 'orders_index',
                'route' => 'orders.index',
                'menu' => ['orders'],
                'dropdown' => true,
                'active' => true
            ],
            // 'orders_returns' => [
            //     'title' => 'Hoàn/trả hàng',
            //     'route' => 'orders.returns',
            //     'menu' => ['orders-returns'],
            //     'dropdown' => false,
            //     'active' => true
            // ],
            //Lịch sử thanh toán
            'orders_payment' => [
                'title' => 'Lịch sử thanh toán',
                'can' => 'orders_payment',
                'route' => 'orders.payment',
                'menu' => ['orders-payment'],
                'dropdown' => true,
                'active' => true
            ],
        ]
    ],
    //Sổ quỹ
    'receipt_vouchers' => [
        'title' => "Sổ quỹ",
        'data' => [
            //Phiếu thu
            'receipt_vouchers' => [
                'title' => 'Phiếu thu',
                'can' => 'receipt_vouchers_index',
                'route' => 'receipt_vouchers.index',
                'menu' => ['receipt-vouchers', 'receipt-groups'],
                'dropdown' => true,
                'active' => true
            ],
            'receipt_groups' => [
                'can' => 'receipt_groups_index',
                'route' => 'receipt_groups.index',
                'menu' => ['receipt-vouchers', 'receipt-groups'],
                'dropdown' => false,
                'active' => false
            ],
            //Phiếu chi
            'payment_vouchers' => [
                'title' => 'Phiếu chi',
                'can' => 'payment_vouchers',
                'route' => 'payment_vouchers.index',
                'menu' => ['payment-vouchers', 'payment-groups'],
                'dropdown' => true,
                'active' => true
            ],
            'payment_groups' => [
                'can' => 'payment_groups_index',
                'route' => 'payment_groups.index',
                'menu' => ['payment-vouchers', 'payment-groups'],
                'dropdown' => false,
                'active' => false
            ],
        ]
    ],


    //Media
    'media' => [
        'title' => "Quản lý Media",
        'data' => [
            'category_media' => [
                'title' => 'Danh mục media',
                'can' => 'category_media_index',
                'route' => 'category_media.index',
                'menu' => ['category-media'],
                'dropdown' => true,
                'active' => true
            ],
            'media' => [
                'title' => 'Danh sách',
                'can' => 'media',
                'route' => 'media.index',
                'menu' => ['media'],
                'dropdown' => true,
                'active' => true
            ],

        ]
    ],
    //Quản lý Trang
    'pages' => [
        'title' => "Quản lý Trang",
        'route' => 'pages.index',
        'can' => 'pages_index',
        'menu' => ['pages'],
        'dropdown' => true,
        'active' => true

    ],
    
    //Quản lý Trang
    'examinations' => [
        'title' => "Quản lý Tra cứu",
        'route' => 'examinations.index',
        'can' => 'examinations_index',
        'menu' => ['examinations'],
        'dropdown' => true,
        'active' => true

    ],
    
    //Liên hệ
    'contacts' => [
        'title' => "Quản lý Liên hệ",
        'data' => [
            /*
            'contacts' => [
                'title' => 'Danh sách liên hệ',
                'can' => 'contacts_index',
                'route' => 'contacts.index',
                'menu' => ['contacts'],
                'dropdown' => true,
                'active' => true
            ],*/
            'books' => [
                'title' => 'Đăng ký tư vấn',
                'can' => 'contacts_index',
                'route' => 'contacts.register',
                'menu' => ['register'],
                'dropdown' => false,
                'active' => true
            ],
            /*
            'schedule-sampling' => [
                'title' => 'Đặt lịch lấy mẫu',
                'can' => 'contacts_index',
                'route' => 'contacts.scheduleSampling',
                'menu' => ['schedule-sampling'],
                'dropdown' => false,
                'active' => true
            ],
            'schedule-an-appointment' => [
                'title' => 'Đặt lịch khám',
                'can' => 'contacts_index',
                'route' => 'contacts.scheduleAnAppointment',
                'menu' => ['schedule-an-appointment'],
                'dropdown' => false,
                'active' => true
            ],
            'subcribes' => [
                'title' => 'Danh sách đăng ký email',
                'can' => 'contacts_index',
                'route' => 'subscribers.index',
                'menu' => ['subscribers'],
                'dropdown' => false,
                'active' => true
            ],
            */
        ]
    ],
    //Tag
    'tags' => [
        'title' => "Quản lý Tag",
        'can' => 'tags_index',
        'route' => 'tags.index',
        'active' => true,
    ],
    //Quản lý Comment
    'comments' => [
        'title' => "Quản lý Comment",
        'data' => [
            'comments' => [
                'title' => 'Sản phẩm',
                'can' => 'comments_index',
                'route' => 'comments.index',
                'menu' => ['comments/index/products'],
                'dropdown' => true,
                'active' => true,
                'type' => 'products'
            ],
            'comments_article' => [
                'title' => 'Bài viết',
                'can' => 'comments_index',
                'route' => 'comments_articles.index',
                'menu' => ['comments/index/articles'],
                'dropdown' => false,
                'active' => true,
                'type' => 'articles'
            ],
        ]
    ],
    //Quản lý slide
    'slides' => [
        'title' => "Quản lý Banner & Slide",
        'can' => 'slides_index',
        'route' => 'slides.index',
        'active' => true,
    ],
    //Quản lý Menu
    'menus' => [
        'title' => "Quản lý Menu",
        'can' => 'menus_index',
        'route' => 'menus.index',
        'active' => true,
    ],
    //Quản lý thành viên
    'users' => [
        'title' => "Quản lý thành viên",
        'data' => [
            'users' => [
                'title' => 'Nhóm thành viên',
                'can' => 'roles_index',
                'route' => 'roles.index',
                'menu' => ['roles'],
                'dropdown' => true,
                'active' => true,
            ],
            'roles' => [
                'title' => 'Thành viên',
                'can' => 'users_index',
                'route' => 'users.index',
                'menu' => ['users'],
                'dropdown' => true,
                'active' => true,
            ],
        ]
    ],
    //Quản lý website
    'websites' => [
        'title' => "Quản lý website",
        'can' => 'websites_index',
        'route' => 'websites.index',
        'active' => true,
        'menu' => ['websites'],

    ],
];
