<?php


namespace App\Constants;


final class ContentTypes
{
    const ADVANCED_TEXT     = 1;
    const NORMAL_TEXT       = 2;
    const IMAGE             = 3;
    const AUDIO             = 4;
    const VIDEO             = 5;
    const YOUTUBVIDEO       = 6;
    const EXTERNALLINK      = 7;

    public static function getList()
    {
        return [
            self::ADVANCED_TEXT => "AdvancedText",
            self::NORMAL_TEXT => "NormalText",
            self::IMAGE => "Image",
            self::AUDIO => "Audio",
            self::VIDEO => "Video",
            self::YOUTUBVIDEO => "Youtube",
            self::EXTERNALLINK => "ExternalLink",
        ];
    }

    public static function getLabel($key)
    {
        return array_key_exists($key, self::getList()) ? self::getList()[$key] : "";
    }
}
