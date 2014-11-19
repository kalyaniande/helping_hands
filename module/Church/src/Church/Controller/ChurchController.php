<?php
namespace Church\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Church\Model\Church; 
use Church\Model\ChurchContactPerson; 
use Church\Model\ChurchNeeds; 
use Church\Model\ChurchBank; 
use Church\Form\ChurchForm;

class ChurchController extends AbstractActionController
{
    protected $churchTable;
    protected $churchContactPersonTable;
    protected $churchNeedsTable;
    protected $churchBankTable;
    protected $countryTable;
    
    public function indexAction()
    {
		return new ViewModel(array(
             'churches' => $this->getChurchTable()->fetchAll(),
         ));
    }

    public function addAction()
    {
		$form = new ChurchForm();
		$countries = $this->getCountryTable()->fetchAll();
		foreach($countries as $country) {
			$countries_list[] = $country['name'];
		}
		$form->get('country')->setAttribute('options', $countries_list);
        $form->get('submit')->setValue('Add');        

        $request = $this->getRequest();
        
        if ($request->isPost()) {			
            
            //$form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
				 $this->saveChurch($form->getData());               
                // Redirect to list of albums
                return $this->redirect()->toRoute('church');
            }
        }
        
        return array('form' => $form);
    }

    public function editAction()
    {
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
            return $this->redirect()->toRoute('church', array(
                'action' => 'add'
            ));
        }
        try {
            $church = $this->getChurchTable()->getEntry($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('church', array(
                'action' => 'index'
            ));
        }
        $needs = $this->getChurchNeedsTable()->getEntryByChurchId($church->id);
        if($needs) {
			foreach($needs as $need) {
				$needs_array[] = $need['need'];
			}
		}
		$needs_str = implode("", $needs_array);
		
		$ch_cp_data = $this->getChurchContactPersonTable()->getEntryByChurchId($church->id);
		$ch_bank_data = $this->getChurchBankTable()->getEntryByChurchId($church->id);		
		
        $form = new ChurchForm();
        $form->bind($church);
        $form->get('needs')->setAttribute('value', $needs_str);
        if($ch_cp_data) {
			$form->get('contactperson')->setAttribute('value', $ch_cp_data->name);
			$form->get('email')->setAttribute('value', $ch_cp_data->email);
			$form->get('phone')->setAttribute('value', $ch_cp_data->phone);
		}
		if($ch_bank_data) {
			$form->get('bankname')->setAttribute('value', $ch_bank_data->bank_name);
			$form->get('branchname')->setAttribute('value', $ch_bank_data->branch_name);
			$form->get('accountname')->setAttribute('value', $ch_bank_data->account_name);
			$form->get('accountnumber')->setAttribute('value', $ch_bank_data->account_number);
		}
        $form->get('submit')->setAttribute('value', 'Edit');
        $request = $this->getRequest();
        if($request->isPost()) {
			$form->setData($request->getPost());
			if($form->isValid()) {
				$this->saveChurch((array)$request->getPost());
				return $this->redirect()->toRoute('church');
			}
		}
		return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
    }
    public function getChurchTable()
    {
        if (!$this->churchTable) {
            $sm = $this->getServiceLocator();
            $this->churchTable = $sm->get('Church\Model\ChurchTable');
        }
        return $this->churchTable;
    }
    public function getChurchContactPersonTable() 
    {
		if (!$this->churchContactPersonTable) {
            $sm = $this->getServiceLocator();
            $this->churchContactPersonTable = $sm->get('Church\Model\ChurchContactPersonTable');
        }
        return $this->churchContactPersonTable;
	}
	public function getChurchNeedsTable() 
    {
		if (!$this->churchNeedsTable) {
            $sm = $this->getServiceLocator();
            $this->churchNeedsTable = $sm->get('Church\Model\ChurchNeedsTable');
        }
        return $this->churchNeedsTable;
	}
	public function getChurchBankTable() 
    {
		if (!$this->churchBankTable) {
            $sm = $this->getServiceLocator();
            $this->churchBankTable = $sm->get('Church\Model\ChurchBankTable');
        }
        return $this->churchBankTable;
	}
	public function getCountryTable() 
    {
		if (!$this->countryTable) {
            $sm = $this->getServiceLocator();
            $this->countryTable = $sm->get('Church\Model\CountryTable');
        }
        return $this->countryTable;
	}
	public function saveChurch($data) 
	{	
		$church= new Church();		
		$church->exchangeArray($data);
		$church_id = $this->getChurchTable()->save($church);
		
		$ccp_data = array('church_id' => $church_id,
						  'name'  => $data['contactperson'],
						  'email' => $data['email'],
						  'phone' => $data['phone']);                
		$church_contact_person = new ChurchContactPerson();
		$church_contact_person->exchangeArray($ccp_data);
		$this->getChurchContactPersonTable()->save($church_contact_person);
		//$needs = explode('<br />', nl2br($data['needs']));
		$cn_data = array('church_id' => $church_id,
						 'need'      => $data['needs']);
		$church_needs = new ChurchNeeds();
		$church_needs->exchangeArray($cn_data);
		$this->getChurchNeedsTable()->save($church_needs);
		
		$cb_data = array('church_id'      => $church_id,
						 'bank_name'      => $data['bankname'],
						 'branch_name'    => $data['branchname'],
						 'account_name'   => $data['accountname'],
						 'account_number' => $data['accountnumber'],);
		$church_bank = new ChurchBank();
		$church_bank->exchangeArray($cb_data);
		$this->getChurchBankTable()->save($church_bank);
	}
}
