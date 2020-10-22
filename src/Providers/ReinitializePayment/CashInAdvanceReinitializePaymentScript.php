<?php

namespace CashInAdvance\Providers\ReinitializePayment;

use Plenty\Plugin\Templates\Twig;
use CashInAdvance\Helper\CashInAdvanceHelper;
use Plenty\Modules\Webshop\Contracts\LocalizationRepositoryContract;

class CashInAdvanceReinitializePaymentScript
{
	public function call(Twig $twig, LocalizationRepositoryContract $localizationRepository): string
	{
		/** @var CashInAdvanceHelper $paymentHelper */
		$paymentHelper = pluginApp(CashInAdvanceHelper::class);
		$paymentId = $paymentHelper->getCashInAdvanceMopId();
		return $twig->render('PrePayment::ReinitializePaymentScript', [
		    'paymentMethodId' => $paymentId,
            'lang' => $localizationRepository->getLanguage()
        ]);
	}
}