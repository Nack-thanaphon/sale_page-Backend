<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\View;

use Cake\View\View;
use Cake\ORM\TableRegistry;

/**
 * Application View
 *
 * Your application's default view class
 *
 * @link https://book.cakephp.org/4/en/views.html#the-app-view
 */
class AppView extends View
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function SYSTEM_OPTION($checked = null)
    {
        $table = TableRegistry::getTableLocator()->get('systems');
        $SystemData  = $table->find()
            ->select([
                'id' => 'systems.id',
                'name' => 'systems.name',
            ])
            ->where([
                'systems.status' => 1
            ])
            ->toArray();

        $option = '';

        foreach ($SystemData as $data) {
            $option .=  '<option class="form-control" value=' . $data->id . ' ';
            if ($data->id == $checked) {
                $option .= 'selected';
            }
            $option .=   '>' . $data->name . '</option>';
        }
        echo $option;
    }
}
