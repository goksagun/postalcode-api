<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Token extends Model
{
    const ACCESS_KEY_LENGTH = 40;
    const ACCESS_SECRET_LENGTH = 45;
    const TOKEN_EXPIRED = 3600; // minutes

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['access_key', 'access_secret', 'expired_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['access_secret', 'expired_at'];

    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Token $model)
        {
            $model->generateTokens();
        });
    }

    /**
     * Generate access tokens.
     *
     * @return mixed
     */
    public function generateTokens()
    {
        $this->attributes['access_key'] = $attributes['access_key'] = str_random(static::ACCESS_KEY_LENGTH);
        $this->attributes['access_secret'] = $attributes['access_secret'] = str_random(static::ACCESS_SECRET_LENGTH);
        $this->attributes['expired_at'] = $attributes['expired_at'] = Carbon::now()->addMinutes(static::TOKEN_EXPIRED);

        return $attributes;
    }

    /**
     * Get the consumer for the token.
     *
     * @return BelongsTo
     */
    public function consumer()
    {
        return $this->belongsTo('App\Consumer');
    }
}