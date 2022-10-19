<?php
/**
 * Softnoesis
 * Copyright(C) 06/2020 Softnoesis <ideveloper1990@gmail.com>
 * @package Softnoesis_Asktoexpert
 * @copyright Copyright(C) 2015 Softnoesis (ideveloper1990@gmail.com)
 * @author Softnoesis <ideveloper1990@gmail.com>
 */
namespace Softnoesis\Asktoexpert\Block;

class Askforquote extends \Magento\Framework\View\Element\Template
{

    protected $_quoteCollectionFactory;
    protected $_assetRepo;
    protected $httpContext;
    protected $_registry;
    protected $_stockItemRepository;
    protected $_productloader;
    
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Softnoesis\Asktoexpert\Model\ResourceModel\Askforquote\CollectionFactory $quoteCollectionFactory,
        \Magento\Framework\App\Http\Context $httpContext,
        \Magento\Framework\Registry $registry,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockItemRepository,
        \Magento\Catalog\Model\ProductFactory $_productloader,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->_quoteCollectionFactory = $quoteCollectionFactory;
        $this->_assetRepo = $context->getAssetRepository();
        $this->httpContext = $httpContext;
        $this->_registry = $registry;
        $this->_stockItemRepository = $stockItemRepository;
        $this->_productloader = $_productloader;
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }

    public function getRequestCollection()
    {
         
        if ($this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH)) {
            $customerId = $this->httpContext->getValue('customer_id');
            $collection = $this->_quoteCollectionFactory->create();
            $collection->addFieldToSelect('*');
            $collection->addFieldToFilter('user_id', $customerId);
            $collection->setOrder('askforquote_id', 'DESC');
            return $collection;
        }
    }

    public function getLoggedinCustomerId()
    {
        if ($this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH)) {
            return (bool)$this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        } else {
            return false;
        }
    }
    public function getCustomerId()
    {
            return $this->httpContext->getValue('customer_id');
    }

    public function getCustomerName()
    {
            return $this->httpContext->getValue('customer_name');
    }

    public function getCustomerEmail()
    {
            return $this->httpContext->getValue('customer_email');
    }

    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }


    public function getStockItem($productId)
    {
        return $this->_stockItemRepository->getStockItem($productId);
    }

    public function getLoadProduct($productId)
    {
        return $this->_productloader->create()->load($productId);
    }

    public function getSuccessMsg()
    {
         return $this->_scopeConfig->getValue('askforquote/general/success', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function getEnable()
    {
         return $this->_scopeConfig->getValue('askforquote/general/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function getStockDetail()
    {
         return $this->_scopeConfig->getValue('askforquote/general/stock_detail', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function getUser()
    {
         return $this->_scopeConfig->getValue('askforquote/general/customer_configration', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
