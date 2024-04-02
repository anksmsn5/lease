@extends('layouts.app')

@section('content')
<div class="main-panel">
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Users</h3>
              <nav aria-label="breadcrumb">
               <a href="<?php echo url("users-list");?>" class="btn btn-success">View Users</a>
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
                    
                    <form class="forms-sample" action="<?php echo url("storeStudent");?>" method="post">
                        <div class="row">@csrf
                      <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full name">
                        @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                         @error('email')
        <div class="text-danger">{{ $message }}</div>
    @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
                         @error('mobile')
        <div class="text-danger">{{ $message }}</div>
    @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputConfirmPassword1">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                         @error('password')
        <div class="text-danger">{{ $message }}</div>
    @enderror
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

@endsection