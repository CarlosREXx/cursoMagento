<?php

namespace TorinoMotors\ModuleAjax\Ui\DataSource\Plugin;

class Provider{

    public function afterGetData(\TorinoMotors\ModuleAjax\Ui\DataSource\NamesProvider $subject, $data){
        return $data;
    }
}