<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 12.08.2019
 * Time: 10:53
 */

namespace App\Repository;

use \Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\PhoneDirectoryController;

interface PhoneDirectoryRepositoryInterface
{
    public function showAllPhones(int $userId): \Illuminate\Database\Eloquent\Collection;

    public function addNewData(array $data): int;

    public function editNumber(int $id): ?\App\Phones;

    public function deleteNumber(int $id);

    public function findByPhone(int $tel, int $userId): \Illuminate\Database\Eloquent\Collection;

    public function findNameByAddress(int $userId, int $address): \Illuminate\Database\Eloquent\Collection;

    public function findPhoneByName(int $userId, int $name): \Illuminate\Database\Eloquent\Collection;
}
