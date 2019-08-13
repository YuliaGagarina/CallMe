<?php

namespace App\Http\Controllers;

use App\Repository\EmployeesRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    private $employeesRepository;

    /**
     * EmployeesController constructor.
     * @param EmployeesRepositoryInterface $employeesRepository
     *
     */
    public function __construct(EmployeesRepositoryInterface $employeesRepository)
    {
        $this->middleware('jwt.auth');
        $this->employeesRepository = $employeesRepository;
    }
    public function show(Request $request)
    {
        if (Auth::check()) {
            $employee = $this->getUser()->name;
            $name = $request->name;
            if (\App\Employees::where('name', $name)->all()) {
                $employee = $this->employeesRepository->findEmployee($name);
                unset($employee->login);
                unset($employee->password);
                return response()->json($employee, Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'This employee does not exist',
                    'errors' =>['name' => 'This name could not be found']
                ], Response::HTTP_NOT_FOUND);
            }
        }
    }

    public function write(Request $request)
    {
        if (Auth::check()) {
            $this->validate($request, [
                'department' => 'required',
                'position' => 'required',
                'name' => 'required',
                'login' => 'required',
                'password' => 'required',
                'phone' => 'required',
                'e-mail' => 'required',
                'rights' => 'required',
                'age' => 'required',
                'address' => 'required',
                'user_id' => 'required',
            ]);
            $employee = $this->employeesRepository->addEmployee([
                'department' => request(department),
                'position' => request(department),
                'name' => request(department),
                'login' => request(department),
                'password' => request(department),
                'phone' => request(department),
                'e-mail' => request(department),
                'rights' => request(department),
                'age' => request(department),
                'address' => request(department),
                'user_id' => request(department),
            ]);

            return \response()->json(null, Response::HTTP_CREATED, [
                'Location' => $employee
            ]);
        }
    }

    public function destroyEmployee(Request $request)
    {
        if (Auth::check()) {
            $employee = $this->getUser()->name;
            $name = $request->name;
            if (\App\Employees::where('name', $name)) {
                $employee = $this->employeesRepository->deleteEmployee($name);
                return response()->json(null, Response::HTTP_NO_CONTENT);
            } else {
                return response()->json([
                    'message' => 'This employee does not exist',
                    'errors' =>['name' => 'This name could not be found']
                ], Response::HTTP_NOT_FOUND);
            }
        }
    }

    public function newInformation()
    {
        if (Auth::check()) {
            $employee = $this->getUser()->name;
            $name = $request->name;
            if (\App\Employees::where('name', $name)) {
                $employee = $this->employeesRepository->updateEmployee($name);
                return response()->json($employee, Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'This employee does not exist',
                    'errors' =>['name' => 'This name could not be found']
                ], Response::HTTP_NOT_FOUND);
            }
        }
    }
}
