<?php
namespace PoP\UserRoles\WP;

class FunctionAPI extends \PoP\UserRoles\FunctionAPI_Base
{
    public function addRole($role, $role_name, $capabilities = array())
    {
        add_role($role, $role_name, $capabilities);
    }
    public function addRoleToUser($user_id, $role)
    {
        $user = get_user_by('id', $user_id);
        $user->add_role($role);
    }
    public function removeRoleFromUser($user_id, $role)
    {
        $user = get_user_by('id', $user_id);
        $user->remove_role($role);
    }
    public function getUserRoles($user_id)
    {
        $user = get_user_by('id', $user_id);
        return $user->roles;
    }
    public function getTheUserRole($user_id)
    {
        return get_the_user_role($user_id);
    }
    public function userCan($user_id, $capability)
    {
        return user_can($user_id, $capability);
    }
}

/**
 * Initialize
 */
new FunctionAPI();