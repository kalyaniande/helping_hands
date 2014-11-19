<?php
namespace Church\Model;

 class ChurchContactPerson
 {
     public $id;
     public $church_id;
     public $name;
     public $email;
     public $phone;
     public $created;
     public $updated;
  
     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->church_id = (!empty($data['church_id'])) ? $data['church_id'] : null;
         $this->name  = (!empty($data['name'])) ? $data['name'] : null;         
         $this->email  = (!empty($data['email'])) ? $data['email'] : null;
         $this->phone  = (!empty($data['phone'])) ? $data['phone'] : null;
         $this->created  = (!empty($data['created'])) ? $data['created'] : null;
         $this->updated  = (!empty($data['updated'])) ? $data['updated'] : null;       
     }
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
 }


