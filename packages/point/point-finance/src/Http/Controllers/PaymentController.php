<?php

namespace Point\PointFinance\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Point\Framework\Helpers\FormulirHelper;
use Point\PointFinance\Helpers\PaymentHelper;
use Point\PointFinance\Models\PaymentReference;

class PaymentController extends Controller
{
    public function choose($payment_reference_id)
    {
        $payment_reference = PaymentReference::where('payment_reference_id', $payment_reference_id)->first();
        return view('point-finance::app.finance.point.choose_payment')->with(['payment_reference' => $payment_reference]);
    }

    public function cancel()
    {
        $permission_slug = app('request')->input('permission_slug');
        $formulir_id = app('request')->input('formulir_id');

        DB::beginTransaction();

        FormulirHelper::cancel($permission_slug, $formulir_id);
        PaymentHelper::cancelPayment($formulir_id);

        DB::commit();

        return array('status' => 'success');
    }
}
