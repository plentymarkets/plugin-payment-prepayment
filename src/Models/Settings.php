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
                                     "infoPage.type"         ,
                                     "infoPage.intern"       ,
                                     "infoPage.extern"       ,
                                     "shippingCountry"       ,
                                     "logo"                  ,
                                     "logo.url"              ,
                                     "fee.domestic"          ,
                                     "fee.foreign"           ,
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