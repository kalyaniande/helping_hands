<?php
namespace Church\Model;

use Zend\Db\TableGateway\TableGateway;

 class ChurchBankTable
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
          
     public function getEntryByChurchId($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('church_id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function save(ChurchBank $church)
     {
         $data = array(
             'church_id'      => $church->church_id,
             'bank_name'      => $church->bank_name,  
             'branch_name'    => $church->branch_name,  
             'account_name'   => $church->account_name,  
             'account_number' => $church->account_number,            
         );

         $id = (int) $church->id;
         if(empty($id)) {
             if($res = $this->getEntryByChurchId($church->church_id)) {
				 $id = (int) $res->id;
			 }
	     }
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getEntry($id)) {				 
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Church id does not exist');
             }
         }
     }

     public function deleteEntry($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }


