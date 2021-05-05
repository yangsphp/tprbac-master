<?php
/**
 * Created by PhpStorm.
 * User: 25754
 * Date: 2020/3/11
 * Time: 15:34
 */
 
 use \think\Request;

$basename = Request::instance()->root();
if (pathinfo($basename, PATHINFO_EXTENSION) == 'php') {
    $basename = dirname($basename);
}
 

return [
    'view_replace_str' => [
        '__PUBLIC__' => $basename.'/static/admin',
        '__IMG__' => $basename.'/static',
    ],

    'template' => [
        // 模板后缀
        'view_suffix' => 'html',
    ],
];