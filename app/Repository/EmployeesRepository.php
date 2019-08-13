<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 09.08.2019
 * Time: 13:49
 */

namespace App\Repository;


use App\Employees;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeesRepository implements EmployeesRepositoryInterface
{
    private $model;

    private function __construct()
    {
        $this->model = app(Employees::class);
    }

    public function addEmployee(array $data): array
    {
        $data = $this->toDbArray($data);
        $this->model->create($data);
        return $data;
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

    public function updateEmployee($name, $newData, 'new Data')
    //$new Data - подразумеваю ячейку и значение, которые нужно заменить
    {
        $employee = \App\Employee::where('name', $name)->set('new Data', $new Data);
        return $employee;
    }
}
