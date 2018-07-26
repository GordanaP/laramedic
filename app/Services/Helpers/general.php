<?php

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