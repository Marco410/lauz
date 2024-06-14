@push('dashboard')
<script src="../assets/js/lauz/calendar.js"></script>
@endpush

<div class="col-sm-12 text-center justify-content-center align-items-center">
  <div id="calendarLoader"></div>
  <div id="cal-heatmap"></div>
</div>
<div class="d-flex justify-content-between" style="padding-left: 50px; padding-right: 50px; margin-top: 20px">
  <label class="text-white" style="font-size: 12px !important;">Bad day</label>
  <label class="text-white" style="font-size: 12px !important;">Good day</label>
</div>
<div class="col-sm-6 offset-sm-3 text-center ">
  <div class="progress"  style="background-color: transparent;">
    <div class="progress-bar bg-primary" role="progressbar" id="progressDays" style="width: 0%; border-radius: 10px 0px 0px 10px; !important" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    <div class="progress-bar bg-white" role="progressbar" id="progressDays2" style="width: 100%; border-radius: 0px 10px 10px 0px; !important" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div id="legend"></div>
  <div class="d-flex justify-content-center gap-2 mt-2">
    <h6 class="text-primary" style="font-size: 11px" id="daysWin">- W</h6>
    <h6 class="text-white" style="font-size: 11px">/</h6>
    <h6 class="text-danger" style="font-size: 11px" id="daysLoss">- L</h6>
    <h6 class="text-primary" style="font-size: 11px" id="percentajeDays">- %</h6>
  </div>
</div>

