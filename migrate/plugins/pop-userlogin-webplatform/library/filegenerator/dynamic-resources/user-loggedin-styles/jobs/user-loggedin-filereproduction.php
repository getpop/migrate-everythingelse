<?php

use PoP\ComponentModel\Misc\RequestUtils;

class PoP_CoreProcessors_FileReproduction_UserLoggedInStyles extends PoP_Engine_CSSFileReproductionBase
{
    protected $domain;

    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    public function getDomain()
    {
        $cmsengineapi = \PoP\Engine\FunctionAPIFactory::getInstance();
        return $this->domain ?? $cmsengineapi->getSiteURL();
    }

    // public function getRenderer()
    // {
    //     global $popcore_userloggedinstyles_filerenderer;
    //     return $popcore_userloggedinstyles_filerenderer;
    // }

    public function getAssetsPath(): string
    {
        return dirname(__FILE__).'/assets/css/user-loggedin.css';
    }

    /**
     * @return mixed[]
     */
    public function getConfiguration(): array
    {
        $configuration = parent::getConfiguration();

        $configuration['{{$domainId}}'] = RequestUtils::getDomainId($this->getDomain());

        return $configuration;
    }
}
