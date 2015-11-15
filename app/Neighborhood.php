<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'neighborhoods';

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
    protected $fillable = ['district_id', 'name', 'slug'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['district_id'];

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
     * Get the suburbs for the suburb.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function suburbs()
    {
        return $this->hasMany('App\Suburb');
    }
}