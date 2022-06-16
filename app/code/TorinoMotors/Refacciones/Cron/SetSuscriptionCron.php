<?php 

namespace TorinoMotors\Refacciones\Cron;

class SetSuscriptionCron
{
    /** @var \Psr\Log\LoggerInterface $logger */
    protected $logger;
    /** @var \Magento\Framework\ObjectManagerInterface $objectManager */
    protected $objectManager;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\ObjectManagerInterface $objectManager
    ){
        $this->logger = $logger;
        $this->objectManager = $objectManager;
    }

    public function checkSuscription(){
        $suscription = $this->objectManager->create("TorinoMotors\Refacciones\Model\Suscription");
        $suscription->setFirstname("NamefromCron");
        $suscription->setLastname("LastNamefromCron");
        $suscription->setEmail("cron@gmail.com");
        $suscription->setStatus("pending");
        $suscription->setMessage("Mensaje desde el Cron");
        $suscription->save();

        $this->logger->debug('Test suscription added');
    }
}