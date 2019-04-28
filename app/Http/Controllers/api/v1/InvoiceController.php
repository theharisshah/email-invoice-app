<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Resources\v1\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\InvoiceService;
use App\Exceptions\ServiceException;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        return InvoiceResource::collection(Invoice::all());
    }

    public function edit(Request $request, $id)
    {
        $invoice = Invoice::find($request->id);
        if (empty($invoice)) {
            abort(404);
        }
        return new InvoiceResource($invoice);
    }

    public function store(Request $request, InvoiceService $invoiceService)
    {
        try {
            $invoice = $invoiceService->create($request);
        } catch (ServiceException $exception) {
            return response(['custom_error' => $exception->getMessage(), 'message' => $exception->getMessage()], 422);
        }
        return new InvoiceResource($invoice);
    }

    public function update(Request $request, InvoiceService $invoiceService)
    {
        try {
            $invoice = $invoiceService->update($request);
        } catch (ServiceException $exception) {
            return response(['custom_error' => $exception->getMessage(), 'message' => $exception->getMessage()], 422);
        }
        return new InvoiceResource($invoice);
    }

    public function delete(Request $request, InvoiceService $invoiceService)
    {
        try {
            $invoice = $invoiceService->delete($request);
        } catch (ServiceException $exception) {
            return response(['custom_error' => $exception->getMessage(), 'message' => $exception->getMessage()], 422);
        }
        return response()->json($invoice);
    }
}
