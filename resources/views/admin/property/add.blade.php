@extends('layouts.app')

@section('content')
<div class="main-panel">
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Add Property</h3>
              <nav aria-label="breadcrumb">
               <a href="<?php echo url("property-list");?>" class="btn btn-success">View Properties</a>
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
                  <div class="card-body">
                    
                    <form class="forms-sample" action="<?php echo url("store-property");?>" method="post">
                        <div class="row">@csrf
						     <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Property Name</label>
                         <input Type="text" name="property_name" class="form-control" required placeholder="Enter Property Name">
                      </div>
					  
					  
                      <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Property Type</label>
                         <select name="property_type" class="form-control select2" required>
                            <option value="">Select</option>
							<?php foreach($type as $tp)
							{?>
                            <option value="<?php echo $tp->id?>"><?php echo $tp->property_type?></option>
                            <?php } ?>
                         </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Property Size</label>
                        <input type="text" class="form-control" id="property_size" name="property_size" placeholder="Property Size in Sq Feet" required>
                          
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Property For</label>
                         <select name="type" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Rental">Rental</option>
                            <option value="Sale">Sale</option>
                            <option value="Lease">Lease</option>
                         </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Basic Rent</label>
                        <input type="text" class="form-control" id="price_rent" name="price_rent" placeholder="Charges/ Rent" required>
                         
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Security Deposit</label>
                        <input type="text" class="form-control" id="security_deposit" name="security_deposit" placeholder="Security Deposit Amount" required>
                         
                      </div>

					<div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Owner Name</label>
                        <input type="text" class="form-control" id="owner_name" name="owner_name" placeholder="Owner Name" required>
                         
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Owner Mobile No.</label>
                        <input type="text" class="form-control" id="owner_mobile_no" name="owner_mobile_no" placeholder="Owner Mobile No" required>
                         
                      </div>
                        

                       <div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Owner Email</label>
                        <input type="text" class="form-control" id="owner_email" name="owner_email" placeholder="Owner Email Id" required>
                         
                      </div>
                     
                       <div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Availability Status</label>
                       <select name="availability_status" class="form-control" required>
                        <option value="">Select</option>
                        <option value="Available">Available</option>
                        <option value="Not Available">Not Available</option>
                       </select>
                          
                      </div>
						<div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Furnishing Status</label>
                       <select name="furnishing_status" class="form-control" required>
                        <option value="">Select</option>
                        <option value="Furnished">Furnished</option>
                        <option value="Semi Furnished">Semi Furnished</option>
                        <option value="Un Furnished">Un Furnished</option>
                       </select>
                         
                      </div>
					  
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Car Parking</label>
                       <select name="car_parking" class="form-control" required>
                        <option value="">Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                       
                       </select>
                         
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Facing Direction</label>
                       <select name="facing_direction" class="form-control" required>
                        <option value="">Select</option>
                        <option value="East">East</option>
                        <option value="West">West</option>
						<option value="North">North</option>
						<option value="South">South</option>
                       
                       </select>
                      </div>
					  
					   <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Maintenance Charge</label>
                         <input Type="text" name="maintenance_charge" class="form-control" required placeholder="Enter Maintenance Charge">
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Water Availability</label>
                         <input Type="text" name="water_availability" class="form-control" required placeholder="Enter Water Availability">
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Status Of Electricity</label>
                       <select name="status_of_electricity" class="form-control" required>
                        <option value="">Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                       
                       </select>
                         
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Floor</label>
                         <input Type="text" name="floor" class="form-control" required placeholder="Enter Floor">
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Landmark</label>
                         <input Type="text" name="landmark" class="form-control" required placeholder="Enter Landmark">
                      </div>
					  
					  <div class="form-group col-md-6">
                    <label for="exampleInputConfirmPassword1">Country</label>
                         <input type="text" name="country" class="form-control" required placeholder="Enter Country">
                    </div>
					
					 <div class="form-group col-md-6">
                    <label for="exampleInputConfirmPassword1">State</label>
                         <input type="text" name="state" class="form-control" required placeholder="Enter state">
                    </div>
					
					 <div class="form-group col-md-6">
                    <label for="exampleInputConfirmPassword1">City</label>
                         <input type="text" name="city" class="form-control" required placeholder="Enter city">
                    </div>


                      <div class="form-group col-md-12">
                    <label for="exampleInputConfirmPassword1">Address</label>
                        <textarea name="address" id="address" class="form-control" required placeholder="Enter Address"></textarea>
                    </div>
					  
 
                    <div class="form-group col-md-12">
                    <label for="exampleInputConfirmPassword1">Description</label>
                        <textarea name="description" id="description" class="form-control" required placeholder="Enter Description"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                    <label for="exampleInputConfirmPassword1">Facilities</label>
                          <select name="facilities[]" class="form-control select2" multiple required>
                            <option value="">Select</option>
							<?php foreach($facilities as $fac)
							{?>
                            <option value="<?php echo $fac->id?>"><?php echo $fac->facility?></option>
                            <?php } ?>
                         </select>
                    </div>
                    <div class="form-group col-md-12">
                    <label for="exampleInputConfirmPassword1">Amenities</label>
                          <select name="amenities[]" class="form-control select2" multiple required>
                            <option value="">Select</option>
							<?php foreach($amenities as $fac)
							{?>
                            <option value="<?php echo $fac->id?>"><?php echo $fac->amenity?></option>
                            <?php } ?>
                         </select>
                    </div>
                    <div class="form-group col-md-12">
                    <label for="exampleInputConfirmPassword1">Tenant Criteria</label>
                         <input type="text" name="tenant_criteria" class="form-control" required>
                    </div>
					
					 

                      <div class="form-group col-md-6">
                      <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                      <button type="reset" class="btn btn-light">Reset</button>
                       </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              

            </div>
          </div>
          </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
          <script>
    $(document).ready(function(){
       
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $("#country").change(function(){
            var id=$(this).val();
            
            var data = {id:id};

                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("get-states-by-country");?>',
                    data:data,
                    success: function (response) {
                       $('#state').empty().append(response);
                    }
                });
        });

        
	   

    

    })

    function getCities(id)
    {
        
            
            var data = {id:id};

                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("get-cities-by-state");?>',
                    data:data,
                    success: function (response) {
                       $('#city').empty().append(response);
                    }
                });
    }
</script>

@endsection