<?php
namespace Church\Model;

use Zend\Db\TableGateway\TableGateway;

 class ChurchNeedsTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         if($resultSet) {
			 $result = $resultSet->toArray();
			 return $result;
		 }         
     }

     public function getEntry($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }
     
     public function getEntryByChurchId($church_id) {
		 
		 $church_id = (int) $church_id;
		 
		 if($result = $this->tableGateway->select(array('church_id' => $church_id))) {
			 return $result->toArray();
		 }
	 }
	 
     public function save(ChurchNeeds $church)
     {
         $data = array(
             'church_id' => $church->church_id,
             'needs'      => $church->need,            
         );
                  
         if ($this->getEntryByChurchId($church->church_id)) {
			  $this->deleteAllByChurchId($church->church_id);
		 }
	     $needs = explode('<br />', nl2br($data['needs']));
		 foreach($needs as $need) {
			 if(trim($need) != NULL) {
			     $need_info = array('church_id' => $church->church_id,
			                        'need'      => $need);
                 $this->tableGateway->insert($need_info);
		     }
		 }
          
     }

     public function deleteEntry($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
     public function deleteAllByChurchId($id)
     {
         $this->tableGateway->delete(array('church_id' => (int) $id));
     }
 }

