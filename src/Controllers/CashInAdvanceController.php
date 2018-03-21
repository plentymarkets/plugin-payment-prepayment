<?php
namespace CashInAdvance\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;

class CashInAdvanceController extends Controller
{
	public function getBankDetails(Twig $twig)
	{
		return $twig->render('CashInAdvance::BankDetailsOverlay');
	}
}