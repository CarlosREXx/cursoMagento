<?php

namespace TorinoMotors\ModuleAjax\Controller\Result;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use \Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\ResourceConnection;
use TorinoMotors\ModuleAjax\Service\jServiceAPI;

class Result extends Action
{
    /**
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $resultJsonFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        jServiceAPI $jServiceAPI,
        ResourceConnection $resource
    ){
        $this->_jServiceApi = $jServiceAPI;
        $this->_resource = $resource;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    } 

    public function execute()
    {   
        /**
         * @return Array
         */
        $result = $this->resultJsonFactory->create();
        $numero = $this->getRequest()->getParam('numero');
        $array = Array("numero" => $numero,
                    "data" => $this->_jServiceApi->execute(),
                    "Table" => $this->getTableData());

        $result->setData($array);
        return $result;
    }

    public function getTableData()
    {
        $connection = $this->_resource->getConnection();
        $myTable = $connection->getTableName('torinomotors_presenciaen');
        $sql     = $connection->select()->from(
            ["tn" => $myTable]
        ); 
        $result  = $connection->fetchAll($sql);
        return $result;
    }

    // protected $resultJsonFactory;

    // protected $fileFactory;

    // public function __construct(
    //     Context $context,
    //     \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
    //     FileFactory $fileFactory
    // )
    // {
    //     $this->fileFactory = $fileFactory;
    //     $this->resultJsonFactory = $resultJsonFactory;
    //     parent::__construct($context);
    // }

    // public function execute()
    // {
    //     $error = true;
    //     try{
    //         $pdf = new \Zend_Pdf();
    //         $pdf->pages[] = $pdf->newPage(\Zend_Pdf_Page::SIZE_A4);
    //         $page = $pdf->pages[0]; // this will get reference to the first page.
    //         $style = new \Zend_Pdf_Style();
    //         $style->setLineColor(new \Zend_Pdf_Color_Rgb(0,0,0));
    //         $font = \Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_TIMES);
    //         $style->setFont($font,15);
    //         $page->setStyle($style);
    //         $width = $page->getWidth();
    //         $hight = $page->getHeight();
    //         $x = 30;
    //         $pageTopalign = 700;
    //         $this->y = 700 - 100;

    //         $style->setFont($font,15);
    //         $page->setStyle($style);
    //         $page->drawRectangle(30, $this->y + 10, $page->getWidth()-30, $this->y +70, \Zend_Pdf_Page::SHAPE_DRAW_STROKE);

    //         $style->setFont($font,15);
    //         $page->setStyle($style);
    //         $page->drawText(__("Cutomer Details"), $x + 5, $this->y+50, 'UTF-8');
    //         $style->setFont($font,11);
    //         $page->setStyle($style);
    //         $page->drawText(__("Name : %1", "Test MageDelight"), $x + 5, $this->y+33, 'UTF-8');
    //         $page->drawText(__("Email : %1","test@magedelight.com
    //         "), $x + 4, $this->y+15, 'UTF-8');
    //         $style->setFont($font,11);
    //         $page->setStyle($style);
    //         $page->drawText(__("PRODUCT NAME"), $x + 60, $this->y-10, 'UTF-8');
    //         $page->drawText(__("PRODUCT PRICE"), $x + 200, $this->y-10, 'UTF-8');
    //         $page->drawText(__("QTY"), $x + 310, $this->y-10, 'UTF-8');
    //         $page->drawText(__("SUB TOTAL"), $x + 440, $this->y-10, 'UTF-8');
    //         $style->setFont($font,10);
    //         $page->setStyle($style);
    //         $add = 9;
    //         $page->drawText("$12.00", $x + 210, $this->y-30, 'UTF-8');
    //         $page->drawText(10, $x + 330, $this->y-30, 'UTF-8');
    //         $page->drawText("$120.00", $x + 470, $this->y-30, 'UTF-8');
    //         $pro = "TEST product";
    //         $page->drawText($pro, $x + 65, $this->y-30, 'UTF-8');
    //         $page->drawRectangle(30, $this->y -62, $page->getWidth()-30, $this->y + 10, \Zend_Pdf_Page::SHAPE_DRAW_STROKE);
    //         $page->drawRectangle(30, $this->y -62, $page->getWidth()-30, $this->y - 100, \Zend_Pdf_Page::SHAPE_DRAW_STROKE);
    //         $style->setFont($font,15);
    //         $page->setStyle($style);
    //         $page->drawText(__("Total : %1", "$50.00"), $x + 435, $this->y-85, 'UTF-8');
    //         $style->setFont($font,10);
    //         $page->setStyle($style);
    //         $page->drawText(__("Test Footer example"), ($page->getWidth()/2)-50, $this->y-200);
    //         $fileName = 'magedelight.pdf';
    //         $this->fileFactory->create(
    //         $fileName,
    //         $pdf->render(),
    //         \Magento\Framework\App\Filesystem\DirectoryList::VAR_DIR, // this pdf will be saved in var directory with the name magedelight.pdf
    //         'application/pdf'
    //         );
    //         $error = false;
    //     }catch(\Exception $e){

    //     }
    //     $result = $this->resultJsonFactory->create();
    //     $result->setData(['error' => $error]);
    //     return $result;
    // }
}