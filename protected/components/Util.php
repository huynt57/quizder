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

    public static function getAmeneties() {
        return array(
            'essential_ameneties' => 'Đồ cá nhân thiết yếu',
            'cable_k' => 'Truyền hình K+',
            'smoke' => 'Được phép hút thuốc',
            'air_conditioner' => 'Điều hòa nhiệt độ',
            'massage' => 'Mát xa',
            'fire_extinguisher' => 'Bình cứu hỏa',
            'wifi' => 'Free wifi',
            'sampoo' => 'Gội đầu',
            'tv' => 'TV',
            'hot_tub' => 'Bồn nước nóng',
            'spa' => 'Spa',
            'kitchen' => 'Nhà bếp',
            'drier' => 'Máy sấy',
            'steam' => 'Xông hơi',
            'heating' => 'Sưởi',
            'washing_machine' => 'Máy giặt',
            'vat_invoice' => 'Có hóa đơn đỏ',
            'elevator_in_house' => 'Thang máy trong tòa nhà',
            'eating' => 'Phục vụ ăn uống',
            'car_parking' => 'Có chỗ đậu ô tô',
            'for_event' => 'Thích hợp cho sự kiện'
        );
    }

    public static function getRoomtypes($room_types) {
        $value = NULL;
        switch ($room_types) {
            case 'entireHouse':
                $value = 'Toàn bộ nhà';
                break;
            case 'privateRoom':
                $value = 'Phòng riêng';
                break;
            case 'sharedRoom':
                $value = 'Phòng ở ghép';
                break;
        }
        return $value;
    }

    public static function getLocation($ward_id, $district_id, $province_id) {
        $ward_type = null;
        $ward_name = null;
        $district_type = null;
        $district_name = null;
        $province_type = null;
        $province_name = null;
        if (isset($ward_id)) {
            $ward = Ward::model()->findByPk($ward_id);
            if ($ward) {
                $ward_type = $ward->type;
                $ward_name = $ward->name;
            }
        }
        if (isset($district_id)) {
            $district = District::model()->findByPk($district_id);
            if ($district) {
                $district_type = $district->type;
                $district_name = $district->name;
            }
        }
        if (isset($province_id)) {
            $province = Province::model()->findByPk($province_id);
            if ($province) {
                $province_type = $province->type;
                $province_name = $province->name;
            }
        }
        if (!empty($ward) && !empty($district) && !empty($province)) {
            return $ward_type . " " . $ward_name . ", " . $district_type . " " . $district_name . ", " . $province_type . " " . $province_name;
        }
        return null;
    }

    public static function compress_image($source_url, $destination_url, $quality) {
        $info = getimagesize($source_url);

        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source_url);
        } elseif ($info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source_url);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source_url);
        }

        //save file
        imagejpeg($image, $destination_url, $quality);

        //return destination file
        return $destination_url;
    }

    public static function countDateBetween($date1, $date2) {

        $datediff = abs($date2 - $date1);
        if ($datediff == 0) {
            return 1;
        }
        return floor($datediff / (60 * 60 * 24));
    }

    public static function getRoomStatus($room_status) {
        $value = NULL;
        switch ($room_status) {
            case 'available':
                $value = 'Luôn có sẵn phòng';
                break;
            case 'maybeAvailable':
                $value = 'Thỉnh thoảng có sẵn phòng';
                break;
            case 'notAvailable':
                $value = 'Đặt lịch lấy phòng trước';
                break;
            default:
                $value = 'Có phòng theo lịch';
                break;
        }
        return $value;
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
        // var_dump($arr);
        //die;
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

            //  $str .= ')';
            substr($str, 0, -1);
            $str .= ')';
        }
        return $str;
    }

    public function GG() {
        $email = '<email account which could access that api>';
        $scope = 'https://www.googleapis.com/auth/cloud-platform';
        $apiKey = '<my api key>';
        $oAuthId = 'db85477d21009dcb006c61ae95edbda2a4351d21';
        $serviceAcc = '<service account id>@developer.gserviceaccount.com';
        $keyFileLocation = $_SERVER['DOCUMENT_ROOT'] . "/<p12 file>";
        $bucketId = '<my bucket id>';
        $list = array();

        $client = new Google_Client();
        $client->setApplicationName("gp-api");
        $client->setDeveloperKey($apiKey);
        $cred = new Google_Auth_AssertionCredentials(
                $serviceAcc, array($scope), file_get_contents($keyFileLocation), 'notasecret', 'http://oauth.net/grant_type/jwt/1.0/bearer', $email
        );
    }

}
