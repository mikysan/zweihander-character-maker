<?php

namespace App\Entity;

class PrimaryAttribute
{
    public const COMBAT = 1;
    public const BRAWN = 2;
    public const AGILITY = 3;
    public const PERCEPTION = 4;
    public const INTELLIGENCE = 5;
    public const WILLPOWER = 6;
    public const FELLOWSHIP = 7;
    public const ATTRIBUTE_NAMES = [
        self::COMBAT => 'Combat',
        self::BRAWN => 'Brawn',
        self::AGILITY => 'Agility',
        self::PERCEPTION => 'Perception',
        self::INTELLIGENCE => 'Intelligence',
        self::WILLPOWER => 'Willpower',
        self::FELLOWSHIP => 'Fellowship',
    ];

    public static function calcPseudoRandomValue()
    {
        return 25 + mt_rand(1, 10) + mt_rand(1, 10) + mt_rand(1, 10);
    }
}
