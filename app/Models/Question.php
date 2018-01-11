<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Question extends Model
{
	protected $table = "questions";

    protected $hidden = ['parents'];

	public function __construct(){
		// foreach(\App\Models\Website::all() as $website){
		// 	if(App::getLocale() == $website->locale){
		// 		 $this->table = $website->question_table;
		// 		return;
		// 	}
		// }
	}

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new CustomCollection($models);
    }

    public function answers(){
    	return $this->hasMany('App\Models\Answer', 'parent_id', 'id');
    }

    public function getChildQuestions(){
    	// $answerIds =  $this->answers()->with('children')->pluck('children.id')->toArray();
    	$answerIds =  $this->answers()->with('children')->get()->each(function($item, $key){
    		dd($item->children);
    	});
    	return $answerIds;
    	return Question::whereIn('id', $answerIds)->get();
    }

    public function childQuestions(){
    	return $this->answers()->children();
    }

    public function parents(){
    	return $this->belongsToMany('App\Models\Answer');
    }

    public function applyLocale(){

    }
}
