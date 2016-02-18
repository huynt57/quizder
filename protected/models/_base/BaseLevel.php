<?php

/**
 * This is the model base class for the table "tbl_level".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Level".
 *
 * Columns in table "tbl_level" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $level
 * @property integer $points_needed
 *
 */
abstract class BaseLevel extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_level';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Level|Levels', $n);
	}

	public static function representingColumn() {
		return 'level';
	}

	public function rules() {
		return array(
			array('level', 'required'),
			array('level, points_needed', 'numerical', 'integerOnly'=>true),
			array('points_needed', 'default', 'setOnEmpty' => true, 'value' => null),
			array('level, points_needed', 'safe', 'on'=>'search'),
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
			'level' => Yii::t('app', 'Level'),
			'points_needed' => Yii::t('app', 'Points Needed'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('level', $this->level);
		$criteria->compare('points_needed', $this->points_needed);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}