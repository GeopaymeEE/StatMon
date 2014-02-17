<?php
	/**
	 * Database definition for a type of object to monitor
	 * @since Version 1.0
	 * @package StatMon
	 * @author Michael Greenhill
	 */
	
	use Zend\Db\TableGateway\AbstractTableGateway;
	use Zend\Db\TableGateway\Feature;
	use Zend\Db\Metadata\Object\TableObject;
	
	class Type extends AbstractTableGateway {
		
		/**
		 * Primary key
		 * @since Version 1.0
		 * @var string $_primary
		 */
		 
		protected $_primary = "type_id";
		
		/**
		 * ID
		 * @since Version 1.0
		 * @var int $id
		 */
		
		public $id;
		
		/**
		 * ID
		 * @since Version 1.0
		 * @var string $transport
		 */
		
		public $transport;
		
		/**
		 * Name
		 * @since Version 1.0
		 * @var string $name
		 */
		
		public $name; 
		
		/**
		 * Port
		 * @since Version 1.0
		 * @var string $address
		 */
		
		public $port;
		
		/**
		 * Meta data
		 * @since Version 1.0
		 * @var array $meta
		 */
		
		public $meta;
		
		/**
		 * Constructor
		 */
		
		public function __construct() {
			$this->table = strtolower(__CLASS__);
			$this->featureSet = new Feature\FeatureSet();
			$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
			$this->initialize();
			
			foreach (func_get_args() as $arg) {
				if (filter_var($arg, FILTER_VALIDATE_INT)) {
					$this->get($arg);
				}
			}
		}
		
		/**
		 * Get this type
		 * @param int $server_id
		 * @return array
		 */
		
		public function get($server_id = false) {
			if (filter_var($server_id, FILTER_VALIDATE_INT)) {
				$rowset = $this->select(array($this->_primary => $server_id));
				$row = $rowset->current(); 
				
				if (!$row) {
					throw new \Exception("Could not find type ID " . $server_id); 
				}
				
				$this->id = $row['type_id']; 
				$this->transport = $row['type_transport'];
				$this->name = $row['type_name'];
				$this->port = $row['type_port'];
				$this->meta = json_decode($row['type_meta'], true);
				
				return $row;
			}
		}
		
		/**
		 * Put changes to this type
		 * @since Version 1.0
		 * @return boolean
		 */
		
		public function put() {
			if (empty($this->name)) {
				throw new \Exception("Cannot put this type - no name given");
			}
			
			if (empty($this->address)) {
				throw new \Exception("Cannot put this type - no address given"); 
			}
			
			$data = array(
				"type_transport" => $this->transport,
				"type_name" => $this->name,
				"type_port" => $this->port,
				"type_meta" => json_encode($this->meta)
			);
			
			if (filter_var($this->id, FILTER_VALIDATE_INT)) {
				// Update
				$rs = $this->update($data, array("type_id" => $this->id)); 
			} else {
				$rs = $this->insert($data);
				$this->id = $this->lastInsertValue;
			}
			
			return $rs;
		}
	}
?>