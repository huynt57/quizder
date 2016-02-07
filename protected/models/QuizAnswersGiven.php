<?php

Yii::import('application.models._base.BaseQuizAnswersGiven');

class QuizAnswersGiven extends BaseQuizAnswersGiven {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function addGivenAnswers($given_answers) {
        $flag = TRUE;
        foreach ($given_answers as $item) {
            unset($item['id']);
            $model = new QuizAnswersGiven;
            $model->setAttributes($item);
            if (!$model->save(FALSE)) {
                $flag = FALSE;
            }
        }
        return $flag;
    }

}
