<?php

namespace App;

use App\Observers\ProfileObserver;
use App\Title;
use App\Traits\Profile\HasAvatar;
use App\Traits\Profile\HasSchedule;
use App\Traits\Profile\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasAvatar,
        HasSchedule,
        HasSlug;

    /**
     * Bootstrap the application Profile service.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::observe(ProfileObserver::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the user that owns the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the title that owns the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    /**
     * Get the days that own the profiles.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function days()
    {
        return $this->belongsToMany(Day::class)->as('work')->withPivot('start_at', 'end_at');
    }

    /**
     * Get the avatar that belongs to the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function avatar()
    {
        return $this->hasOne(Avatar::class);
    }

    /**
     * Get the profile's full name.
     *
     * @return [string]
     */
    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' .ucfirst($this->last_name);
    }

    /**
     * Get the profile's title name.
     *
     * @return [string]
     */
    public function getTitleNameAttribute()
    {
        $title = Title::find($this->title);

        return $title->name;
    }

    /**
     * Get profile role ids.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return array
     */
    public static function getProfileRolesIds($request, $id)
    {
        $profileId = $request->route()->parameter($id);
        $profile = static::find($profileId);

        $roleIds = [];

        foreach ($profile->user->roles as $role) {
           array_push($roleIds, $role->id);
        }

        return $roleIds;
    }
}