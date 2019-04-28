<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exceptions\ServiceException;
use App\Services\Service;

class CustomerService extends Service
{
    public function create(Request $request)
    {
        $customer = $this->processData($request, new Customer());
        $customer->save();
        return $customer;
    }
    
    public function update(Request $request)
    {
        $customer = Customer::find($request->id);
        if (empty($customer)) {
            throw new ServiceException("Customer doesn't exist !");
        }
        $customer = $this->processData($request, $customer);
        $customer->save();
        return $customer;
    }
    
    public function delete(Request $request)
    {
        $customer = Customer::find($request->id);
        if (empty($customer)) {
            throw new ServiceException("Customer doesn't exist !");
        }
        return $customer->delete();
    }
    
    private function processData(Request $request, Customer $customer)
    {
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        return $customer;
    }

    public function findOrCreate(Request $request)
    {
        return Customer::firstOrCreate(
            ['email'=>$request->email],
            [
                'address'=>$request->address,
                'name'=>$request->name,
            ]
        );
    }
}
