<?php
namespace Church\Model;

 class Church
 {
     public $id;
     public $name;
     public $description;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->artist = (!empty($data['name'])) ? $data['name'] : null;
         $this->title  = (!empty($data['description'])) ? $data['description'] : null;
     }
 }

