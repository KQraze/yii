<?php

namespace app\common;

use Yii;

class Auth
{
    public static function isGuest()
    {
        return Yii::$app->user->isGuest;
    }

    public static function user()
    {
        return Yii::$app->user->identity;
    }

    public static function id()
    {
        return self::user()->id;
    }
}