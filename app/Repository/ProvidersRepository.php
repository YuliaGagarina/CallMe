<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 09.08.2019
 * Time: 13:50
 */

namespace App\Repository;


class ProvidersRepository
{
    private $model;
    public function addClient()
    {
        $this->model->create($data);
        return $data;
    }
}