<?php

class sfPinbaCommandContext extends sfPinbaContext
{
	/**
     * Get the pinba context instance
     * @return sfPinbaContext
     */
    public static function getInstance() {
        if (!isset(self::$_instance)) {
			sfPinbaContext::$_instance = new sfPinbaCommandContext();
        }

    	sfConfig::set("app_pinba_enabled", sfPinbaContext::$_instance->isEnabled());

    	return sfPinbaContext::$_instance;
    }

	/**
     * Check if pinba is enabled
     * @return boolean
     */
    public function isEnabled(){
      return extension_loaded('pinba');
    }
}