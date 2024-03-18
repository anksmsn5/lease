@extends('layouts.app')

@section('content')
<div class="main-panel">
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Rent Agreement List</h3>
              <nav aria-label="breadcrumb">
                <a href="<?php echo url("rent-agreement");?>" class="btn btn-success">Add Rent Agreement</a>
              </nav>
            </div>
            <?php if(session('success'))
            {?>
             <div class="alert alert-success">
  <strong>Success!</strong> <?php echo session('success');?>
</div><?php } ?>
            <div class="row">
                
            
              <div class="col-md-12 grid-margin stretch-card">
                  
                <div class="card">
                  <div class="card-body table-responsive" style="overflow-x: scroll; display:block">
                    <table id="myTable" class="table table-bordered" width="100%">
        <thead>
            <tr>
                <th>Agreement</th>
               
                <th>Tenant </th>
                <th>Property Type</th>
                <th>Property Details</th>
                <th>Owner Details</th>
                <th>Rent Start Date</th>
                <th>Rent Amount</th>
                <th>Security Deposit</th>
                
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
    $(function () {
          var table = $('#myTable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('property.agreement-data') }}",
              columns: [
                  
                  {data: 'agreement_id', name: 'agreement_id'},
                  {data: 'tenant_name', name: 'tenant_name'},
                  {data: 'property_type', name: 'property_type'},
                  {data:'property_id',name:'property_id'},
                  {data: 'owner_name', name: 'owner_name'},
                   {data: 'rent_start_date', name: 'rent_start_date'},
                   {data: 'rent_amount', name: 'rent_amount'},
                   {data: 'security_amount', name: 'security_amount'},
                   
                  {data: 'action', name: 'action'},
              ]
          });
        });
</script>