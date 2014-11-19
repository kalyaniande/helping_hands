<?php
namespace Church\Model;

 class Church
 {
     public $id;
     public $name;
     public $description;
     public $donation;
     public $location;
     public $street;
     public $city;
     public $state;
     public $postal_code;
     public $country;
     public $latitude;
     public $longitude;
     public $banner;
     public $created;
     public $updated;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->name = (!empty($data['name'])) ? $data['name'] : null;
         $this->description  = (!empty($data['description'])) ? $data['description'] : null;
         $this->donation  = (!empty($data['donation'])) ? $data['donation'] : null;
         $this->location  = (!empty($data['location'])) ? $data['location'] : null;
         $this->street  = (!empty($data['street'])) ? $data['street'] : null;
         $this->city  = (!empty($data['city'])) ? $data['city'] : null;
         $this->state  = (!empty($data['state'])) ? $data['state'] : null;
         $this->postal_code  = (!empty($data['postal_code'])) ? $data['postal_code'] : null;
         $this->country  = (!empty($data['country'])) ? $data['country'] : null;
         $this->latitude  = (!empty($data['latitude'])) ? $data['latitude'] : null;
         $this->longitude  = (!empty($data['longitude'])) ? $data['longitude'] : null;
         $this->banner  = (!empty($data['banner'])) ? $data['banner'] : null;     
         $this->created =  (!empty($data['created'])) ? $data['created'] : null;   
         $this->updated =  (!empty($data['updated'])) ? $data['updated'] : null;       
     }
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
 }

