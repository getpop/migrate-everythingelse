<?php
use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\LooseContracts\Facades\NameResolverFacade;
use PoP\Users\TypeDataLoaders\UserTypeDataLoader;

define('GD_ROLE_PROFILE', 'profile');

// Set the default role for the user typeDataResolver
HooksAPIFacade::getInstance()->addFilter('UserTypeDataLoader:query', 'gdUreMaybeProfileRole');
function gdUreMaybeProfileRole($query)
{

    // Only if no $role set yet
    if (!$query['role']) {
        $query['role'] = GD_ROLE_PROFILE;
    }

    return $query;
}

HooksAPIFacade::getInstance()->addFilter('gdRoles', 'gdUreAddProfileRole');
function gdUreAddProfileRole($roles)
{
    $roles[] = GD_ROLE_PROFILE;
    return $roles;
}

// Priority 0: before anything else
HooksAPIFacade::getInstance()->addFilter('getUserRoleCombinations', 'getUserRoleCombinationsProfileRole', 0);
function getUserRoleCombinationsProfileRole($user_role_combinations)
{
    $user_role_combinations = array(
        array(
            GD_ROLE_PROFILE,
        ),
    );
    return $user_role_combinations;
}

function isProfile($user = null)
{
    return \PoP\UserRoles\Utils::hasRole(GD_ROLE_PROFILE, $user);
}

/**
 * Determine the threshold capability to split subscriber users from admins / individual / organization users
 */
function userHasProfileAccess($user_id = null)
{
    return userHasAccess(NameResolverFacade::getInstance()->getName('popcms:capability:editPosts'), $user_id);
}

/**
 * User Type Data Resolver: allow to select users only with at least role GD_ROLE_PROFILE
 */
HooksAPIFacade::getInstance()->addFilter(UserTypeDataLoader::class.':gd_dataload_query', 'gdUreUserlistQuery');
function gdUreUserlistQuery($query)
{
    // The role can only be Profile (Organization + Individual), force there's no other (protection against hackers).
    $roles = gdRoles();
    if (!in_array($query['role'], $roles)) {
        $query['role'] = GD_ROLE_PROFILE;
    }

    return $query;
}
