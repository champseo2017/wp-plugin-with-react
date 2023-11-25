<?php
/**
* Plugin Name: My React Plugin
* Description: A simple WordPress plugin with React.js
* Version: 1.0
* Author: Your Name
*/

// ตรวจสอบว่าค่าคงที่ ABSPATH ถูกกำหนดหรือไม่
if ( ! defined( 'ABSPATH' ) ) {
    exit;
    // หยุดการทำงานของสคริปต์ถ้าไม่ได้ถูกเรียกจาก WordPress
}

function my_react_plugin_script() {
    $dir = plugin_dir_path( __FILE__ ) . 'dist/assets/';

    $script_files = scandir( $dir );
    foreach ( $script_files as $file ) {
        if ( preg_match( '/index.*\.js$/', $file ) ) {
            wp_enqueue_script( 'my-react-plugin', plugin_dir_url( __FILE__ ) . 'dist/assets/' . $file, array( 'wp-element' ), '1.0.0', true );
            break;
        }
    }
    /*
    ใน WordPress: เมื่อคุณต้องการใช้สคริปต์ที่พัฒนาด้วย React ใน WordPress, WordPress ต้องรู้ว่าสคริปต์นั้นต้องการ React เพื่อทำงาน. การระบุ 'wp-element' เป็นการพึ่งพาใน wp_enqueue_script คือการบอก WordPress ว่า "ก่อนที่จะโหลดสคริปต์นี้, โปรดแน่ใจว่า React และ ReactDOM (ซึ่งอยู่ใน 'wp-element') ถูกโหลดแล้ว".
    */
}
add_action( 'wp_enqueue_scripts', 'my_react_plugin_script' );

// สร้าง Shortcode

function my_react_app_shortcode() {
    return '<div id="my-react-app"></div>';
    // ตำแหน่งที่ React component ของคุณจะถูก render
}
add_shortcode( 'my_react_app', 'my_react_app_shortcode' );

?>
