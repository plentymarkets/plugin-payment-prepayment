<?php

namespace PrePayment\Containers;

use Plenty\Plugin\Templates\Twig;


class PrePaymentContainer
{
    public function call(Twig $twig):string
    {
        return $twig->render('PrePayment::Icon');
    }
}