<?php

namespace Ricardo\Teste\Controller;

use Ricardo\Teste\Entity\Veiculo;
use Ricardo\Teste\Helper\RenderizadorDeHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BuscaVeiculo implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    private $repositorio;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->repositorio = $entityManager->getRepository(Veiculo::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $veiculoChave = ($request->getQueryParams()['veiculo']);
        $veiculo = explode('-',$veiculoChave);
        $veiculoId = $veiculo[1];

        $html = $this->renderizaHtml(
            'card-veiculo.php',
            [
                'veiculo'=>$this->repositorio->find($veiculoId),
            ]
        );

        return new Response(200,[],$html);
    }
}
