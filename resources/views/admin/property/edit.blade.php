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
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Property Size</label>
                  <input type="text" class="form-control" id="property_size" name="property_size" placeholder="Property Size in Sq Feet" value="<?php echo $property->property_size ?>">

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
                  <label for="exampleInputConfirmPassword1">Charges/Rent</label>
                  <input type="text" class="form-control" id="price_rent" name="price_rent" value="<?php echo $property->price_rent; ?>" placeholder="Charges/ Rent">

                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Security Deposit ( if Any )</label>
                  <input type="text" class="form-control" id="security_deposit" name="security_deposit" placeholder="Security Deposit Amount" value="<?php echo $property->security_deposit; ?>">

                </div>


                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Owner Email</label>
                  <input type="text" class="form-control" id="owner_email" name="owner_email" placeholder="Owner Email Id" value="<?php echo $property->email; ?>">

                </div>

                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">Availability Status</label>
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
                <div class="form-group col-md-3">
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
                <div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Tenant Criteria Added</label>
                  <input type="text" name="tenant_criteria" class="form-control" value="<?php echo $property->tenant_criteria ?>">
                </div>

                <div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Address</label>
                  <textarea name="address" id="address" class="form-control"><?php echo $property->address ?></textarea>
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