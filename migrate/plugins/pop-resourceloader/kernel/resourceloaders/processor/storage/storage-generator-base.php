<?php
use PoP\Hooks\Facades\HooksAPIFacade;
abstract class PoP_Engine_ResourceLoaderFileObjectBase  extends \PoP\FileStore\File\AbstractFile {

	protected function acrossThememodes() {

		return false;
	}

	protected function getBaseDir() {

		// Allow pop-cluster-resourceloader to change the dir to pop-cluster-generatecache/
		return HooksAPIFacade::getInstance()->applyFilters(
			'PoP_Engine_ResourceLoaderFileObjectBase:base-dir',
			POP_RESOURCELOADER_GENERATECACHE_DIR,
			defined('POP_THEME_INITIALIZED') && $this->acrossThememodes()
		);
	}
	
	protected function getFolderSubpath() {

		// We must create different mapping files depending on if we're adding the CDN resources inside the bundles or not
		$subfolder = PoP_ResourceLoader_ServerUtils::bundleExternalFiles() ? 'global' : 'local';
		if (defined('POP_THEME_INITIALIZED')) {

			if ($this->acrossThememodes()) {

				return '/shared';
			}
			
			$vars = \PoP\ComponentModel\Engine_Vars::getVars();
			return '/'.$vars['theme'].'/'.$vars['thememode'].'/'.$subfolder;
		}

		return $subfolder;
	}

	function getDir() {

		return $this->getBaseDir().'/resourceloader'.$this->getFolderSubpath();
	}
}