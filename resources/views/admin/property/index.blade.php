@extends('layouts.app')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">Properties</h3>
      <nav aria-label="breadcrumb">
        <a href="<?php echo url("add-property"); ?>" class="btn btn-success">Add Properties</a>
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
                  <th> ID</th>
                  <th>Property Name</th>

                  <th> Type</th>
                  <th> Purpose</th>

                  <th>Owner</th>
                  <th>Mobile</th>
                  <th> Area</th>
                  <th>Rent (Rs.)</th>
                  <th>Security (Rs.)</th>
                  <th>Status</th>

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

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">
  $(function() {
    var table = $('#myTable').DataTable({
      "aaSorting": [],
      processing: true,
      serverSide: true,
      ajax: "{{ route('property.data') }}",
      columns: [

        {
          data: 'property_id',
          name: 'property_id'
        },
        {
          data: 'property_name',
          name: 'property_name'
        },
        {
          data: 'property_type',
          name: 'property_type'
        },
        {
          data: 'type',
          name: 'type'
        },


        {
          data: 'owner_name',
          name: 'owner_name'
        },
        {
          data: 'owner_mobile_no',
          name: 'owner_mobile_no'
        },
        {
          data: 'property_size',
          name: 'property_size'
        },
        {
          data: 'price_rent',
          name: 'price_rent'
        },
        {
          data: 'security_deposit',
          name: 'security_deposit'
        },
        {
          data: 'statusBtn',
          name: 'statusBtn'
        },
        {
          data: 'action',
          name: 'action'
        },
      ]
    });
  });
</script>