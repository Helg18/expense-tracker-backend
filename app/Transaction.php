<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	protected $table = "transaction";
    protected $fillable = [
    	'subject','amount','tot','category_id',
    ];

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
}
