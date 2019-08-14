<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 09.08.2019
 * Time: 13:49
 */

namespace App\Repository;


use App\Phones;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\PhoneDirectoryController;

class PhoneDirectoryRepository implements PhoneDirectoryRepositoryInterface
{
    private $model;

    private function __construct()
    {
        $this->model = app(Phones::class);
    }

    public function showAllPhones(int $userId): \Illuminate\Database\Eloquent\Collection
    {
        $phones = Phones::all();
        return $phones;
    }

    public function addNewData(array $data): int
    {
        $this->model->fill($data)->save();
        return $this->model->id;
    }

    public function editNumber(int $id): ?\App\Phones
    {
        $phone = Phones::where('id', $id)->set($phone);
        return $phone;
    }

    public function deleteNumber(int $id)
    {
        $phone = \App\Phones::findOrFail($id);
        $phone->delete($phone->all());
        return $phone;
    }

    public function findByPhone(int $tel, int $userId): \Illuminate\Database\Eloquent\Collection
    {
        $name = Phones::where('phone', $phone)->get();
        return $name;
    }

    public function findNameByAddress(int $userId, int $address): \Illuminate\Database\Eloquent\Collection
    {
        $name = Phones::where('address', $address)->get();
        return $name;
    }

    public function findPhoneByName(int $userId, int $name): \Illuminate\Database\Eloquent\Collection
    {
        $phone = Phones::where('name', $name)->get();
        return $phone;
    }
}
