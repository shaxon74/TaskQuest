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

    // リレーション
    public function user(){
        return $this->belongsTo('App\User');
    }

    // リレーション
    public function task(){
        return $this->belongsTo('App\Task');
    }

    //指定のユーザーIDをもつタスクをスコープする。
    public function scopeUserIdEqual($query, $id) {
        return $query->where('user_id', $id);
    }

    //本日を含む以降のタスクをスコープする。
    public function scopeDatelimitThanToday($query) {
        $now = date('Y-m-d'); // 現在の日付
        return $query->where('date_limit', '>=', $now);
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
