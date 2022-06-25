<?php 

namespace TorinoMotors\ModuleEventManager\Controller\Index;

class Token extends \Magento\Framework\App\Action\Action
{
    /** @var \Psr\Log\LoggerInterface $logger */
    protected $logger;

    /** @var \Magento\Framework\View\Result\PageFactory $resultPageFactory */
    protected $resultPageFactory;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\App\Action\Context $context
    ){
        $this->logger = $logger;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute(){
        $data = array('username' => 'admin', 'password' => 'Pasword01');
        $dataSJason = json_encode($data);
        $ch = curl_init('http://curso.net/rest/V1/integration/admin/token');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataSJason);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($dataSJason)));
        $token = curl_exec($ch);
        $tokenString = json_decode($token);

        $url = "http://curso.net/rest/V1/torinomotorslineSliderSlide";
        $ch = curl_init($url);
        $data = array("slide" => array("title" => "API Test Application"));
        $dataSJason = json_encode($data);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataSJason);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: Bearer " .  $tokenString
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);

        echo "<pre>";
        var_dump($result);
        echo "</pre>";
        exit;
    }
}