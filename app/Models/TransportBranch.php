<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportBranch extends Model
{
    use HasFactory;

    // テーブル名を指定 (Laravelではテーブル名が複数形になるので、明示的に指定)
    protected $table = 'transport_branches';

    // マスアサインメントを許可するカラム
    protected $fillable = [
        'branch_name',        // 運輸支局名
        'display_order',      // 表示順
        'branch_name_kana',   // 運輸支局名（カナ）
    ];

    // もしtimestampsを使用しない場合は以下を追加
    public $timestamps = false;
}
