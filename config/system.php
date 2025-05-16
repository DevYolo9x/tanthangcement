<?php
$data['homepage'] = array(
    'label' => 'Thông tin chung',
    'description' => 'Cài đặt đầy đủ thông tin chung của website. Tên thương hiệu website. Logo của website và icon website trên tab trình duyệt',
    'value' => array(
        'brandname' => array('type' => 'text', 'label' => 'Tên thương hiệu'),
        'company' => array('type' => 'text', 'label' => 'Tên công ty'),
        'logo' => array('type' => 'images', 'label' => 'Logo'),
        'logo_footer' => array('type' => 'images', 'label' => 'Logo footer'),
        'favicon' => array('type' => 'images', 'label' => 'Favicon'),
        //'copyright' => array('type' => 'editor', 'label' => 'Copyright'),
        'mst' => array('type' => 'editor', 'label' => 'Mã số thuế'),
        'address' => array('type' => 'textarea', 'label' => 'Danh sách địa điểm muốn thuê (Form đăng ký)'),
        //'footer_address' => array('type' => 'editor', 'label' => 'Địa chỉ chân trang'),
        //'bct' => array('type' => 'textarea', 'label' => 'Thông tin bộ công thương'),
        //'noidung' => array('type' => 'editor', 'label' => 'Chịu trách nhiệm nội dung'),
        // 'isMobile' => array('type' => 'dropdown', 'value' => ['0' => 'Tắt', '1' => 'Bật'], 'label' => 'Giới thiệu footer'),
    ),
);
$data['contact'] = array(
    'label' => 'Thông tin liên lạc',
    'description' => 'Cấu hình đầy đủ thông tin liên hệ giúp khách hàng dễ dàng tiếp cận với dịch vụ của bạn',
    'value' => array(
        //'mst' => array('type' => 'textarea', 'label' => 'Mã số thuế'),
        'address' => array('type' => 'text', 'label' => 'Địa chỉ'),
        'hotline' => array('type' => 'text', 'label' => 'Hotline'),
        //'phone' => array('type' => 'text', 'label' => 'Hỗ trợ'),
        'email' => array('type' => 'text', 'label' => 'Email'),
        //'map' => array('type' => 'textarea', 'label' => 'Bản đồ'),
        //'office_1' => array('type' => 'text', 'label' => 'Văn phòng (Chân trang)'),
        //'office_1_add' => array('type' => 'textarea', 'label' => ''),
        //'office_2' => array('type' => 'text', 'label' => 'Văn phòng (Chân trang)'),
        //'office_2_add' => array('type' => 'textarea', 'label' => ''),
        //'time' => array('type' => 'text', 'label' => 'Thời gian làm việc'),
        'website' => array('type' => 'text', 'label' => 'website'),

    ),
);
$data['seo'] = array(
    'label' => 'Cấu hình thẻ tiêu đề',
    'description' => 'Cài đặt đầy đủ Thẻ tiêu đề và thẻ mô tả giúp xác định cửa hàng của bạn xuất hiện trên công cụ tìm kiếm.',
    'value' => array(
        'meta_title' => array('type' => 'text', 'label' => 'Tiêu đề trang', 'extend' => ' trên 70 kí tự', 'class' => 'meta-title', 'id' => 'titleCount'),
        'meta_description' => array('type' => 'textarea', 'label' => 'Mô tả trang', 'extend' => ' trên 320 kí tự', 'class' => 'meta-description', 'id' => 'descriptionCount'),
        'meta_images' => array('type' => 'images', 'label' => 'Ảnh'),
    ),
);
$data['social'] = array(
    'label' => 'Cấu hình mạng xã hội',
    'description' => 'Cài đặt đầy đủ Thẻ tiêu đề và thẻ mô tả giúp xác định cửa hàng của bạn xuất hiện trên công cụ tìm kiếm.',
    'value' => array(
        //'facebook' => array('type' => 'text', 'label' => 'Facebook'),
        //'twitter' => array('type' => 'text', 'label' => 'Twitter'),
        //'google_plus' => array('type' => 'text', 'label' => 'Google plus'),
        //'youtube' => array('type' => 'text', 'label' => 'Youtube'),
        //'instagram' => array('type' => 'text', 'label' => 'Instagram'),
        // 'linkedin' => array('type' => 'text', 'label' => 'linkedin'),
        //'tiktok' => array('type' => 'text', 'label' => 'Tiktok'),
        //'facebookm' => array('type' => 'text', 'label' => 'Facebook message'),
        //'pinterest' => array('type' => 'text', 'label' => 'Pinterest'),
        // 'rss' => array('type' => 'text', 'label' => 'RSS'),
        // 'vimeo' => array('type' => 'text', 'label' => 'Vimeo'),
        //      'skype' => array('type' => 'text', 'label' => 'Skype'),
        'zalo' => array('type' => 'text', 'label' => 'Số zalo'),
        // 'shopee' => array('type' => 'text', 'label' => 'Shopee'),
        // 'tiki' => array('type' => 'text', 'label' => 'Tiki'),
        // 'lazada' => array('type' => 'text', 'label' => 'Lazada'),
        //'fanpage' => array('type' => 'textarea', 'label' => 'Fanpage Facebook'),
        //'qr_code' => array('type' => 'images', 'label' => 'Mã QR code (Chân trang)'),
        //'appstore' => array('type' => 'text', 'label' => 'Link ứng dụng Appstore (Chân trang)'),
        //'android' => array('type' => 'text', 'label' => 'Link ứng dụng Android (Chân trang)'),
    ),
);

$data['script'] = array(
    'label' => 'Script',
    'description' => '',
    'value' => array(
        'header' => array('type' => 'textarea', 'label' => 'Script header'),
        'footer' => array('type' => 'textarea', 'label' => 'Script footer'),
    ),
);

/*
$data['message'] = array(
    'label' => 'Thông báo',
    'description' => '',
    'value' => array(
        // '1' => array('type' => 'text', 'label' => 'GỬI YÊU CẦU NGAY thành công'),
        '2' => array('type' => 'text', 'label' => 'Gửi thông tin liên hệ thành công'),
        // '3' => array('type' => 'text', 'label' => 'Gửi bình luận thành công!'),
        // '4' => array('type' => 'text', 'label' => 'Phản hồi bình luận thành công!'),
        // '5' => array('type' => 'text', 'label' => 'Đăng kí đại lý  thành công!'),
        //'6' => array('type' => 'text', 'label' => 'Đăng kí popup thành công!'),
        //'7' => array('type' => 'text', 'label' => 'Đăng kí đại lý thành công!'),
    ),
);
*/

/*
$data['services'] = array(
    'label' => 'Thông tin chung dịch vụ',
    'description' => '',
    'value' => array(
        '1' => array('type' => 'text', 'label' => 'Tiêu đề (Khối 1)'),
        '2' => array('type' => 'images', 'label' => 'Hình ảnh (Khối 1)'),
        '3' => array('type' => 'editor', 'label' => 'Nội dung (Khối 1)'),
        '4' => array('type' => 'text', 'label' => 'Đường dẫn (Khối 1)'),

        '5' => array('type' => 'text', 'label' => 'Tiêu đề (Khối 2)'),
        '6' => array('type' => 'images', 'label' => 'Hình ảnh (Khối 2)'),
        '7' => array('type' => 'editor', 'label' => 'Nội dung (Khối 2)'),
        '8' => array('type' => 'text', 'label' => 'Đường dẫn (Khối 2)'),
    ),
);*/

/*
$data['title'] =  array(
    'label' => 'Tiêu đề',
    'description' => '',
    'value' => array(
        '1' => array('type' => 'text', 'label' => 'Tiêu đề video (Trang chủ)'),
    ),
);*/

$data['banner'] =  array(
    'label' => 'Banner & icon',
    'description' => '',
    'value' => array(
        '0' => array('type' => 'images', 'label' => 'Ảnh (Aside)'),
        '1' => array('type' => 'text', 'label' => 'Url (Adside)'),
    ),
);

/*
$data['cart'] = array(
    'label' => 'Đơn hàng',
    'description' => '',
    'value' => array(
        '1' => array('type' => 'editor', 'label' => 'Đặt hàng thành công'),
    ),
);*/

// $data['404'] =  array(
//     'label' => '404',
//     'description' => '',
//     'value' => array(
//         '1' => array('type' => 'text', 'label' => 'Tiêu đề'),
//         '3' => array('type' => 'textarea', 'label' => 'Mô tả'),
//         '4' => array('type' => 'textarea', 'label' => 'Chi tiết'),
//         '2' => array('type' => 'images', 'label' => 'Background image'),
//     ),
// );
return $data;
