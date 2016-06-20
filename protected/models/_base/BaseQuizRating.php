<?php

/**
 * This is the model base class for the table "tbl_quiz_rating".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "QuizRating".
 *
 * Columns in table "tbl_quiz_rating" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $quiz_id
 * @property integer $player_id
 * @property integer $rating
 * @property string $comment
 * @property integer $created_at
 * @property integer $updated_at
 *
 */
abstract class BaseQuizRating extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_quiz_rating';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'QuizRating|QuizRatings', $n);
	}

	public static function representingColumn() {
		return 'comment';
	}

	public function rules() {
		return array(
			array('quiz_id, player_id, rating, created_at, updated_at', 'numerical', 'integerOnly'=>true),
			array('comment', 'safe'),
			array('quiz_id, player_id, rating, comment, created_at, updated_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, quiz_id, player_id, rating, comment, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'rating' => Yii::t('app', 'Rating'),
			'comment' => Yii::t('app', 'Comment'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('quiz_id', $this->quiz_id);
		$criteria->compare('player_id', $this->player_id);
		$criteria->compare('rating', $this->rating);
		$criteria->compare('comment', $this->comment, true);
		$criteria->compare('created_at', $this->created_at);
		$criteria->compare('updated_at', $this->updated_at);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}