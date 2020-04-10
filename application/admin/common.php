<?php
/**
 * Created by PhpStorm.
 * User: 25754
 * Date: 2020/3/11
 * Time: 16:43
 */

function result($data, $code = 0, $msg = '', $count = 0)
{
    $result = [
        'code' => $code,
        'msg' => $msg,
        'time' => $_SERVER['REQUEST_TIME'],
        'data' => $data,
        'count' => $count,
    ];
    return $result;
}

function getCategory($data, $parent_id = 0, $level = 0){
    static $tree = array();
    foreach ($data as $k => $v) {
        if ($v["parent_id"] == $parent_id) {
            $v["level"] = $level;
            $tree[] = $v;
            getCategory($data, $v["id"], $level + 1);
        }
    }
    return $tree;
}

function getRoleTree($data, $parent_id = 0, $array = array()) {
    $tree = array();
    foreach ($data as $k => $v) {
        $v['checked'] = false;
        $v['value'] = $v['id'];
        if (in_array($v['id'], $array)) {
            $v['checked'] = true;
        }
        if ($v["parent_id"] == $parent_id) {
            unset($data[$k]);
            if (!empty($data)) {
                $children = getRoleTree($data, $v["id"], $array);
                if (!empty($children)) {
                    $v["children"] = $children;
                }
            }
            $tree[] = $v;
        }
    }
    return $tree;
}

function random($length, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz')
{
    $hash = '';
    $max = strlen($chars) - 1;
    for ($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}