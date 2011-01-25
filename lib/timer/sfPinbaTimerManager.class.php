<?php
/**
 * sfPinbaTimerManager is a container for sfPinbaTimer objects.
 *
 * @package    symfony
 * @subpackage util
 */
class sfPinbaTimerManager extends sfTimerManager
{
	
	/**
   * Gets a sfPinbaTimer instance.
   *
   * It returns the timer named $name or create a new one if it does not exist.
   *
   * @param string $name The name of the timer
   *
   * @return sfPinbaTimer The timer instance
   */
  public static function getTimer($name, $tags=array())
  {
    self::$timers[$name] = new sfPinbaTimer($name);
    self::$timers[$name]->setTags($tags);
	
    self::$timers[$name]->startTimer();

    return self::$timers[$name];
  }
  
	
}