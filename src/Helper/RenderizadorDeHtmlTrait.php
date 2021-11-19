<?php
namespace Ricardo\Teste\Helper;

trait RenderizadorDeHtmlTrait {
    public function renderizaHtml(string $caminho, array $dados): string
    {
        extract($dados);
        ob_start();
        require __DIR__ . '/../../view/' . $caminho;
        $html = ob_get_clean();

        return $html;
    }
}
