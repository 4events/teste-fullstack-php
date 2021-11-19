<?php

$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    \Doctrine\ORM\EntityManagerInterface::class => function() {
    return (new Ricardo\Teste\Infra\EntityManagerCreator())->getEntityManager();
    }
]);

return $builder->build();
