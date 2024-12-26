<?php

namespace App\Enums;

enum QuestionnaireEnum: string
{
    case Internet = "Google、Yahoo!等のインターネット広告";
    case SNS = "Youtube、Twitter、Facebook等のSNS";
    case HomePage = "弊社のホームページ";
    case Mail = "郵便物";
    case StoreFront = "店頭看板";
    case Advertisement = "屋外広告";
    case Flyer = "折込チラシ";
    case FreePaper = "フリーペーパー";
    case ReferralFamily = "家族・知人からの紹介";
    case ReferralWork = "職場や取引先からの紹介";

    public function getLabel(): string
    {
        return match ($this) {
            self::Internet => self::Internet->value,
            self::SNS => self::SNS->value,
            self::HomePage => self::HomePage->value,
            self::Mail => self::Mail->value,
            self::StoreFront => self::StoreFront->value,
            self::Advertisement => self::Advertisement->value,
            self::Flyer => self::Flyer->value,
            self::FreePaper => self::FreePaper->value,
            self::ReferralFamily => self::ReferralFamily->value,
            self::ReferralWork => self::ReferralWork->value,
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(int $value): string
    {
        return match ($value) {
            self::Internet->value => self::Internet->getLabel(),
            self::SNS->value => self::SNS->getLabel(),
            self::HomePage->value => self::HomePage->getLabel(),
            self::Mail->value => self::Mail->getLabel(),
            self::StoreFront->value => self::StoreFront->getLabel(),
            self::Advertisement->value => self::Advertisement->getLabel(),
            self::Flyer->value => self::Flyer->getLabel(),
            self::FreePaper->value => self::FreePaper->getLabel(),
            self::ReferralFamily->value => self::ReferralFamily->getLabel(),
            self::ReferralWork->value => self::ReferralWork->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }

    public function getShortName(): string
    {
        return match ($this) {
            self::Internet => "インターネット広告",
            self::Internet => "SNS",
            self::Internet => "HP",
            self::Internet => "郵便物",
            self::Internet => "店頭看板",
            self::Internet => "屋外広告",
            self::Internet => "折込チラシ",
            self::Internet => "フリーペーパー",
            self::Internet => "家族・知人からの紹介",
            self::Internet => "職場や取引先からの紹介",
        };
    }

    // Get enum case by its value and return the label
    public static function getShortNameByValue(int $value): string
    {
        return match ($value) {
            self::Internet->value => self::Internet->getShortName(),
            self::SNS->value => self::SNS->getShortName(),
            self::HomePage->value => self::HomePage->getShortName(),
            self::Mail->value => self::Mail->getShortName(),
            self::StoreFront->value => self::StoreFront->getShortName(),
            self::Advertisement->value => self::Advertisement->getShortName(),
            self::Flyer->value => self::Flyer->getShortName(),
            self::FreePaper->value => self::FreePaper->getShortName(),
            self::ReferralFamily->value => self::ReferralFamily->getShortName(),
            self::ReferralWork->value => self::ReferralWork->getShortName(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }
}
