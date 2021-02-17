<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoneTask extends Model
{
    // protected $table = 'donetasks';
    // protected $primaryKey = 'id';
    // public $timestamps = true;
    protected $guarded = array('id');

    // カラムのデフォルト値を設定
    protected $attributes = [
        'is_done' => false,
    ];

    //指定のユーザーIDをもつタスクを昇順でスコープする。
    public function scopeUserIdEqual($query, $str) {
        return $query->where('user_id', $str);
    }

    //指定のユーザーIDをもつタスクを昇順でスコープする。
    public function scopeUserTaskDateEqual($query, $data) {
        return $query->where([
            'user_id'   => $data['user_id'],
            'tasks_id'  => $data['tasks_id'],
            'date_limit'=> $data['date_limit'],
        ]);
    }
}
