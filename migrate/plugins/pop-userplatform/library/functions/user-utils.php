<?php

class PoP_UserPlatform_UserUtils
{
    public static function getUserLastAccess($user_id)
    {
        return \PoP\UserMeta\Utils::getUserMeta($user_id, POP_METAKEY_USER_LASTACCESS, true);
    }
    public static function saveUserLastAccess($user_id, $lastaccess)
    {
        \PoP\UserMeta\Utils::updateUserMeta($user_id, POP_METAKEY_USER_LASTACCESS, $lastaccess, true);
    }
}