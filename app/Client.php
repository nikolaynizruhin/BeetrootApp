<?php

namespace App;

use App\Scopes\NameScope;
use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Client extends Model
{
    use Filterable, Taggable;

    /**
     * Constant representing a default client logo.
     *
     * @var string
     */
    const DEFAULT_LOGO = 'logos/default.png';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The list of sorts.
     *
     * @var array
     */
    protected static $sorts = [
        'name' => 'Name',
        '-created_at' => 'Recent',
        'created_at' => 'Oldest',
    ];

    /**
     * Get the users for the client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get list of sorts.
     *
     * @return array
     */
    public static function sorts()
    {
        return static::$sorts;
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NameScope);

        static::deleting(function ($client) {
            if ($client->logo !== self::DEFAULT_LOGO) {
                Storage::delete($client->logo);
            }
        });
    }
}
