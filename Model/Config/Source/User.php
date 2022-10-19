<?php
/**
 * Softnoesis
 * Copyright(C) 06/2020 Softnoesis <ideveloper1990@gmail.com>
 * @package Softnoesis_Asktoexpert
 * @copyright Copyright(C) 2015 Softnoesis (ideveloper1990@gmail.com)
 * @author Softnoesis <ideveloper1990@gmail.com>
 */
namespace Softnoesis\Asktoexpert\Model\Config\Source;

class User implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        $choose = [
            'all' => __('All User'),
            'register' => __('Login User'),
            'guest' => __('Guest User'),
        ];
        return $choose;
    }
}
