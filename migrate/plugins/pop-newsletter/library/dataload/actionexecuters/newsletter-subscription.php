<?php

class GD_DataLoad_ActionExecuter_NewsletterSubscription extends GD_DataLoad_FormActionExecuterBase
{
    public function getMutationResolverClass(): string
    {
        return PoP_ActionExecuterInstance_SubscribeToNewsletter::class;
    }
}

