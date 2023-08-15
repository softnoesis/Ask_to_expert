<?php
/**
 * Softnoesis
 * Copyright(C) 06/2020 Softnoesis <ideveloper1990@gmail.com>
 * @package Softnoesis_Asktoexpert
 * @copyright Copyright(C) 2015 Softnoesis (ideveloper1990@gmail.com)
 * @author Softnoesis <ideveloper1990@gmail.com>
 */
namespace Softnoesis\Asktoexpert\Controller\Askforquote;

use Magento\Framework\App\Action\Context;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Framework\Mail\Template\TransportBuilder;

class Quote extends \Magento\Framework\App\Action\Action
{
    protected $scopeConfig;
    protected $transportBuilder;
    protected $_scopeConfig;
    protected $_resources;

    public function __construct(
        Context $context,
        TransportBuilder $transportBuilder,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->transportBuilder = $transportBuilder;
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context);
    }
    public function execute()
    {
        $phone_number           = $this->getRequest()->getPost("guest_quote_qty");
        $description        = $this->getRequest()->getPost("guest_quote_desc");
        $guestcustomerName  = $this->getRequest()->getPost("guest_quote_customer");
        $guestcustomerEmail = $this->getRequest()->getPost("guest_quote_email");
        $product_id         = $this->getRequest()->getPost("guest_product_id");
        $productName        = $this->getRequest()->getPost("product_name");
        $productSku         = $this->getRequest()->getPost("product_sku");
        $customerName       = $this->getRequest()->getPost("login_customer_name");
        $customerEmail      = $this->getRequest()->getPost("login_customer_email");
        $customerId         = $this->getRequest()->getPost("login_customer_id");

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $magentoDateObject = $objectManager->create(\Magento\Framework\Stdlib\DateTime\DateTime::class);
        $magentoDate = $magentoDateObject->gmtDate();
        if ($customerId != '') {
            $this->_resources = \Magento\Framework\App\ObjectManager::getInstance() // To insert data in database
            ->get(\Magento\Framework\App\ResourceConnection::class);
            $connection = $this->_resources->getConnection();
            $themeTable = $this->_resources->getTableName('softnoesis_askforquote');
            $sql = "INSERT INTO " . $themeTable . "(
                `phone_number`, 
                `user_id` , 
                `product_id` ,
                `description`, 
                `product_name`,
                `product_sku`,
                `customer_name`, 
                `customer_email`, 
                `created_time`)
            VALUES (
                '$phone_number', 
                '$customerId', 
                '$product_id',
                '$description',
                '$productName',
                '$productSku',
                '$customerName',
                '$customerEmail',
                '$magentoDate'
                )";
            $connection->query($sql);

            $post = $this->getRequest()->getPostValue(); // send mail code
            $senderName = $this->_scopeConfig->getValue(
                'trans_email/ident_general/name',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );
            $senderEmail = $this->_scopeConfig->getValue(
                'trans_email/ident_general/email',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );
            $postObject = new \Magento\Framework\DataObject();
            $templateVars = [
                'product_name' => $productName,
                'product_sku' => $productSku,
                'customer_name' => $customerName,
                'customer_email' => $customerEmail,
                'requested_qty' => $phone_number,
                'description' => $description,
            ];
            $sender = [
                'name' => $senderName,
                'email' => $senderEmail,
            ];
            $transport = $this->transportBuilder->setTemplateIdentifier('quote_template')
            ->setTemplateOptions(
                ['area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID]
            )->setTemplateVars($templateVars)
            ->setFrom($sender)
            ->addTo($customerEmail)
            ->addBcc($senderEmail)
            ->setReplyTo($senderEmail)
            ->getTransport();
            $transport->sendMessage();

        } else {
            $this->_resources = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Framework\App\ResourceConnection::class);
            $connection = $this->_resources->getConnection();
            $themeTable = $this->_resources->getTableName('softnoesis_askforquote');
            $sql = "INSERT INTO " . $themeTable . "(
                `phone_number`, 
                `user_id` , 
                `product_id` ,
                `description`,
                `product_name`,
                `product_sku`,
                `customer_name`,
                `customer_email`,
                `created_time`)
            VALUES (
                '$phone_number', 
                '', 
                '$product_id',
                '$description',
                '$productName',
                '$productSku',
                '$guestcustomerName',
                '$guestcustomerEmail',
                '$magentoDate'
                )";
            $connection->query($sql);

            $post = $this->getRequest()->getPostValue(); // send mail code
            $senderName = $this->_scopeConfig->getValue(
                'trans_email/ident_general/name',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );
            $senderEmail = $this->_scopeConfig->getValue(
                'trans_email/ident_general/email',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );
            $postObject = new \Magento\Framework\DataObject();
            $templateVars = [
                'product_name' => $productName,
                'product_sku' => $productSku,
                'customer_name' => $guestcustomerName,
                'customer_email' => $guestcustomerEmail,
                'requested_qty' => $phone_number,
                'description' => $description,
            ];
            $sender = [
                'name' => $senderName,
                'email' => $senderEmail,
            ];
            $transport = $this->transportBuilder->setTemplateIdentifier('quote_template')
            ->setTemplateOptions(
                ['area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID]
            )->setTemplateVars($templateVars)
            ->setFrom($sender)
            ->addTo($guestcustomerEmail)
            ->addBcc($senderEmail)
            ->setReplyTo($senderEmail)
            ->getTransport();
            $transport->sendMessage();
        }
    }
}
