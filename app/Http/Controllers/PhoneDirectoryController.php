<?php

namespace App\Http\Controllers;

use App\Repository\PhoneDirectoryRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Location;

class PhoneDirectoryController extends Controller
{
    private $phoneDirectoryRepository;

    /**
     * PhoneDirectoryController constructor.
     * @param PhoneDirectoryRepositoryInterface $phoneDirectoryRepository
     *
     */
    public function __construct(PhoneDirectoryRepositoryInterface $phoneDirectoryRepository)
    {
        $this->middleware('jwt.auth');
        $this->phoneDirectoryRepository = $phoneDirectoryRepository;
    }

    public function index()
    {
        if (Auth::check()) {
            $phones = $this->phoneDirectoryRepository->showAllPhones();
            //этот метод нужно дописать
            return response()->json($phones, Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'Yuu cannot watch this information',
                'errors' =>['userId' => 'Incorrect name or password']
            ], Response::HTTP_FORBIDDEN);
        }
    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            $this->validate($request, [
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
                ]);
            $userId = $this->phoneDirectoryRepository->addNewData([
                'name' => request('name'),
                'address' => request ('address'),
                'phone' => request ('phone')
            ]);

            return response()->json(null, Response::HTTP_CREATED, [
                'Location' => $userId
            ]);
        }
    }

    public function update(Request $request)
    {
        if (Auth::check()) {
            $phone = $this->getUser()->phone;
            $name = $request->name;
            if (\App\Phones::where('name', $name)->first()) {
                $phone = $this->phonesRepository->editNumber($id);
                $phone->update($request->all());
                return response()->json($phone, 200);
            } else {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => ['phone' => 'such phone could not be found.']
                ], Response::HTTP_NOT_FOUND);
            }
        }
    }

    public function delete(Request $request)
    {
        if (Auth::check()) {
            $userId = $this->getUser()->id;
            $id = $request->id;
            if (\App\Phones::where('user_id', $userId)->where('id', $id)->first()) {
                $userId = $this->phoneDirectoryRepository->deleteNumber($id);
                return response()->json(null, Response:: HTTP_NO_CONTENT);
            } else {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => ['id' => 'such userId could not be found.']
                ], Response::HTTP_NOT_FOUND);
            }
        }
    }

    public function findByNumberPhone(Request $request)
    {
        if (Auth::check()) {
            $userId = $this->getUser()->id;
            $phone = $request->id;
            if (\App\Phones::where('userId', $userId)->where('phone', $phone)) {
                $name = $this->phoneDirectoryRepository->findByPhone($phone);
                return response()->json($name, Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'This name does not exist',
                    'errors' =>['name' => 'This name could not be found']
                ], Response::HTTP_NOT_FOUND);
            }
        }
    }

    public function findByAddress(Request $request)
    {
        if (Auth::check()) {
            $userId = $this->getUser()->id;
            $address = $request->id;
            if (\App\Phones::where('userId', $userId)->where('address', $address)) {
                $name = $this->phoneDirectoryRepository->findNameByAddress($address);
                return response()->json($name, Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'This name does not exist',
                    'errors' =>['name' => 'This name could not be found']
                ], Response::HTTP_NOT_FOUND);
            }
        }
    }

    public function findByName(Request $request)
    {
        if (Auth::check()) {
            $userId = $this->getUser()->id;
            $name = $request->id;
            if (\App\Phones::where('userId', $userId)->where('name', $name)) {
                $phone = $this->phoneDirectoryRepository->findPhoneByName($name);
                return response()->json($phone, Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'This phone does not exist',
                    'errors' =>['name' => 'This phone could not be found']
                ], Response::HTTP_NOT_FOUND);
            }
        }
    }
}

