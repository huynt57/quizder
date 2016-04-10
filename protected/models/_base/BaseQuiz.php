<?php

/**
 * This is the model base class for the table "tbl_quiz".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Quiz".
 *
 * Columns in table "tbl_quiz" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $category
 * @property integer $time
 * @property string $left_answer
 * @property string $right_answer
 * @property string $created_at
 * @property integer $is_time_bonus
 *
 */
abstract class BaseQuiz extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_quiz';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Quiz|Quizs', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('time, is_time_bonus', 'numerical', 'integerOnly'=>true),
			array('name, description, category, left_answer, right_answer, created_at', 'safe'),
			array('name, description, category, time, left_answer, right_answer, created_at, is_time_bonus', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, description, category, time, left_answer, right_answer, created_at, is_time_bonus', 'safe', 'on'=>'search'),
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
			'description' => Yii::t('app', 'Description'),
			'category' => Yii::t('app', 'Category'),
			'time' => Yii::t('app', 'Time'),
			'left_answer' => Yii::t('app', 'Left Answer'),
			'right_answer' => Yii::t('app', 'Right Answer'),
			'created_at' => Yii::t('app', 'Created At'),
			'is_time_bonus' => Yii::t('app', 'Is Time Bonus'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('category', $this->category, true);
		$criteria->compare('time', $this->time);
		$criteria->compare('left_answer', $this->left_answer, true);
		$criteria->compare('right_answer', $this->right_answer, true);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('is_time_bonus', $this->is_time_bonus);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}