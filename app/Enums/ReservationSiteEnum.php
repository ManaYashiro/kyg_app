<?php

namespace App\Enums;

enum ReservationSiteEnum: string
{
    case SiteInazawa = "拠点フラグ(稲沢)";
    case SiteNagoyakita = "拠点フラグ(名古屋北)";
    case SiteKariya = "拠点フラグ(刈谷)";
    case SiteNishiki = "拠点フラグ(錦)";
    case SiteToyotaKamigo = "拠点フラグ(豊田上郷)";
    case SiteInuyama = "拠点フラグ(犬山)";

    public function getLabel(): string
    {
        return match ($this) {
            self::SiteInazawa => '拠点フラグ(稲沢)',
            self::SiteNagoyakita => '拠点フラグ(名古屋北)',
            self::SiteKariya => '拠点フラグ(刈谷)',
            self::SiteNishiki => '拠点フラグ(錦)',
            self::SiteToyotaKamigo => '拠点フラグ(豊田上郷)',
            self::SiteInuyama => '拠点フラグ(犬山)',
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(string $value): string
    {
        return match ($value) {
            self::SiteInazawa->value => self::SiteInazawa->getLabel(),
            self::SiteNagoyakita->value => self::SiteNagoyakita->getLabel(),
            self::SiteKariya->value => self::SiteKariya->getLabel(),
            self::SiteNishiki->value => self::SiteNishiki->getLabel(),
            self::SiteToyotaKamigo->value => self::SiteToyotaKamigo->getLabel(),
            self::SiteInuyama->value => self::SiteInuyama->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }
}
