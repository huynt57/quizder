<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EmailHelper {

    public static function sendEmail($subject, $to_email, $body, $from_email, $from_name) {
        $mail = new YiiMailer();
        $mail->setView('confirm');
        $mail->setData(array('data' => $body));
        $mail->setFrom($from_email, $from_name);
        $mail->setSubject($subject);
        $mail->setTo($to_email);
        if ($mail->send()) {
            return TRUE;
        }
        return FALSE;
    }

}
