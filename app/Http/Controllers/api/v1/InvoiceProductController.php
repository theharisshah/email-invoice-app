<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Resources\v1\InvoiceProductResource;
use App\Models\InvoiceProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\InvoiceProductService;
use App\Exceptions\ServiceException;

class InvoiceProductController extends Controller
{
    public function index(Request $request)
    {
        return InvoiceProductResource::collection(InvoiceProduct::all());
    }

    public function edit(Request $request,$id)
    {
        $invoiceProduct = InvoiceProduct::find($id);
        if (empty($invoiceProduct)) {
            abort(404);
        }
        return new InvoiceProductResource($invoiceProduct);
    }

    public function store(Request $request,InvoiceProductService $invoiceProductService)
    {
        try{
            $invoiceProduct = $invoiceProductService->create($request);
        }catch (ServiceException $exception){
            return response(['custom_error' => $exception->getMessage(),'message'=> $exception->getMessage()], 422);
        }
        return new InvoiceProductResource($invoiceProduct);
    }

    public function update(Request $request,InvoiceProductService $invoiceProductService)
    {
        try{
            $invoiceProduct = $invoiceProductService->update($request);
        }catch (ServiceException $exception){
            return response(['custom_error' => $exception->getMessage(),'message'=> $exception->getMessage()], 422);
        }
        return new InvoiceProductResource($invoiceProduct);
    }

    public function delete(Request $request,InvoiceProductService $invoiceProductService)
    {
        try{
            $invoiceProduct = $invoiceProductService->delete($request);
        }catch (ServiceException $exception){
            return response(['custom_error' => $exception->getMessage(),'message'=> $exception->getMessage()], 422);
        }
        return response()->json($invoiceProduct);
    }
}
