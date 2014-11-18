<?php
namespace Church\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Church\Model\Church; 
use Church\Form\ChurchForm;

class ChurchController extends AbstractActionController
{
    protected $churchTable;
    
    public function indexAction()
    {
		return new ViewModel(array(
             'churches' => $this->getChurchTable()->fetchAll(),
         ));
    }

    public function addAction()
    {
		$form = new ChurchForm();
        $form->get('submit')->setValue('Add');        

        $request = $this->getRequest();
        
        if ($request->isPost()) {
			
            $album = new Church();
            //$form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $album->exchangeArray($form->getData());
                $this->getChurchTable()->saveAlbum($album);
                
                // Redirect to list of albums
                return $this->redirect()->toRoute('church');
            }
        }
        
        return array('form' => $form);
    }

    public function editAction()
    {
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
}
