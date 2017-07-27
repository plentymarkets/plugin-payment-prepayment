<?php

namespace PrePayment\Providers\ReinitializePayment;

use Plenty\Plugin\Templates\Twig;
use PrePayment\Helper\PrePaymentHelper;

class PrePaymentReinitializePayment
{
	public function call(Twig $twig, $arg): string
	{
		/** @var PrePaymentHelper $paymentHelper */
		$paymentHelper = pluginApp(PrePaymentHelper::class);
		$paymentId = $paymentHelper->getPrePaymentMopId();
		return $twig->render('PrePayment::ReinitializePayment', ["order" => $arg[0], "paymentMethodId" => $paymentId]);
	}
}