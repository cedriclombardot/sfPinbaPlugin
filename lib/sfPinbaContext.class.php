<?php 
class sfPinbaContext  
{
	
	protected static $_request;
	protected static $_sfUser;
    protected static $_instance;
 
    public static function getInstance() {
        if (!isset(self::$_instance)) {
			self::$_instance = new sfPinbaContext();         
        }

        if (self::$_request  === NULL) {            	
    		self::$_request = sfContext::getInstance()->getRequest();
        }
		if (self::$_sfUser  === NULL) {
		     self::$_sfUser    = sfContext::getInstance()->getUser();
		} 
        
        return self::$_instance;
    }
 
    // Do not allow an explicit call of the constructor: $v = new Singleton();
    final private function __construct() {
    	
    	if (sfConfig::get("app_pinba_enabled") && !extension_loaded('pinba')) {
    		throw new Exception("The plugin sfPinbaPlugin required the pinba extension");
    	}
    }
 
    /**
     * Change the pinba_script_name_set
     * @param string $script_name the new script name
     * @return sfPinbaContext the current context
     */
    public function setScriptName($script_name){
    	pinba_script_name_set($script_name);
    	return $this;
    }
    
    /**
     * Start pinba timer
     * @see pinba_timer_start 
     * execute pinba_timer_start
     * @param $tags array of tags
     * @return $ressource timer
     */
    public function start($tags=null){
    	return pinba_timer_start($tags);
    }
    
    
	/**
     * Stop pinba timer
     * @see pinba_timer_stop
     * execute pinba_timer_stop
     * @param Resource $timer
     * @return boolean 
     */
    public function stop($timer){
    	return pinba_timer_stop($timer);
    }
    
    public function startTimerForRequest() {
    	if (sfConfig::get("app_pinba_enabled")) {
	    	$option = array(
	    		"module" => self::$_request->getParameter("module"),
	    		"action" => self::$_request->getParameter("action"),
	    	);
	    	
	    	$modules = sfConfig::get("app_pinba_modules");
	    	
	    	if (!empty($modules[$option['module']])) {
	    		$actionsEnabled = $modules[$option['module']];
	    	} else {
	    		$actionsEnabled = null;
	    	}
	    	
	    	$startTimer = false;
	    	//No modules are specified, we monitor all the modules
	    	if (empty($modules)) {
	    		$startTimer = true;
	    	} elseif ((is_array($actionsEnabled)  && !empty($option['action']) && in_array($option['action'], $actionsEnabled))) {
	    		//We monitor the specific module/action listed in the config file
	    		$startTimer = true;
	    	} elseif (isset($modules[$option['module']])  && $modules[$option['module']] === true) {
	    		//A module is specified, but the action is not, so we monitor all the actions
	    		$startTimer = true;
	    	}
	    	
			if ($startTimer) {
	    		$this->start($option);
	    	} 
    	}
    }
    
    // Do not allow the clone operation: $x = clone $v;
    final protected function __clone() { }
}
