<?php
namespace PrePayment\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;

class PrePaymentController extends Controller
{
	public function getBankDetails(Twig $twig)
	{
		return $twig->render('PrePayment::BankDetailsOverlay');
	}
}