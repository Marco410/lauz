@extends('layouts.user_type.auth')

@section('content')

<div class="row">
    <div class="col-sm-10">
        <h2 class="text-white">My sync Accounts</h2>
        <div class="card mb-4" style="background-color: var(--bgDark)" >
            <div class="card-body px-0 pt-0 pb-2" >
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="tableAccounts">
                  <thead>
                    <tr>
                      <th style="padding: 10px; margin-left:15px;" class="text-white text-sm font-weight-bolder">Account</th>
                      <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Broker</th>
                      <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Strategy name</th>
                      <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">initial balance</th>
                      <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Status</th>
                      <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Action</th>
                    </tr>
                  </thead>
                  <tbody>
              
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('accounts')
<script src="../assets/js/lauz/accounts/accounts.js"></script>

@endpush
