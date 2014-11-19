<?php
namespace Church\Model;

use Zend\Db\TableGateway\TableGateway;

 class ChurchContactPersonTable
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

     public function save(ChurchContactPerson $church)
     {
         $data = array(
             'church_id'    => $church->church_id,
             'name'         => $church->name,
             'email'        => $church->email,
             'phone'        => $church->phone,                    
         );

         $id = (int) $church->id;
         if(empty($id)) {
             if($res = $this->getEntryByChurchId($church->church_id)) {
				 $id = (int) $res->id;
			 }
	     }
         if ($id == 0) {
			 $data['created'] = strtotime("now");
			 $data['updated'] = strtotime("now");
             $this->tableGateway->insert($data);
         } else {
             if ($this->getEntry($id)) {
				 $data['updated'] = strtotime("now");
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

