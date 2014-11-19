<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Church;

use Church\Model\Church;
use Church\Model\ChurchTable;
use Church\Model\ChurchContactPerson;
use Church\Model\ChurchContactPersonTable;
use Church\Model\ChurchNeeds;
use Church\Model\ChurchNeedsTable;
use Church\Model\ChurchBank;
use Church\Model\ChurchBankTable;
use Church\Model\Country;
use Church\Model\CountryTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Church\Model\ChurchTable' =>  function($sm) {
                    $tableGateway = $sm->get('ChurchTableGateway');
                    $table = new ChurchTable($tableGateway);
                    return $table;
                },
                'ChurchTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Church());
                    return new TableGateway('hh_church', $dbAdapter, null, $resultSetPrototype);
                },
                'Church\Model\ChurchContactPersonTable' =>  function($sm) {
                    $tableGateway = $sm->get('ChurchContactPersonTableGateway');
                    $table = new ChurchContactPersonTable($tableGateway);
                    return $table;
                },
                'ChurchContactPersonTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new ChurchContactPerson());
                    return new TableGateway('hh_church_contact_person', $dbAdapter, null, $resultSetPrototype);
                },
                'Church\Model\ChurchNeedsTable' =>  function($sm) {
                    $tableGateway = $sm->get('ChurchNeedsTableGateway');
                    $table = new ChurchNeedsTable($tableGateway);
                    return $table;
                },
                'ChurchNeedsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new ChurchNeeds());
                    return new TableGateway('hh_church_needs', $dbAdapter, null, $resultSetPrototype);
                },
                'Church\Model\ChurchBankTable' =>  function($sm) {
                    $tableGateway = $sm->get('ChurchBankTableGateway');
                    $table = new ChurchBankTable($tableGateway);
                    return $table;
                },
                'ChurchBankTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new ChurchBank());
                    return new TableGateway('hh_church_bank', $dbAdapter, null, $resultSetPrototype);
                },
                'Church\Model\CountryTable' =>  function($sm) {
                    $tableGateway = $sm->get('CountryTableGateway');
                    $table = new CountryTable($tableGateway);
                    return $table;
                },
                'CountryTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Country());
                    return new TableGateway('hh_countries', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

}
