 @extends('layouts.app')

@section('content')
<div class="main-panel">
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Responsibility Type</h3>
              
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
                      <div class="col-md-6">
					  <form class="forms-sample" action="<?php echo url("storeResponsibility");?>" method="post">
					  <div class="form-group">@csrf
                        <label for="exampleInputUsername1">Responsibility</label>
                        <input type="text" class="form-control" id="responsibility" name="responsibility" placeholder="Enter Responsibility Type">
                        @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
	</div>
	 <div class="form-group">
		<input type="submit" Name="submit" class="btn btn-success" value="Submit">
	 </div>
	</form>
                      </div>
                      <div class="col-md-6">
                        <table class="table table-striped" id="myTable">
						<thead>
							<tr>
								<td>Sr. No.</td>
								<td>Responsibility</td>
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
              ajax: "{{ route('masters.responsibilities-list') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'responsibility', name: 'responsibility'},
                  {data: 'action', name: 'action'},
                 
              ]
          });
        });
</script>
@endsection