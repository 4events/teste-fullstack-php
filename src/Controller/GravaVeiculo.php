<?php

namespace Ricardo\Teste\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Ricardo\Teste\Entity\Veiculo;
use Ricardo\Teste\Infra\EntityManagerCreator;

class GravaVeiculo
{
    private $repositorio;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorio = $entityManager->getRepository(Veiculo::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $novoVeiculo = $request->getParsedBody();

        $vendido = 0;  // off
        if (isset($novoVeiculo['txtVendido'])) {
            $vendido = 1;
        }

        $veiculo = new Veiculo();
        $veiculo->setVeiculo( $novoVeiculo['txtVeiculo'] );
        $veiculo->setMarca($novoVeiculo['txtMarca']);
        $veiculo->setDescricao($novoVeiculo['txtDescricao']);
        $veiculo->setAno( (int) $novoVeiculo['txtAno'] );
        $veiculo->setVendido($vendido);

        $entityManagerCreator = new EntityManagerCreator();
        $entityManager = $entityManagerCreator->getEntityManager();

        $entityManager->persist($veiculo);

        $entityManager->flush();

        $html = "[{'status:success'}]";

        return new Response(200,[],$html);

    }
}
