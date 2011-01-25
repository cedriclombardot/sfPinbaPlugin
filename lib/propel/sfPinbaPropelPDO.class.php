<?php

class sfPinbaPropelPDO extends DebugPDO{
	
	protected $dbname;
	
	
	public function __construct($dsn, $username = null, $password = null, $driver_options = array())
	{	
		parent::__construct($dsn, $username, $password, $driver_options);
		
		$this->configureStatementClass('sfPinbaPropelPDOStatement');
		
		$this->setDbNameFromDsn($dsn);
	}
	
	protected function setDbNameFromDsn($dsn){
		preg_match('#dbname=([a-zA-Z0-9\_]+)#', $dsn, $matches);
		$this->dbname=$matches[1];
	}
	
	public function getDbName(){
		return $this->dbname;
	}
}