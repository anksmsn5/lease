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
						<th>Agreement ID</th>
						<th>Tenant Name</th>
						<th>Property Name</th>
						<th>Point of Contact</th>
						<th>Rent Date</th>
						<th>Agreement Date</th>
						<th>Basic Rent</th>
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
                  { data: 'tenant_name', name:'tenant_name',
						   render: function ( data, type, row ) 
						   {
							 return row.tenant_name + '<br><br> Mob:<a href="tel:'+row.tenant_mobile+'"> ' + row.tenant_mobile+'</a>' 
						   }
              
                    },
                  
                  {data:'property_name',name:'property_name'},
                  { data: 'contact_name', name:'contact_name',
						   render: function ( data, type, row ) 
						   {
							 return row.contact_name + '<br><br> Mob:<a href="tel:'+row.contact_mobile+'"> ' + row.contact_mobile+'</a>' 
						   }
              
                    },
                  { data: 'rent_date', name:'rent_date',
						   render: function ( data, type, row ) 
						   {
							 return 'Star Date: '+row.start_date + '<br><br> End Date:'+row.end_date 
						   }
              
                    }, { data: 'end_date', name:'end_date',
						   render: function ( data, type, row ) 
						   {
							 return 'Star Date: '+row.start_date + '<br><br> End Date:'+row.end_date 
						   }
              
                    },
                   
                  
                   
                  {data: 'rent_amount', name: 'rent_amount'},
                  {data: 'security_amount', name: 'security_amount'},
                  {data: 'action', name: 'action'},
                  
              ]
          });
        });
</script>