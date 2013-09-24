<?php

namespace PUGX\I18nBundle\Tests\Mapping\Event\Adapter\ORM;

use PUGX\I18nBundle\Mapping\Event\Adapter\ODM\MongoDB\MongoDBAdapter;
use PUGX\I18nBundle\Tests\Translatable;
use PUGX\I18nBundle\Tests\TranslatableProxy;

class MongoDBAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testGetObject()
    {
        if (!class_exists('Doctrine\ODM\MongoDB\Event\LifecycleEventArgs')) {
            $this->markTestSkipped('Doctrine\ODM\MongoDB\Event\LifecycleEventArgs does not exist.');
        } else {
            $args = $this->getMockBuilder('Doctrine\ODM\MongoDB\Event\LifecycleEventArgs')
                    ->disableOriginalConstructor()->getMock();
            
            $adapter = new MongoDBAdapter();
            $args->expects($this->once())->method('getDocument');
            $adapter->getObject($args);
        }
    }
    
    public function testGetReflectionClass()
    {
        if (!interface_exists('Doctrine\Common\Persistence\Proxy')) {
            $this->markTestSkipped('Doctrine\Common\Persistence\Proxy does not exist.');
        } else {
            $obj = new Translatable(array());
            $adapter = new MongoDBAdapter();
            $class = $adapter->getReflectionClass($obj);

            $this->assertEquals($class->getName(), get_class($obj));
        }
    }
    
    public function testGetReflectionClassProxy()
    {
        if (!interface_exists('Doctrine\Common\Persistence\Proxy')) {
            $this->markTestSkipped('Doctrine\Common\Persistence\Proxy does not exist.');
        } else {
            $obj = new TranslatableProxy(array());
            $adapter = new MongoDBAdapter();
            $class = $adapter->getReflectionClass($obj);

            $this->assertEquals($class->getName(), get_parent_class($obj));
        }
    }
}