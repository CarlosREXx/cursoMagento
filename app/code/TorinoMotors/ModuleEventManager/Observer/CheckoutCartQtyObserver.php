<?php 

namespace TorinoMotors\ModuleEventManager\Observer;

use Magento\Framework\Event\ObserverInterface;

class CheckoutCartQtyObserver implements ObserverInterface
{
    /** @var \Psr\Log\LoggerInterface $logger*/
    protected $logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ){
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->logger->debug('Action event Manager Add to Cart');

        if($observer->getProduct()->getQty()%2 != 0){
            $this->logger->debug('No se agrego el producto');
            throw new \Exception('Error must be even');
        }else{
            $this->logger->debug('El producto se agrego correctamente');
        }
    }
}