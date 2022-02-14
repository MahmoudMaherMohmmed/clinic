<?php


namespace App\Constants;


final class SettingTypes
{
    const ADVANCED_TEXT = 1;
    const NORMAL_TEXT   = 2;
    const IMAGE         = 3;
    const VIDEO         = 4;
    const AUDIO         = 5;
    const EXSTENTION    = 6;
    const SELECTOR      = 7;

    public static function getList()
    {
        return [
            self::ADVANCED_TEXT => "advanced_text",
            self::NORMAL_TEXT => "normal_text",
            self::IMAGE => "image",
            self::VIDEO => "video",
            self::AUDIO => "audio",
            self::EXSTENTION => "exstention",
            self::SELECTOR => "selector",
        ];
    }

    public static function getLabel($key)
    {
        return array_key_exists($key, self::getList()) ? self::getList()[$key] : "";
    }
}
