<?php

namespace Point\PointSales\Helpers;

use Point\PointSales\Models\Sales\InvoiceItem;

class SalesReportHelper
{
    public static function searchList($date_from, $date_to, $search)
    {
        $date_from = $date_from ? date_format_db($date_from, 'start') : date('Y-m-1 00:00:00');
        $date_to = $date_to ? date_format_db($date_to, 'end') : date('Y-m-31 23:59:59');
        return InvoiceItem::joinInvoice()
            ->joinFormulir()
            ->joinCustomer()
            ->whereNotNull('formulir.form_number')
            ->where('form_status', '!=', -1)
            ->whereBetween('formulir.form_date', [$date_from, $date_to])
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('person.name', 'like', '%'.trim($search).'%')
                        ->orWhere('formulir.form_number', 'like', '%'.trim($search).'%');
                }
            })
            ->select('point_sales_invoice_item.*')
            ->orderBy('formulir.form_date');
    }
}
