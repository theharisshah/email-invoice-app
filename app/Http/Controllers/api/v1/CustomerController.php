<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Resources\v1\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use App\Exceptions\ServiceException;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        return CustomerResource::collection(Customer::all());
    }

    public function edit(Request $request, $id)
    {
        $customer = Customer::find($request->id);
        if (empty($customer)) {
            abort(404);
        }
        return new CustomerResource($customer);
    }

    public function store(Request $request, CustomerService $customerService)
    {
        try {
            $customer = $customerService->create($request);
        } catch (ServiceException $exception) {
            return response(['custom_error' => $exception->getMessage(), 'message' => $exception->getMessage()], 422);
        }
        return new CustomerResource($customer);
    }

    public function update(Request $request, CustomerService $customerService)
    {
        try {
            $customer = $customerService->update($request);
        } catch (ServiceException $exception) {
            return response(['custom_error' => $exception->getMessage(), 'message' => $exception->getMessage()], 422);
        }
        return new CustomerResource($customer);
    }

    public function delete(Request $request, CustomerService $customerService)
    {
        try {
            $customer = $customerService->delete($request);
        } catch (ServiceException $exception) {
            return response(['custom_error' => $exception->getMessage(), 'message' => $exception->getMessage()], 422);
        }
        return response()->json($customer);
    }
}
