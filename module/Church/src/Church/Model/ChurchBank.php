<?php
namespace Church\Model;

 class ChurchBank
 {
     public $id;
     public $church_id;
     public $bank_name; 
     public $branch_name; 
     public $account_name; 
     public $account_number;     

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->church_id = (!empty($data['church_id'])) ? $data['church_id'] : null;
         $this->bank_name = (!empty($data['bank_name'])) ? $data['bank_name'] : null;
         $this->branch_name = (!empty($data['branch_name'])) ? $data['branch_name'] : null;
         $this->account_name = (!empty($data['account_name'])) ? $data['account_name'] : null;
         $this->account_number = (!empty($data['account_number'])) ? $data['account_number'] : null;
     }
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
 }



