@extends('layouts.app')

@section('content')
<div class="main-panel">
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Facilities</h3>
              
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
					  <form class="forms-sample" action="<?php echo url("updateFacility");?>" method="post">
					  <div class="form-group">@csrf
                        <label for="exampleInputUsername1">Facility</label>
                        <input type="text" class="form-control" id="facility" name="facility" value="<?php echo $facility->facility;?>" placeholder="Enter Facility">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $facility->id;?>" placeholder="Enter Facility">
                        @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
	</div>
	 <div class="form-group">
		<input type="submit" Name="submit" class="btn btn-success" value="Update">
	 </div>
	</form>
                      </div>
                      
                     
                    </div>
                    
                  </div>
                </div>
              </div>
              
             
               
             
             
             
             
            
              
               
            </div>
          </div>
          </div>

@endsection