@push('dashboard')
<script src="../assets/js/lauz/calendar.js"></script>
@endpush

<div class="col-sm-12 text-center justify-content-center align-items-center">
  <div class="spinner-border text-primary spinner-border-md text-center" style="margin-left: 30px" id="loaderCalendar"  role="status"> </div>
  <div id="cal-heatmap"></div>
</div>
<div class="d-flex justify-content-between" style="padding-left: 50px; padding-right: 50px; margin-top: 20px">
  <label class="text-white" style="font-size: 12px !important;">Bad day</label>
  <label class="text-white" style="font-size: 12px !important;">Good day</label>
</div>
<div class="col-sm-6 offset-sm-3 text-center ">

  <div id="legend"></div>
  <div class="d-flex justify-content-center gap-2 mt-2">
    <h6 class="text-primary" style="font-size: 11px">70 W</h6>
    <h6 class="text-white" style="font-size: 11px">/</h6>
    <h6 class="text-danger" style="font-size: 11px"> 30 W</h6>
    <h6 class="text-primary" style="font-size: 11px">70 %</h6>
  </div>
</div>

