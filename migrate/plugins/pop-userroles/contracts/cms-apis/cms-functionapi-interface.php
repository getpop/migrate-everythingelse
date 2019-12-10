<?php
namespace PoP\UserRoles;

interface FunctionAPI
{
    public function addRole($role, $role_name, $capabilities = array());
    public function addRoleToUser($user_id, $role);
    public function removeRoleFromUser($user_id, $role);
    public function getUserRoles($user_id);
    public function getTheUserRole($user_id);
    public function userCan($user_id, $capability);
    public function currentUserCan($capability);
}