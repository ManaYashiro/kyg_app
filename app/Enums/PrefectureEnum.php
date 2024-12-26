<?php

namespace App\Enums;

enum PrefectureEnum: string
{

        // Kanji value
    case Hokkaido = "北海道";
    case Aomori = "青森県";
    case Iwate = "岩手県";
    case Miyagi = "宮城県";
    case Akita = "秋田県";
    case Yamagata = "山形県";
    case Fukushima = "福島県";
    case Ibaraki = "茨城県";
    case Tochigi = "栃木県";
    case Gunma = "群馬県";
    case Saitama = "埼玉県";
    case Chiba = "千葉県";
    case Tokyo = "東京都";
    case Kanagawa = "神奈川県";
    case Niigata = "新潟県";
    case Toyama = "富山県";
    case Ishikawa = "石川県";
    case Fukui = "福井県";
    case Yamanashi = "山梨県";
    case Nagano = "長野県";
    case Gifu = "岐阜県";
    case Shizuoka = "静岡県";
    case Aichi = "愛知県";
    case Mie = "三重県";
    case Shiga = "滋賀県";
    case Kyoto = "京都府";
    case Osaka = "大阪府";
    case Hyogo = "兵庫県";
    case Nara = "奈良県";
    case Wakayama = "和歌山県";
    case Tottori = "鳥取県";
    case Shimane = "島根県";
    case Okayama = "岡山県";
    case Hiroshima = "広島県";
    case Yamaguchi = "山口県";
    case Tokushima = "徳島県";
    case Kagawa = "香川県";
    case Ehime = "愛媛県";
    case Kochi = "高知県";
    case Fukuoka = "福岡県";
    case Saga = "佐賀県";
    case Nagasaki = "長崎県";
    case Kumamoto = "熊本県";
    case Oita = "大分県";
    case Miyazaki = "宮崎県";
    case Kagoshima = "鹿児島県";
    case Okinawa = "沖縄県";

    // Return the Kanji label for each prefecture
    public function getLabel(): string
    {
        return match ($this) {
            self::Hokkaido => self::Hokkaido->value,
            self::Aomori => self::Aomori->value,
            self::Iwate => self::Iwate->value,
            self::Miyagi => self::Miyagi->value,
            self::Akita => self::Akita->value,
            self::Yamagata => self::Yamagata->value,
            self::Fukushima => self::Fukushima->value,
            self::Ibaraki => self::Ibaraki->value,
            self::Tochigi => self::Tochigi->value,
            self::Gunma => self::Gunma->value,
            self::Saitama => self::Saitama->value,
            self::Chiba => self::Chiba->value,
            self::Tokyo => self::Tokyo->value,
            self::Kanagawa => self::Kanagawa->value,
            self::Niigata => self::Niigata->value,
            self::Toyama => self::Toyama->value,
            self::Ishikawa => self::Ishikawa->value,
            self::Fukui => self::Fukui->value,
            self::Yamanashi => self::Yamanashi->value,
            self::Nagano => self::Nagano->value,
            self::Gifu => self::Gifu->value,
            self::Shizuoka => self::Shizuoka->value,
            self::Aichi => self::Aichi->value,
            self::Mie => self::Mie->value,
            self::Shiga => self::Shiga->value,
            self::Kyoto => self::Kyoto->value,
            self::Osaka => self::Osaka->value,
            self::Hyogo => self::Hyogo->value,
            self::Nara => self::Nara->value,
            self::Wakayama => self::Wakayama->value,
            self::Tottori => self::Tottori->value,
            self::Shimane => self::Shimane->value,
            self::Okayama => self::Okayama->value,
            self::Hiroshima => self::Hiroshima->value,
            self::Yamaguchi => self::Yamaguchi->value,
            self::Tokushima => self::Tokushima->value,
            self::Kagawa => self::Kagawa->value,
            self::Ehime => self::Ehime->value,
            self::Kochi => self::Kochi->value,
            self::Fukuoka => self::Fukuoka->value,
            self::Saga => self::Saga->value,
            self::Nagasaki => self::Nagasaki->value,
            self::Kumamoto => self::Kumamoto->value,
            self::Oita => self::Oita->value,
            self::Miyazaki => self::Miyazaki->value,
            self::Kagoshima => self::Kagoshima->value,
            self::Okinawa => self::Okinawa->value,
        };
    }

    // Get enum case by its value and return the label
    public static function getLabelByValue(int|string $value): string
    {
        return match ($value) {
            self::Hokkaido->value => self::Hokkaido->getLabel(),
            self::Aomori->value => self::Aomori->getLabel(),
            self::Iwate->value => self::Iwate->getLabel(),
            self::Miyagi->value => self::Miyagi->getLabel(),
            self::Akita->value => self::Akita->getLabel(),
            self::Yamagata->value => self::Yamagata->getLabel(),
            self::Fukushima->value => self::Fukushima->getLabel(),
            self::Ibaraki->value => self::Ibaraki->getLabel(),
            self::Tochigi->value => self::Tochigi->getLabel(),
            self::Gunma->value => self::Gunma->getLabel(),
            self::Saitama->value => self::Saitama->getLabel(),
            self::Chiba->value => self::Chiba->getLabel(),
            self::Tokyo->value => self::Tokyo->getLabel(),
            self::Kanagawa->value => self::Kanagawa->getLabel(),
            self::Niigata->value => self::Niigata->getLabel(),
            self::Toyama->value => self::Toyama->getLabel(),
            self::Ishikawa->value => self::Ishikawa->getLabel(),
            self::Fukui->value => self::Fukui->getLabel(),
            self::Yamanashi->value => self::Yamanashi->getLabel(),
            self::Nagano->value => self::Nagano->getLabel(),
            self::Gifu->value => self::Gifu->getLabel(),
            self::Shizuoka->value => self::Shizuoka->getLabel(),
            self::Aichi->value => self::Aichi->getLabel(),
            self::Mie->value => self::Mie->getLabel(),
            self::Shiga->value => self::Shiga->getLabel(),
            self::Kyoto->value => self::Kyoto->getLabel(),
            self::Osaka->value => self::Osaka->getLabel(),
            self::Hyogo->value => self::Hyogo->getLabel(),
            self::Nara->value => self::Nara->getLabel(),
            self::Wakayama->value => self::Wakayama->getLabel(),
            self::Tottori->value => self::Tottori->getLabel(),
            self::Shimane->value => self::Shimane->getLabel(),
            self::Okayama->value => self::Okayama->getLabel(),
            self::Hiroshima->value => self::Hiroshima->getLabel(),
            self::Yamaguchi->value => self::Yamaguchi->getLabel(),
            self::Tokushima->value => self::Tokushima->getLabel(),
            self::Kagawa->value => self::Kagawa->getLabel(),
            self::Ehime->value => self::Ehime->getLabel(),
            self::Kochi->value => self::Kochi->getLabel(),
            self::Fukuoka->value => self::Fukuoka->getLabel(),
            self::Saga->value => self::Saga->getLabel(),
            self::Nagasaki->value => self::Nagasaki->getLabel(),
            self::Kumamoto->value => self::Kumamoto->getLabel(),
            self::Oita->value => self::Oita->getLabel(),
            self::Miyazaki->value => self::Miyazaki->getLabel(),
            self::Kagoshima->value => self::Kagoshima->getLabel(),
            self::Okinawa->value => self::Okinawa->getLabel(),
            default => 'Unknown', // Optional fallback for invalid values
        };
    }

    public static function getRegions(): array
    {
        // Grouping prefectures by region
        return [
            '北海道地方' => [PrefectureEnum::Hokkaido],
            '東北地方' => [
                PrefectureEnum::Aomori,
                PrefectureEnum::Iwate,
                PrefectureEnum::Miyagi,
                PrefectureEnum::Akita,
                PrefectureEnum::Yamagata,
                PrefectureEnum::Fukushima
            ],
            '関東地方' => [
                PrefectureEnum::Ibaraki,
                PrefectureEnum::Tochigi,
                PrefectureEnum::Gunma,
                PrefectureEnum::Saitama,
                PrefectureEnum::Chiba,
                PrefectureEnum::Tokyo,
                PrefectureEnum::Kanagawa
            ],
            '中部地方' => [
                PrefectureEnum::Niigata,
                PrefectureEnum::Toyama,
                PrefectureEnum::Ishikawa,
                PrefectureEnum::Fukui,
                PrefectureEnum::Yamanashi,
                PrefectureEnum::Nagano,
                PrefectureEnum::Gifu,
                PrefectureEnum::Shizuoka,
                PrefectureEnum::Aichi,
                PrefectureEnum::Mie // Mie added here correctly
            ],
            '近畿地方' => [
                PrefectureEnum::Shiga,
                PrefectureEnum::Kyoto,
                PrefectureEnum::Osaka,
                PrefectureEnum::Hyogo,
                PrefectureEnum::Nara,
                PrefectureEnum::Wakayama
            ],
            '中国地方' => [
                PrefectureEnum::Tottori,
                PrefectureEnum::Shimane,
                PrefectureEnum::Okayama,
                PrefectureEnum::Hiroshima,
                PrefectureEnum::Yamaguchi
            ],
            '四国地方' => [
                PrefectureEnum::Tokushima,
                PrefectureEnum::Kagawa,
                PrefectureEnum::Ehime,
                PrefectureEnum::Kochi
            ],
            '九州地方' => [
                PrefectureEnum::Fukuoka,
                PrefectureEnum::Saga,
                PrefectureEnum::Nagasaki,
                PrefectureEnum::Kumamoto,
                PrefectureEnum::Oita,
                PrefectureEnum::Miyazaki,
                PrefectureEnum::Kagoshima,
                PrefectureEnum::Okinawa
            ],
        ];
    }
}
