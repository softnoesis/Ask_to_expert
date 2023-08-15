<?php
/**
 * Softnoesis
 * Copyright(C) 06/2020 Softnoesis <ideveloper1990@gmail.com>
 * @package Softnoesis_Asktoexpert
 * @copyright Copyright(C) 2015 Softnoesis (ideveloper1990@gmail.com)
 * @author Softnoesis <ideveloper1990@gmail.com>
 */
 
namespace Softnoesis\Asktoexpert\Block\Adminhtml\Items\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

class Main extends Generic implements TabInterface
{
    protected $_wysiwygConfig;
    public $_storeManager;
    
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_storeManager=$storeManager;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    public function getTabLabel()
    {
        return __('Inquiries Information');
    }

    public function getTabTitle()
    {
        return __('Inquiries Information');
    }

    public function canShowTab()
    {
        return true;
    }
    public function isHidden()
    {
        return false;
    }

    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('current_softnoesis_askforquote_items');
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('item_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Product Information')]);
        if ($model->getId()) {
            $fieldset->addField('askforquote_id', 'hidden', ['name' => 'askforquote_id']);
        }

        $fieldset->addField(
            'product_sku',
            'text',
            [
                'name' => 'product_sku',
                'label' => __('Product Sku'),
                'title' => __('Product Sku'),
                'readonly' => 'true',
            ]
        );

        $fieldset->addField(
            'product_name',
            'text',
            [
                'name' => 'product_name',
                'label' => __('Product Name'),
                'title' => __('Product Name'),
                'readonly' => 'true',
            ]
        );
        $fieldset = $form->addFieldset('customer_fieldset', ['legend' => __('Customer Information')]);
        
        $fieldset->addField(
            'customer_name',
            'text',
            [
                'name' => 'customer_name',
                'label' => __('Customer Name'),
                'title' => __('Customer Name'),
                'index' => 'customer_name',
                'readonly' => 'true',
            ]
        );

        $fieldset->addField(
            'customer_email',
            'text',
            [
                'name' => 'customer_email',
                'label' => __('Customer Email'),
                'title' => __('Customer Email'),
                'index' => 'customer_name',
                'readonly' => 'true',
            ]
        );

        $fieldset->addField(
            'phone_number',
            'text',
            [
                'name' => 'phone_number',
                'label' => __('Customer Phone Number'),
                'title' => __('Customer Phone Number'),
                'readonly' => 'true',
            ]
        );

        $fieldset = $form->addFieldset('quote_fieldset', ['legend' => __('Inquiries Information')]);

        $fieldset->addField(
            'description',
            'textarea',
            [
                'name' => 'description',
                'label' => __('Description'),
                'title' => __('Description'),
                'readonly' => 'true',
            ]
        );

        $fieldset->addField(
            'admin_reply',
            'textarea',
            [
                'name' => 'admin_reply',
                'label' => __('Admin Reply'),
                'title' => __('Admin Reply'),
            ]
        );
     
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
