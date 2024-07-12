<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use App\Models\Proposal;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //

    public function invoice(){
        $invoices = Invoice::where(function ($query) {
            $query->where('seller_id', auth()->id())
                ->orWhere('client_id', auth()->id());
        })->latest()->paginate(5);

        return view('invoice.invoice',compact('invoices'));

    }

    public function invoice_view($id){
        // $proposal = Proposal::find($invoice->proposal_id);
        $invoice = Invoice::find($id);
        
        if(!$invoice) {
            // Handle the case where the invoice with the given ID was not found, for example, redirect back with an error message
            return redirect()->back()->with('error', 'Invoice not found');
        }
    
        return view('invoice.invoice_view', compact('invoice'));
    }
    
}
