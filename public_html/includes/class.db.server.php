<?php
	/**
	 * Database definition for a server / host to be monitored
	 * @since Version 1.0
	 * @package StatMon
	 * @author Michael Greenhill
	 */
	
	use Zend\Db\TableGateway\AbstractTableGateway;
	use Zend\Db\TableGateway\Feature;
	use Zend\Db\Metadata\Object\TableObject;
	use Zend\Db\Sql\Select;
	
	class Server extends AbstractTableGateway {
		
		/**
		 * Primary key
		 * @since Version 1.0
		 * @var string $_primary
		 */
		 
		protected $_primary = "server_id";
		
		/**
		 * Server ID
		 * @since Version 1.0
		 * @var int $id
		 */
		
		public $id;
		
		/**
		 * Server name
		 * @since Version 1.0
		 * @var string $name
		 */
		
		public $name; 
		
		/**
		 * Server address
		 * @since Version 1.0
		 * @var string $address
		 */
		
		public $address;
		
		/**
		 * Maximum allowed RTT for this server
		 * @since Version 1.0
		 * @var float $rtt_max
		 */
		
		public $rtt_max;
		
		/**
		 * Metadata
		 * @since Version 1.0
		 * @var array $meta
		 */
		
		public $meta;
		
		/**
		 * Server type
		 * @since Version 1.0
		 * @var object $Type
		 */
		
		public $Type;
		
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
		 * Get this server
		 * @param int $server_id
		 * @return array
		 */
		
		public function get($server_id = false) {
			if (filter_var($server_id, FILTER_VALIDATE_INT)) {
				$rowset = $this->select(array($this->_primary => $server_id));
				$row = $rowset->current(); 
				
				if (!$row) {
					throw new \Exception("Could not find server ID " . $server_id); 
				}
				
				$this->id = $row['server_id']; 
				$this->name = $row['server_name'];
				$this->address = $row['server_address'];
				$this->Type = new Type($row['type_id']);
				$this->rtt_max = $row['server_rtt_max'];
				$this->meta = json_decode($row['server_meta'], true);
				
				return $row;
			}
		}
		
		/**
		 * Put changes to this server
		 * @since Version 1.0
		 * @return boolean
		 */
		
		public function put() {
			if (empty($this->name)) {
				throw new \Exception("Cannot put this server - no name given");
			}
			
			if (empty($this->address)) {
				throw new \Exception("Cannot put this server - no address given"); 
			}
			
			$data = array(
				"server_name" => $this->name,
				"server_address" => $this->address,
				"type_id" => $this->Type->id,
				"server_rtt_max" => $this->rtt_max,
				"server_meta" => json_encode($this->meta)
			);
			
			if (filter_var($this->id, FILTER_VALIDATE_INT)) {
				// Update
				$rs = $this->update($data, array("server_id" => $this->id)); 
			} else {
				$rs = $this->insert($data);
				$this->id = $this->lastInsertValue;
			}
			
			return $rs;
		}
	}
?>