@extends('layouts.user_type.landing')

@section('content')

  <main class="main-content  mt-0">
    <section id="header">
      <div class="page-header min-vh-100 " style="background-image:url('../assets/img/curved-images/curved14.jpg');border-radius: 0px 0px 40px 40px">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 ">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-center bg-transparent">
                  <h3 class="font-weight-bolder text-white text-bold">Despierta tu Potencial como Trader: Analiza y Optimiza tu Trading con el unico Journal impulsado por IA, invierte de forma sencilla con
                    CopyTrading</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column text-center" style="align-items: center">
                        <p class="text-white" style="margin-bottom: 90px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br></p>
                   
                        <div class="mt-4" style="height: 450px;width: 80%;background-color: var(--bg);border-radius: 20px">
                        </div>

                    </div>
                </div>
              </div>
           
            </div>
      
          </div>
        </div>
      </div>
    </section>
    <section id="sponsors" class="mt-4 ">
        <div class="container">
            <div class="row p-4">
                <div class="col-sm-12 text-center" >
                    <h3 class="font-weight-bolder text-white text-bold">Sponsors</h3>
                </div>
              <div class="col-sm-3">
                <div class="mt-4" style="height: 150px;width: 100%; border-radius: 20px;background-color: var(--bg)">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="mt-4 " style="height: 150px;width: 100%; border-radius: 20px; background-color: var(--bg)">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="mt-4 " style="height: 150px;width: 100%; border-radius: 20px; background-color: var(--bg)">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="mt-4 " style="height: 150px;width: 100%; border-radius: 20px; background-color: var(--bg)">
                </div>
              </div>
            </div>
        </div>

    </section>
    <section id="subtitle" class="mt-4" style="background-color: var(--bg)">
        <div class="container p-4">
            <div class="row">
                <div class="col-sm-12 text-center mt-4 mb-4" >
                    <h3 class="font-weight-bolder text-white text-bold">A Subtitle</h3>
                </div>
                    <div class="col-sm-2 mt-4 mb-4" >
                        <div style="height: 200px;width: 200px; background-color: var(--primary);border-radius: 15px" ></div>
                    </div>
                    <div class="col-sm-5 mt-4 mb-4" >
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                    
                    <div class="col-sm-4 mt-4 mb-4"></div>
                    <div class="col-sm-4 mt-4 mb-4"></div>

                    <div class="col-sm-5 mt-4 mb-4" >
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                    <div class="col-sm-2 mt-4 mb-4" >
                        <div style="height: 200px;width: 200px; background-color: var(--primary);border-radius: 15px" ></div>
                    </div>

                    <div class="col-sm-2 mt-4 mb-4" >
                        <div style="height: 200px;width: 200px; background-color: var(--primary);border-radius: 15px" ></div>
                    </div>
                    <div class="col-sm-5 mt-4 mb-4" >
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
               
            </div>
        </div>

    </section>

    <section id="features" class="p-4" style="background-color: var(--bgDark)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="nav nav-pills nav-fill mb-3 bg-transparent" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-0 px-0 py-1 active " style="color: var(--primary);font-weight: bold;" data-bs-toggle="tab" data-bs-target="#pills-home"
                                role="tab" >
                                <span class="ms-1">{{ __('Jouornal') }}</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-0 px-0 py-1 " style="color: var(--primary); font-weight: bold;"  data-bs-toggle="tab" data-bs-target="#pills-profile"
                          role="tab" >
                             <span class="ms-1">{{ __('Analytics') }}</span>
                             </a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link mb-0 px-0 py-1 "  style="color: var(--primary); font-weight: bold;"  data-bs-toggle="tab" data-bs-target="#pills-contact"
                          role="tab" >
                             <span class="ms-1">{{ __('CopyTrading') }}</span>
                             </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-0 px-0 py-1 "  style="color: var(--primary); font-weight: bold;"  data-bs-toggle="tab" data-bs-target="#pills-ai"
                            role="tab" >
                               <span class="ms-1">{{ __('AI Assistant') }}</span>
                               </a>
                          </li>

                          <li class="nav-item" role="presentation">
                            <a class="nav-link mb-0 px-0 py-1 "  style="color: var(--primary); font-weight: bold;"  data-bs-toggle="tab" data-bs-target="#pills-education"
                            role="tab" >
                               <span class="ms-1">{{ __('Education') }}</span>
                               </a>
                          </li>
                   
                      </ul>
                      <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                          <div class="row p-4">
                              <div class="col-sm-6 mt-4 mb-4 d-flex justify-content-center" style="align-items: center" >
                                <div style="height: 310px;width: 310px; background-color: var(--primary);border-radius: 15px; justify-content: center" ></div>
                              </div>
                              <div class="col-sm-6 mt-4 mb-4" >
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                              </div>
                          </div>
                            
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                          <div class="row p-4">
                            <div class="col-sm-6 mt-4 mb-4 " >
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </p>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </p>
                            </div>
                            <div class="col-sm-6 mt-4 mb-4 d-flex justify-content-center" style="justify-content: center" >
                              <div style="height: 310px;width: 310px; background-color: var(--primary);border-radius: 15px" ></div>
                            </div>
                        </div>

                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">

                          <div class="row p-4">
                            <div class="col-sm-6 mt-4 mb-4 d-flex justify-content-center" style="align-items: center" >
                              <div style="height: 310px;width: 310px; background-color: var(--primary);border-radius: 15px; justify-content: center" ></div>
                            </div>
                            <div class="col-sm-6 mt-4 mb-4" >
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </p>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </p>
                            </div>
                        </div>

                        </div>
                        <div class="tab-pane fade" id="pills-ai" role="tabpanel" aria-labelledby="pills-ai-tab" tabindex="0">
                          
                          <div class="row p-4">
                            <div class="col-sm-6 mt-4 mb-4 " >
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </p>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                              </p>
                            </div>
                            <div class="col-sm-6 mt-4 mb-4 d-flex justify-content-center" style="justify-content: center" >
                              <div style="height: 310px;width: 310px; background-color: var(--primary);border-radius: 15px" ></div>
                            </div>
                        </div>

                        </div>
                        <div class="tab-pane fade" id="pills-education" role="tabpanel" aria-labelledby="pills-education-tab" tabindex="0">
                          
                          <div class="row p-4">
                              <div class="col-sm-6 mt-4 mb-4 d-flex justify-content-center" style="align-items: center" >
                                <div style="height: 310px;width: 310px; background-color: var(--primary);border-radius: 15px; justify-content: center" ></div>
                              </div>
                              <div class="col-sm-6 mt-4 mb-4" >
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                              </div>
                          </div>

                        </div>
                       
                      </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="p-4" style="background-color: var(--bg)">
      <div class="container">
          <div class="row">
              <div class="col-sm-12 text-center mt-4 mb-4" >
                <h3 class="font-weight-bolder text-white text-bold">The most consistent strategies</h3>
            </div>
              <div class="col-sm-3 text-center" >
                <div class="card z-index-2" >
                  <div class="card-header pb-0" >
                    <h6>HiLoTime</h6>
                    <p class="text-sm">
                      <i class="fa fa-arrow-up text-success"></i>
                      <span class="font-weight-bold">30% more</span> in 2021
                    </p>
                  </div>
                  <div class="card-body p-3">
                    <div class="chart">
                      <canvas id="chart-line" class="chart-canvas" height="200"></canvas>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary btn-sm mt-4" type="button">Start Copy</button>

              </div>
              <div class="col-sm-3 text-center">
                <div class="card z-index-2">
                  <div class="card-header pb-0">
                    <h6>HiLoTime</h6>
                    <p class="text-sm">
                      <i class="fa fa-arrow-up text-success"></i>
                      <span class="font-weight-bold">30% more</span> in 2021
                    </p>
                  </div>
                  <div class="card-body p-3">
                    <div class="chart">
                      <canvas id="chart-line2" class="chart-canvas" height="200"></canvas>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary btn-sm mt-4" type="button">Start Copy</button>

              </div>
              <div class="col-sm-3 text-center">
                <div class="card z-index-2">
                  <div class="card-header pb-0">
                    <h6>HiLoTime</h6>
                    <p class="text-sm">
                      <i class="fa fa-arrow-up text-success"></i>
                      <span class="font-weight-bold">30% more</span> in 2021
                    </p>
                  </div>
                  <div class="card-body p-3">
                    <div class="chart">
                      <canvas id="chart-line3" class="chart-canvas" height="200"></canvas>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary btn-sm mt-4" type="button">Start Copy</button>

              </div>
              <div class="col-sm-3 text-center">
                <div class="card z-index-2">
                  <div class="card-header pb-0">
                    <h6>HiLoTime</h6>
                    <p class="text-sm">
                      <i class="fa fa-arrow-up text-success"></i>
                      <span class="font-weight-bold">30% more</span> in 2021
                    </p>
                  </div>
                  <div class="card-body p-3">
                    <div class="chart">
                      <canvas id="chart-line4" class="chart-canvas" height="200"></canvas>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary btn-sm mt-4" type="button">Start Copy</button>

              </div>

              <div class="col-sm-12 text-center mt-4 mb-4" >
                <button class="btn btn-secondary btn-lg mt-4" type="button">All Strategies</button>

            </div>
     
          </div>
      </div>
    </section>
  </main>

@endsection


@push('landing')
  <script>
    window.onload = function() {

      var options = {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#b2b9bf',
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#b2b9bf',
                padding: 20,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        };

       /*  var data =  */

      var ctx2 = document.getElementById("chart-line").getContext("2d");

      var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
      gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); 

      var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
      gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); 
      new Chart(ctx2, {
        type: "line",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug"],
          datasets: [{
              label: "Risk 1",
              tension: 0.1,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#cb0c9f",
              borderWidth: 3,
              backgroundColor: gradientStroke1,
              fill: true,
              data: [20, 140, 500, 290, 400],
              maxBarThickness: 6

            },
            {
              label: "Risk 2",
              tension: 0.1,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#FFFFF",
              borderWidth: 3,
              backgroundColor: gradientStroke2,
              fill: true,
              data: [30, 220, 40, 340, 200],
              maxBarThickness: 6
            },
          ],
        },
        options: options,
      });

      var ctx3 = document.getElementById("chart-line2").getContext("2d");

      var gradientStroke1 = ctx3.createLinearGradient(0, 230, 0, 50);

      gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
      gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); 

      var gradientStroke2 = ctx3.createLinearGradient(0, 230, 0, 50);

      gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
      gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); 
      new Chart(ctx3, {
        type: "line",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug"],
          datasets: [{
              label: "Risk 1",
              tension: 0.1,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#cb0c9f",
              borderWidth: 3,
              backgroundColor: gradientStroke1,
              fill: true,
              data: [150, 240, 380, 200, 200],
              maxBarThickness: 6

            },
            {
              label: "Risk 2",
              tension: 0.1,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#FFFFF",
              borderWidth: 3,
              backgroundColor: gradientStroke2,
              fill: true,
              data: [130, 110, 40, 240, 90],
              maxBarThickness: 6
            },
          ],
        },
        options: options,
      });

      var ctx4 = document.getElementById("chart-line3").getContext("2d");

        var gradientStroke1 = ctx4.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); 

        var gradientStroke2 = ctx4.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); 
        new Chart(ctx4, {
          type: "line",
          data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug"],
            datasets: [{
                label: "Risk 1",
                tension: 0.1,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#cb0c9f",
                borderWidth: 3,
                backgroundColor: gradientStroke1,
                fill: true,
                data: [150, 200, 200, 120, 230],
                maxBarThickness: 6

              },
              {
                label: "Risk 2",
                tension: 0.1,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#FFFFF",
                borderWidth: 3,
                backgroundColor: gradientStroke2,
                fill: true,
                data: [430, 210, 240, 340, 290],
                maxBarThickness: 6
              },
            ],
          },
          options: options,
        });

        var ctx5 = document.getElementById("chart-line4").getContext("2d");

var gradientStroke1 = ctx5.createLinearGradient(0, 230, 0, 50);

gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); 

var gradientStroke2 = ctx5.createLinearGradient(0, 230, 0, 50);

gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); 
new Chart(ctx5, {
  type: "line",
  data: {
    labels: ["Apr", "May", "Jun", "Jul", "Aug"],
    datasets: [{
        label: "Risk 1",
        tension: 0.1,
        borderWidth: 0,
        pointRadius: 0,
        borderColor: "#cb0c9f",
        borderWidth: 3,
        backgroundColor: gradientStroke1,
        fill: true,
        data: [50, 240, 300, 220, 500],
        maxBarThickness: 6

      },
      {
        label: "Risk 2",
        tension: 0.1,
        borderWidth: 0,
        pointRadius: 0,
        borderColor: "#FFFFF",
        borderWidth: 3,
        backgroundColor: gradientStroke2,
        fill: true,
        data: [230, 210, 140, 340, 290],
        maxBarThickness: 6
      },
    ],
  },
  options: options,
});
    }
  </script>
@endpush