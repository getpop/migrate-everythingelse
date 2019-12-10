<?php
/*
Plugin Name: PoP Menus
Version: 0.1
Description: The foundation for a PoP Menus
Plugin URI: https://getpop.org/
Author: Leonardo Losoviz
*/
namespace PoP\Menus;
use PoP\Hooks\Facades\HooksAPIFacade;

//-------------------------------------------------------------------------------------
// Constants Definition
//-------------------------------------------------------------------------------------
define('POP_MENUS_VERSION', 0.106);
define('POP_MENUS_DIR', dirname(__FILE__));

class Plugins
{
    public function __construct()
    {
        
        // Priority: new section, after PoP Engine section
        HooksAPIFacade::getInstance()->addAction('plugins_loaded', array($this, 'init'), 200);
    }
    public function init()
    {
        if ($this->validate()) {
            $this->initialize();
            define('POP_MENUS_INITIALIZED', true);
        }
    }
    public function validate()
    {
        return true;
        include_once 'validation.php';
        $validation = new Validation();
        return $validation->validate();
    }
    public function initialize()
    {
        include_once 'initialization.php';
        $initialization = new Initialization();
        return $initialization->initialize();
    }
}

/**
 * Initialization
 */
new Plugins();