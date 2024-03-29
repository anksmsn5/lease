@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Collected Rents</h3>
            <nav aria-label="breadcrumb">
                <a href="<?php echo url("collect-rent"); ?>" class="btn btn-success">Collect Rent</a>
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
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>

                                    <th>Receipt ID</th>

                                    <th>Tenant Name</th>
                                    <th>Tenant Mobile</th>
                                    <th>Paid For</th>
                                    <th>Agreent Id</th>
                                    <th>Total</th>
                                    <th>Paid</th>
                                    <th>Balance</th>



                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>










        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">
    $(function() {
        var table = $('#myTable').DataTable({
            "aaSorting": [],
            processing: true,
            serverSide: true,
            ajax: "{{ route('payment.data') }}",
            columns: [

                {
                    data: 'receipt_id',
                    name: 'receipt_id'
                },
                {
                    data: 'tenant_name',
                    name: 'tenant_name'
                },
                {
                    data: 'tenant_mobile',
                    name: 'tenant_mobile'
                },



                {
                    data: 'rent_for',
                    name: 'rent_for'
                },
                {
                    data: 'agreement_id',
                    name: 'agreement_id'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'paying',
                    name: 'paying'
                },
                {
                    data: 'balance',
                    name: 'balance'
                },

                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });
    });
</script>
@endsection