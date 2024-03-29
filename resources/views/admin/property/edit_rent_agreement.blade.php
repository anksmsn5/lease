 @extends('layouts.app')

 @section('content')
 <div class="main-panel">
   <div class="content-wrapper">
     <div class="page-header">
       <h3 class="page-title">Edit Rent Agreement</h3>
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

             <form class="forms-sample" action="<?php echo url("update-agreement"); ?>" method="post" enctype="multipart/form-data">
               <div class="row">@csrf
                 <div class="form-group col-md-6">
                   <label for="exampleInputUsername1">Property Type</label>
                   <select name="property_type" id="property_type" class="form-control select2" required>
                     <option value="">Select</option>
                     <?php foreach ($type as $tp) { ?>
                       <option value="<?php echo $tp->id ?>" <?php if ($agreement->property_type == $tp->id) {
                                                                echo "selected";
                                                              } ?>><?php echo $tp->property_type ?></option>
                     <?php } ?>
                   </select>
                 </div>
                 <div class="form-group col-md-6">
                   <label for="exampleInputEmail1">Select Property</label>
                   <select name="property" id="property" class="form-control  select2" onchange="getPropertyData(this.value)">
                     <option value="">Select</option>
                     <?php foreach ($properties as $prop) { ?>
                       <option value="<?php echo $prop->id; ?>" <?php if ($prop->id == $property->id) {
                                                                  echo "selected";
                                                                } ?>>(<?php echo $prop->property_id; ?>) <?php echo $prop->property_name; ?>, <?php echo $prop->address; ?></option>
                     <?php } ?>
                   </select>

                 </div>
                 <div class="form-group col-md-12" id="propertydata">
                   <?php echo $html = '
        <table class="table">
            <tr>
                <td><b>Property Id :</b> ' . $property->property_id . '</td>
                <td><b>Property Type :</b> ' . $property->ptype . '</td>
                <td><b>Saleable Area :</b> ' . $property->property_size . '</td>
                <td><b>Carpet Area :</b> ' . $property->carpet_area . '</td>
            </tr>

             <tr>
                <td><b>Address :</b> ' . $property->address . '</td>
                <td><b>City :</b>' . $property->cityname . '</td>
                <td><b>State :</b> ' . $property->statename . '</td>
                <td><b>Country :</b> ' . $property->countryname . '</td>
            </tr>

             <tr>
                <td><b>Property For  :</b> ' . $property->type . '</td>
                <td><b>Owner Name  :</b> ' . $property->owner_name . '</td>
                <td><b>Owner Email  :</b> ' . $property->owner_email . '</td>
                <td><b>Owner Phone  :</b> ' . $property->owner_mobile_no . '</td>
                
            </tr>
            <tr>
                <td><b>Basic Rent  :</b> ' . $property->price_rent . '</td>
                <td><b>Furnishing Status  :</b> ' . $property->furnishing . '</td>
                <td><b>Security Deposit  :</b> ' . $property->security_deposit . '</td>
                <td></td>
                
            </tr>
            <tr>
                <td colspan="4"><a href="">Read More....</a></td>
            </tr>
        </table>
        '; ?>
                 </div>

                 <div class="form-group col-md-12">
                   <h4>Tenant Information</h4>
                 </div>


                 <div class="form-group col-md-4">
                   <label for="exampleInputConfirmPassword1">Tenant Name</label>
                   <input type="text" class="form-control" id="tenant_name" name="tenant_name" placeholder="Name of Tenant" required value="<?php echo $tenant->tenant_name; ?>">
                   <input type="hidden" class="form-control" id="tenant_id" name="tenant_id" placeholder="Name of Tenant" required value="<?php echo $tenant->id; ?>">
                   <input type="hidden" class="form-control" id="id" name="id" placeholder="Name of Tenant" required value="<?php echo $agreement->id; ?>">

                 </div>
                 <div class="form-group col-md-4">
                   <label for="exampleInputConfirmPassword1">Tenant Email</label>
                   <input type="text" class="form-control" id="tenant_email" name="tenant_email" placeholder="Tenant Email" required value="<?php echo $tenant->tenant_email; ?>">

                 </div>

                 <div class="form-group col-md-4">
                   <label for="exampleInputConfirmPassword1">Tenant Mobile</label>
                   <input type="text" class="form-control" id="tenant_mobile" name="tenant_mobile" placeholder="Tenant Mobile" required value="<?php echo $tenant->tenant_mobile; ?>">

                 </div>
                 <div class="form-group col-md-4">
                   <label for="exampleInputConfirmPassword1">Country</label>
                   <select name="country" id="country" class="form-control" required>
                     <option value="">Select</option>
                     <?php foreach ($countries as $cont) { ?>
                       <option value="<?php echo $cont->id ?>" <?php if ($tenant->country == $cont->id) {
                                                                  echo "selected";
                                                                } ?>><?php echo $cont->country ?></option>
                     <?php } ?>
                   </select>
                 </div>

                 <div class="form-group col-md-4">
                   <label for="exampleInputConfirmPassword1">State</label>
                   <select name="state" id="state" class="form-control" onchange="getCities(this.value)" required>
                     <option value="">Select</option>
                     <?php foreach ($states as $cont) { ?>
                       <option value="<?php echo $cont->id ?>" <?php if ($tenant->state == $cont->id) {
                                                                  echo "selected";
                                                                } ?>><?php echo $cont->state ?></option>
                     <?php } ?>
                   </select>
                 </div>

                 <div class="form-group col-md-4">
                   <label for="exampleInputConfirmPassword1">City</label>
                   <select name="city" id="city" class="form-control" required>
                     <option value="">Select</option>
                     <?php foreach ($cities as $cont) { ?>
                       <option value="<?php echo $cont->id ?>" <?php if ($tenant->city == $cont->id) {
                                                                  echo "selected";
                                                                } ?>><?php echo $cont->city ?></option>
                     <?php } ?>
                   </select>
                 </div>

                 <div class="form-group col-md-12">
                   <label for="exampleInputConfirmPassword1">Address of Tenant</label>
                   <textarea name="address" id="address" class="form-control" required><?php echo $tenant->address ?></textarea>
                 </div>

                 <div class="form-group col-md-3">
                   <label for="exampleInputConfirmPassword1">PAN No</label>
                   <input name="pan" type="text" id="pan" class="form-control" required value="<?php echo $tenant->pan ?>">
                 </div>
                 <div class="form-group col-md-3">
                   <label for="exampleInputConfirmPassword1">AAdhar No</label>
                   <input name="aadhar" type="text" id="aadhar" class="form-control" required value="<?php echo $tenant->aadhar ?>">
                 </div>
                 <div class="form-group col-md-3">
                   <label for="exampleInputConfirmPassword1">TDS No</label>
                   <input name="tds" type="text" id="tds" class="form-control" required value="<?php echo $tenant->tds_no ?>">
                 </div>
                 <div class="form-group col-md-3">
                   <label for="exampleInputConfirmPassword1">GST No</label>
                   <input name="gst_no" type="text" id="gst_no" class="form-control" required value="<?php echo $tenant->gstno ?>">
                 </div>

                 <div class="form-group col-md-12">
                   <label for="exampleInputConfirmPassword1">Rental Terms</label>
                   <textarea name="rental_terms" id="rental_terms" class="form-control" required><?php echo $agreement->rental_terms ?></textarea>
                 </div>

                 <div class="form-group col-md-4">
                   <label for="exampleInputConfirmPassword1">Rent Start Date</label>
                   <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Owner Email Id" required onchange="monthDiff();" value="<?php echo $agreement->start_date ?>">

                 </div>

                 <div class="form-group col-md-4">
                   <label for="exampleInputConfirmPassword1">Rent End Date</label>
                   <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Owner Email Id" required onchange="monthDiff();" value="<?php echo $agreement->end_date ?>">

                 </div>
                 <div class="form-group col-md-4">
                   <label for="exampleInputConfirmPassword1">Agreement Tenure</label>
                   <input type="text" class="form-control" id="rent_duration" name="rent_duration" placeholder="Rent Duration" required value="<?php echo $agreement->agreement_tenure ?>">

                 </div>
                 <div class="form-group col-md-4">
                   <label for="exampleInputConfirmPassword1">Basic Rent</label>
                   <input type="text" class="form-control" id="rent_amount" name="rent_amount" placeholder="Rent Amount" required value="<?php echo $agreement->rent_amount ?>">

                 </div>
                 <div class="form-group col-md-4">
                   <label for="exampleInputConfirmPassword1">Maintenance Amount</label>
                   <input type="text" class="form-control" id="maintenance_amount" name="maintenance_amount" placeholder="" required value="<?php echo $agreement->maintenance_amount ?>">

                 </div>
                 <div class="form-group col-md-4">
                   <label for="exampleInputConfirmPassword1">Security Deposit</label>
                   <input type="text" class="form-control" id="security_amount" name="security_amount" placeholder="Security Amount" required value="<?php echo $agreement->security_amount ?>">

                 </div>

                 <div class="form-group col-md-3">
                   <label for="exampleInputConfirmPassword1">Fit Out Period (Days)</label>
                   <select name="fit_out" class="form-control">
                     <option value="">Select</option>
                     <option value="30" <?php if ($agreement->fit_out == '30') {
                                          echo "selected";
                                        } ?>>30</option>
                     <option value="45" <?php if ($agreement->fit_out == '45') {
                                          echo "selected";
                                        } ?>>45</option>
                     <option value="60" <?php if ($agreement->fit_out == '60') {
                                          echo "selected";
                                        } ?>>60</option>
                     <option value="90" <?php if ($agreement->fit_out == '90') {
                                          echo "selected";
                                        } ?>>90</option>
                   </select>

                 </div>
                 <div class="form-group col-md-3">
                   <label>Escalation Tenure (Months)</label>
                   <input type="text" name="escalation_tenure" class="form-control" value="<?php echo $agreement->escalation_tenure ?>">
                 </div>
                 <div class="form-group col-md-3">
                   <label for="exampleInputConfirmPassword1">Escalation (%)</label>
                   <select name="escalation" class="form-control">
                     <option value="">Select</option>
                     <option value="5" <?php if ($agreement->escalation == '5') {
                                          echo "selected";
                                        } ?>>5</option>
                     <option value="7.5" <?php if ($agreement->escalation == '7.5') {
                                            echo "selected";
                                          } ?>>7.5</option>
                     <option value="10" <?php if ($agreement->escalation == '10') {
                                          echo "selected";
                                        } ?>>10</option>

                   </select>

                 </div>

                 <div class="form-group col-md-3">
                   <label for="exampleInputConfirmPassword1">LockIn Period ( Months )</label>
                   <input type="text" class="form-control" id="lockin" name="lockin" placeholder="Lock In Period" required value="<?php echo $agreement->lockin; ?>">

                 </div>
                 <div class="form-group col-md-3">
                   <label for="exampleInputConfirmPassword1">GST (%)</label>
                   <input type="text" class="form-control" id="gst" name="gst" placeholder="GST" value="<?php echo $agreement->gst; ?>" required>

                 </div>
                 <div class="form-group col-md-3">
                   <label for="exampleInputConfirmPassword1">Notice Period ( Days)</label>
                   <input type="text" class="form-control" id="notice_period" name="notice_period" placeholder="Notice Period ( Days)" value="<?php echo $agreement->notice_period; ?>" required>

                 </div>
                 <div class="form-group col-md-3">
                   <label for="exampleInputConfirmPassword1">Agreement Start Date</label>
                   <input type="date" class="form-control" id="agreement_start" name="agreement_start" placeholder="Notice Period ( Days)" value="<?php echo $agreement->agreement_start; ?>" required>

                 </div>
                 <div class="form-group col-md-3">
                   <label for="exampleInputConfirmPassword1">Agreement End Date</label>
                   <input type="date" class="form-control" id="agreement_end" name="agreement_end" placeholder="Notice Period ( Days)" value="<?php echo $agreement->agreement_end; ?>" required>

                 </div>


                 <div class="form-group col-md-12">
                   <label for="exampleInputConfirmPassword1">Security Return Terms & Conditions</label>
                   <textarea name="security_return_terms" class="form-control"><?php echo $agreement->security_return_terms; ?></textarea>

                 </div>




                 <?php $tenant_responsibility = explode(", ", $agreement->tenant_responsibility); ?>
                 <div class="form-group col-md-12">
                   <label for="exampleInputConfirmPassword1">Tenant's Responsibility</label>

                   <select name="tenant_responsibility[]" class="form-control select2" required multiple>
                     <?php foreach ($responsibilities as $res) { ?>
                       <option value="<?php echo $res->responsibility ?>" <?php if (in_array($res->responsibility, $tenant_responsibility)) {
                                                                            echo "selected";
                                                                          } ?>><?php echo $res->responsibility ?></option>
                     <?php } ?>
                   </select>
                 </div>

                 <?php $owner_responsibility = explode(", ", $agreement->owner_responsibility); ?>

                 <div class="form-group col-md-12">
                   <label for="exampleInputConfirmPassword1">Owner's Responsibility</label>

                   <select name="owner_responsibility[]" class="form-control select2" required multiple>
                     <?php foreach ($responsibilities as $res) { ?>
                       <option value="<?php echo $res->responsibility ?>" <?php if (in_array($res->responsibility, $owner_responsibility)) {
                                                                            echo "selected";
                                                                          } ?>><?php echo $res->responsibility ?></option>
                     <?php } ?>
                   </select>
                 </div>

                 <div class="form-group col-md-12">
                   <label for="exampleInputConfirmPassword1">Rent Agreement Termination Clause</label>
                   <textarea name="termination_clause" class="form-control"><?php echo $agreement->termination_clause ?></textarea>

                 </div>

                 <div class="form-group col-md-4">
                   <label for="exampleInputConfirmPassword1">Owner's Signature</label>
                   <input type="file" class="form-control" id="ownersign" name="ownersign" placeholder="Owner Email Id">
                   <img src="<?php echo url("uploads"); ?>/<?php echo $agreement->ownersign ?>" width="150" height="150">
                 </div>
                 <div class="form-group col-md-4">
                   <label for="exampleInputConfirmPassword1">Tenant's Signature</label>
                   <input type="file" class="form-control" id="tenantsign" name="tenantsign" placeholder="Owner Email Id">
                   <img src="<?php echo url("uploads"); ?>/<?php echo $agreement->tenantsign ?>" width="150" height="150">
                 </div>
                 <div class="form-group col-md-4">
                   <label for="exampleInputConfirmPassword1">Date of Agreement</label>
                   <input type="date" class="form-control" id="date" name="date" placeholder="Owner Email Id" required value="<?php echo $agreement->date; ?>">

                 </div>


                 <div class="form-group col-md-12">
                   <h4>Point Of Contact</h4>
                 </div>

                 <div class="form-group col-md-6">
                   <label for="exampleInputConfirmPassword1">Name</label>
                   <input name="contact_name" type="text" class="form-control" value="<?php echo $agreement->contact_name; ?>">

                 </div>

                 <div class="form-group col-md-6">
                   <label for="exampleInputConfirmPassword1">Email</label>
                   <input name="contact_email" type="email" class="form-control" value="<?php echo $agreement->contact_email; ?>">

                 </div>

                 <div class="form-group col-md-6">
                   <label for="exampleInputConfirmPassword1">Number</label>
                   <input name="contact_mobile" type="text" class="form-control" value="<?php echo $agreement->contact_mobile; ?>">

                 </div>

                 <div class="form-group col-md-6">
                   <label for="exampleInputConfirmPassword1">Stamp Duty Paid</label>

                   <select name="stamp_duty_paid" class="form-control">
                     <option value="">Select</option>
                     <option value="Yes" <?php if ($agreement->stamp_duty_paid == 'Yes') {
                                            echo "selected";
                                          } ?>>Yes</option>
                     <option value="No" <?php if ($agreement->stamp_duty_paid == 'No') {
                                          echo "selected";
                                        } ?>>No</option>

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

     document.getElementById("rent_duration").value = Math.abs(Math.round(diff) - 1);

   }
 </script>

 @endsection