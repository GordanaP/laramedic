<?php

use Carbon\Carbon;

/**
 * Create the response message.
 *
 * @param  string  $message
 * @param  string  $type
 * @return array
 */
function message($message, $type="success")
{
    $response['message'] = $message;
    $response['type'] = $type;

    return $response;
}

/**
 * Set username.
 *
 * @param string $first_name
 * @param string $last_name
 */
function setUsername($first_name, $last_name)
{
    return strtolower(substr($first_name, 0, 1)).strtolower($last_name);
}


/**
 * Get full name.
 *
 * @param string $first_name
 * @param string $last_name
 */
function getFullName($first_name, $last_name)
{
    return $first_name .' ' .$last_name;
}

/**
 * Set avatar.
 *
 * @param \App\User $user
 * @return string
 */
function setAvatar($profile)
{
    $avatar = optional($profile->avatar)->filename ?: 'default.jpg';
    return 'images/avatars/'.$avatar;
}

/**
 * Set avatar name.
 *
 * @param int $userId
 * @param Fil $file
 */
function setAvatarName($userId, $file)
{
    return $userId.'-'.$file->getClientOriginalName();
}


/**
 * Get the medical record number
 *
 * @param  [string] $date
 * @param  [string] $f_name
 * @param  [string] $l_name
 * @return [string]
 */
function setMedicalRecord($birthday, $f_name, $l_name)
{
    $day = formattedDate($birthday, 'd');
    $month = formattedDate($birthday, 'm');
    $year = substr(formattedDate($birthday, 'Y'), 1);
    $f_name = strtoupper(substr($f_name, 0, 2));
    $l_name = strtoupper(substr($l_name, 0, 2));

    return $day.$month.$year.$f_name.$l_name;
}

/**
 * Get the PHP format of the date.
 *
 * @param  string $date
 * @param  string $format
 * @return string
 */
function formattedDate($date, $format)
{
    return date($format, strtotime($date));
}

/**
 * Get the Carbon instance of the event date.
 *
 * @param  string $date
 * @param  string $time
 * @param  string $format
 * @return string
 */
function formatEventDate($date, $time, $format='Y-m-d H:i')
{
    return Carbon::createFromFormat($format, $date.' '.$time);
}

/**
 * Set a weekday.
 *
 * @param string $format
 */
function getFormattedDay($date, $format='l')
{
    return date($format, strtotime($date));
}
