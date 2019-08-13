<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 12.08.2019
 * Time: 10:53
 */

namespace App\Repository;

interface EmployeesRepositoryInterface
{
    public function addEmployee();

    public function deleteEmployee();

    public function findEmployee(): \Illuminate\Database\Eloquent\Collection;

    public function updateEmployee();
}
