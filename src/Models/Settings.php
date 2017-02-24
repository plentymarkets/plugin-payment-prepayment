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
 * @property string $name
 * @property string $value
 * @property string $updatedAt
 */
class Settings extends Model
{
    const AVAILABLE_SETTINGS = array("name"                  ,
                                     "infoPageType"         ,
                                     "infoPageIntern"       ,
                                     "infoPageExtern"       ,
                                     "shippingCountry"       ,
                                     "logo"                  ,
                                     "logoUrl"              ,
                                     "feeDomestic"          ,
                                     "feeForeign"           ,
                                     "showBankData"          ,
                                     "orderConfirmationText" ,
                                     "showBookingText"       ,);

    public $id          = 0;
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