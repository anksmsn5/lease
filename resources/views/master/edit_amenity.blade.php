@extends('layouts.app')

@section('content')
<div class="main-panel">
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Amenities</h3>
              
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
					  <form class="forms-sample" action="<?php echo url("updateAmenity");?>" method="post">
					  <div class="form-group">@csrf
                        <label for="exampleInputUsername1">Amenity</label>
                        <input type="text" class="form-control" id="amenity" name="amenity" value="<?php echo $amenity->amenity;?>" placeholder="Enter Amenity">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $amenity->id;?>" placeholder="Enter Amenity">
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