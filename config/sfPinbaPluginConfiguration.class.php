<?php

/**
 * sfPinbaPlugin configuration.
 *
 * @package     sfPinbaPlugin
 * @subpackage  config
 * @author      Bysoft
 * @version     SVN: $Id: PluginConfiguration.class.php 17207 2009-04-10 15:36:26Z Kris.Wallsmith $
 */
class sfPinbaPluginConfiguration extends sfPluginConfiguration
{
  const VERSION = '1.0.0-DEV';

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
      $this->dispatcher->connect('command.pre_command', array(
          new sfPinbaCommandEventListener(),
          'onPreCommand'
      ));

      $this->dispatcher->connect('command.post_command', array(
          new sfPinbaCommandEventListener(),
          'onPostCommand'
      ));
  }
}
