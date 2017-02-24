<?php
/**
 * Created by IntelliJ IDEA.
 * User: ckunze
 * Date: 23/2/17
 * Time: 12:26
 */

namespace PrePayment\Services;

use Illuminate\Database\Eloquent\Collection;
use Plenty\Modules\Plugin\DataBase\Contracts\DataBase;

use PrePayment\Models\Settings;


class SettingsService
{

    /** @var  DataBase */
    private $db;

    public function __construct(DataBase $db)
    {
        $this->db           = $db;
    }

    public function loadSettings()
    {

        /** @var Settings[] $query */
        $query = $this->db->query('PrePayment\Models\Settings')->get();

        $outputArray = array();

        /** @var Settings $setting */
        foreach($query as $setting)
        {

            $availableSettings = Settings::AVAILABLE_SETTINGS;
            if(in_array($setting->name,$availableSettings))
            {
                $outputArray[$setting->name] = $setting->value;
            }

        }

        return $outputArray;
    }


    public function saveSettings($data)
    {
        $availableSettings = Settings::AVAILABLE_SETTINGS;
        $errors            = array();

        foreach($data as $field => $value)
        {
            if(in_array($field, $availableSettings))
            {
                /** @var Settings $storedSetting */
                $query = $this->db->query('PrePayment\Models\Settings')
                    ->where('name', '=', $field)->get();
                if(count($query) == 1)
                {
                    $storedSetting = $query[0];

                    if (!empty($storedSetting->id))
                    {
                        $storedSetting->value     = $value;
                        $storedSetting->updatedAt = date('Y-m-d H:i:s');

                        $this->db->save($storedSetting);
                    }
                }
                elseif(count($query) > 1)
                {
                    /**ToDo Implement better Error handling */
                    $errors[] = 'Corrupt Database: \"' . $field . '\" is stored more than once.';
                }
                elseif(count($query) == 0)
                {
                    /**ToDo Implement better Error handling */
                    $errors[] = 'Field \"' . $field . '\" couldn\'t be found in Database.';
                }

            }
        }

        if(count($errors) > 0)
        {
            return $errors;
        }

        return 1;

    }

}