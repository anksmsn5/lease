@extends('layouts.app')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">Rent Agreement</h3>
      <nav aria-label="breadcrumb">
        <a href="<?php echo url("rent-agreement-list"); ?>" class="btn btn-success">Rent Agreement List</a>
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

            <form class="forms-sample" action="<?php echo url("store-agreement"); ?>" method="post" enctype="multipart/form-data">
              <div class="row">@csrf
                <div class="form-group col-md-6">
                  <label for="exampleInputUsername1">Property Type</label>
                  <select name="property_type" id="property_type" class="form-control select2" required>
                    <option value="">Select</option>
                    <?php foreach ($type as $tp) { ?>
                      <option value="<?php echo $tp->id ?>"><?php echo $tp->property_type ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Select Property</label>
                  <select name="property" id="property" class="form-control  select2" onchange="getPropertyData(this.value)">
                    <option value="">Select</option>
                  </select>

                </div>
                <div class="form-group col-md-12" id="propertydata">
                </div>

                <div class="form-group col-md-12">
                  <h4>Tenant Information</h4>
                </div>


                <div class="form-group col-md-4">
                  <label for="exampleInputConfirmPassword1">Tenant Name</label>
                  <input type="text" class="form-control" id="tenant_name" name="tenant_name" placeholder="Name of Tenant" required>

                </div>
                <div class="form-group col-md-4">
                  <label for="exampleInputConfirmPassword1">Tenant Email</label>
                  <input type="text" class="form-control" id="tenant_email" name="tenant_email" placeholder="Tenant Email" required>

                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputConfirmPassword1">Tenant Mobile</label>
                  <input type="text" class="form-control" id="tenant_mobile" name="tenant_mobile" placeholder="Tenant Mobile" required>

                </div>
                <div class="form-group col-md-4">
                  <label for="exampleInputConfirmPassword1">Country</label>
                  <select name="country" id="country" class="form-control" required>
                    <option value="">Select</option>
                    <?php foreach ($countries as $cont) { ?>
                      <option value="<?php echo $cont->id ?>"><?php echo $cont->country ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputConfirmPassword1">State</label>
                  <select name="state" id="state" class="form-control" onchange="getCities(this.value)" required>
                    <option value="">Select</option>

                  </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputConfirmPassword1">City</label>
                  <select name="city" id="city" class="form-control" required>
                    <option value="">Select</option>

                  </select>
                </div>

                <div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Address of Tenant</label>
                  <textarea name="address" id="address" class="form-control" required></textarea>
                </div>

                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">PAN No</label>
                  <input name="pan" type="text" id="pan" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">AAdhar No</label>
                  <input name="aadhar" type="text" id="aadhar" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">TDS No</label>
                  <input name="tds" type="text" id="tds" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">GST No</label>
                  <input name="gst_no" type="text" id="gst_no" class="form-control" required>
                </div>

                <div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Rental Terms</label>
                  <textarea name="rental_terms" id="rental_terms" class="form-control" required></textarea>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputConfirmPassword1">Rent Start Date</label>
                  <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Owner Email Id" required onchange="monthDiff();">

                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputConfirmPassword1">Rent End Date</label>
                  <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Owner Email Id" required onchange="monthDiff();">

                </div>
                <div class="form-group col-md-4">
                  <label for="exampleInputConfirmPassword1">Agreement Tenure</label>
                  <input type="text" class="form-control" id="rent_duration" name="rent_duration" placeholder="Rent Duration" required>

                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">Basic Rent</label>
                  <input type="text" class="form-control" id="rent_amount" name="rent_amount" placeholder="Rent Amount" required>

                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">Maintenance Amount</label>
                  <input type="text" class="form-control" id="maintenance_amount" name="maintenance_amount" placeholder="" required>

                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">Security Deposit</label>
                  <input type="text" class="form-control" id="security_amount" name="security_amount" placeholder="Security Amount" required>

                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">TDS Applicable(%)</label>
                  <input type="text" class="form-control" id="tds_perc" name="tds_perc" placeholder="TDS %" required>

                </div>

                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">Fit Out Period (Days)</label>
                  <select name="fit_out" class="form-control">
                    <option value="">Select</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                    <option value="60">60</option>
                    <option value="90">90</option>
                  </select>

                </div>
                <div class="form-group col-md-3">
                  <label>Escalation Tenure (Months)</label>
                  <input type="text" name="escalation_tenure" class="form-control" value="0">
                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">Escalation (%)</label>
                  <select name="escalation" class="form-control">
                    <option value="">Select</option>
                    <option value="0">0</option>
                    <option value="5">5</option>
                    <option value="7.5">7.5</option>
                    <option value="10">10</option>

                  </select>

                </div>

                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">LockIn Period ( Months )</label>
                  <input type="text" class="form-control" id="lockin" name="lockin" placeholder="Lock In Period" required>

                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">GST (%)</label>
                  <input type="text" class="form-control" id="gst" name="gst" placeholder="GST" value="18" required>

                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">Notice Period ( Days)</label>
                  <input type="text" class="form-control" id="notice_period" name="notice_period" placeholder="Notice Period ( Days)" required>

                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">Agreement Start Date</label>
                  <input type="date" class="form-control" id="agreement_start" name="agreement_start" placeholder="Notice Period ( Days)" required>

                </div>
                <div class="form-group col-md-3">
                  <label for="exampleInputConfirmPassword1">Agreement End Date</label>
                  <input type="date" class="form-control" id="agreement_end" name="agreement_end" placeholder="Notice Period ( Days)" required>

                </div>


                <div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Security Return Terms & Conditions</label>
                  <textarea name="security_return_terms" class="form-control"></textarea>

                </div>





                <div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Tenant's Responsibility</label>

                  <select name="tenant_responsibility[]" class="form-control select2" required multiple>
                    <?php foreach ($responsibilities as $res) { ?>
                      <option value="<?php echo $res->responsibility ?>"><?php echo $res->responsibility ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Owner's Responsibility</label>

                  <select name="owner_responsibility[]" class="form-control select2" required multiple>
                    <?php foreach ($responsibilities as $res) { ?>
                      <option value="<?php echo $res->responsibility ?>"><?php echo $res->responsibility ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group col-md-12">
                  <label for="exampleInputConfirmPassword1">Rent Agreement Termination Clause</label>
                  <textarea name="termination_clause" class="form-control"></textarea>

                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputConfirmPassword1">Owner's Signature</label>
                  <input type="file" class="form-control" id="ownersign" name="ownersign" placeholder="Owner Email Id" required>

                </div>
                <div class="form-group col-md-4">
                  <label for="exampleInputConfirmPassword1">Tenant's Signature</label>
                  <input type="file" class="form-control" id="tenantsign" name="tenantsign" placeholder="Owner Email Id" required>

                </div>
                <div class="form-group col-md-4">
                  <label for="exampleInputConfirmPassword1">Date of Agreement</label>
                  <input type="date" class="form-control" id="date" name="date" placeholder="Owner Email Id" required>

                </div>


                <div class="form-group col-md-12">
                  <h4>Point Of Contact</h4>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Name</label>
                  <input name="contact_name" type="text" class="form-control">

                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Email</label>
                  <input name="contact_email" type="email" class="form-control">

                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Number</label>
                  <input name="contact_mobile" type="text" class="form-control">

                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputConfirmPassword1">Stamp Duty Paid</label>

                  <select name="stamp_duty_paid" class="form-control">
                    <option value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>

                  </select>
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
    $("#property_type").change(function() {
      var id = $(this).val();

      var data = {
        id: id
      };

      $.ajax({
        type: 'POST',
        url: '<?php echo url("get-properties-by-property-type"); ?>',
        data: data,
        success: function(response) {
          $('#property').empty().append(response);
        }
      });
    });






  })

  function getPropertyData(id) {


    var data = {
      id: id
    };
    if (id == '') {
      $('#propertydata').html('');
    }
    $.ajax({
      type: 'POST',
      url: '<?php echo url("get-property-data"); ?>',
      data: data,
      success: function(response) {
        $('#propertydata').html(response);
      }
    });
  }

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

  function monthDiff() {
    var date1 = new Date($('#start_date').val());
    var date2 = new Date($('#end_date').val());
    diff_months(date2, date1);
  }

  function diff_months(dt2, dt1) {
    // Calculate the difference in milliseconds between the two dates.
    var diff = (dt2.getTime() - dt1.getTime()) / 1000;
    // Convert the difference from milliseconds to months by dividing it by the number of milliseconds in an hour, a day, a week, and approximately 4 weeks in a month.
    diff /= (60 * 60 * 24 * 7 * 4);
    // Round the result to the nearest integer using Math.round().

    document.getElementById("rent_duration").value = Math.abs(Math.round(diff));

  }
</script>

@endsection