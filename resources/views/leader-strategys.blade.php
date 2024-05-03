@extends('layouts.user_type.auth')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <div class="row">
    <div class="col-sm-7">
      <h2 class="text-white">Top Strategies</h2>
    </div>
    <div class="d-flex flex-row-reverse">
      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary btn-sm" style="background-color: var(--bgDark); border: 1px solid var(--bg300);">All</button>
        <button type="button" class="btn btn-secondary btn-sm" style="background-color: var(--bgDark); border: 1px solid var(--bg300);">Futures</button>
        <button type="button" class="btn btn-secondary btn-sm" style="background-color: var(--bgDark); border: 1px solid var(--bg300);">Stocks</button>
        <button type="button" class="btn btn-secondary btn-sm" style="background-color: var(--bgDark); border: 1px solid var(--bg300);">Forex</button>
        <button type="button" class="btn btn-secondary btn-sm" style="background-color: var(--bgDark); border: 1px solid var(--bg300);">Cryptos</button>
      </div>
    </div>

    <div class="col-sm-12">
      <div class="card mb-4" style="background-color: var(--bgDark);" >
          <div class="card-body px-0 pt-0 pb-2" >
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                      <tr>
                          <th  style="padding: 10px;" class="text-white text-sm font-weight-bolder"></th>
                        <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Strategy</th>
                        <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">
                          <select name="how_often_invest" class="form-select" >
                            <option selected value="Account">Annual Return</option>
                          </select>
                        </th>
                        <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">
                          <select name="how_often_invest" class="form-select">
                            <option selected value="Account">Max DrawDown</option>
                          </select>
                        </th>
                        <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">
                          <select name="how_often_invest" class="form-select">
                            <option selected value="Account">Strategy age</option>
                          </select>
                        </th>
                        <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">
                          <select name="how_often_invest" class="form-select">
                            <option selected value="Account">Risk Level</option>
                          </select>
                        </th>
                        <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Q Trades</th>
                        <th style="padding: 10px;" class="text-white text-sm font-weight-bolder">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                          <td></td>
                          <td><small class="text-sm" style="color: var(--textGray);">HiLoTime SiomTrading</small></td>
                          <td><small class="text-sm" style="color: var(--textGray);">30%</small></td>
                          <td><small class="text-sm" style="color: var(--textGray);">13%</small></td>
                          <td><small class="text-sm" style="color: var(--textGray);">1 Year</small></td>
                          <td><small class="text-sm" style="color: var(--textGray);">Risk 1</small></td>
                          <td><small class="text-sm" style="color: var(--textGray);">320</small></td>
                          <td>
                            <button class="btn btn-primary btn-sm"  style="padding: 6px 18px; font-size: 11px !important;" >Watch</button>
                            <button class="btn btn-danger btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Follow</button>
                            <button class="btn btn-info btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Copy</button>
                          </td>
                        </tr>
                      <tr>
                        <td></td>
                        <td><small class="text-sm" style="color: var(--textGray);">VolumeBreakout SiomTrading</small></td>
                        <td><small class="text-sm" style="color: var(--textGray);">30%</small></td>
                        <td><small class="text-sm" style="color: var(--textGray);">13%</small></td>
                        <td><small class="text-sm" style="color: var(--textGray);">1 Year</small></td>
                        <td><small class="text-sm" style="color: var(--textGray);">Risk 1</small></td>
                        <td><small class="text-sm" style="color: var(--textGray);">320</small></td>
                        <td>
                          <button class="btn btn-primary btn-sm"  style="padding: 6px 18px; font-size: 11px !important;" >Watch</button>
                          <button class="btn btn-danger btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Follow</button>
                          <button class="btn btn-info btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Copy</button>
                        </td>
                      </tr>
                    <tr>
                      <td></td>
                      <td><small class="text-sm" style="color: var(--textGray);">EMACrossover Carlos Peru</small></td>
                      <td><small class="text-sm" style="color: var(--textGray);">30%</small></td>
                      <td><small class="text-sm" style="color: var(--textGray);">13%</small></td>
                      <td><small class="text-sm" style="color: var(--textGray);">1 Year</small></td>
                      <td><small class="text-sm" style="color: var(--textGray);">Risk 1</small></td>
                      <td><small class="text-sm" style="color: var(--textGray);">320</small></td>
                      <td>
                        <button class="btn btn-primary btn-sm"  style="padding: 6px 18px; font-size: 11px !important;" >Watch</button>
                        <button class="btn btn-danger btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Follow</button>
                        <button class="btn btn-info btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Copy</button>
                      </td>
                    </tr>
                  <tr>
                    <td></td>
                    <td><small class="text-sm" style="color: var(--textGray);">QuickSignals Juan Gomez</small></td>
                    <td><small class="text-sm" style="color: var(--textGray);">30%</small></td>
                    <td><small class="text-sm" style="color: var(--textGray);">13%</small></td>
                    <td><small class="text-sm" style="color: var(--textGray);">1 Year</small></td>
                    <td><small class="text-sm" style="color: var(--textGray);">Risk 1</small></td>
                    <td><small class="text-sm" style="color: var(--textGray);">320</small></td>
                    <td>
                      <button class="btn btn-primary btn-sm"  style="padding: 6px 18px; font-size: 11px !important;" >Watch</button>
                      <button class="btn btn-danger btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Follow</button>
                      <button class="btn btn-info btn-sm" style="padding: 6px 18px; font-size: 11px !important;" >Copy</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>    

    </div>
  </div>

</div>
@endsection