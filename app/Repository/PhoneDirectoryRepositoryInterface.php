<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 12.08.2019
 * Time: 10:53
 */

namespace App\Repository;

use \Illuminate\Database\Eloquent\Collection;

interface PhonesDirectoryRepositoryInterface
{
    public function showAllPhones(): \Illuminate\Database\Eloquent\Collection;

    public function addNewData();

    public function editNumber();

    public function deleteNumber();

    public function findByPhone(): \Illuminate\Database\Eloquent\Collection;

    public function findNameByAddress();

    public function findPhoneByName();
}

// для разнообразия