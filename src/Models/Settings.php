<?php
/**
 * Created by IntelliJ IDEA.
 * User: ckunze
 * Date: 23/2/17
 * Time: 12:10
 */

namespace PrePayment\Models;

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
                                             "shippingCountries"   => ['int']   ,
                                             "logo"                => "int"     ,
                                             "logoUrl"             => "string"  ,
                                             "feeDomestic"         => "float"   ,
                                             "feeForeign"          => "float"   ,
                                             "showBankData"        => "bool"    ,
                                             "designatedUse"       => "string"  ,
                                             "showDesignatedUse"   => "bool"    );

    const SETTINGS_DEFAULT_VALUES = array(   "infoPageType"        => "0"                ,
                                             "shippingCountries"   => ""                 ,
                                             "feeDomestic"         => "0.00"             ,
                                             "feeForeign"          => "0.00"             ,
                                             "showBankData"        => "0"                ,
                                             "de"  => array( "name"                => "Vorkasse"         ,
                                                             "infoPageIntern"      => ""                 ,
                                                             "infoPageExtern"      => ""                 ,
                                                             "logo"                => "0"                ,
                                                             "logoUrl"             => ""                 ,
                                                             "designatedUse"       => "Verwendungszweck" ,
                                                             "showDesignatedUse"   => "0"                ),
                                             "en"  => array( "name"                => "Pay in advance"   ,
                                                             "infoPageIntern"      => ""                 ,
                                                             "infoPageExtern"      => ""                 ,
                                                             "logo"                => "0"                ,
                                                             "logoUrl"             => ""                 ,
                                                             "designatedUse"       => "Designated use"   ,
                                                             "showDesignatedUse"   => "0"                ),
                                             "fr"  => array( "name"                => "Prépaiement"         ,
                                                             "infoPageIntern"      => ""                 ,
                                                             "infoPageExtern"      => ""                 ,
                                                             "logo"                => "0"                ,
                                                             "logoUrl"             => ""                 ,
                                                             "designatedUse"       => "Concept" ,
                                                             "showDesignatedUse"   => "0"                ),
                                             "es"  => array( "name"                => "Pago por adelantado",
                                                             "infoPageIntern"      => ""                 ,
                                                             "infoPageExtern"      => ""                 ,
                                                             "logo"                => "0"                ,
                                                             "logoUrl"             => ""                 ,
                                                             "designatedUse"       => "Concepto" ,
                                                             "showDesignatedUse"   => "0"                ) );

    const LANG_INDEPENDENT_SETTINGS = array(    "infoPageType"      ,
                                                "shippingCountries" ,
                                                "feeDomestic"       ,
                                                "feeForeign"        ,
                                                "showBankData"      );

    const AVAILABLE_LANGUAGES = array( "de",
                                       "en",
                                       "fr",
                                       "es" );

    const DEFAULT_LANGUAGE = "de";

    const MODEL_NAMESPACE = 'PrePayment\Models\Settings';


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