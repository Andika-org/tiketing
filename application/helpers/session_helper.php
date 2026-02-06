<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_user_session')) {
    function get_user_session()
    {
        $CI = &get_instance();
        return $CI->session->userdata('user_data');
    }
}

if (!function_exists('get_user_dept_id')) {
    function get_user_dept_id()
    {
        $user = get_user_session();
        return isset($user['DeptID']) ? $user['DeptID'] : null;
    }
}

if (!function_exists('get_user_unitrs')) {
    function get_user_unitrs()
    {
        $user = get_user_session();
        return isset($user['unitrs']) ? $user['unitrs'] : null;
    }
}

if (!function_exists('get_user_id')) {
    function get_user_id()
    {
        $user = get_user_session();
        return isset($user['id']) ? $user['id'] : null;
    }
}

if (!function_exists('get_user_username')) {
    function get_user_username()
    {
        $user = get_user_session();
        return isset($user['UserName']) ? $user['UserName'] : null;
    }
}