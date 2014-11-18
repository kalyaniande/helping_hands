<?php
namespace Church\Form;

 use Zend\Form\Form;

 class ChurchForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('album');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'title',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Title',
             ),
         ));
         $this->add(array(
             'name' => 'description',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Description',
             ),
         ));
         $this->add(array(
             'name' => 'needs',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Needs',
             ),
         ));
         $this->add(array(
             'name' => 'donation',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Donation Needed',
             ),
         ));
         $this->add(array(
             'name' => 'banner',
             'type' => 'File',
             'options' => array(
                 'label' => 'Banner',
             ),
         ));
         $this->add(array(
             'name' => 'thumbnail',
             'type' => 'File',
             'options' => array(
                 'label' => 'Thumbnail',
             ),
         ));
         $this->add(array(
             'name' => 'location-name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Location Name',
             ),
         ));
         $this->add(array(
             'name' => 'street',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Street',
             ),
         ));
         $this->add(array(
             'name' => 'city',
             'type' => 'Text',
             'options' => array(
                 'label' => 'City',
             ),
         ));
          $this->add(array(
             'name' => 'state',
             'type' => 'Text',
             'options' => array(
                 'label' => 'State/Province',
             ),
         ));
          $this->add(array(
             'name' => 'postalcode',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Postal Code',
             ),
         ));
         $this->add(array(
             'name' => 'country',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Country',
             ),
         ));
         $this->add(array(
             'name' => 'latitude',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Latitude',
             ),
         ));
         $this->add(array(
             'name' => 'longitude',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Longitude',
             ),
         ));
         $this->add(array(
             'name' => 'contactperson',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Contact Person',
             ),
         ));
         $this->add(array(
             'name' => 'email',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Email',
             ),
         ));
         $this->add(array(
             'name' => 'phone',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Phone Number',
             ),
         ));
         $this->add(array(
             'name' => 'bankname',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Bank Name',
             ),
         ));
         $this->add(array(
             'name' => 'branchname',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Branch Name',
             ),
         ));
         $this->add(array(
             'name' => 'accountname',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Account Name',
             ),
         ));
         $this->add(array(
             'name' => 'accountnumber',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Account Number',
             ),
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }

