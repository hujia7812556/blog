<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    use SoftDeletingTrait;

    protected $fillable = ['title', 'content'];

    public function tags()
    {
        return $this->belongsToMany('Tag');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

}
