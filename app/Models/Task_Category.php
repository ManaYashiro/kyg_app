<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task_Category  extends Model
{
    use HasFactory;

    // テーブル名を明示的に指定
    protected $table = 'task_category';

    // 複数代入可能なフィールドの定義
    protected $fillable = [
        'category_name',
    ];
}
