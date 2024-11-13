<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // テーブル名がLaravelの規約に従っていない場合は、明示的に指定
    protected $table = 'notifications';

    // マスアサインメント可能なカラム
    protected $fillable = [
        'title',
        'content',
        'category',
        'published_at',
        'is_active',
        'image'
    ];

    // 日付型カラムの指定
    protected $dates = ['published_at'];

    // もし timestamps を使いたくない場合は、コメントアウト
    public $timestamps = true;

    // 公開日が過去または現在の日付であれば公開状態を確認
    public function scopePublished($query)
    {
        return $query->where('is_active', true)
            ->where('published_at', '<=', now());
    }

    // 逆に公開されていないものを取得するスコープ
    public function scopeUnpublished($query)
    {
        return $query->where('is_active', false)
            ->orWhere('published_at', '>', now());
    }
}
