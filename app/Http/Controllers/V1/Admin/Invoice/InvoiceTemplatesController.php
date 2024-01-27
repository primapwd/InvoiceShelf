<?php

namespace InvoiceShelf\Http\Controllers\V1\Admin\Invoice;

use InvoiceShelf\Http\Controllers\Controller;
use InvoiceShelf\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceTemplatesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->authorize('viewAny', Invoice::class);

        $invoiceTemplates = Invoice::invoiceTemplates();

        return response()->json([
            'invoiceTemplates' => $invoiceTemplates,
        ]);
    }
}
