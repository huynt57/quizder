<?php

/**
 * This is the model base class for the table "tbl_quiz_suggestion".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "QuizSuggestion".
 *
 * Columns in table "tbl_quiz_suggestion" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $category
 * @property string $title
 * @property string $description
 *
 */
abstract class BaseQuizSuggestion extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_quiz_suggestion';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'QuizSuggestion|QuizSuggestions', $n);
	}

	public static function representingColumn() {
		return 'category';
	}

	public function rules() {
		return array(
			array('category, title, description', 'safe'),
			array('category, title, description', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, category, title, description', 'safe', 'on'=>'search'),
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
			'category' => Yii::t('app', 'Category'),
			'title' => Yii::t('app', 'Title'),
			'description' => Yii::t('app', 'Description'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('category', $this->category, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}