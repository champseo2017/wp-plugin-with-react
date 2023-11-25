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

// เพิ่ม Header สำหรับ CORS

function handle_cors() {
    header( 'Access-Control-Allow-Origin: *' );
    header( 'Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE' );
    header( 'Access-Control-Allow-Headers: X-Requested-With, Content-Type, Authorization' );

    if ( 'OPTIONS' == $_SERVER[ 'REQUEST_METHOD' ] ) {
        exit( 0 );
    }
}

add_action( 'init', 'handle_cors' );

function my_react_plugin_script() {
    $dir = plugin_dir_path( __FILE__ ) . 'dist/assets/';

    $script_files = scandir( $dir );
    foreach ( $script_files as $file ) {
        if ( preg_match( '/index.*\.js$/', $file ) ) {
            wp_enqueue_script( 'my-react-plugin', plugin_dir_url( __FILE__ ) . 'dist/assets/' . $file, array( 'wp-element' ), '1.0.0', true );

            // สร้างและส่ง Nonce ไปยัง React App
            wp_localize_script( 'my-react-plugin', 'myReactApp', array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce( 'my_react_app_nonce' )
            ) );

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

// ฟังก์ชันจัดการ AJAX request

function my_ajax_handler() {
    $debug_mode = WP_DEBUG;
    // ตรวจสอบสภาพแวดล้อมก่อนตรวจสอบ nonce
    if ( !$debug_mode ) {
        check_ajax_referer( 'my_react_app_nonce', 'nonce' );
    }

    // เพิ่ม Header สำหรับ CORS
    // header( 'Access-Control-Allow-Origin: *' );
    // header( 'Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE' );
    // header( 'Access-Control-Allow-Headers: X-Requested-With, Content-Type, Authorization' );

    // ตัวอย่างการจัดการข้อมูล
    // $data = $_POST[ 'data' ];

    // ทำงานกับข้อมูล ...

    // ส่งค่ากลับไปยัง React App
    $response_data = array(
        'message' => 'Response from WordPress gg',
        'debug_mode' => $debug_mode
    );

    echo json_encode( $response_data );
    wp_die();
    // ป้องกันการโหลดหน้า WordPress
}

// เพิ่ม Hooks สำหรับ AJAX
add_action( 'wp_ajax_my_react_action', 'my_ajax_handler' );
// สำหรับผู้ใช้ที่ login
add_action( 'wp_ajax_nopriv_my_react_action', 'my_ajax_handler' );
// สำหรับผู้ใช้ที่ไม่ได้ login

?>
