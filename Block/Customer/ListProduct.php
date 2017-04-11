<?php
namespace Ecommistry\ProductList\Block\Customer;

class ListProduct extends \Magento\Framework\View\Element\Template
{
    protected $currentCustomer;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->currentCustomer = $currentCustomer;
        $this->getEvents();
    }
    public function getEvents(){
        $currentCustomerId = $this->currentCustomer->getCustomerId();
        $eventId = $this->getRequest()->getParams();
        if(empty($eventId['event_fn']) && empty($eventId['event_ln'])){
            $eventCollection = $this->_eventFactory->create()->addFieldToFilter('customer_id', $currentCustomerId);
            $data = $eventCollection->getData();
            return $data;
        }
        else
        {
            $eventCollection = $this->_eventFactory->create()
                ->addFieldToFilter('ship_firstname',$eventId['event_fn'])
                ->addFieldToFilter('ship_lastname',$eventId['event_ln']);
            $data =$eventCollection->getData();
            return $data;
        }
    }
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
}
