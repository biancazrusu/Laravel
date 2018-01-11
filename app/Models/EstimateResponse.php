<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstimateResponse extends Model
{
	protected $fillable = ['estimate_id', 'question_id', 'answer_id', 'current_price'];

	public function answer()
    {
        return $this->hasOne('App\Models\Answer', 'id', 'answer_id');
    }

    public function question()
    {
        return $this->hasOne('App\Models\Question', 'id', 'question_id');
    }
}