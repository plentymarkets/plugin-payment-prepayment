<?php

namespace CashInAdvance\Providers\ReinitializePayment;

use Plenty\Plugin\Templates\Twig;
use CashInAdvance\Helper\CashInAdvanceHelper;

class CashInAdvanceReinitializePaymentScript
{
	public function call(Twig $twig): string
	{
		/** @var CashInAdvanceHelper $paymentHelper */
		$paymentHelper = pluginApp(CashInAdvanceHelper::class);
		$paymentId = $paymentHelper->getCashInAdvanceMopId();
		return $twig->render('CashInAdvance::ReinitializePaymentScript', ['paymentMethodId' => $paymentId]);
	}
}