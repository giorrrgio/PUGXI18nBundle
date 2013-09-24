<?php

namespace PUGX\I18nBundle\Mapping\Event\Adapter\ODM\MongoDB;

use PUGX\I18nBundle\Mapping\Event\Adapter\EventAdapterInterface;
use Doctrine\Common\EventArgs;
use Doctrine\Common\Persistence\Proxy;

class MongoDBAdapter implements EventAdapterInterface
{
    /**
     * {@inheritDoc}
     */
    public function getObject(EventArgs $e)
    {
        return $e->getDocument();
    }

    /**
     * {@inheritDoc}
     */
    public function getReflectionClass($obj)
    {
        if ($obj instanceof Proxy) {
            return new \ReflectionClass(get_parent_class($obj));
        }

        return new \ReflectionClass($obj);
    }
}