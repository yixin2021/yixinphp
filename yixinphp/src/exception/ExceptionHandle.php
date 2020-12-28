<?php


namespace yixinphp\exception;


class ExceptionHandle
{
    public static function init()
    {
        if (DEBUG) {
            ini_set('display_errors', 'On');
        } else {
            ini_set('display_errors', 'Off');
        }
    }
}