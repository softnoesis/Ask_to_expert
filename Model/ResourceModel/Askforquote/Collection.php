<?php
/**
 * Softnoesis
 * Copyright(C) 06/2020 Softnoesis <ideveloper1990@gmail.com>
 * @package Softnoesis_Asktoexpert
 * @copyright Copyright(C) 2015 Softnoesis (ideveloper1990@gmail.com)
 * @author Softnoesis <ideveloper1990@gmail.com>
 */
namespace Softnoesis\Asktoexpert\Model\ResourceModel\Askforquote;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'askforquote_id';
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            \Softnoesis\Asktoexpert\Model\Askforquote::class,
            \Softnoesis\Asktoexpert\Model\ResourceModel\Askforquote::class
        );
    }
}
