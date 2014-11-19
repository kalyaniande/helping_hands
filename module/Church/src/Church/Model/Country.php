<?php
namespace Church\Model;

 class Country
 {
     public $id;
     public $code;
     public $name;
     
     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->code = (!empty($data['code'])) ? $data['code'] : null;
         $this->name  = (!empty($data['name'])) ? $data['name'] : null;     
     }
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
 }


