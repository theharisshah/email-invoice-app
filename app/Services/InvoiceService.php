<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Invoice;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exceptions\ServiceException;
use App\Services\Service;

class InvoiceService extends Service
{
    public function create(Request $request)
    {
        $invoice = $this->processData($request, new Invoice());
        $invoice->save();
        return $invoice;
    }

    public function update(Request $request)
    {
        $invoice = Invoice::find($request->id);
        if (empty($invoice)) {
            throw new ServiceException("Invoice doesn't exist !");
        }
        $invoice = $this->processData($request, $invoice);
        $invoice->save();
        return $invoice;
    }

    public function delete(Request $request)
    {
        $invoice = Invoice::find($request->id);
        if (empty($invoice)) {
            throw new ServiceException("Invoice doesn't exist !");
        }
        return $invoice->delete();
    }

    private function processData(Request $request, Invoice $invoice)
    {
        $invoice->name = $request->name;
        $invoice->customer_id = $request->customer_id;
        $invoice->description = $request->description;
        $invoice->date = Carbon::parse($request->date)->toDateString();
        $invoice->status = Invoice::STATUS_PROCESSED;
        return $invoice;
    }

    public function generateInvoice(Request $request,$customer)
    {
        $invoice = Invoice::find($request->id);
        if(empty($invoice)){
            throw new ServiceException('Invoice not found');
        }
        if($invoice->items->isEmpty()){
            throw new ServiceException('Cannot Generate Empty Invoice');
        }
        $invoice->customer_id = $customer->id;
        $invoice->status = Invoice::STATUS_GENERATED;
        $invoice->save();
        $invoice->loadMissing('items','customer');
        $overwrite = false;
        if (file_exists(public_path("invoices/".$invoice->customer->name.'/'.$invoice->id.'.pdf'))) {
            $overwrite = true;
        }
        $pdf = SnappyPdf::loadView('pdf.invoice', compact('invoice'));
        $pdf->save(public_path("invoices/".$invoice->customer->name.'/'.$invoice->id.'.pdf'), $overwrite);
        return $pdf->stream($invoice->customer->name.'.pdf');
    }
}
