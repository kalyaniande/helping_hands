<?php
namespace Church\Model;

use Zend\Db\TableGateway\TableGateway;

 class CountryTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select(function ($select) {
                             //$select->where->like('name', 'Brit%');
                             //$select->order('name ASC')->limit(2);
                             $select->order('name ASC');
                             });
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

     public function save(Country $country)
     {
         $data = array(
             'code'         => $country->code,
             'name'         => $country->name,                   
         );

         $id = (int) $country->id;
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

