<?php

namespace Ricardo\Teste\Infra;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class EntityManagerCreator
{
    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function getEntityManager(): EntityManagerInterface
    {
        $paths = [__DIR__ . '/../Entity'];

        $config = Setup::createAnnotationMetadataConfiguration($paths, false,null,null,false);

        $dbParams = array(
            'driver'=>DBDRIVER,
            'url'=>DBPROTOCOLO."://".DBUSER."@".DBHOST."/".DBNAME
        );
        return EntityManager::create($dbParams, $config);
    }
}
