<?php

/**
 * This is the model base class for the table "tbl_game".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Game".
 *
 * Columns in table "tbl_game" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $quiz_id
 * @property integer $player_id
 * @property integer $player_points
 * @property integer $rating
 * @property string $started_at
 *
 */
abstract class BaseGame extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_game';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Game|Games', $n);
	}

	public static function representingColumn() {
		return 'started_at';
	}

	public function rules() {
		return array(
			array('quiz_id, player_id, player_points, rating', 'numerical', 'integerOnly'=>true),
			array('started_at', 'safe'),
			array('quiz_id, player_id, player_points, rating, started_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, quiz_id, player_id, player_points, rating, started_at', 'safe', 'on'=>'search'),
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
			'quiz_id' => Yii::t('app', 'Quiz'),
			'player_id' => Yii::t('app', 'Player'),
			'player_points' => Yii::t('app', 'Player Points'),
			'rating' => Yii::t('app', 'Rating'),
			'started_at' => Yii::t('app', 'Started At'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('quiz_id', $this->quiz_id);
		$criteria->compare('player_id', $this->player_id);
		$criteria->compare('player_points', $this->player_points);
		$criteria->compare('rating', $this->rating);
		$criteria->compare('started_at', $this->started_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}