 @extends('layouts.app')

@section('content')
<div class="main-panel">
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Property Type</h3>
              
            </div>
            <?php if(session('success'))
            {?>
             <div class="alert alert-success">
  <strong>Success!</strong> <?php echo session('success');?>
</div><?php } ?>
            <div class="row">
                
            
              <div class="col-md-12 grid-margin stretch-card">
                  
                <div class="card">
                  <div class="card-body">
                    
                    
                        <div class="row">
                      <div class="col-md-4">
					  <form class="forms-sample" action="<?php echo url("storePropertyType");?>" method="post">
					  <div class="form-group">@csrf
                        <label for="exampleInputUsername1">Property Type</label>
                        <input type="text" class="form-control" id="property_type" name="property_type" placeholder="Enter Property Type">
                        @error('property_type')
        <div class="text-danger">{{ $message }}</div>
    @enderror
	</div>
		  <div class="form-group"> 
                        <label for="exampleInputUsername1">Property Number</label><br>
                        <label class="radio-inline">
      <input type="radio" name="property_no" checked value="No"> No
    </label>
    <label class="radio-inline">
      <input type="radio" name="property_no" value="Yes"> Yes
    </label>
    
                        @error('property_no')
        <div class="text-danger">{{ $message }}</div>
    @enderror
	</div>
	 <div class="form-group">
		<input type="submit" Name="submit" class="btn btn-success" value="Submit">
	 </div>
	</form>
                      </div>
                      <div class="col-md-8">
                        <table class="table table-striped" id="myTable">
						<thead>
							<tr>
								<td>Sr. No.</td>
								<td>Property Type</td>
								<td>Property No</td>
								<td>Action</td>
							</tr>
							</thead>
						</table>
                      </div>
                     
                    </div>
                    
                  </div>
                </div>
              </div>
              

            </div>
          </div>
          </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script type="text/javascript">
    $(function () {
          var table = $('#myTable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('masters.propertype-list') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'property_type', name: 'property_type'},
                  {data: 'property_no', name: 'property_no'},
                  {data: 'action', name: 'action'},
                 
              ]
          });
        });
</script>
@endsection