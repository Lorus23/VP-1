<?php

class View
{
    protected $loader;
    protected $twig;
    public function __construct($data)
    {
        $data = is_array($data);
        $this->loader = new \Twig_Loader_Filesystem();
        $this->twig = Twig_Environment($this->loader);
    }

    public function twigLoader($filename, array $data)
    {
        echo $this->twig->render($filename.".twig", $data);
    }


}