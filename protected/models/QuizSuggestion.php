<?php

Yii::import('application.models._base.BaseQuizSuggestion');

class QuizSuggestion extends BaseQuizSuggestion
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function add($args)
        {
            $model = new QuizSuggestion;
            $model->setAttributes($args);
            if($model->save(FALSE))
            {
               return $model->id;
            }
            return FALSE;
        }
}