@extends('core::app.layout')

@section('scripts')
    <script>
        $("#check-all").change(function () {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });
    </script>
@stop

@section('content')
    <div id="page-content">
        <ul class="breadcrumb breadcrumb-top">
            @include('point-purchasing::app.purchasing.point.fixed-assets._breadcrumb')
            <li><a href="{{ url('purchasing/point/fixed-assets/goods-received') }}">Goods Received</a></li>
            <li>Request approval</li>
        </ul>
        <h2 class="sub-header">Goods Received | Fixed Assets</h2>
        @include('point-purchasing::app.purchasing.point.fixed-assets.goods-received._menu')

        <form action="{{url('purchasing/point/fixed-assets/goods-received/send-request-approval')}}" method="post">
            {!! csrf_field() !!}

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        {!! $list_goods_received->render() !!}
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">
                                    <input type="checkbox" id="check-all">
                                </th>
                                <th>Form Date</th>
                                <th>Form Number</th>
                                <th>Supplier</th>
                                <th>Amount</th>
                                <th>Last Request</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list_goods_received as $goods_received)
                                <tr id="list-{{$goods_received->formulir_id}}">
                                    <td class="text-center">
                                        <input type="checkbox" name="formulir_id[]"
                                               value="{{$goods_received->formulir_id}}">
                                    </td>
                                    <td>{{ date_format_view($goods_received->formulir->form_date) }}</td>
                                    <td>
                                        <a href="{{ url('purchasing/point/fixed-assets/goods-received/'.$goods_received->id) }}">{{ $goods_received->formulir->form_number}}</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('master/contact/supplier/'.$goods_received->supplier_id) }}">{{ $goods_received->supplier->codeName}}</a>
                                    </td>
                                    <td>{{ number_format_quantity($goods_received->amount) }}</td>
                                    <td>
                                        @if($goods_received->formulir->request_approval_at != '0000-00-00 00:00:00')
                                            {{ date_format_view($goods_received->formulir->request_approval_at, true) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $list_goods_received->render() !!}
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-effect-ripple btn-primary">Send Request</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
