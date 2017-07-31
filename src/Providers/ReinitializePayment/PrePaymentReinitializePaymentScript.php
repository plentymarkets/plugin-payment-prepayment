<?php

namespace PrePayment\Providers\ReinitializePayment;

use Plenty\Plugin\Templates\Twig;
use PrePayment\Helper\PrePaymentHelper;

class PrePaymentReinitializePaymentScript
{
	public function call(Twig $twig): string
	{
		/** @var PrePaymentHelper $paymentHelper */
		$paymentHelper = pluginApp(PrePaymentHelper::class);
		$paymentId = $paymentHelper->getPrePaymentMopId();
		return $twig->render('PrePayment::ReinitializePaymentScript', ['paymentMethodId' => $paymentId]);
	}
}