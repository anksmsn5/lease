@extends('layouts.app')

@section('content')
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
                                        <option value="<?php echo $dt->agreement_id ?>"><b>Agreement ID:</b> <?php echo $dt->agreement_id; ?>, <b>Tenant Name:</b> <?php echo $dt->tenant_name; ?>, Tenant Mobile: <?php echo $dt->tenant_mobile; ?>, Property ID: <?php echo $dt->property_id ?></option>
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










        </div>
    </div>
</div>


@endsection