<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceEmailed extends Mailable
{
    use Queueable, SerializesModels;

    private $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invoice = $this->invoice;
        return $this->view('emails.email', compact('invoice'))
            ->attach( public_path("invoices/".$invoice->customer->name.'/'.$invoice->id.'.pdf'), [
                'mime' => 'application/pdf',
            ]);
    }
}
