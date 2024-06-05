<div class="row p-4 m-4">
  <div class="col-sm-12">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="d-grid gap-2">
      <button id="btn-create-note" class="btn btn-primary" type="button"> <i class="fas fa-plus" ></i> </button>
    </div>
  </div>

  <div class="col-sm-12 mb-4" >
    <div id="editor" >
    </div>
  </div>

  <div class="col-sm-12 mt-4">
    <div class="row text-center mt-4">
      <h3 class="text-white">My Notes</h3>
      <div class="col-sm-8 offset-2" id="notes-view">
      </div>
    </div>
  </div>
  
</div>


@push('dashboard_chart_bar')
<script src="../assets/js/lauz/tabs/notes.js"></script>
@endpush