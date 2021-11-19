<?php

namespace Ricardo\Teste\Controller;

use Ricardo\Teste\Entity\Veiculo;
use Ricardo\Teste\Helper\RenderizadorDeHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Veiculos implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;

    private $repositorio;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->repositorio = $entityManager->getRepository(Veiculo::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderizaHtml(
            'listar-veiculos.php',
            [
                'veiculos'=>$this->repositorio->findAll(),
                'titulo'=>'Lista de Veiculos',
            ]
        );

        return new Response(200,[],$html);
    }
}
