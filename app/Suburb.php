<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Suburb extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'suburbs';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['neighborhood_id', 'name', 'slug'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['neighborhood_id', 'created_at', 'updated_at'];

    /**
     * Set the model slug.
     *
     * @param $value
     * @return string
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function neighborhood()
    {
        return $this->belongsTo('App\Neighborhood');
    }
}