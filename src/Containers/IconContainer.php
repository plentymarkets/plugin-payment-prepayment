<?php

namespace PrePayment\Containers;

use Plenty\Plugin\Templates\Twig;


class IconContainer
{
    public function call(Twig $twig):string
    {
        return $twig->render('PrePayment::Icon');
    }
}