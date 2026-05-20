<?php

namespace App\View;

use Smarty\Smarty;

class Renderer
{
    private Smarty $smarty;

    public function __construct(string $templateDir, string $compileDir)
    {
        $this->smarty = new Smarty();

        $this->smarty->setTemplateDir($templateDir);
        $this->smarty->setCompileDir($compileDir);
    }

    public function render(string $template, array $params = []): string
    {
        foreach ($params as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        return $this->smarty->fetch($template);
    }
}