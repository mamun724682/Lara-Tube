<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Replace primary key id to uuid
     */
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    // Relations
    public function channel()
    {
        return $this->hasOne(Channel::class);
    }

    public function toggleVote($entity, $type)
    {
        $vote = $entity->votes->where('user_id', $this->id)->first();

        if ($vote){
            $vote->update([
                'type' => $type
            ]);

            return $vote->refresh();
        } else {
            return $entity->votes()->create([
                'user_id' => $this->id,
                'type' => $type
            ]);
        }
    }
}
