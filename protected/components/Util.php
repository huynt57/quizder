<?php

require_once './vendor/autoload.php';

class Util {

    public static function getVoiceUploadPath() {
        return Yii::app()->basePath . '/../upload/message/voice/';
    }

    public static function getUserAvatarUploadPath() {
        return Yii::app()->basePath . '/../upload/user/avatar/';
    }

    public static function getUserAvatarPath() {
        $url = 'http://' . Yii::app()->request->getServerName();
        return $url . '/upload/user/avatar/';
    }

    public static function getVoicePath() {
        $url = 'http://' . Yii::app()->request->getServerName();
        return $url . '/upload/message/voice/';
    }

    public static function getAbsoluteUrlImages($url) {
        return Yii::app()->request->getBaseUrl(true) . '/' . $url;
    }

    public static function getFriendsFacebook($access_token) {
        $facebook_url = 'https://graph.facebook.com/v2.6/me/friends?fields=id';
        $result = file_get_contents($facebook_url . '&access_token=' . $access_token);
        $friend_arrs = json_decode($result, true);
        $arr = array();
        foreach ($friend_arrs['data'] as $item) {
            $arr[] = $item['id'];
        }
        $str = NULL;
        $criteria = new CDbCriteria;
        $criteria->select = 'id';
        $criteria->addInCondition('facebook_id', $arr);

        $friends = Player::model()->findAll($criteria);
        if ($friends) {
            $str = '(';
            foreach ($friends as $item) {
                $str .= $item->id . ',';
            }
            substr($str, 0, -1);
            $str .= ')';
        }
        return $str;
    }

    public function validateToken($token, $player_id) {
        $check = Player::model()->findByAttributes(array('id' => $player_id, 'token' => $token));
        if ($check) {
            return true;
        }
        return false;
    }

}
