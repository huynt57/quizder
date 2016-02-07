<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UploadHelper {

    public static function getUrlUploadSingleImage($obj, $user_id) {
        $ext_arr = array('png', 'jpg', 'jpeg', 'bmp');
        $name = StringHelper::filterString($obj['name']);
        $storeFolder = Yii::getPathOfAlias('webroot') . '/images/' . date('Y-m-d', time()) . '/' . $user_id . '/';
        if (!file_exists($storeFolder)) {
            mkdir($storeFolder, 0777, true);
        }
        $tempFile = $obj['tmp_name'];
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $random_string = StringHelper::generateRandomString(15);
        $targetFile = $storeFolder . time() . $random_string . '.'. $ext;
        $pathUrl = 'images/' . date('Y-m-d', time()) . '/' . $user_id . '/' . time() . $random_string . '.' . $ext;
        if (in_array($ext, $ext_arr)) {
            if (move_uploaded_file($tempFile, $targetFile)) {
                //  ImageResize::resize_image($pathUrl, '', 1400, 470);

                return $pathUrl;
            } else {
                return NULL;
            }
        } else {
            return NULL;
        }
    }

    public static function getUrlUploadMultiImages($obj, $user_id) {
        $url_arr = array();
        $min_size = 1024 * 1000 * 700;
        $max_size = 1024 * 1000 * 1000 * 3.5;
        foreach ($obj["tmp_name"] as $key => $tmp_name) {
            $ext_arr = array('png', 'jpg', 'jpeg', 'bmp');
            $name = StringHelper::filterString($obj['name'][$key]);
            $storeFolder = Yii::getPathOfAlias('webroot') . '/images/' . date('Y-m-d', time()) . '/' . $user_id . '/';
            $pathUrl = 'images/' . date('Y-m-d', time()) . '/' . $user_id . '/' . time() . $name;
            if (!file_exists($storeFolder)) {
                mkdir($storeFolder, 0777, true);
            }
            $tempFile = $obj['tmp_name'][$key];
            $targetFile = $storeFolder . time() . $name;
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $size = $obj['name']['size'];
            if (in_array($ext, $ext_arr)) {
                if ($size >= $min_size && $size <= $max_size) {
                    if (move_uploaded_file($tempFile, $targetFile)) {

                        array_push($url_arr, $pathUrl);
                    } else {
                        return NULL;
                    }
                } else {
                    return NULL;
                }
            } else {
                return NULL;
            }
        }
        return $url_arr;
    }

}
