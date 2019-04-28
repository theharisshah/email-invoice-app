<?php

namespace App\Http\Controllers\Web;

use App\Http\Resources\v1\InvoiceResource;
use App\Models\Customer;
use App\Models\Invoice;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\InvoiceService;
use App\Exceptions\ServiceException;
use Illuminate\Support\Facades\Response;
class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoices = Invoice::with('customer')->get();
        return view('invoice.index', compact('invoices'));
    }

    public function edit(Request $request, $id)
    {
        $invoice = Invoice::find($request->id);
        if (empty($invoice)) {
            abort(404);
        }
        return view('invoice.edit', compact('invoice'));
    }

    public function create()
    {
        return view('invoice.form');
    }

    public function store(Request $request, InvoiceService $invoiceService)
    {
        try {
            $invoice = $invoiceService->create($request);
        } catch (ServiceException $exception) {
            return response(['custom_error' => $exception->getMessage(), 'message' => $exception->getMessage()], 422);
        }
        return redirect()->route('web::invoices');
    }

    public function update(Request $request, InvoiceService $invoiceService)
    {
        try {
            $invoice = $invoiceService->update($request);
        } catch (ServiceException $exception) {
            return response(['custom_error' => $exception->getMessage(), 'message' => $exception->getMessage()], 422);
        }
        return redirect()->route('web::invoices');
    }


    public function generateInvoice(Request $request, CustomerService $customerService, InvoiceService $service)
    {
        try {
            $customer = $customerService->findOrCreate($request);
            $pdf = $service->generateInvoice($request, $customer);
        }catch(ServiceException $exception){
            return response(['custom_error' => $exception->getMessage(), 'message' => $exception->getMessage()], 422);
        }
        return $pdf;
    }

    public function downloadInvoice(Request $request, InvoiceService $service)
    {
       try{
           $invoice = Invoice::find($request->id);
           $pdf = $service->prepareInvoiceFile($invoice);
       }catch(ServiceException $exception){
           return response(['custom_error' => $exception->getMessage(), 'message' => $exception->getMessage()], 422);
       }
       return $pdf->inline($invoice->customer->name.'.pdf');
    }
}
