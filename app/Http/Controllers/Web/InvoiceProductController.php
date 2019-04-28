<?php

namespace App\Http\Controllers\Web;

use App\Http\Resources\v1\InvoiceProductResource;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\InvoiceProductService;
use App\Exceptions\ServiceException;

class InvoiceProductController extends Controller
{
    public function index($invoiceId)
    {
       $items = InvoiceProduct::where('invoice_id', $invoiceId)->get();
       $invoice = Invoice::find($invoiceId);
       return view('products.form', compact('items', 'invoice'));
    }


    public function store(Request $request,InvoiceProductService $invoiceProductService)
    {
        try{
            $invoiceProduct = $invoiceProductService->create($request);
        }catch (ServiceException $exception){
            return response(['custom_error' => $exception->getMessage(),'message'=> $exception->getMessage()], 422);
        }
        return redirect()->back();
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
        return redirect()->back();
    }
}
