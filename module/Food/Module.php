<?php
namespace Food;

use Food\Model\Food;
use Food\Model\Reservation;
use Food\Model\User;
use Food\Model\Type;
use Food\Model\FoodTable;
use Food\Model\ReservationTable;
use Food\Model\UserTable;
use Food\Model\TypeTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module
{
	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\ClassMapAutoloader'=>array(
				__DIR__ . '/autoload_classmap.php',
			),
			'Zend\Loader\StandardAutoLoader'=>array(
				'namespaces'=>array(
					__NAMESPACE__=>__DIR__ . '/src/' . __NAMESPACE__,
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
			'factories'=>array(
				'Food\Model\FoodTable'=>function($sm)
				{
					$tableGateway=$sm->get('FoodTableGateway');
					$table=new FoodTable($tableGateway);
					return $table;
				},
				'FoodTableGateway'=>function($sm)
				{
					$dbAdapter=$sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Food());
					return new tableGateway('food', $dbAdapter, null, $resultSetPrototype);
				},
				'Food\Model\ReservationTable'=>function($sm)
				{
					$tableGateway=$sm->get('ReservationTableGateway');
					$table=new ReservationTable($tableGateway);
					return $table;
				},
				'ReservationTableGateway'=>function($sm)
				{
					$dbAdapter=$sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Reservation());
					return new tableGateway('reservation', $dbAdapter, null, $resultSetPrototype);
				},
				'Food\Model\UserTable'=>function($sm)
				{
					$tableGateway=$sm->get('UserTableGateway');
					$table=new UserTable($tableGateway);
					return $table;
				},
				'UserTableGateway'=>function($sm)
				{
					$dbAdapter=$sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new User());
					return new tableGateway('user', $dbAdapter, null, $resultSetPrototype);
				},
				'Food\Model\TypeTable'=>function($sm)
				{
					$tableGateway=$sm->get('TypeTableGateway');
					$table=new TypeTable($tableGateway);
					return $table;
				},
				'TypeTableGateway'=>function($sm)
				{
					$dbAdapter=$sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Type());
					return new tableGateway('type', $dbAdapter, null, $resultSetPrototype);
				},
			),
		);
	}
}
