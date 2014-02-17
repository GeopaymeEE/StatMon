<?php
	/**
	 * Database definition for a list of server types
	 * @since Version 1.0
	 * @package StatMon
	 * @author Michael Greenhill
	 */
	
	use Zend\Db\TableGateway\AbstractTableGateway;
	use Zend\Db\TableGateway\Feature;
	use Zend\Db\Metadata\Object\TableObject;
	use Zend\Db\Sql\Select;
	
	class Types extends AbstractTableGateway {
		
		/**
		 * Primary key
		 * @since Version 1.0
		 * @var string $_primary
		 */
		 
		protected $_primary = "type_id";
		
		/**
		 * Server types
		 * @since Version 1.0
		 * @var array $types
		 */
		
		public $types;
		
		/**
		 * Constructor
		 */
		
		public function __construct() {
			$this->table = "type";
			$this->featureSet = new Feature\FeatureSet();
			$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
			$this->initialize();
			
			$Select = new Select;
			$Select->from($this->table)->order("type_name ASC");
			
			$rowset = $this->selectWith($Select);
			
			foreach ($rowset as $row) {
				$this->types[$row['type_id']] = new Type($row['type_id']);
			}
		}
	}
?>