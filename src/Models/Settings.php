<?php

namespace CashInAdvance\Models;

use Plenty\Modules\Plugin\DataBase\Contracts\Model;

/**
 * Class Settings
 *
 * @property int $id
 * @property int $plentyId
 * @property string $lang
 * @property string $name
 * @property string $value
 * @property string $updatedAt
 */
class Settings extends Model
{
    const AVAILABLE_SETTINGS = array(        "plentyId"            => "int"     ,
                                             "lang"                => "string"  ,
                                             "name"                => "string"  ,
                                             "infoPageType"        => "int"     ,
                                             "infoPageIntern"      => "int"     ,
                                             "infoPageExtern"      => "string"  ,
                                             "logo"                => "int"     ,
                                             "logoUrl"             => "string"  ,
                                             "description"         => "string"  ,
                                             "feeDomestic"         => "float"   ,
                                             "feeForeign"          => "float"   ,
                                             "showBankData"        => "bool"    ,
                                             "designatedUse"       => "string"  ,
                                             "showDesignatedUse"   => "bool"    );

    const SETTINGS_DEFAULT_VALUES = array(   "feeDomestic"         => "0.00"             ,
                                             "feeForeign"          => "0.00"             ,
                                             "showBankData"        => "0"                ,
                                             "de"  => array( "name"                => "Vorkasse"         ,
                                                             "infoPageType"        => "2"                ,
                                                             "infoPageIntern"      => ""                 ,
                                                             "infoPageExtern"      => ""                 ,
                                                             "logo"                => "2"                ,
                                                             "logoUrl"             => ""                 ,
                                                             "description"         => ""                 ,
                                                             "designatedUse"       => "Verwendungszweck" ,
                                                             "showDesignatedUse"   => "0"                ),
                                             "en"  => array( "name"                => "Pay in advance"   ,
                                                             "infoPageType"        => "2"                ,
                                                             "infoPageIntern"      => ""                 ,
                                                             "infoPageExtern"      => ""                 ,
                                                             "logo"                => "0"                ,
                                                             "logoUrl"             => ""                 ,
                                                             "description"         => ""                 ,
                                                             "designatedUse"       => "Designated use"   ,
                                                             "showDesignatedUse"   => "0"                ),
                                             "fr"  => array( "name"                => "Prépaiement"         ,
                                                             "infoPageType"        => "2"                ,
                                                             "infoPageIntern"      => ""                 ,
                                                             "infoPageExtern"      => ""                 ,
                                                             "logo"                => "0"                ,
                                                             "logoUrl"             => ""                 ,
                                                             "description"         => ""                 ,
                                                             "designatedUse"       => "Concept" ,
                                                             "showDesignatedUse"   => "0"                ),
                                             "es"  => array( "name"                => "Pago por adelantado",
                                                             "infoPageType"        => "2"                ,
                                                             "infoPageIntern"      => ""                 ,
                                                             "infoPageExtern"      => ""                 ,
                                                             "logo"                => "0"                ,
                                                             "logoUrl"             => ""                 ,
                                                             "description"         => ""                 ,
                                                             "designatedUse"       => "Concepto" ,
                                                             "showDesignatedUse"   => "0"                ) );

    const LANG_INDEPENDENT_SETTINGS = array(    "feeDomestic"       ,
                                                "feeForeign"        ,
                                                "showBankData"      );

    const AVAILABLE_LANGUAGES = array( "de",
                                       "en",
                                       "bg",
                                       "fr",
                                       "it",
                                       "es",
                                       "tr",
                                       "nl",
                                       "pl",
                                       "pt",
                                       "nn",
                                       "da",
                                       "se",
                                       "cz",
                                       "ro",
                                       "ru",
                                       "sk",
                                       "cn",
                                       "vn");

    const DEFAULT_LANGUAGE = "de";

    const MODEL_NAMESPACE = 'CashInAdvance\Models\Settings';


    public $id;
    public $plentyId;
    public $lang        = '';
    public $name        = '';
    public $value       = '';
    public $updatedAt   = '';


    /**
     * @return string
     */
    public function getTableName():string
    {
        return 'PrePayment::settings';
    }
}