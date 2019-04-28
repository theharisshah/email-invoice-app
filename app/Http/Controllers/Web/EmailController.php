<?php

namespace App\Http\Controllers\Web;

use App\Mail\InvoiceEmailed;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{

    public function mail(Request $request)
    {
        $invoice = Invoice::find($request->id);
        if (empty($invoice)) {
            abort(404);
        }
        if($invoice->status != Invoice::STATUS_GENERATED){
            return redirect()->back()->with('error','Please Generate the invoice first');
        }
        Mail::to($invoice->customer->email)->send(new InvoiceEmailed($invoice));
        return redirect()->back()->with('success', 'Invoice Emailed Successfully!');
    }
}
