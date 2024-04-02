 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Property Details for Property ID <?php echo $property->property_id?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
label{
	font-weight:bold;
	margin-rigth:20px;
}</style>
<body>
 
<div class="container">
  <h2 align="center"><u>Property Details</u></h2>
  <div class="card">
    <div class="card-header"><?php echo $property->property_name;?> (<?php echo $property->property_id;?>)  </div>
    <div class="card-body">
	<div class="row">@csrf
                <div class="form-group col-md-6">
                  <label for="exampleInputUsername1">Property Name:</label>
                 <?php echo $property->property_name ?>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputUsername1">Property Type:</label>
                  <?php echo $property->propertytype;?>
                </div>
				
				<div class="form-group col-md-6" id="property_number">
                        <label for="exampleInputEmail1">Property Number:</label>
                       <?php echo $property->property_no ?>
                          
                      </div>
					  
					  
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Saleable Property Size:</label>
                 <?php echo $property->property_size ?>

                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Carpet Area:</label>
                 <?php echo $property->carpet_area ?>

                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputPassword1">Property For:</label>
                  <?php echo $property->type ?>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Basic Rent:</label>
                 <?php echo $property->price_rent; ?>

                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Security Deposit:</label>
                <?php echo $property->security_deposit; ?>

                </div>
<div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Owner Name:</label>
                        <?php echo $property->owner_name; ?>
                         
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Owner Mobile No.:</label>
                        <?php echo $property->owner_mobile_no; ?>
                         
                      </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Owner Email:</label>
                  <?php echo $property->email; ?>

                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Status:</label>
                  <?php echo $property->availability_status?>

                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Furnishing Status:</label>
				 <?php echo $property->furnishing?>
                   

                </div>

						<div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Car Parking:</label>
						 <?php echo $property->car_parking?>
                       
                         
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Facing Direction:</label>
						<?php echo $property->facing_direction?>
                       
                      </div>
					  
					   <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Maintenance Charge:</label>
                        <?php echo $property->maintenance_charge?>
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Water Availability:</label>
						 <?php echo $property->water_availability?>
                        
                         
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Status Of Electricity:</label>
						 <?php echo $property->status_of_electricity?>
                        
                       
                         
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Floor:</label>
                          <?php echo $property->floor?>
                      </div>
					  
					  <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Landmark:</label>
                         <?php echo $property->landmark?>
                      </div>
					  
					  <div class="form-group col-md-4">
                    <label for="exampleInputConfirmPassword1">Country:</label>
                          <?php echo $property->countryname?>
                    </div>
					
					 <div class="form-group col-md-4">
                    <label for="exampleInputConfirmPassword1">State:</label>
					<?php echo $property->statename?>
                         
                    </div>
					
					 <div class="form-group col-md-4">
                    <label for="exampleInputConfirmPassword1">City:</label>
                        <?php echo $property->cityname; ?>
                    </div>
<div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Address: </label>
                 <?php echo $property->address ?>
                </div>
                <div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Description:</label>
                  <?php echo $property->description ?>
                </div>
                <?php $facilitiesarray = explode(",", $property->facilities); ?>
                <div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Facilities</label>
                   <?php echo getFacilities($property->facilities);?>
                </div>
                <?php $amentiesarray = explode(",", $property->amenities); ?>
                <div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Amenities</label>
                  <?php echo getAmenities($property->amenities);?>
                </div>
                 
 
              </div></div> 
    <div class="card-footer" align="center">&copy; Ankur Srivastava</div>
  </div>
</div>

</body>
</html>
