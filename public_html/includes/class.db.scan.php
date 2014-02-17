<?php
	/**
	 * Database definition for a server / host status scan
	 * @since Version 1.0
	 * @package StatMon
	 * @author Michael Greenhill
	 */
	
	use Zend\Db\TableGateway\AbstractTableGateway;
	use Zend\Db\TableGateway\Feature;
	use Zend\Db\Sql\Select;
	use Zend\Db\Metadata\Object\TableObject;
	
	class Scan extends AbstractTableGateway {
		
		/**
		 * Primary key
		 * @since Version 1.0
		 * @var string $_primary
		 */
		 
		protected $_primary = "scan_id";
		
		/**
		 * Scan ID
		 * @since Version 1.0
		 * @var int $id
		 */
		
		public $id;
		
		/**
		 * Server object
		 * @since Version 1.0
		 * @var $object $Server
		 */
		
		public $Server; 
		
		/**
		 * Scan timestamp
		 * @since Version 1.0
		 * @var object $timestamp
		 */
		
		public $timestamp;
		
		/**
		 * Scan result
		 * @since Version 1.0
		 * @var string $result
		 */
		
		public $result;
		
		/**
		 * Scan round trip time (rtt)
		 * @since Version 1.0
		 * @var float $rtt
		 */
		
		public $rtt;
		
		/**
		 * Do we want to be verbose about this scan?
		 * @since Version 1.0
		 * @var boolean $verbose
		 */
		
		public $verbose = false;
		
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
		 * Get this scan
		 * @param int $scan_id
		 * @return array
		 */
		
		public function get($scan_id = false) {
			if (filter_var($scan_id, FILTER_VALIDATE_INT)) {
				$rowset = $this->select(array($this->_primary => $scan_id));
				$row = $rowset->current(); 
				
				if (!$row) {
					throw new \Exception("Could not find server scan ID " . $scan_id); 
				}
				
				$this->id = $row['scan_id']; 
				$this->timestamp = new DateTime($row['scan_time']); 
				$this->result = $row['scan_result'];
				$this->rtt = $row['scan_rtt'];
				
				return $row;
			}
		}
		
		/**
		 * Put changes to this server
		 * @since Version 1.0
		 * @return boolean
		 */
		
		public function put() {
			if (empty($this->Server) || !$this->Server instanceof Server || !filter_var($this->Server->id, FILTER_VALIDATE_INT)) {
				throw new \Exception("Cannot put this server scan - no name given");
			}
			
			if (empty($this->result)) {
				throw new \Exception("Cannot put this server scan - no result given"); 
			}
			
			if (empty($this->rtt)) {
				throw new \Exception("Cannot put this server scan - no rtt given"); 
			}
			
			$data = array(
				"server_id" => $this->Server->id,
				"scan_result" => $this->result,
				"scan_rtt" => $this->rtt
			);
			
			if (filter_var($this->id, FILTER_VALIDATE_INT)) {
				// Update
				$data['scan_time'] = $this->timestamp->format("Y-m-d H:i:s");
				$rs = $this->update($data, array("scan_id" => $this->id)); 
			} else {				$rs = $this->insert($data);
				$this->id = $this->lastInsertValue;
			}
			
			return $rs;
		}
		
		/**
		 * Get latest scan results of a server
		 * @param object $Server
		 */
		
		public function getLatestFromServer($Server) {
			if (!$Server instanceof Server) {
				return false;
			}
			
			$Select = new Select($this->table);
			$Select->where(array("server_id" => $Server->id))->order("scan_time DESC")->limit("1");
			
			$rowset = $this->selectWith($Select);
			$row = $rowset->current(); 
			
			if (is_object($row) && isset($row['scan_id'])) {
				$this->get($row['scan_id']); 
			}
		}
		
		/**
		 * Run a scan
		 * @since Version 1.0
		 */
		
		public function runScan() {
			$start = microtime(true);
			
			if ($this->verbose) {
				$break = "-----------------------------------------------------\n";
				print $break;
				print "Running " . $this->Server->Type->name . " scan for " . $this->Server->name . "\n";
			}
			
			// Set a default
			$this->rtt = "0.00";
			$this->result = "down";
			
			if ($this->Server->Type->transport == "icmp") {
				// This is just a bog-standard ping, so let's ping it
				
				if (ping($this->Server->address) == "online") {
					$this->result = "up";
				}
			} elseif (isset($this->Server->meta['proxy'])) {
				// Use a proxy server to test this server
				
				use Zend\Http\Client;
				use Zend\Http\Uri;
				use Zend\Http\Request;
				
				$client_config = array(
					"max_redirects" => 2,
					"timeout" => $this->Server->rtt_max
				);
				
				$client = new Client($this->Server->address, $client_config);
				$request = new Request;
				
				$client->setRequest($request);
				$response = $client->dispatch(); 
				
				var_dump($response->isSuccess()); 
			} else {
				// For everything else
				
				$fp = @fsockopen($this->Server->address, $this->Server->Type->port, $errno, $errstr, $this->Server->rtt_max);
				
				if ($fp) {
					$this->result = "up";
				}
			}
			
			// End time
			$end = microtime(true);
			$this->rtt = number_format($end - $start, 2);
			
			if ($this->verbose) {
				print "Server is " . $this->result . ", completed in " . $this->rtt . "s\n";
			}
			
			$this->put();
		}
	}
?>