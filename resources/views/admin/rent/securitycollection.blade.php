@extends('layouts.app')

@section('content')
<style>
    .chdetails,
    .upidetails {
        display: none;
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Collect Rent</h3>
            <nav aria-label="breadcrumb">
                <a href="<?php echo url("rent-collection"); ?>" class="btn btn-success">Collected Rents</a>
            </nav>
        </div>
        <?php if (session('success')) { ?>
            <div class="alert alert-success">
                <strong>Success!</strong> <?php echo session('success'); ?>
            </div><?php } ?>
        <div class="row">


            <div class="col-md-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Select Agreement ID/ Tenant Name / Tenant Mobile Number</label>@csrf
                                <select name="keyword" class="form-control select2">
                                    <?php foreach ($data as $dt) { ?>
                                        <option value=""></option>
                                        <option value="<?php echo $dt->agreement_id ?>" <?php if (request()->keyword == $dt->agreement_id) {
                                                                                            echo "selected";
                                                                                        } ?>><b>Agreement ID:</b> <?php echo $dt->agreement_id; ?>, <b>Tenant Name:</b> <?php echo $dt->tenant_name; ?>, Tenant Mobile: <?php echo $dt->tenant_mobile; ?>, Property ID: <?php echo $dt->property_id ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Proceed">
                            </div>
                        </form>

                    </div>
                </div>
            </div>


            <div class="col-md-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo url("make-payment"); ?>" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Collect Rent From: <?php echo $data[0]->tenant_name; ?></h3>
                                </div>@csrf
                                <?php foreach ($data as $dt) { ?>
                                    <div class="col-md-4"><input type="checkbox" id="rent[]" name="rent[]" class="rentbox" value="Rent~<?php echo $dt->amount; ?>~<?php echo $dt->id; ?>~<?php echo $dt->rent_no; ?>">
                                        <label class="smallabel"> <?php echo " Month " . $dt->rent_no ?> <span class="text-danger">(Due On: <?php echo $dt->due_date ?>)</span></label>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Security Deposit</h3>
                                </div>
                                <?php foreach ($deposit as $dt) {
                                    if ($dt->security > 0) { ?>
                                        <div class="col-md-4"><input type="checkbox" id="security" class="securitybox" name="security" value="Rent~<?php echo $dt->security; ?>~<?php echo $dt->id; ?>">
                                            <label class="smallabel"> Security Amount</label>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label>Previous Total</label>
                                    <input type="text" name="previous_balance" id="previous_balance" class="form-control" value="<?php echo @$previousbalance->balance ?: "0" ?>" readonly>

                                </div>
                                <div class="col-md-3 form-group">
                                    <label>Total Amount</label>
                                    <input type="text" name="total" id="total" class="form-control" readonly>
                                    <input type="hidden" name="tenant_id" id="tenant_id" class="form-control" value="<?php echo $data[0]->tenant_id; ?>">
                                    <input type="hidden" name="agreement_id" id="agreement_id" class="form-control" value="<?php echo $data[0]->agreement_id; ?>">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>Paying</label>
                                    <input type="text" name="paying" id="paying" class="form-control">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>Balance</label>
                                    <input type="text" name="balance" id="balance" class="form-control" readonly>
                                    <input type="hidden" name="rent_for" id="rent_for" class="form-control">
                                </div>

                                <div class="col-md-12 form-group">
                                    <label> Remarks</label>
                                    <textarea name="remarks" id="remarks" class="form-control"></textarea>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>Payment Mode</label>
                                    <select name="pmode" id="pmode" required class="form-control">
                                        <option value="Cash">Cash</option>
                                        <option value="UPI">UPI</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                </div>

                                <div class="col-md-3 form-group chdetails">
                                    <label>Cheque No</label>
                                    <input type="text" name="chno" class="form-control">

                                </div>
                                <div class="col-md-3 form-group chdetails">
                                    <label>Cheque Date</label>
                                    <input type="date" name="chdate" class="form-control">

                                </div>
                                <div class="col-md-3 form-group chdetails">
                                    <label>Bank Name</label>
                                    <input type="text" name="bank" class="form-control">

                                </div>
                                <div class="col-md-3 form-group upidetails">
                                    <label>Reference ID</label>
                                    <input type="text" name="reference_id" class="form-control">

                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-success" value="Submit">
                                    <input type="reset" class="btn btn-danger" value="Reset">
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>










        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    var total = 0;
    var rentfor = [];
    $(document).ready(function() {

        $(".rentbox").click(function() {
            if ($(this).is(':checked')) {
                var sval = $(this).val().split("~");
                var amount = sval[1];
                total = parseFloat(total) + parseFloat(amount);
                $("#total").val(total);
                $("#balance").val(0);
                $("#paying").val(0);
                rentfor.push(sval[3])
                $("#rent_for").val(rentfor);
            } else {
                var sval = $(this).val().split("~");
                var amount = sval[1];
                total = parseFloat(total) - parseFloat(amount);
                $("#total").val(total);
                $("#balance").val(0);
                $("#paying").val(0);
                rentfor.pop(sval[3]);
                $("#rent_for").val(rentfor);
            }
        });

        $(".securitybox").click(function() {
            if ($(this).is(':checked')) {
                var sval = $(this).val().split("~");
                var amount = sval[1];
                total = parseFloat(total) + parseFloat(amount);
                $("#total").val(total);
                $("#balance").val(0);
                $("#paying").val(0);
                $("#rent_for").val();
            } else {
                var sval = $(this).val().split("~");
                var amount = sval[1];
                total = parseFloat(total) - parseFloat(amount);
                $("#total").val(total);
                $("#balance").val(0);
                $("#paying").val(0);
            }
        });

        $("#paying").blur(function() {
            var paying = parseFloat($(this).val()) || 0;
            var total = parseFloat($("#total").val()) || 0;
            var previous_balance = parseFloat($("#previous_balance").val()) || 0;

            $("#balance").val(total + previous_balance - paying);
        });

        $("#pmode").change(function() {
            var id = $(this).val();
            if (id == 'Cheque') {
                $(".chdetails").show();
                $(".upidetails").hide();
            } else if (id == 'UPI') {
                $(".chdetails").hide();
                $(".upidetails").show();
            } else {
                $(".chdetails").hide();
                $(".upidetails").hide();
            }
        })

    })
</script>
@endsection