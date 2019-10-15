<?php
namespace CashInAdvance\Assistants;

use CashInAdvance\Assistants\DataSources\AssistantDataSource;
use CashInAdvance\Assistants\SettingsHandlers\CashInAdvanceSettingsHandler;
use CashInAdvance\Services\SettingsService;
use Plenty\Modules\Order\Shipping\Countries\Contracts\CountryRepositoryContract;
use Plenty\Modules\System\Contracts\WebstoreRepositoryContract;
use Plenty\Modules\Wizard\Services\WizardProvider;
use Plenty\Plugin\Application;

class CashInAdvanceAssistant extends WizardProvider
{
    /** @var SettingsService */
    protected $settings;
    /**
     * @var string
     */
    private $language;

    /**
     * @var WebstoreRepositoryContract
     */
    private $webstoreRepository;

    /**
     * @var Webstore
     */
    private $mainWebstore;

    /**
     * @var Array
     */
    private $webstoreValues;

    /**
     * @var array
     */
    private $deliveryCountries;

    public function __construct(
        WebstoreRepositoryContract $webstoreRepository,
        SettingsService $settings
    ) {
        $this->webstoreRepository = $webstoreRepository;
        $this->settings = $settings;
    }

    protected function structure()
    {
        return [
            "title" => 'PrePaymentAssistant.assistantTitle',
            "shortDescription" => 'PrePaymentAssistant.assistantShortDescription',
            "iconPath" => $this->getIcon(),
            "settingsHandlerClass" => CashInAdvanceSettingsHandler::class,
            'dataSource' => AssistantDataSource::class,
            "translationNamespace" => "PrePayment",
            "key" => "payment-cash-in-advance-assistant",
            "topics" => ["payment"],
            "priority" => 990,
            "options" => [
                "config_name" => [
                    "type" => 'select',
                    'defaultValue' => $this->getMainWebstore(),
                    "options" => [
                        "name" => 'PrePaymentAssistant.storeName',
                        'required' => true,
                        'listBoxValues' => $this->getWebstoreListForm(),
                    ],
                ],
            ],
            "steps" => [
                "stepOne" => [
                    "title" => "PrePaymentAssistant.stepOneTitle",
                    "sections" => [
                        [
                            "title" => 'PrePaymentAssistant.shippingCountriesTitle',
                            "description" => 'PrePaymentAssistant.shippingCountriesDescription',
                            "form" => [
                                "shippingCountries" => [
                                    'type' => 'checkboxGroup',
                                    'defaultValue' => [],
                                    'options' => [
                                        'name' => 'PrePaymentAssistant.shippingCountries',
                                        'checkboxValues' => $this->getCountriesListForm(),
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                "stepTwo" => [
                    "title" => "PrePaymentAssistant.stepTwoTitle",
                    "sections" => [
                        [
                            "title" => 'PrePaymentAssistant.infoPageTitle',
                            "form" => [
                                "info_page_toggle" => [
                                    'type' => 'toggle',
                                    'options' => [
                                        'name' => 'PrePaymentAssistant.infoPageToggle',
                                    ]
                                ],
                            ],
                        ],
                        [
                            "title" => 'PrePaymentAssistant.infoPageTypeTitle',
                            "description" => 'PrePaymentAssistant.infoPageTypeDescription',
                            "condition" => 'info_page_toggle',
                            "form" => [
                                "info_page_type" => [
                                    'type' => 'select',
                                    'defaultValue' => 1,
                                    'options' => [
                                        'name' => 'PrePaymentAssistant.infoPageTypeName',
                                        'listBoxValues' => [
                                            [
                                                "caption" => 'PrePaymentAssistant.infoPageInternal',
                                                "value" => 1,
                                            ],
                                            [
                                                "caption" => 'PrePaymentAssistant.infoPageExternal',
                                                "value" => 2,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            "title" => '',
                            "description" => 'PrePaymentAssistant.infoPageNameInternal',
                            "condition" => 'info_page_toggle && info_page_type == 1',
                            "form" => [
                                "internal_info_page" => [
                                    "type" => 'category',
                                    'defaultValue' => '',
                                    'isVisible' => "info_page_toggle && info_page_type == 1",
                                    "displaySearch" => true,
                                    "options" => [
                                        "name" => "PrePaymentAssistant.infoPageNameInternal"
                                    ]
                                ],
                            ],
                        ],
                        [
                            "title" => '',
                            "description" => '',
                            "condition" => 'info_page_toggle && info_page_type == 2',
                            "form" => [
                                "external_info_page" => [
                                    'type' => 'text',
                                    'defaultValue' => '',
                                    'options' => [
                                        'pattern'=> "(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})",
                                        'name' => 'PrePaymentAssistant.infoPageNameExternal',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                "stepThree" => [
                    "title" => 'PrePaymentAssistant.stepThreeTitle',
                    "sections" => [
                        [
                            "title" => 'PrePaymentAssistant.sectionLogoTitle',
                            "description" => 'PrePaymentAssistant.sectionLogoDescription',
                            "form" => [
                                "logo_type_external" => [
                                    'type' => 'toggle',
                                    'defaultValue' => false,
                                    'options' => [
                                        'name' => 'PrePaymentAssistant.logoTypeToggle',
                                    ],
                                ],
                            ],
                        ],
                        [
                            "title" => '',
                            "description" => 'PrePaymentAssistant.logoURLDescription',
                            "condition" => 'logo_type_external',
                            "form" => [
                                "logo_url" => [
                                    'type' => 'file',
                                    'defaultValue' => '',
                                    'showPreview' => true,
                                    'options' => [
                                        'name' => 'PrePaymentAssistant.logoURLTypeName'
                                    ]
                                ],
                            ],
                        ],
                        [
                            "title" => 'PrePaymentAssistant.sectionPaymentMethodIconTitle',
                            "description" => 'PrePaymentAssistant.sectionPaymentMethodIconDescription',
                            "form" => [
                                "PaymentMethodIcon" => [
                                    'type' => 'checkbox',
                                    'defaultValue' => false,
                                    'options' => [
                                        'name' => 'PrePaymentAssistant.assistantPaymentMethodIconCheckbox'
                                    ]
                                ],
                            ],
                        ],
                    ]
                ],
                "stepFour" => [
                    "title" => 'PrePaymentAssistant.interface',
                    "sections" => [
                        [
                            "title" => 'PrePaymentAssistant.showBankDataTitle',
                            "description" => 'PrePaymentAssistant.showBankDataDescription',
                            "showFullDescription" => true,
                            "form" => [
                                "showBankData" => [
                                    'type' => 'checkbox',
                                    'defaultValue' => false,
                                    'options' => [
                                        'name' => 'PrePaymentAssistant.showBankData'
                                    ]
                                ],
                            ],
                        ],
                        [
                            "title" => 'PrePaymentAssistant.showDesignatedUseTitle',
                            "form" => [
                                "showDesignatedUse" => [
                                    'type' => 'toggle',
                                    'defaultValue' => true,
                                    'options' => [
                                        'name' => 'PrePaymentAssistant.showDesignatedUse'
                                    ]
                                ],
                            ],
                        ],
                        [
                            "title" => 'PrePaymentAssistant.designatedUseTitle',
                            "condition" => 'showDesignatedUse',
                            "description" => 'PrePaymentAssistant.designatedUseDescription',
                            "form" => [
                                "designatedUse" => [
                                    'type' => 'text',
                                    'defaultValue' => "%s",
                                    'options' => [
                                        'name' => 'PrePaymentAssistant.designatedUse',
                                    ],
                                ],
                            ],
                        ],
                    ]
                ]
            ]
        ];
    }

    /**
     * @return string
     */
    private function getLanguage()
    {
        if ($this->language === null) {
            $this->language =  \Locale::getDefault();
        }

        return $this->language;
    }

    /**
     * @return string
     */
    private function getIcon()
    {
        $app = pluginApp(Application::class);
        $icon = $app->getUrlPath('prepayment').'/images/icon.png';

        return $icon;
    }

    private function getMainWebstore(){
        if($this->mainWebstore === null) {
            /** @var WebstoreRepositoryContract $webstoreRepository */
            $webstoreRepository = pluginApp(WebstoreRepositoryContract::class);

            $this->mainWebstore = $webstoreRepository->findById(0)->storeIdentifier;
        }
        return $this->mainWebstore;
    }

    /**
     * @return array
     */
    private function getWebstoreListForm()
    {
        if($this->webstoreValues === null)
        {
            $webstores = $this->webstoreRepository->loadAll();
            $this->webstoreValues = [];
            /** @var Webstore $webstore */
            foreach ($webstores as $webstore) {
                $this->webstoreValues[] = [
                    "caption" => $webstore->name,
                    "value" => $webstore->storeIdentifier,
                ];
            }

            usort($this->webstoreValues, function ($a, $b) {
                return ($a['value'] <=> $b['value']);
            });
        }

        return $this->webstoreValues;
    }

    /**
     * @return array
     */
    private function getCountriesListForm()
    {
        if ($this->deliveryCountries === null) {
            /** @var CountryRepositoryContract $countryRepository */
            $countryRepository = pluginApp(CountryRepositoryContract::class);
            $countries = $countryRepository->getCountriesList(true, ['names']);
            $this->deliveryCountries = [];
            $systemLanguage = $this->getLanguage();
            foreach($countries as $country) {
                $name = $country->names->where('lang', $systemLanguage)->first()->name;
                $this->deliveryCountries[] = [
                    'caption' => $name ?? $country->name,
                    'value' => $country->id
                ];
            }
            // Sort values alphabetically
            usort($this->deliveryCountries, function($a, $b) {
                return ($a['caption'] <=> $b['caption']);
            });
        }
        return $this->deliveryCountries;
    }
}
?>
