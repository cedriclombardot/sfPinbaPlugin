<?php
/**
 * sfPinbaTimer class allows to time some PHP code.
 *
 * @package    symfony
 * @subpackage util
 */
class sfPinbaTimer extends sfTimer
{
  protected $ressource=null;
  
  protected $tags=array();
  
	/**
   * Creates a new sfTimer instance.
   *
   * @param string $name The name of the timer
   */
  public function __construct($name = '')
  {
    $this->name = $name;
  }
  
  /**
   * Starts the timer.
   */
  public function startTimer()
  {
    parent::startTimer();
    
    if (sfConfig::get("app_pinba_enabled")) {
    	$this->ressource = sfPinbaContext::getInstance()->start($this->tags);
    }
  }
  
  /**
   * 
   * Change the tags for the start timer
   * @param array $tags
   */
  public function setTags($tags=array()){
  	$this->tags=$tags;
  }

  
  /**
   * Stops the timer and add the amount of time since the start to the total time.
   *
   * @return float Time spend for the last call
   */
  public function addTime()
  {
    $spend=parent::addTime();
	
    if (sfConfig::get("app_pinba_enabled")) {
    	sfPinbaContext::getInstance()->stop($this->ressource);
    }
    
    return $spend;
  }
  
}
