<?php
namespace CashInAdvance\Assistants;

use CashInAdvance\Assistants\DataSources\AssistantDataSource;
use CashInAdvance\Assistants\SettingsHandlers\InvoiceAssistantSettingsHandler;
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
            "title" => 'assistant.assistantTitle',
            "shortDescription" => 'assistant.assistantShortDescription',
            "iconPath" => $this->getIcon(),
            "settingsHandlerClass" => CashInAdvanceSettingsHandler::class,
            'dataSource' => AssistantDataSource::class,
            "translationNamespace" => "CashInAdvance",
            "key" => "payment-cash-in-advance-assistant",
            "topics" => ["payment"],
            "priority" => 990,
            "options" => [
                "config_name" => [
                    "type" => 'select',
                    'defaultValue' => $this->getMainWebstore(),
                    "options" => [
                        "name" => 'assistant.storeName',
                        'required' => true,
                        'listBoxValues' => $this->getWebstoreListForm(),
                    ],
                ],
            ],
            "steps" => [
                "stepOne" => [
                    "title" => "assistant.stepOneTitle",
                    "sections" => [
                        [
                            "title" => 'assistant.shippingCountriesTitle',
                            "description" => 'assistant.shippingCountriesDescription',
                            "form" => [
                                "shippingCountries" => [
                                    'type' => 'checkboxGroup',
                                    'defaultValue' => [],
                                    'options' => [
                                        'name' => 'assistant.shippingCountries',
                                        'checkboxValues' => $this->getCountriesListForm(),
                                    ],
                                ],
                            ],
                        ],
                        [
                            "title" => 'assistant.allowInvoiceForGuestTitle',
                            "form" => [
                                "allowInvoiceForGuest" => [
                                    'type' => 'checkbox',
                                    'defaultValue' => false,
                                    'options' => [
                                        'name' => 'assistant.assistantInvoiceForGuestCheckbox'
                                    ]
                                ],
                            ],
                        ],
                        [
                            "title" => 'assistant.invoiceAddressEqualShippingAddressTitle',
                            "description" => 'assistant.invoiceEqualsShippingAddressDescription',
                            "form" => [
                                "invoiceEqualsShippingAddress" => [
                                    'type' => 'checkbox',
                                    'defaultValue' => false,
                                    'options' => [
                                        'name' => 'assistant.invoiceAddressEqualShippingAddress'
                                    ]
                                ],
                            ],
                        ],
                    ],
                ],
                "stepTwo" => [
                    "title" => "assistant.stepTwoTitle",
                    "sections" => [
                        [
                            "title" => 'assistant.infoPageTitle',
                            "form" => [
                                "info_page_toggle" => [
                                    'type' => 'toggle',
                                    'options' => [
                                        'name' => 'assistant.infoPageToggle',
                                    ]
                                ],
                            ],
                        ],
                        [
                            "title" => 'assistant.infoPageTypeTitle',
                            "description" => 'assistant.infoPageTypeDescription',
                            "condition" => 'info_page_toggle',
                            "form" => [
                                "info_page_type" => [
                                    'type' => 'select',
                                    'defaultValue' => 1,
                                    'options' => [
                                        'name' => 'assistant.infoPageTypeName',
                                        'listBoxValues' => [
                                            [
                                                "caption" => 'assistant.infoPageInternal',
                                                "value" => 1,
                                            ],
                                            [
                                                "caption" => 'assistant.infoPageExternal',
                                                "value" => 2,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            "title" => '',
                            "description" => 'assistant.infoPageNameInternal',
                            "condition" => 'info_page_toggle && info_page_type == 1',
                            "form" => [
                                "internal_info_page" => [
                                    "type" => 'category',
                                    'defaultValue' => '',
                                    'isVisible' => "info_page_toggle && info_page_type == 1",
                                    "displaySearch" => true,
                                    "options" => [
                                        "name" => "assistant.infoPageNameInternal"
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
                                        'name' => 'assistant.infoPageNameExternal',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                "stepThree" => [
                    "title" => 'assistant.stepThreeTitle',
                    "sections" => [
                        [
                            "title" => 'assistant.sectionLogoTitle',
                            "description" => 'assistant.sectionLogoDescription',
                            "form" => [
                                "logo_type_external" => [
                                    'type' => 'toggle',
                                    'defaultValue' => false,
                                    'options' => [
                                        'name' => 'assistant.logoTypeToggle',
                                    ],
                                ],
                            ],
                        ],
                        [
                            "title" => '',
                            "description" => 'assistant.logoURLDescription',
                            "condition" => 'logo_type_external',
                            "form" => [
                                "logo_url" => [
                                    'type' => 'file',
                                    'defaultValue' => '',
                                    'showPreview' => true,
                                    'options' => [
                                        'name' => 'assistant.logoURLTypeName'
                                    ]
                                ],
                            ],
                        ],
                        [
                            "title" => 'assistant.sectionPaymentMethodIconTitle',
                            "description" => 'assistant.sectionPaymentMethodIconDescription',
                            "form" => [
                                "invoicePaymentMethodIcon" => [
                                    'type' => 'checkbox',
                                    'defaultValue' => 'false',
                                    'options' => [
                                        'name' => 'assistant.assistantPaymentMethodIconCheckbox'
                                    ]
                                ],
                            ],
                        ],
                    ]
                ],
                "stepFour" => [
                    "title" => 'assistant.interface',
                    "sections" => [
                        [
                            "title" => 'assistant.showBankDataTitle',
                            "description" => 'assistant.showBankDataDescription',
                            "showFullDescription" => true,
                            "form" => [
                                "showBankData" => [
                                    'type' => 'checkbox',
                                    'defaultValue' => false,
                                    'options' => [
                                        'name' => 'assistant.showBankData'
                                    ]
                                ],
                            ],
                        ],
                        [
                            "title" => "assistant.infoPageLimitInputTitle",
                            "form" => [
                                "limit_toggle" => [
                                    'type' => 'toggle',
                                    'defaultValue' => false,
                                    'options' => [
                                        'name' => 'assistant.infoPageLimitInput',
                                    ]
                                ],
                            ],
                        ],
                        [
                            "title" => 'assistant.quorumOrders',
                            "description" => 'assistant.quorumOrdersDescription',
                            "condition" => "limit_toggle",
                            "form" => [
                                "quorumOrders" => [
                                    'type' => 'number',
                                    'defaultValue' => 0,
                                    'options' => [
                                        'name' => 'assistant.quorumOrders',
                                    ],
                                ],
                            ],
                        ],
                        [
                            "title" => 'assistant.minimumAmount',
                            "description" => 'assistant.minimumAmountDescription',
                            "condition" => "limit_toggle",
                            "form" => [
                                "minimumAmount" => [
                                    'type' => 'double',
                                    'isPriceInput' => true,
                                    'defaultValue' => 0,
                                    'options' => [
                                        'name' => 'assistant.minimumAmount',
                                    ],
                                ],
                            ],
                        ],
                        [
                            "title" => 'assistant.maximumAmount',
                            "condition" => "limit_toggle",
                            "description" => 'assistant.maximumAmountDescription',
                            "form" => [
                                "maximumAmount" => [
                                    'type' => 'double',
                                    'isPriceInput' => true,
                                    'defaultValue' => 0,
                                    'options' => [
                                        'name' => 'assistant.maximumAmount',
                                    ],
                                ],
                            ],
                        ],

                        [
                            "title" => 'assistant.showDesignatedUseTitle',
                            "form" => [
                                "showDesignatedUse" => [
                                    'type' => 'toggle',
                                    'defaultValue' => true,
                                    'options' => [
                                        'name' => 'assistant.showDesignatedUse'
                                    ]
                                ],
                            ],
                        ],
                        [
                            "title" => 'assistant.designatedUseTitle',
                            "condition" => 'showDesignatedUse',
                            "description" => 'assistant.designatedUseDescription',
                            "form" => [
                                "designatedUse" => [
                                    'type' => 'text',
                                    'defaultValue' => "%s",
                                    'options' => [
                                        'name' => 'assistant.designatedUse',
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
        $icon = $app->getUrlPath('invoice').'/images/icon.png';

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
