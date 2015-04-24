<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    use SoftDeletingTrait;

    protected $fillable = ['name'];

    public function articles()
    {
        return $this->belongsToMany('Article');
    }
}