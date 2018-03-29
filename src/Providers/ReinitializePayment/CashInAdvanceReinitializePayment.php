<?php

namespace CashInAdvance\Providers\ReinitializePayment;

use Plenty\Plugin\Templates\Twig;
use CashInAdvance\Helper\CashInAdvanceHelper;

class CashInAdvanceReinitializePayment
{
	public function call(Twig $twig, $arg): string
	{
		/** @var CashInAdvanceHelper $paymentHelper */
		$paymentHelper = pluginApp(CashInAdvanceHelper::class);
		$paymentId = $paymentHelper->getCashInAdvanceMopId();
		return $twig->render('PrePayment::ReinitializePayment', ["order" => $arg[0], "paymentMethodId" => $paymentId]);
	}
}