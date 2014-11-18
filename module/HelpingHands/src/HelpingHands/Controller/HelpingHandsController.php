<?php
namespace HelpingHands\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class HelpingHandsController extends AbstractActionController
{
    public function indexAction()
    {
		return new ViewModel();
    }
   
}

