<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 09.08.2019
 * Time: 13:50
 */

namespace App\Repository;


use App\Transporters;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransportersRepository
{
    use RefreshDatabase;

    private $model;

    public function __construct()
    {
        $this->model = app(Transporters::class);
    }

    public function findByTransporter($transporter)
    {
        $transporter = $this->model->where('Transporter', 'like', '%$transporter%')->all();
        return $transporter;
    }

    public function transportToDB()
    {
        return [
            'kind of transport' => $apiRequest('Kind of transport'),
            'transporter' => $apiRequest('Transporter'),
            'position' => $apiRequest('Position'),
            'name' => $apiRequest('Name'),
            'phone' => $apiRequest('Phone'),
            'e-mail' => $apiRequest('E-mail'),
            'created by' => $apiRequest('Created by')
        ];
    }
}