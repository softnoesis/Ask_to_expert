<?php
/**
 * Softnoesis
 * Copyright(C) 06/2020 Softnoesis <ideveloper1990@gmail.com>
 * @package Softnoesis_Asktoexpert
 * @copyright Copyright(C) 2015 Softnoesis (ideveloper1990@gmail.com)
 * @author Softnoesis <ideveloper1990@gmail.com>
 */
namespace Softnoesis\Asktoexpert\Model;

use Magento\Framework\Model\AbstractModel;

class Askforquote extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(\Softnoesis\Asktoexpert\Model\ResourceModel\Askforquote::class);
    }
}
