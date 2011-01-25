<?php
/**
* Filter requestinto pinba without using tags,
* but changing the pinba_script_name_set setting
* @author clombardot
*/
class sfPinbaScriptNameFilter extends sfFilter
{
	/**
	 * @see sfFilter
	 */
	public function execute($filterChain)
	{
		$res = sfPinbaContext::getInstance()
			->setScriptName(sfContext::getInstance()->getRequest()->getPathInfo());
			
		$filterChain->execute();
		
	}
}
