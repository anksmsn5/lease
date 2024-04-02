  @extends('layouts.app')

@section('content')
<div class="main-panel">
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Edit Property Type</h3>
              
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
					  <form class="forms-sample" action="<?php echo url("updatePropertyType");?>" method="post">
					  <div class="form-group">@csrf
                        <label for="exampleInputUsername1">Edit Property Type</label>
                        <input type="text" class="form-control" id="property_type" name="property_type" placeholder="Enter Property Type" value="<?php echo $propertytype->property_type?>">
                        @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
	</div>
		  <div class="form-group"> 
                        <label for="exampleInputUsername1">Property Number ( if any )</label>
                        <label for="exampleInputUsername1">Property Number</label><br>
                        <label class="radio-inline">
      <input type="radio" name="property_no" checked value="No" <?php if($propertytype->property_no=='No'){ echo "checked";}?>> No
    </label>
    <label class="radio-inline">
      <input type="radio" name="property_no" value="Yes" <?php if($propertytype->property_no=='Yes'){ echo "checked";}?>> Yes
    </label>
                        <input type="hidden" class="form-control" id="id" name="id" placeholder="Enter Property Type" value="<?php echo $propertytype->id?>">
                        @error('property_no')
        <div class="text-danger">{{ $message }}</div>
    @enderror
	</div>
	 <div class="form-group">
		<input type="submit" Name="submit" class="btn btn-success" value="Submit">
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