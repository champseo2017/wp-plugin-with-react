<?php
/**
* Plugin Name: Plugin with React
* Description: A WordPress plugin that uses React.js
* Version: 1.0
* Author: Your Name
*/

// ตรวจสอบว่าค่าคงที่ ABSPATH ถูกกำหนดหรือไม่
if ( ! defined( 'ABSPATH' ) ) {
    exit;
    // หยุดการทำงานของสคริปต์ถ้าไม่ได้ถูกเรียกจาก WordPress
}

// กำหนดค่าคงที่สำหรับปลั๊กอิน
define( 'WPWR_PATH', plugin_dir_path( __FILE__ ) );
// กำหนด path ทางไฟล์
define( 'WPWR_URL', plugins_url( '/', __FILE__ ) );
// กำหนด URL

// ฟังก์ชัน 'new_dashboard_setup' ที่กำหนดไว้

function new_dashboard_setup() {
    // โค้ดสำหรับการเพิ่มหรือแก้ไขเนื้อหาหน้าแดชบอร์ด
    wp_add_dashboard_widget(
        'new_dashboard_widget', // widget_id
        'New Graph Widget',
        'new_dashboard_widget_callback' // callback function
    );
}

// เชื่อมต่อ 'new_dashboard_setup' กับ hook 'wp_dashboard_setup'
add_action( 'wp_dashboard_setup', 'new_dashboard_setup' );

// Callback function สำหรับ widget

function new_dashboard_widget_callback() {
    echo '<div id="new-dashboard-widget"></div>';
}
?>
