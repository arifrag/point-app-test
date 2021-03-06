<?php

namespace Point\PointPurchasing\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Point\PointPurchasing\Models\Service\Downpayment;

class DownpaymentVesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approval()
    {
        access_is_allowed('approval.point.purchasing.service.downpayment');

        $view = view('app.index');
        $view->array_vesa = Downpayment::getVesaApproval();
        return $view;
    }

    public function rejected()
    {
        access_is_allowed('update.point.purchasing.service.downpayment');

        $view = view('app.index');
        $view->array_vesa = Downpayment::getVesaReject();
        return $view;
    }
}
