<?php

namespace CashInAdvance\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;

class CashInAdvanceController extends Controller
{
	public function getBankDetails(Twig $twig, $lang)
	{
	    if ($lang === null || !strlen($lang)) {
	        $lang = 'de';
        }
	    
		return $twig->render('PrePayment::BankDetailsOverlay', ['lang' => $lang]);
	}
}