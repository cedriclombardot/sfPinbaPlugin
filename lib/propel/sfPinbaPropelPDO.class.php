<?php

class sfPinbaPropelPDO extends DebugPDO{
	
	protected $dbname;
	
	/**
	 * @see DebugPDO::__construct()
	 */
	public function __construct($dsn, $username = null, $password = null, $driver_options = array())
	{	
		parent::__construct($dsn, $username, $password, $driver_options);
		
		$this->configureStatementClass('sfPinbaPropelPDOStatement');
		
		if($this->getAttribute(PDO::ATTR_DRIVER_NAME)=='oci'){
			$this->dbname=$username;
		}else{
			$this->setDbNameFromDsn($dsn);
		}
	}
	
	/**
	 * Extract the dbname from dsn
	 * @param string $dsn
	 */
	protected function setDbNameFromDsn($dsn){
		preg_match('#dbname=([a-zA-Z0-9\_]+)#', $dsn, $matches);
		$this->dbname=$matches[1];
	}
	
	/**
	 * Return the dbname
	 */
	public function getDbName(){
		return $this->dbname;
	}
}