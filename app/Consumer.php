<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consumer extends Model
{
    use SoftDeletes;

    const API_KEY_LENGTH = 25;
    const API_SECRET_LENGTH = 50;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'consumers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'website', 'api_key', 'api_secret', 'access_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['api_key', 'api_secret', 'access_token'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model)
        {
            $model->generateKeys();
        });
    }

    /**
     * Generates a new 2048-bit RSA Key-Pair used for various User Activities
     */
    protected function generateKeys()
    {
        $this->attributes['api_key'] = str_random(static::API_KEY_LENGTH);
        $this->attributes['api_secret'] = str_random(static::API_SECRET_LENGTH);
    }

    /**
     * Get the user for the consumer.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the token for consumer.
     *
     * @return HasOne
     */
    public function token()
    {
        return $this->hasOne('App\Token');
    }
}