<?php
namespace Church\Model;

 class ChurchNeeds
 {
     public $id;
     public $church_id;
     public $need;     

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->church_id = (!empty($data['church_id'])) ? $data['church_id'] : null;
         $this->need = (!empty($data['need'])) ? $data['need'] : null;
     }
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
 }


