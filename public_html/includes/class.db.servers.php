<?php
	/**
	 * List all servers / Check all servers
	 * @since Version 1.0
	 * @package StatMon
	 * @author Michael Greenhill
	 */
	
	use Zend\Db\TableGateway\AbstractTableGateway;
	use Zend\Db\TableGateway\Feature;
	use Zend\Db\Metadata\Object\TableObject;
	use Zend\Db\Sql\Select;
	
	class Servers extends AbstractTableGateway {
		
		/**
		 * Primary key
		 * @since Version 1.0
		 * @var string $_primary
		 */
		 
		protected $_primary = "server_id";
		
		/**
		 * List of server objects
		 * @since Version 1.0
		 * var object $servers
		 */
		
		public $servers;
		
		/**
		 * Constructor
		 */
		
		public function __construct() {
			$this->table = "server";
			$this->featureSet = new Feature\FeatureSet();
			$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
			$this->initialize();
			
			$Select = new Select;
			$Select->from($this->table)->order("server_name ASC");
			
			$rowset = $this->selectWith($Select);
			
			foreach ($rowset as $row) {
				$this->servers[$row['server_id']] = new Server($row['server_id']);
			}
		}
	}
?>