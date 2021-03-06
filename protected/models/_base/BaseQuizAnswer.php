<?php

/**
 * This is the model base class for the table "tbl_quiz_answer".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "QuizAnswer".
 *
 * Columns in table "tbl_quiz_answer" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $quiz_id
 * @property integer $correct_answer
 * @property string $answer_image
 * @property string $answer_text
 *
 */
abstract class BaseQuizAnswer extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_quiz_answer';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'QuizAnswer|QuizAnswers', $n);
	}

	public static function representingColumn() {
		return 'answer_image';
	}

	public function rules() {
		return array(
			array('quiz_id, correct_answer', 'numerical', 'integerOnly'=>true),
			array('answer_image, answer_text', 'safe'),
			array('quiz_id, correct_answer, answer_image, answer_text', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, quiz_id, correct_answer, answer_image, answer_text', 'safe', 'on'=>'search'),
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
			'correct_answer' => Yii::t('app', 'Correct Answer'),
			'answer_image' => Yii::t('app', 'Answer Image'),
			'answer_text' => Yii::t('app', 'Answer Text'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('quiz_id', $this->quiz_id);
		$criteria->compare('correct_answer', $this->correct_answer);
		$criteria->compare('answer_image', $this->answer_image, true);
		$criteria->compare('answer_text', $this->answer_text, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}