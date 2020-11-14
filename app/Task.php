<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // protected $table = 'tasks';
    // protected $primaryKey = 'id';
    // public $timestamps = true;
    protected $guarded = array('id');

    // カラムのデフォルト値を設定
    protected $attributes = [
        'is_finished' => false,
        'is_activated' => true,
    ];

    //指定のユーザーIDをもつタスクを昇順でスコープする。
    public function scopeUserIdEqual($query, $str) {
        return $query->where('user_id', $str)
                     ->orderBy('id', 'asc');
    }
}
