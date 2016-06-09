<?php

/**
 * This is the model base class for the table "tbl_player".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Player".
 *
 * Columns in table "tbl_player" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $name
 * @property string $nick_name
 * @property string $profile_picture
 * @property string $email_address
 * @property string $facebook_id
 * @property string $google_id
 * @property string $twitter_id
 * @property string $gender
 * @property string $date_of_birth
 * @property string $country
 * @property integer $membership_id
 * @property string $created_at
 * @property integer $total_points
 * @property string $facebook_token
 * @property string $google_token
 * @property string $token
 *
 */
abstract class BasePlayer extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_player';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Player|Players', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('membership_id, total_points', 'numerical', 'integerOnly'=>true),
			array('name, nick_name, profile_picture, email_address, facebook_id, google_id, twitter_id, gender, date_of_birth, country, created_at, facebook_token, google_token, token', 'safe'),
			array('name, nick_name, profile_picture, email_address, facebook_id, google_id, twitter_id, gender, date_of_birth, country, membership_id, created_at, total_points, facebook_token, google_token, token', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, nick_name, profile_picture, email_address, facebook_id, google_id, twitter_id, gender, date_of_birth, country, membership_id, created_at, total_points, facebook_token, google_token, token', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'name' => Yii::t('app', 'Name'),
			'nick_name' => Yii::t('app', 'Nick Name'),
			'profile_picture' => Yii::t('app', 'Profile Picture'),
			'email_address' => Yii::t('app', 'Email Address'),
			'facebook_id' => Yii::t('app', 'Facebook'),
			'google_id' => Yii::t('app', 'Google'),
			'twitter_id' => Yii::t('app', 'Twitter'),
			'gender' => Yii::t('app', 'Gender'),
			'date_of_birth' => Yii::t('app', 'Date Of Birth'),
			'country' => Yii::t('app', 'Country'),
			'membership_id' => Yii::t('app', 'Membership'),
			'created_at' => Yii::t('app', 'Created At'),
			'total_points' => Yii::t('app', 'Total Points'),
			'facebook_token' => Yii::t('app', 'Facebook Token'),
			'google_token' => Yii::t('app', 'Google Token'),
			'token' => Yii::t('app', 'Token'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('nick_name', $this->nick_name, true);
		$criteria->compare('profile_picture', $this->profile_picture, true);
		$criteria->compare('email_address', $this->email_address, true);
		$criteria->compare('facebook_id', $this->facebook_id, true);
		$criteria->compare('google_id', $this->google_id, true);
		$criteria->compare('twitter_id', $this->twitter_id, true);
		$criteria->compare('gender', $this->gender, true);
		$criteria->compare('date_of_birth', $this->date_of_birth, true);
		$criteria->compare('country', $this->country, true);
		$criteria->compare('membership_id', $this->membership_id);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('total_points', $this->total_points);
		$criteria->compare('facebook_token', $this->facebook_token, true);
		$criteria->compare('google_token', $this->google_token, true);
		$criteria->compare('token', $this->token, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}