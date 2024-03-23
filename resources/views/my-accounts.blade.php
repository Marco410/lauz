@extends('layouts.user_type.auth')

@section('content')

<div class="row">
    <div class="col-sm-10">
        <h2 class="text-white">My sync Accounts</h2>
        <div class="card mb-4" style="background-color: var(--bgDark)" >
            <div class="card-body px-0 pt-0 pb-2" >
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                        <th  style="padding: 10px;" class="text-white text-xs font-weight-bolder"></th>
                      <th style="padding: 10px;" class="text-white text-xs font-weight-bolder">Account</th>
                      <th style="padding: 10px;" class="text-white text-xs font-weight-bolder">Broker</th>
                      <th style="padding: 10px;" class="text-white text-xs font-weight-bolder">Strategy name</th>
                      <th style="padding: 10px;" class="text-white text-xs font-weight-bolder">initial balance</th>
                      <th style="padding: 10px;" class="text-white text-xs font-weight-bolder">Status</th>
                      <th style="padding: 10px;" class="text-white text-xs font-weight-bolder">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td></td>
                      <td><small class="text-xxs" style="color: var(--textGray);">254565</small></td>
                      <td><small class="text-xxs" style="color: var(--textGray);">Uprofit</small></td>
                      <td><small class="text-xxs" style="color: var(--textGray);">+$HiLoTime</small></td>
                      <td><small class="text-xxs" style="color: var(--textGray);">2000</small></td>
                      <td><small class="text-xxs" style="color: var(--textGray);">Conected</small></td>
                      <td>
                        <button class="btn btn-warning btn-sm"  style="padding: 6px 18px; font-size: 11px !important;" >Edit</button>
                        <button class="btn btn-danger btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Delete</button>
                        <button class="btn btn-info btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Reset</button>
                      </td>
                    </tr>
                    <tr>
                        <td></td>
                      <td><small class="text-xxs" style="color: var(--textGray);">254565</small></td>
                      <td><small class="text-xxs" style="color: var(--textGray);">Uprofit</small></td>
                      <td><small class="text-xxs" style="color: var(--textGray);">+$HiLoTime</small></td>
                      <td><small class="text-xxs" style="color: var(--textGray);">2000</small></td>
                      <td><small class="text-xxs" style="color: var(--textGray);">Conected</small></td>
                      <td>
                        <button class="btn btn-warning btn-sm"  style="padding: 6px 18px; font-size: 11px !important;" >Edit</button>
                        <button class="btn btn-danger btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Delete</button>
                        <button class="btn btn-info btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Reset</button>
                      </td>
                    </tr>
                    <tr>
                        <td></td>
                      <td><small class="text-xxs" style="color: var(--textGray);">254565</small></td>
                      <td><small class="text-xxs" style="color: var(--textGray);">Uprofit</small></td>
                      <td><small class="text-xxs" style="color: var(--textGray);">+$HiLoTime</small></td>
                      <td><small class="text-xxs" style="color: var(--textGray);">2000</small></td>
                      <td><small class="text-xxs" style="color: var(--textGray);">Conected</small></td>
                      <td>
                        <button class="btn btn-warning btn-sm"  style="padding: 6px 18px; font-size: 11px !important;" >Edit</button>
                        <button class="btn btn-danger btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Delete</button>
                        <button class="btn btn-info btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Reset</button>
                      </td>
                    </tr>
                   
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>

</div>

@endsection