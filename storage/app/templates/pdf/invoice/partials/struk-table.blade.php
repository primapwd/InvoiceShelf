<table width="100%" class="items-table" cellspacing="0" border="0">
    @foreach ($invoice->items as $item)
        <tr class="item-row">
            <td
                class="pl-0 text-left item-cell"
                style="vertical-align: top;"
            >
                <span>{{ $item->name }}</span><br>
                {{$item->quantity}} @if($item->unit_name) {{$item->unit_name}} @endif
                @if ($item->description)
                    <br><span> - {!! nl2br(htmlspecialchars($item->description)) !!}</span>
                @endif
            </td>
            <td
                class="pr-20 text-right item-cell"
                style="vertical-align: top;"
            >
                {!! format_money_pdf($item->price, $invoice->customer->currency) !!}

                @if($invoice->discount_per_item === 'YES' && $item->discount > 0)
                    <br>Disc: ({!! format_money_pdf($item->discount_val, $invoice->customer->currency) !!})
                @endif
            </td>
            <td
                class="text-right item-cell"
                style="vertical-align: top;"
            >
                {!! format_money_pdf($item->total, $invoice->customer->currency) !!}
            </td>
        </tr>
    @endforeach
    <tr class="item-row">
        <td class="pl-0 text-right item-cell" style="vertical-align: top;" colspan="2">
            @lang('pdf_subtotal')
        </td>
        <td class="p-0 text-right item-cell" style="vertical-align: top;">
            {!! format_money_pdf($invoice->sub_total, $invoice->customer->currency) !!}
        </td>
    </tr>

    @php
        $downPayment = 0;
    @endphp
    @if($invoice->paid_status === App\Models\Invoice::STATUS_PARTIALLY_PAID)
    <tr class="item-row">
        @php
            $downPayment = $invoice->total - $invoice->due_amount;
        @endphp
        <td class="pl-0 text-right item-cell" style="vertical-align: top;" colspan="2">
            DP
        </td>
        <td class="p-0 text-right item-cell" style="vertical-align: top;">
            {!! format_money_pdf($downPayment, $invoice->customer->currency) !!}
        </td>
    </tr>
    @endif

    <tr class="item-row">
        <td class="pl-0 text-right item-cell" style="vertical-align: top;" colspan="2">
            @lang('pdf_total')
        </td>
        <td class="p-0 text-right item-cell" style="vertical-align: top;">
            {!! format_money_pdf($invoice->total - $downPayment, $invoice->customer->currency) !!}
        </td>
    </tr>
</table>

<hr class="item-cell-table-hr">

<table width="100%" cellspacing="0px" border="0" class="total-display-table">

</table>
<div class="total-display-container">
</div>
