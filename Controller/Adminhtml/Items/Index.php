<?php
/**
 * Softnoesis
 * Copyright(C) 06/2020 Softnoesis <ideveloper1990@gmail.com>
 * @package Softnoesis_Asktoexpert
 * @copyright Copyright(C) 2015 Softnoesis (ideveloper1990@gmail.com)
 * @author Softnoesis <ideveloper1990@gmail.com>
 */
namespace Softnoesis\Asktoexpert\Controller\Adminhtml\Items;

class Index extends \Softnoesis\Asktoexpert\Controller\Adminhtml\Items
{
    /**
     * Items list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('softnoesis_askforquote::test');
        $resultPage->getConfig()->getTitle()->prepend(__('Inquiries Information'));
        $resultPage->addBreadcrumb(__('Inquiries'), __('Inquiries'));
        $resultPage->addBreadcrumb(__('Inquiries'), __('Inquiries'));
        return $resultPage;
    }
}
