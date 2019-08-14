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

class PhoneDirectoryRepository implements PhoneDirectoryRepositoryInterface
{
    private $model;

    private function __construct()
    {
        $this->model = app(Phones::class);
    }

    public function showAllPhones(): \Illuminate\Database\Eloquent\Collection
    {
        $phones = Phones::where('phone')->get(); //не знаю, как это вытащить списком
        return $phones;
    }

    public function addNewData(array $data)
    {
        $this->model->fill($data)->save();
        return $this->model->id;
    }

    public function editNumber($id, $phone)
    {
        $phone = Phones::where('id', $id)->set($phone);
        return $phone;
    }

    public function deleteNumber($id)
    {
        $phone = \App\Phones::findOrFail($id);
        $phone->delete($phone->all());
        return $phone;
    }

    public function findByPhone($phone): \Illuminate\Database\Eloquent\Collection
    {
        $name = Phones::where('phone', $phone)->get();
        return $name;
    }

    public function findNameByAddress($address)
    {
        $name = Phones::where('address', $address)->get();
        return $name;
    }

    public function findPhoneByName($name)
    {
        $phone = Phones::where('name', $name)->get();
        return $phone;
    }





    private function toDbArray(array $apiRequest): array
    {
        return [
            'department' => $apiRequest['Department'],
            'position' => $apiRequest['Position'],
            'name' => $apiRequest['Name'],
            'login' => $apiRequest['Login'],
            'password' => $apiRequest['Password'],
            'phone' => $apiRequest['Phone'],
            'e-mail' => $apiRequest['E-mail'],
            'rights' => $apiRequest['Rights'],
            'age' => $apiRequest['Age'],
            'address' => $apiRequest['Address'],
            'user_id' => $apiRequest['User_id'],
        ];
    }

    public function findEmployee(string $name): \Illuminate\Database\Eloquent\Collection
    {
        $employee = Employees::findOrFail('name', $name)->get();
        return $employee;
    }

    public function deleteEmployee(string $name)
    {
        $employee = \App\Employee::findOrFail($name);
        $employee->delete($employee->all());
        return $employee;
    }

    public function updateEmployee($name, $newData)
    //$new Data - подразумеваю ячейку и значение, которые нужно заменить
    {
        $employee = \App\Employee::where('name', $name)->set('new Data', $newData);
        return $employee;
    }
}
