<?php

namespace Ricardo\Teste\Controller;

use Ricardo\Teste\Entity\Veiculo;
use Ricardo\Teste\Helper\RenderizadorDeHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TrazVeiculos implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    private $repositorio;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->repositorio = $entityManager->getRepository(Veiculo::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        //var_dump($request->getQueryParams());

        $veiculoChave = ($request->getQueryParams()['nome']);


        $veiculo = explode('=',$veiculoChave);
        $veiculoNome = $veiculo[1];

//        var_dump($veiculoChave);
//        var_dump($veiculoNome);

        $qb = $this->repositorio->createQueryBuilder('v');
        $qb
            ->select('v')
            ->where($qb->expr()->like('v.veiculo',':veiculo'))
            ->setParameter('veiculo','%'.$veiculoNome.'%');

        $arrayVeiculos = $qb->getQuery()->getResult();

//        var_dump($arrayVeiculos);

        $html = $this->renderizaHtml(
            'list-veiculos.php',
            [
                'veiculos'=>$arrayVeiculos,
            ]
        );

        return new Response(200,[],$html);
    }
}
