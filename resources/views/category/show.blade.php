<?php
$id = "";
$paid_at = "";
$account_id = "";
$amount = "";
$currency_code = "";
$currency_rate = "";
$description = "";
$payment_method = "";
$vendor_name = "";
$vendor_email = "";
$reference = "";
$notes = "";

if (isset($payment) && sizeof($payment->toArray())) {
    $id = $payment->id;
    $paid_at = $payment->paid_at;
    $account_id = $payment->account_id;
    $amount = $payment->amount;
    $currency_code = $payment->currency_code;
    $currency_rate = $payment->currency_rate;
    $description = $payment->description;
    $payment_method = $payment->payment_method;
    $vendor_name = $payment->vendor->name;
    $vendor_email = $payment->vendor->email;
    $reference = $payment->reference;
}
?>


@extends('layouts.app')
@section('title')Inovice
@stop
@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-lg-12">
                    <table id="table" class="table hover">
                        <tbody>
                        <tr>
                            <th>Paid at:</th>
                            <td>{{$paid_at}}</td>

                            <th>Account Id:</th>
                            <td>{{$account_id}}</td>
                        </tr>
                        <tr>
                            <th>Amount:</th>
                            <td >{{$amount}}</td>

                            <th>Paid At:</th>
                            <td>{{$paid_at}}</td>
                        </tr>
                        <tr>
                            <th>Currency Code:</th>
                            <td>{{ucfirst($currency_code)}}</td>
                            <th>Currency Rate:</th>
                            <td>{{$currency_rate}}</td>
                        </tr>
                        <tr>
                            <th>Vendor Name:</th>
                            <td>{{$vendor_name}}</td>
                            <th>Vendor  Email:</th>
                            <td>{{$vendor_email}}</td>
                        </tr>
                        <tr>
                            <th>Notes:</th>
                            <td>{{$description}}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{route('payment.edit',$payment->id)}}" class="btn btn-primary hidden-print">Edit</a>
                <button class="btn  btn-success hidden-print" type="button" onclick="window.print()">Print</button>
            </div>
        </div>
    </div>
    <div id="markModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Are you Confirmed for this payment?</h4>

                </div>
                <form role="form" id="form" action="{{route('bill.mark.paid')}}" method="GET" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-body">
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="form-group">
                            <label for="payment_method">Bill Status Code</label>
                            <select name="payment_method" class="form-control" required>
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="paid_at">Paid At</label>
                            <input type="text" name="paid_at" class="form-control date-picker" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="account_id">Accound Id</label>
                            <input type="number" name="account_id" class="form-control" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="Description">Description</label>
                            <textarea type="text" name="description" class="form-control"></textarea>
                        </div>

                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div id="successModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Data has been updated Successfully</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@stop
@section('scripts')
@endsection