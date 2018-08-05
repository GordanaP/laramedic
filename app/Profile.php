<?php

namespace App;

use App\Appointment;
use App\Observers\ProfileObserver;
use App\Patient;
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
        return $this->belongsToMany(Day::class)->as('work')->withPivot('start_at', 'end_at', 'app_interval');
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
     * Get the appointments that belong to the profile.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
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

    /**
     * Delete the profile's attribute.
     *
     * @param  string $attribute
     * @return void
     */
    public function removeAttribute($attribute)
    {
        $this->$attribute = '';

        $this->save();
    }

    /**
     * Get doctors' profiles.
     *
     * @return array
     */
    public static function getDoctors()
    {
        $profiles = static::with('user.roles')->get();
        $doctors = [];

        foreach ($profiles as $profile){

            if ($profile->user->is_doctor) {

                array_push($doctors, $profile);
            }
        }

        return $doctors;
    }

    public static function doctorsOnDuty($start, $breakpoint, $end)
    {
        $today = today()->dayOfWeekIso;

        if(morningShift($start, $breakpoint))
        {
            $profiles = static::whereHas('workdays', function ($q) use($today, $breakpoint) {
                $q->where('start', '<', $breakpoint);
            })->get();
        }
        elseif (afternoonShift($breakpoint, $end))
        {
            $profiles = static::whereHas('workdays', function ($q) use($today, $breakpoint) {
                $q->where('start', '>=', $breakpoint);
            })->get();
        }

        return $profiles->load('appointments.patient');
    }

    /**
     * Get profiles grouped by appointments intervals
     *
     * @param  int  $mins
     * @return  array
     */
    public static function appInterval($mins)
    {
        return static::with('days')->whereHas('days', function ($q) use($mins) {
            $q->where('app_interval', '=', $mins);
        })->get();
    }

    /**
     * The doctor is at work.
     *
     * @param  string  $date
     * @return boolean
     */
    public function isWorkingOn($date)
    {
        $profileBusinessDays = $this->days->pluck('name');

        $selectedDay = getFormattedDay($date);

        return $profileBusinessDays->contains($selectedDay);
    }

    /**
     * Determine if the time is working hour.
     *
     * @param  string $date
     * @param  string $time
     * @return string
     */
    public function isProfileBusinessHour($date, $time)
    {
        $selectedDay = getFormattedDay($date, 'w');

        $profileBusinessDay = $this->days()->where('day_id', $selectedDay)->first();

        return $profileBusinessDay ? $time >= $profileBusinessDay->work->start_at && $time < $profileBusinessDay->work->end_at : '';
    }

    public function isAvailableForAppointment($date, $time)
    {
        $appDate = formatEventDate($date, $time);
        $app = $this->appointments()->where('start_at', $appDate)->first();

        return ! optional($app)->exists;
    }

}