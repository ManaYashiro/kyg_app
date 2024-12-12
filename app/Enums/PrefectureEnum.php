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

    // Numeric value
    // case Hokkaido = 1;
    // case Aomori = 2;
    // case Iwate = 3;
    // case Miyagi = 4;
    // case Akita = 5;
    // case Yamagata = 6;
    // case Fukushima = 7;
    // case Ibaraki = 8;
    // case Tochigi = 9;
    // case Gunma = 10;
    // case Saitama = 11;
    // case Chiba = 12;
    // case Tokyo = 13;
    // case Kanagawa = 14;
    // case Niigata = 15;
    // case Toyama = 16;
    // case Ishikawa = 17;
    // case Fukui = 18;
    // case Yamanashi = 19;
    // case Nagano = 20;
    // case Gifu = 21;
    // case Shizuoka = 22;
    // case Aichi = 23;
    // case Mie = 24;
    // case Shiga = 25;
    // case Kyoto = 26;
    // case Osaka = 27;
    // case Hyogo = 28;
    // case Nara = 29;
    // case Wakayama = 30;
    // case Tottori = 31;
    // case Shimane = 32;
    // case Okayama = 33;
    // case Hiroshima = 34;
    // case Yamaguchi = 35;
    // case Tokushima = 36;
    // case Kagawa = 37;
    // case Ehime = 38;
    // case Kochi = 39;
    // case Fukuoka = 40;
    // case Saga = 41;
    // case Nagasaki = 42;
    // case Kumamoto = 43;
    // case Oita = 44;
    // case Miyazaki = 45;
    // case Kagoshima = 46;
    // case Okinawa = 47;

    // Return the Kanji label for each prefecture
    public function getLabel(): string
    {
        return match ($this) {
            self::Hokkaido => '北海道',
            self::Aomori => '青森県',
            self::Iwate => '岩手県',
            self::Miyagi => '宮城県',
            self::Akita => '秋田県',
            self::Yamagata => '山形県',
            self::Fukushima => '福島県',
            self::Ibaraki => '茨城県',
            self::Tochigi => '栃木県',
            self::Gunma => '群馬県',
            self::Saitama => '埼玉県',
            self::Chiba => '千葉県',
            self::Tokyo => '東京都',
            self::Kanagawa => '神奈川県',
            self::Niigata => '新潟県',
            self::Toyama => '富山県',
            self::Ishikawa => '石川県',
            self::Fukui => '福井県',
            self::Yamanashi => '山梨県',
            self::Nagano => '長野県',
            self::Gifu => '岐阜県',
            self::Shizuoka => '静岡県',
            self::Aichi => '愛知県',
            self::Mie => '三重県',
            self::Shiga => '滋賀県',
            self::Kyoto => '京都府',
            self::Osaka => '大阪府',
            self::Hyogo => '兵庫県',
            self::Nara => '奈良県',
            self::Wakayama => '和歌山県',
            self::Tottori => '鳥取県',
            self::Shimane => '島根県',
            self::Okayama => '岡山県',
            self::Hiroshima => '広島県',
            self::Yamaguchi => '山口県',
            self::Tokushima => '徳島県',
            self::Kagawa => '香川県',
            self::Ehime => '愛媛県',
            self::Kochi => '高知県',
            self::Fukuoka => '福岡県',
            self::Saga => '佐賀県',
            self::Nagasaki => '長崎県',
            self::Kumamoto => '熊本県',
            self::Oita => '大分県',
            self::Miyazaki => '宮崎県',
            self::Kagoshima => '鹿児島県',
            self::Okinawa => '沖縄県',
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
