<?php
/*
Plugin Name: Access Counter
Plugin URI: https://tip5shub.com/
Description: This plugin counts and displays access statistics.
Version: 1.0
Author: Khương
Author URI: https://tip5shub.com/
*/

// Mã của plugin sẽ được viết ở đây.

// Hàm để tăng số lượng truy cập
function increase_access_count() {
    if (!is_admin() && !is_user_logged_in()) {
        $current_count = get_option('access_counter', 0);
        update_option('access_counter', $current_count + 1);
    }
}
add_action('wp', 'increase_access_count');



// Hàm để hiển thị thống kê trong giao diện quản trị
function display_access_count() {
    $count = get_option('access_counter', 0);
    echo '<div class="access-counter">';
    echo '<h3>Access Counter</h3>';
    echo '<p>Total access count: ' . $count . '</p>';
    echo '</div>';
}


// // Đăng ký submenu để hiển thị thống kê
function register_access_counter_submenu() {
    add_submenu_page('options-general.php', 'Access Counter', 'Access Counter', 'manage_options', 'access-counter', 'display_access_count');
}

add_action('admin_menu', 'register_access_counter_submenu');

?>


