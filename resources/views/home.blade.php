@extends('layouts.app')

@section('content')
<div class="main-panel">

  <div class="content-wrapper pb-0">
    <div class="page-header flex-wrap">
      <h3 class="mb-0"> Hi, <?php echo Auth::user()->name; ?>
      </h3>

    </div>
    <div class="row">
      <div class="col-xl-3 col-lg-12 stretch-card grid-margin">
        <div class="row">
          <div class="col-xl-12 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
            <div class="card bg-warning">
              <div class="card-body px-3 py-4">
                <div class="d-flex justify-content-between align-items-start">
                  <div class="color-card">
                    <p class="mb-0 color-card-head">Properties</p>
                    <h2 class="text-white"><?php echo $properties; ?>
                    </h2>
                  </div>

                </div>

              </div>
            </div>
          </div>
          <div class="col-xl-12 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
            <div class="card bg-danger">
              <div class="card-body px-3 py-4">
                <div class="d-flex justify-content-between align-items-start">
                  <div class="color-card">
                    <p class="mb-0 color-card-head">Due Rent</p>
                    <h2 class="text-white"> <?php echo $duerent ?>
                    </h2>
                  </div>

                </div>

              </div>
            </div>
          </div>
          <div class="col-xl-12 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
            <div class="card bg-primary">
              <div class="card-body px-3 py-4">
                <div class="d-flex justify-content-between align-items-start">
                  <div class="color-card">
                    <p class="mb-0 color-card-head">Collected Rent</p>
                    <h2 class="text-white"><?php echo $rent; ?>
                    </h2>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="col-xl-12 col-md-6 stretch-card pb-sm-3 pb-lg-0">
            <div class="card bg-success">
              <div class="card-body px-3 py-4">
                <div class="d-flex justify-content-between align-items-start">
                  <div class="color-card">
                    <p class="mb-0 color-card-head">Agreements Generated</p>
                    <h2 class="text-white"><?php echo $agreements ?></h2>
                  </div>

                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-9 stretch-card grid-margin">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-7">
                <h5>Collection Stats</h5>

              </div>

            </div>

            <div class="row my-3">
              <div class="col-sm-12">
                <div class="flot-chart-wrapper">
                  <div id="flotChart" class="flot-chart">
                    <canvas class="flot-base"></canvas>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>





  </div>
</div>

@endsection