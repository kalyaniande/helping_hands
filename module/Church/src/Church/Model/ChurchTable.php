<?php
namespace Church\Model;

use Zend\Db\TableGateway\TableGateway;

 class ChurchTable
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

     public function save(Church $church)
     {
         $data = array(
             'name'         => $church->name,
             'description'  => $church->description,
             'donation'  => $church->donation,
             'location'     => $church->location,
             'street'       => $church->street,
             'city'         => $church->city,
             'state'        => $church->state,
             'postal_code'  => $church->postal_code,
             'country'      => $church->country,
             'latitude'     => $church->latitude,
             'longitude'    => $church->longitude,
             'banner'       => $church->banner,            
         );

         $id = (int) $church->id;
         if ($id == 0) {
			 $data['created'] = strtotime("now");
			 $data['updated'] = strtotime("now");
             if($this->tableGateway->insert($data)) {
				 $dbAdapter = $this->tableGateway->adapter;
                 $lastId = $dbAdapter->getDriver()->getConnection()->getLastGeneratedValue();
                 return $lastId;
			 }
         } else {
             if ($this->getEntry($id)) {
				 $data['updated'] = strtotime("now");
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Church id does not exist');
             }
             return $id;
         }
     }

     public function deleteEntry($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }
