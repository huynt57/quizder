<?php

/**
 * This is the model base class for the table "tbl_player_badge".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "PlayerBadge".
 *
 * Columns in table "tbl_player_badge" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $player_id
 * @property integer $badge_id
 * @property string $created_at
 *
 */
abstract class BasePlayerBadge extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_player_badge';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'PlayerBadge|PlayerBadges', $n);
	}

	public static function representingColumn() {
		return 'created_at';
	}

	public function rules() {
		return array(
			array('player_id, badge_id', 'numerical', 'integerOnly'=>true),
			array('created_at', 'safe'),
			array('player_id, badge_id, created_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, player_id, badge_id, created_at', 'safe', 'on'=>'search'),
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
			'player_id' => Yii::t('app', 'Player'),
			'badge_id' => Yii::t('app', 'Badge'),
			'created_at' => Yii::t('app', 'Created At'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('player_id', $this->player_id);
		$criteria->compare('badge_id', $this->badge_id);
		$criteria->compare('created_at', $this->created_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}