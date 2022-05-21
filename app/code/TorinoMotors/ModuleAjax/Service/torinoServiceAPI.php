<?php

namespace TorinoMotors\ModuleAjax\Service;

class torinoServiceAPI
{
    protected $apiTokenPath = "rest/V1/integration/admin/token";
    protected $username = "rzamudio";
    private $password = "Password01";

    public function __construct()
    {
        $this->apiTokenPath;
        $this->username;
        $this->password;
    }

    public function getToken()
    { 
        $url = "http://torinomotors.mx/";
        $token_url = $url . $this->apiTokenPath;
        $username = $this->username;
        $password = $this->password;

        $data = array("username" => $username, "password" => $password);
        $data_json = json_encode($data);

        $ch = curl_init($token_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_json)
        ));

        $token = curl_exec($ch);
        $adminToken = json_decode($token);
        return $adminToken;
    }

    public function getDataTorino(){
        $productUrl = "http://torinomotors.mx/rest/V1/products?searchCriteria[page_size]=1000";
        $ch = curl_init($productUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: Bearer " .  $this->getToken()
        ));
        $productsList = curl_exec($ch);
        $err = curl_error($ch);
        $products = json_decode($productsList, JSON_OBJECT_AS_ARRAY);

        // foreach($products["items"] as $product){
        //     if ($product["extension_attributes"]["category_links"][0]["category_id"] == "5"){
        //         $product[] = "<br>";
        //         $data[] = $product;
        //     }
        // }
        return $products["items"];
    }

    public function getDataMotos($categoryId = null, $categoryId2 = null){
        $products = $this->getDataTorino();
        foreach($products as $product => &$item){
            if($item["status"] == 1){
                if ($item["extension_attributes"]["category_links"][0]["category_id"] == $categoryId ||
                $item["extension_attributes"]["category_links"][0]["category_id"] == $categoryId2){
                    foreach($item["custom_attributes"] as $num => &$value){
                        if ($value["attribute_code"] == "meta_keyword"){
                            strtoupper($value["value"]) == strtoupper($item["sku"]) ? 
                                    $names[] = $item["sku"] : "";
                            strtoupper($value["value"]) == strtoupper($item["sku"]) ?
                                    $nameValid = $value["value"]: "";
                        }
                        if ($value["attribute_code"] == "small_image"){
                            //strtoupper($value["value"]) == strtoupper($item["sku"]) ?
                            //if ($nameValid)
                            !($value["value"] == "no_selection") ? $images[] = $value["value"] : "";
                        }
                    }
                }
            }
            //$names = $item["custom_attributes"];
        }
        return [$names, $images];
    }
}