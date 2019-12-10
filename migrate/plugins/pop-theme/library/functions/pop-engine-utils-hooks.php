<?php
namespace PoP\Theme;
use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\Engine\FieldResolvers\OperatorFieldResolver;

class PoP_Theme_UtilsHooks
{
    public static function addVars($vars_in_array)
    {
        $thememanager = Themes\ThemeManagerFactory::getInstance();
        $vars = &$vars_in_array[0];

        $vars['theme'] = $thememanager->getTheme() ? $thememanager->getTheme()->getName() : '';
        $vars['thememode'] = $thememanager->getThememode() ? $thememanager->getThememode()->getName() : '';
        $vars['themestyle'] = $thememanager->getThemestyle() ? $thememanager->getThemestyle()->getName() : '';
        $vars['theme-isdefault'] = $thememanager->isDefaultTheme();
        $vars['thememode-isdefault'] = $thememanager->isDefaultThememode();
        $vars['themestyle-isdefault'] = $thememanager->isDefaultThemestyle();
        $vars['theme-path'] = $thememanager->getThemePath();
    }
    public function setSafeVars($vars_in_array)
    {
        // Remove the theme path
        $safeVars = &$vars_in_array[0];
        unset($safeVars['theme-path']);
    }
}

/**
 * Initialization
 */
HooksAPIFacade::getInstance()->addAction('\PoP\ComponentModel\Engine_Vars:addVars', array(PoP_Theme_UtilsHooks::class, 'addVars'), 10, 1);
HooksAPIFacade::getInstance()->addAction(OperatorFieldResolver::HOOK_SAFEVARS, array(PoP_Theme_UtilsHooks::class, 'setSafeVars'), 10, 1);