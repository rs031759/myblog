<?php

namespace App;
 

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    public function comments()  {
    	return $this->hasMany('App\comment');
    }

    public function getURL() {
        return URL::action('BlogController@viewPost', ['id' => $this->id]);
    }

    public function getNumCommentsStr() {
    	$num = $this->comments()->count();

    	if ($num ==1) {
    		return '1 comment';
    	}

    	return $num. ' comments';
    }
}
