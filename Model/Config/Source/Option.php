<?php
/**
 * Softnoesis
 * Copyright(C) 06/2020 Softnoesis <ideveloper1990@gmail.com>
 * @package Softnoesis_Asktoexpert
 * @copyright Copyright(C) 2015 Softnoesis (ideveloper1990@gmail.com)
 * @author Softnoesis <ideveloper1990@gmail.com>
 */
namespace Softnoesis\Asktoexpert\Model\Config\Source;

class Option implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        $choose = [
            'all' => __('All Products'),
            'instock' => __('In Stock Products'),
            'outofstock' => __('Out Of Stock Products'),
        ];
        return $choose;
    }
}
