<?php
use PoP\Engine\Route\RouteUtils;

class NSCPP_Module_Processor_CarouselControls extends PoP_Module_Processor_CarouselControlsBase
{
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS00 = 'carouselcontrols-nosearchcategoryposts00';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS01 = 'carouselcontrols-nosearchcategoryposts01';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS02 = 'carouselcontrols-nosearchcategoryposts02';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS03 = 'carouselcontrols-nosearchcategoryposts03';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS04 = 'carouselcontrols-nosearchcategoryposts04';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS05 = 'carouselcontrols-nosearchcategoryposts05';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS06 = 'carouselcontrols-nosearchcategoryposts06';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS07 = 'carouselcontrols-nosearchcategoryposts07';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS08 = 'carouselcontrols-nosearchcategoryposts08';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS09 = 'carouselcontrols-nosearchcategoryposts09';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS10 = 'carouselcontrols-nosearchcategoryposts10';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS11 = 'carouselcontrols-nosearchcategoryposts11';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS12 = 'carouselcontrols-nosearchcategoryposts12';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS13 = 'carouselcontrols-nosearchcategoryposts13';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS14 = 'carouselcontrols-nosearchcategoryposts14';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS15 = 'carouselcontrols-nosearchcategoryposts15';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS16 = 'carouselcontrols-nosearchcategoryposts16';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS17 = 'carouselcontrols-nosearchcategoryposts17';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS18 = 'carouselcontrols-nosearchcategoryposts18';
    public const MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS19 = 'carouselcontrols-nosearchcategoryposts19';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS00 = 'carouselcontrols-authornosearchcategoryposts00';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS01 = 'carouselcontrols-authornosearchcategoryposts01';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS02 = 'carouselcontrols-authornosearchcategoryposts02';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS03 = 'carouselcontrols-authornosearchcategoryposts03';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS04 = 'carouselcontrols-authornosearchcategoryposts04';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS05 = 'carouselcontrols-authornosearchcategoryposts05';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS06 = 'carouselcontrols-authornosearchcategoryposts06';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS07 = 'carouselcontrols-authornosearchcategoryposts07';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS08 = 'carouselcontrols-authornosearchcategoryposts08';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS09 = 'carouselcontrols-authornosearchcategoryposts09';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS10 = 'carouselcontrols-authornosearchcategoryposts10';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS11 = 'carouselcontrols-authornosearchcategoryposts11';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS12 = 'carouselcontrols-authornosearchcategoryposts12';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS13 = 'carouselcontrols-authornosearchcategoryposts13';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS14 = 'carouselcontrols-authornosearchcategoryposts14';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS15 = 'carouselcontrols-authornosearchcategoryposts15';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS16 = 'carouselcontrols-authornosearchcategoryposts16';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS17 = 'carouselcontrols-authornosearchcategoryposts17';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS18 = 'carouselcontrols-authornosearchcategoryposts18';
    public const MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS19 = 'carouselcontrols-authornosearchcategoryposts19';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS00 = 'carouselcontrols-tagnosearchcategoryposts00';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS01 = 'carouselcontrols-tagnosearchcategoryposts01';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS02 = 'carouselcontrols-tagnosearchcategoryposts02';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS03 = 'carouselcontrols-tagnosearchcategoryposts03';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS04 = 'carouselcontrols-tagnosearchcategoryposts04';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS05 = 'carouselcontrols-tagnosearchcategoryposts05';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS06 = 'carouselcontrols-tagnosearchcategoryposts06';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS07 = 'carouselcontrols-tagnosearchcategoryposts07';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS08 = 'carouselcontrols-tagnosearchcategoryposts08';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS09 = 'carouselcontrols-tagnosearchcategoryposts09';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS10 = 'carouselcontrols-tagnosearchcategoryposts10';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS11 = 'carouselcontrols-tagnosearchcategoryposts11';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS12 = 'carouselcontrols-tagnosearchcategoryposts12';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS13 = 'carouselcontrols-tagnosearchcategoryposts13';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS14 = 'carouselcontrols-tagnosearchcategoryposts14';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS15 = 'carouselcontrols-tagnosearchcategoryposts15';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS16 = 'carouselcontrols-tagnosearchcategoryposts16';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS17 = 'carouselcontrols-tagnosearchcategoryposts17';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS18 = 'carouselcontrols-tagnosearchcategoryposts18';
    public const MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS19 = 'carouselcontrols-tagnosearchcategoryposts19';

    public function getModulesToProcess(): array
    {
        return array(
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS00],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS01],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS02],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS03],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS04],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS05],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS06],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS07],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS08],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS09],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS10],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS11],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS12],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS13],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS14],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS15],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS16],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS17],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS18],
            [self::class, self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS19],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS00],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS01],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS02],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS03],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS04],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS05],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS06],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS07],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS08],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS09],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS10],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS11],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS12],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS13],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS14],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS15],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS16],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS17],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS18],
            [self::class, self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS19],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS00],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS01],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS02],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS03],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS04],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS05],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS06],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS07],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS08],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS09],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS10],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS11],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS12],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS13],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS14],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS15],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS16],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS17],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS18],
            [self::class, self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS19],
        );
    }

    public function getControlClass(array $module)
    {
        switch ($module[1]) {
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS00:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS01:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS02:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS03:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS04:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS05:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS06:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS07:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS08:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS09:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS10:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS11:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS12:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS13:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS14:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS15:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS16:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS17:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS18:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS19:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS00:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS01:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS02:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS03:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS04:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS05:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS06:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS07:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS08:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS09:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS10:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS11:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS12:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS13:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS14:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS15:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS16:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS17:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS18:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS19:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS00:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS01:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS02:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS03:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS04:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS05:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS06:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS07:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS08:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS09:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS10:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS11:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS12:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS13:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS14:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS15:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS16:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS17:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS18:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS19:
                return 'btn btn-link btn-compact';
        }

        return parent::getControlClass($module);
    }

    public function getTitleClass(array $module)
    {
        switch ($module[1]) {
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS00:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS01:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS02:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS03:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS04:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS05:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS06:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS07:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS08:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS09:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS10:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS11:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS12:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS13:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS14:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS15:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS16:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS17:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS18:
            case self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS19:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS00:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS01:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS02:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS03:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS04:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS05:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS06:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS07:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS08:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS09:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS10:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS11:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS12:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS13:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS14:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS15:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS16:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS17:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS18:
            case self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS19:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS00:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS01:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS02:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS03:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS04:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS05:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS06:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS07:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS08:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS09:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS10:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS11:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS12:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS13:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS14:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS15:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS16:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS17:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS18:
            case self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS19:
                return 'btn btn-link btn-compact';
        }

        return parent::getTitleClass($module);
    }
    public function getTitle(array $module, array &$props)
    {
        $routes = array(
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS00 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS00,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS01 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS01,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS02 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS02,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS03 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS03,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS04 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS04,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS05 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS05,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS06 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS06,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS07 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS07,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS08 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS08,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS09 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS09,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS10 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS10,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS11 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS11,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS12 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS12,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS13 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS13,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS14 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS14,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS15 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS15,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS16 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS16,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS17 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS17,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS18 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS18,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS19 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS19,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS00 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS00,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS01 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS01,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS02 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS02,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS03 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS03,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS04 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS04,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS05 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS05,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS06 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS06,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS07 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS07,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS08 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS08,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS09 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS09,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS10 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS10,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS11 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS11,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS12 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS12,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS13 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS13,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS14 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS14,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS15 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS15,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS16 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS16,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS17 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS17,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS18 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS18,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS19 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS19,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS00 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS00,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS01 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS01,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS02 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS02,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS03 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS03,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS04 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS04,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS05 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS05,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS06 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS06,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS07 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS07,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS08 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS08,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS09 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS09,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS10 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS10,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS11 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS11,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS12 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS12,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS13 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS13,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS14 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS14,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS15 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS15,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS16 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS16,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS17 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS17,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS18 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS18,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS19 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS19,
        );
        if ($route = $routes[$module[1]]) {
            return RouteUtils::getRouteTitle($route);
        }

        return parent::getTitle($module, $props);
    }
    protected function getTitleLink(array $module, array &$props)
    {
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
        $taxonomyapi = \PoP\Taxonomies\FunctionAPIFactory::getInstance();
        $routes = array(
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS00 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS00,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS01 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS01,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS02 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS02,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS03 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS03,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS04 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS04,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS05 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS05,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS06 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS06,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS07 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS07,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS08 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS08,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS09 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS09,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS10 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS10,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS11 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS11,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS12 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS12,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS13 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS13,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS14 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS14,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS15 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS15,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS16 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS16,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS17 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS17,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS18 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS18,
            self::MODULE_CAROUSELCONTROLS_NOSEARCHCATEGORYPOSTS19 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS19,
        );
        $authorroutes = array(
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS00 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS00,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS01 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS01,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS02 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS02,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS03 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS03,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS04 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS04,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS05 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS05,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS06 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS06,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS07 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS07,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS08 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS08,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS09 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS09,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS10 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS10,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS11 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS11,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS12 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS12,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS13 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS13,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS14 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS14,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS15 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS15,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS16 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS16,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS17 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS17,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS18 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS18,
            self::MODULE_CAROUSELCONTROLS_AUTHORNOSEARCHCATEGORYPOSTS19 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS19,
        );
        $tagroutes = array(
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS00 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS00,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS01 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS01,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS02 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS02,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS03 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS03,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS04 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS04,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS05 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS05,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS06 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS06,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS07 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS07,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS08 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS08,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS09 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS09,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS10 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS10,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS11 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS11,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS12 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS12,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS13 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS13,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS14 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS14,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS15 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS15,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS16 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS16,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS17 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS17,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS18 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS18,
            self::MODULE_CAROUSELCONTROLS_TAGNOSEARCHCATEGORYPOSTS19 => POP_NOSEARCHCATEGORYPOSTS_ROUTE_NOSEARCHCATEGORYPOSTS19,
        );
        if ($route = $routes[$module[1]]) {
            return RouteUtils::getRouteURL($route);
        } elseif ($route = $authorroutes[$module[1]]) {
            $author = $vars['routing-state']['queried-object-id'];
            $url = $cmsusersapi->getUserURL($author);
            return \PoP\ComponentModel\Utils::addRoute($url, $route);
        } elseif ($route = $tagroutes[$module[1]]) {
            $url = $taxonomyapi->getTagLink($vars['routing-state']['queried-object-id']);
            return \PoP\ComponentModel\Utils::addRoute($url, $route);
        }

        return parent::getTitleLink($module, $props);
    }
}

