<?php

namespace App\Services;

use App\Models\InvoiceProduct;
use Illuminate\Http\Request;
use App\Exceptions\ServiceException;
use App\Services\Service;

class InvoiceProductService extends Service
{
    public function create(Request $request)
    {
        $invoiceProduct = $this->processData($request, new InvoiceProduct());
        $invoiceProduct->save();
        return $invoiceProduct;
    }
    
    public function update(Request $request)
    {
        $invoiceProduct = InvoiceProduct::find($request->id);
        if (empty($invoiceProduct)) {
            throw new ServiceException("Invoice Product doesn't exist !");
        }
        $invoiceProduct = $this->processData($request, $invoiceProduct);
        $invoiceProduct->save();
        return $invoiceProduct;
    }
    
    public function delete(Request $request)
    {
        $invoiceProduct = InvoiceProduct::find($request->id);
        if (empty($invoiceProduct)) {
            throw new ServiceException("Invoice Product doesn't exist !");
        }
        return $invoiceProduct->delete();
    }
    
    private function processData(Request $request, InvoiceProduct $invoiceProduct)
    {
        $invoiceProduct->invoice_id = $request->invoice_id;
        $invoiceProduct->product_name = $request->product_name;
        $invoiceProduct->quantity = $request->quantity;
        $invoiceProduct->product_price = $request->product_price;
        $invoiceProduct->total = $request->quantity * $request->product_price;
        return $invoiceProduct;
    }
}
