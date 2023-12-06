<?php

namespace App\Enums;

enum Day
{
    const MONDAY = 'Monday';
    const TUESDAY = 'Tuesday';
    const WEDNESDAY = 'Wednesday';
    const THURSDAY = 'Thursday';
    const FRIDAY = 'Friday';
    const SATURDAY = 'Saturday';
    const SUNDAY = 'Sunday';

    public static function getValues()
    {
        return [
            self::MONDAY,
            self::TUESDAY,
            self::WEDNESDAY,
            self::THURSDAY,
            self::FRIDAY,
            self::SATURDAY,
            self::SUNDAY,
        ];
    }


    public static function getDescription($value): string
    {
        switch ($value) {
            case self::MONDAY:
                return 'دوشنبه';
            case self::TUESDAY:
                return 'سه‌شنبه';
            case self::WEDNESDAY:
                return 'چهار‌شنبه';
            case self::THURSDAY:
                return 'پنجشنبه';
            case self::FRIDAY:
                return 'جمعه';
            case self::SATURDAY:
                return '‌شنبه';
            case self::SUNDAY:
                return '‌یکشنبه';
            default:
                return self::getKey($value);
        }
    }

}
