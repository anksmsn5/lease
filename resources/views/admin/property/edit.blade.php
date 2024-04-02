@extends('layouts.app')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">Edit Property</h3>
      <nav aria-label="breadcrumb">
        <a href="<?php echo url("property-list"); ?>" class="btn btn-success">View Properties</a>
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

            <form class="forms-sample" action="<?php echo url("update-property"); ?>/<?php echo $property->id; ?>" method="post">
              <div class="row">@csrf
                <div class="form-group col-md-6">
                  <label for="exampleInputUsername1">Property Name</label>
                  <input Type="text" name="property_name" class="form-control" required placeholder="Enter Property Name" value="<?php echo $property->property_name ?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputUsername1">Property Type</label>
                  <select name="property_type" class="form-control">
                    <option value="">Select</option>
                    <?php foreach ($type as $tp) { ?>
                      <option value="<?php echo $tp->id ?>" <?php if ($property->property_type == $tp->id) {
                                                              echo "selected";
                                                            } ?>><?php echo $tp->property_type ?></option>
                    <?php } ?>
                  </select>
                </div>
				
				<div class="form-group col-md-6" id="property_number" style="display:<?php if($property->property_no==''){ echo "none"; }?>">
                        <label for="exampleInputEmail1">Property Number</label>
                        <input type="text" class="form-control" id="property_no" name="property_no" placeholder="Property Number" value="<?php echo $property->property_no?>">
                          
                      </div>
					  
					  
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Saleable Property Size</label>
                  <input type="text" class="form-control" id="property_size" name="property_size" placeholder="Property Size in Sq Feet" value="<?php echo $property->property_size ?>">

                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Carpet Area</label>
                  <input type="text" class="form-control" id="carpet_area" name="carpet_area" placeholder="Carpet area Size in Sq Feet" value="<?php echo $property->carpet_area ?>">

                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputPassword1">Property For</label>
                  <select name="type" class="form-control">
                    <option value="">Select</option>
                    <option value="Rental" <?php if ($property->type == 'Rental') {
                                              echo "selected";
                                            } ?>>Rental</option>
                    <option value="Sale" <?php if ($property->type == 'Sale') {
                                            echo "selected";
                                          } ?>>Sale</option>
                    <option value="Lease" <?php if ($property->type == 'Lease') {
                                            echo "selected";
                                          } ?>>Lease</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Basic Rent</label>
                  <input type="text" class="form-control" id="price_rent" name="price_rent" value="<?php echo $property->price_rent; ?>" placeholder="Basic Rent">

                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Security Deposit</label>
                  <input type="text" class="form-control" id="security_deposit" name="security_deposit" placeholder="Security Deposit Amount" value="<?php echo $property->security_deposit; ?>">

                </div>
<div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Owner Name</label>
                        <input type="text" class="form-control" id="owner_name" name="owner_name" placeholder="Owner Name" required value="<?php echo $property->owner_name; ?>">
                         
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Owner Mobile No.</label>
                        <input type="text" class="form-control" id="owner_mobile_no" name="owner_mobile_no" placeholder="Owner Mobile No" required value="<?php echo $property->owner_mobile_no; ?>">
                         
                      </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Owner Email</label>
                  <input type="text" class="form-control" id="owner_email" name="owner_email" placeholder="Owner Email Id" value="<?php echo $property->email; ?>">

                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Status</label>
                  <select name="availability_status" class="form-control">
                    <option value="">Select</option>
                    <option value="Available" <?php if ($property->availability_status == 'Available') {
                                                echo "selected";
                                              } ?>>Available</option>
                    <option value="Not Available" <?php if ($property->availability_status == 'Not Available') {
                                                    echo "selected";
                                                  } ?>>Not Available</option>
                  </select>

                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Furnishing Status</label>
                  <select name="furnishing_status" class="form-control">
                    <option value="">Select</option>
                    <option value="Furnished" <?php if ($property->furnishing == 'Furnished') {
                                                echo "selected";
                                              } ?>>Furnished</option>
                    <option value="Semi Furnished" <?php if ($property->furnishing == 'Semi Furnished') {
                                                      echo "selected";
                                                    } ?>>Semi Furnished</option>
                    <option value="Un Furnished" <?php if ($property->furnishing == 'Un Furnished') {
                                                    echo "selected";
                                                  } ?>>Un Furnished</option>
                  </select>

                </div>

						<div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Car Parking</label>
                       <select name="car_parking" class="form-control" required>
                        <option value="">Select</option>
                        <option value="Yes" <?php if($property->car_parking=='Yes'){ echo "selected";}?>>Yes</option>
                        <option value="No" <?php if($property->car_parking=='No'){ echo "selected";}?>>No</option>
                       
                       </select>
                         
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Facing Direction</label>
                       <select name="facing_direction" class="form-control" required>
                        <option value="">Select</option>
                        <option value="East" <?php if($property->facing_direction=='East'){ echo "selected";}?>>East</option>
                        <option value="West" <?php if($property->facing_direction=='West'){ echo "selected";}?>>West</option>
						<option value="North" <?php if($property->facing_direction=='North'){ echo "selected";}?>>North</option>
						<option value="South" <?php if($property->facing_direction=='South'){ echo "selected";}?>>South</option>
                       
                       </select>
                      </div>
					  
					   <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Maintenance Charge</label>
                         <input Type="text" name="maintenance_charge" class="form-control" required placeholder="Enter Maintenance Charge" value="<?php echo $property->maintenance_charge?>">
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Water Availability</label>
                        <select name="water_availability" class="form-control" required>
                        <option value="">Select</option>
                        <option value="Yes" <?php if($property->water_availability=='Yes'){ echo "selected";}?>>Yes</option>
                        <option value="No" <?php if($property->water_availability=='No'){ echo "selected";}?>>No</option>
                       
                       </select>
                         
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Status Of Electricity</label>
                       <select name="status_of_electricity" class="form-control" required>
                        <option value="">Select</option>
                        <option value="Yes" <?php if($property->status_of_electricity=='Yes'){ echo "selected";}?>>Yes</option>
                        <option value="No" <?php if($property->status_of_electricity=='No'){ echo "selected";}?>>No</option>
                       
                       </select>
                         
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Floor</label>
                         <input Type="text" name="floor" value="<?php echo $property->floor?>" class="form-control" required placeholder="Enter Floor">
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Landmark</label>
                         <input Type="text" name="landmark" value="<?php echo $property->landmark?>" class="form-control" required placeholder="Enter Landmark">
                      </div>
					  
					  <div class="form-group col-md-4">
                    <label for="exampleInputConfirmPassword1">Country</label>
                          <select name="country" id="country" class="form-control">
							<option value="">Select</option>
							<?php foreach($countries as $cont)
							{?>
							<option value="<?php echo $cont->id?>" <?php if($property->country==$cont->id){ echo "selected";}?>><?php echo $cont->country?></option>
							<?php } ?>
							</select>
                    </div>
					
					 <div class="form-group col-md-4">
                    <label for="exampleInputConfirmPassword1">State</label>
                         <select name="state" id="state" class="form-control" onchange="getCities(this.value)">
							<option value="">Select</option>
							 <?php foreach($states as $cont)
							{?>
							<option value="<?php echo $cont->id?>" <?php if($property->state==$cont->id){ echo "selected";}?>><?php echo $cont->state?></option>
							<?php } ?>
							</select>
                    </div>
					
					 <div class="form-group col-md-4">
                    <label for="exampleInputConfirmPassword1">City</label>
                        <select name="city" id="city" class="form-control">
							<option value="">Select</option>
							 <?php foreach($cities as $cont)
							{?>
							<option value="<?php echo $cont->id?>" <?php if($property->city==$cont->id){ echo "selected";}?>><?php echo $cont->city?></option>
							<?php } ?>
							</select>
                    </div>
<div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Address</label>
                  <textarea name="address" id="address" class="form-control"><?php echo $property->address ?></textarea>
                </div>
                <div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Description</label>
                  <textarea name="description" id="description" class="form-control"><?php echo $property->description ?></textarea>
                </div>
                <?php $facilitiesarray = explode(",", $property->facilities); ?>
                <div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Facilities</label>
                  <select name="facilities[]" class="form-control select2" multiple required>
                    <option value="">Select</option>
                    <?php foreach ($facilities as $fac) { ?>
                      <option value="<?php echo $fac->id ?>" <?php if (in_array($fac->id, $facilitiesarray)) {
                                                                echo "selected";
                                                              } ?>><?php echo $fac->facility ?></option>
                    <?php } ?>
                  </select>
                </div>
                <?php $amentiesarray = explode(",", $property->amenities); ?>
                <div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Amenities</label>
                  <select name="amenities[]" class="form-control select2" multiple required>
                    <?php foreach ($amenities as $fac) { ?>
                      <option value="<?php echo $fac->id ?>" <?php if (in_array($fac->id, $amentiesarray)) {
                                                                echo "selected";
                                                              } ?>><?php echo $fac->amenity ?></option>
                    <?php } ?>
                  </select>
                </div>
                 

                







                <div class="form-group col-md-6">
                  <button type="submit" class="btn btn-primary mr-2"> Update </button>
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
  $(document).ready(function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("#country").change(function() {
      var id = $(this).val();

      var data = {
        id: id
      };

      $.ajax({
        type: 'POST',
        url: '<?php echo url("get-states-by-country"); ?>',
        data: data,
        success: function(response) {
          $('#state').empty().append(response);
        }
      });
    });






  })

  function getCities(id) {


    var data = {
      id: id
    };

    $.ajax({
      type: 'POST',
      url: '<?php echo url("get-cities-by-state"); ?>',
      data: data,
      success: function(response) {
        $('#city').empty().append(response);
      }
    });
  }
</script>

@endsection