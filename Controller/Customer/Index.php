<?php
/**
 * Softnoesis
 * Copyright(C) 06/2020 Softnoesis <ideveloper1990@gmail.com>
 * @package Softnoesis_Asktoexpert
 * @copyright Copyright(C) 2015 Softnoesis (ideveloper1990@gmail.com)
 * @author Softnoesis <ideveloper1990@gmail.com>
 */
namespace Softnoesis\Asktoexpert\Controller\Customer;

use Magento\Framework\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * Show customer tickets
     *
     * @return \Magento\Framework\View\Result\Page
     * @throws NotFoundException
     */
    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Page resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        return $resultPage;
    }
}
