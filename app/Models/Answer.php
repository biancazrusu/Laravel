<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	protected $table ="answers";

	protected $hidden = ['questions', 'children', 'parent'];

	public function __construct(){
		// foreach(\App\Models\Website::all() as $website){
		// 	if(App::getLocale() == $website->locale){
		// 		 $this->table = $website->answers_table;
		// 		return;
		// 	}
		// }
	}

    public function questions(){
    	return $this->belongsToMany('App\Models\Question');
    }

    public function getQuestionsWithAnswers(){
    	return $this->questions->filter(function($question){
    		return $question->answers->count() ? true : false;
    	});
    }

    public function children(){
    	return $this->belongsToMany('App\Models\Question');
    }

    public function parent(){
    	return $this->belongsTo('App\Models\Question', 'parent_id');
    }
}
