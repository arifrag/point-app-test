<?php

namespace Point\PointPurchasing\Http\Controllers;

use App\Http\Controllers\Controller;
use Point\Core\Traits\ValidationTrait;
use Point\PointPurchasing\Models\PurchaseRequisition;

class PurchaseRequisitionVesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approval()
    {
        access_is_allowed('read.point.purchasing.requisition');

        $view = view('app.index');
        $view->array_vesa = PurchaseRequisition::getVesaApproval();
        return $view;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPurchaseRequisition()
    {
        access_is_allowed('create.point.purchasing.requisition');

        $view = view('app.index');
        $view->array_vesa = PurchaseRequisition::getVesaCreate();
        return $view;
    }

    public function rejected()
    {
        access_is_allowed('update.point.purchasing.requisition');

        $view = view('app.index');
        $view->array_vesa = PurchaseRequisition::getVesaReject();
        return $view;
    }
    
    public function createPurchaseOrder()
    {
        access_is_allowed('create.point.purchasing.order');

        $view = view('app.index');
        $view->array_vesa = PurchaseRequisition::getVesaCreatePurchaseOrder();
        return $view;
    }
}
