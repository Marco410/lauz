@extends('layouts.user_type.landing')

@section('content')

  <main class="main-content  mt-0">
    <section id="header">
      <div class="min-vh-100 " style="border-radius: 0px 0px 40px 40px;background-color: var(--bgDark)">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 ">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-center bg-transparent">
                  <h3 class="font-weight-bolder text-white text-bold">Optimiza tus Inversiones con Estadísticas Avanzadas, CopyTrading y Asesoría Personalizada de IA</h3>
                </div>
                <div class="card-body">
                  <img src="{{ asset('assets/img/placeholder/header.png') }}" style="border-radius: 15px;" class="image img-fluid" width="auto" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="sponsors" class="mt-4 " style="background-color: var(--bg)">
        <div class="container">
            <div class="row p-4">
              <div class="col-sm-12 text-center" >
                  <h3 class="font-weight-bolder text-white text-bold p-4">Herramientas avanzadas para maximizar tu éxito en el trading</h3>
                  <p class="text-white p-4">En LAUZ, somos más que una plataforma de trading: somos una encubadora de traders. Nuestras herramientas avanzadas, como el Journal Web para análisis detallado, el CopyTrading para seguir estrategias exitosas y el asesor de IA personalizado, están diseñadas para potenciar tu éxito como trader. Únete a LAUZ hoy y descubre cómo podemos ayudarte a alcanzar tu máximo potencial en el mundo del trading</p>
              </div>
            </div>
        </div>
    </section>
    <section id="subtitle" class="mt-4" style="background-color: var(--bgDark)">
        <div class="container p-4">
            <div class="row">
                <div class="col-sm-6 text-white" style="align-content: center;" >
                  <ul class="nav flex-column nav-pills nav-fill mb-3 bg-transparent" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation" style="width: 100% !important">
                      <div class="mb-4 pt-4 p-4 landing nav-link active " data-bs-toggle="tab" data-bs-target="#pills-analisis"
                      role="tab" style="width: 100% !important">
                        <h4 class="font-weight-bolder text-white text-bold" style="text-align: left;">📈  Análisis Detallado con Journal Web:</h4>
                        <p class="justify-content" style="text-align: left;">Sumérgete en un análisis detallado de cada operación. Con tu Journal Web, tendrás acceso a estadísticas y métricas precisas que te permitirán comprender a fondo tu rendimiento como trader. Desde el seguimiento de tus operaciones hasta la evaluación de tus estrategias, esta herramienta te brindará una visión completa de tu desempeño, ayudándote a identificar áreas de mejora y optimizar tus decisiones de inversión.</p>
                      </div>
                    </li>
                    <li class="nav-item" role="presentation" style="width: 100% !important">
                      <div class="mt-4 pb-4 p-4 landing nav-link " data-bs-toggle="tab" data-bs-target="#pills-estrategias"
                      role="tab" style="width: 100% !important">
                        <h4 class="font-weight-bolder text-white text-bold" style="text-align: left;">💼  Estrategias de Grandes Fondos y Traders Expertos con CopyTrading:</h4>
                        <p class="justify-content" style="text-align: left;">Aprovecha la experiencia de los grandes fondos de inversión y de los Traders Profesionales con nuestra función de CopyTrading. Con LAUZ, puedes seguir y copiar las estrategias utilizadas por los expertos en el mercado. Ya no tienes que tomar decisiones de inversión por tu cuenta; simplemente elige a los traders más exitosos y deja que sus estrategias trabajen para ti. Es una forma inteligente y eficiente de diversificar tu cartera y maximizar tus oportunidades de éxito.</p>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="col-sm-6 mt-4 mb-4" >
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-analisis" role="tabpanel" aria-labelledby="pills-analisis" tabindex="0">
                     
                      <img src="{{ asset('assets/img/placeholder/image.png') }}" style="border-radius: 15px;" class="image img-fluid" width="auto" alt="">
                        
                    </div>
                    <div class="tab-pane fade" id="pills-estrategias" role="tabpanel" aria-labelledby="pills-estrategias" tabindex="0">
                      <img src="{{ asset('assets/img/placeholder/image.png') }}" style="border-radius: 15px;" class="image img-fluid" width="auto" alt="">
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </section>

    <section id="asesoramiento" class="mt-4" style="background-color: var(--bg)">
      <div class="container p-4">
          <div class="row">
            <div class="col-sm-6 mt-4 mb-4" >
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-asesoramiento" role="tabpanel" aria-labelledby="pills-asesoramiento" tabindex="0">
                 
                  <img src="{{ asset('assets/img/placeholder/image.png') }}" style="border-radius: 15px;" class="image img-fluid" width="auto" alt="">
                    
                </div>
                <div class="tab-pane fade" id="pills-educacion" role="tabpanel" aria-labelledby="pills-educacion" tabindex="0">
                  <img src="{{ asset('assets/img/placeholder/image.png') }}" style="border-radius: 15px;" class="image img-fluid" width="auto" alt="">
                </div>
              </div>
            </div>
              <div class="col-sm-6 text-white" style="align-content: center;" >
                <ul class="nav flex-column nav-pills nav-fill mb-3 bg-transparent" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation" style="width: 100% !important">
                    <div class="mb-4 pt-4 p-4 landing nav-link active " data-bs-toggle="tab" data-bs-target="#pills-asesoramiento"
                    role="tab" style="width: 100% !important">
                      <h4 class="font-weight-bolder text-white text-bold" style="text-align: left;">🧠  Asesoramiento Personalizado de IA:</h4>
                      <p class="justify-content" style="text-align: left;">Nuestra IA personalizada está aquí para ayudarte a tomar decisiones más informadas y rentables. A través de un análisis avanzado de tus hábitos de trading y preferencias individuales, nuestra IA te ofrece asesoramiento personalizado adaptado a tus necesidades específicas. Desde recomendaciones de inversión hasta consejos para mejorar tu rendimiento, nuestra IA está contigo en cada paso del camino, asegurándote que estés siempre un paso adelante en el mercado.</p>
                    </div>
                  </li>
                  <li class="nav-item" role="presentation" style="width: 100% !important">
                    <div class="mt-4 pb-4 p-4 landing nav-link " data-bs-toggle="tab" data-bs-target="#pills-educacion"
                    role="tab" style="width: 100% !important">
                      <h4 class="font-weight-bolder text-white text-bold" style="text-align: left;">🎯  Educación Guiada por Logros y Retos:</h4>
                      <p class="justify-content" style="text-align: left;">En LAUZ, creemos en el aprendizaje continuo y la mejora constante. Nuestra plataforma ofrece una educación guiada por logros y retos diseñada para ayudarte a desarrollar tus habilidades de trading y alcanzar tus metas financieras. A través de desafíos personalizados y metas específicas, te motivamos a superarte a ti mismo y a convertirte en un trader más competente y exitoso. Con LAUZ, tu potencial es ilimitado.</p>
                    </div>
                  </li>
                </ul>
              </div>
            
          </div>
      </div>
  </section>

    <section id="features" class="p-4" style="background-color: var(--bgDark)">
      <div class="container">
          <div class="row">
              <div class="col-sm-12 text-center mt-4 mb-4" >
                <h3 class="font-weight-bolder text-white text-bold">Top de Estrategias más Consistentes</h3>
            </div>
              <div class="col-sm-4 text-center">
                <div class="card z-index-2" style="background-color: var(--bgDark)">
                  <div class="card-body p-3">
                    <img src="{{ asset('assets/img/placeholder/image2.png') }}" style="border-radius: 15px;" class="image img-fluid" width="auto" alt="">
                    <h5 class="mt-4 text-white">Long heading is what you see here in this feature section</h5>
                    <p class="text-white text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla.</p>
                    <button class="btn btn-primary btn-sm mt-4" type="button">Button <i class="fas fa-arrow-forward" ></i></button>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 text-center">
                <div class="card z-index-2" style="background-color: var(--bgDark)">
                  <div class="card-body p-3">
                    <img src="{{ asset('assets/img/placeholder/image2.png') }}" style="border-radius: 15px;" class="image img-fluid" width="auto" alt="">
                    <h5 class="mt-4 text-white">Long heading is what you see here in this feature section</h5>
                    <p class="text-white text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla.</p>
                    <button class="btn btn-primary btn-sm mt-4" type="button">Button <i class="fas fa-arrow-forward" ></i></button>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 text-center">
                <div class="card z-index-2" style="background-color: var(--bgDark)">
                  <div class="card-body p-3">
                    <img src="{{ asset('assets/img/placeholder/image2.png') }}" style="border-radius: 15px;" class="image img-fluid" width="auto" alt="">
                    <h5 class="mt-4 text-white">Long heading is what you see here in this feature section</h5>
                    <p class="text-white text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla.</p>
                    <button class="btn btn-primary btn-sm mt-4" type="button">Button <i class="fas fa-arrow-forward" ></i></button>
                  </div>
                </div>
              </div>
          </div>
      </div>
    </section>

    <section id="results" class="mt-4" style="background-color: var(--bg)">
      <div class="container p-4" style="margin-bottom: 90px;margin-top: 60px;">
          <div class="row">
              <div class="col-sm-6 text-white"  >
                 <img src="{{ asset('assets/img/placeholder/image.png') }}" style="border-radius: 15px;" class="image img-fluid" width="auto" alt="">
              </div>
              <div class="col-sm-6 mt-4 mb-4 p-4" style="align-content: center;">
                <small class="text-white">Éxito</small>
                <h3 class="text-white">Resultados que destacan el éxito de nuestros usuarios</h3>
                <p class="text-white">¡Traders, es hora de descubrir un nuevo mundo de posibilidades en el trading! En LAUZ, te invitamos a explorar nuestro Journal Web público, donde podrás acceder y detallar las estadísticas y resultados de otros traders. ¿Quieres conocer las estrategias exitosas que están generando ganancias? ¿Deseas aprender de las experiencias de traders con trayectorias comprobadas? Con nuestro Journal Web, tienes la oportunidad de sumergirte en el análisis detallado de operaciones de otros traders, permitiéndote aprender, inspirarte y mejorar tus propias estrategias. Únete a LAUZ hoy mismo y comienza a descubrir las claves del éxito en el trading a través de nuestro Journal Web público.</p>
                <button class="btn btn-outline-primary btn-sm mt-4" type="button">Descubre</button>
                <a class="btn btn-link btn-sm mt-4" href="{{ url('register') }}" type="button">Regístrate</a>
              </div>
          </div>
      </div>
  </section>

  <section id="function" class="p-4" style="background-color: var(--bgDark)">
    <div class="container" style="margin-top: 50px" >
        <div class="row">
            <div class="col-sm-6 offset-3 text-center mt-4 mb-4" >
              <small class="text-white">Éxito</small>
              <h3 class="font-weight-bolder text-white text-bold mb-3">Cómo Funciona el Copy Trading en LAUZ</h3>
              <p class="text-white text-sm mb-4">Con nuestro sistema de Copy Trading, los usuarios tienen la oportunidad de seguir a traders exitosos y replicar sus operaciones en tiempo real. Esto les permite aprovechar la experiencia y conocimientos de traders profesionales para maximizar sus ganancias en el trading.</p>
          </div>
            <div class="col-sm-4 text-center">
              <div class="card z-index-2" style="background-color: var(--bgDark)">
                <div class="card-body p-3">
                  <img src="{{ asset('assets/img/placeholder/image2.png') }}" style="border-radius: 8px;" class="image img-fluid" width="auto" alt="">
                  <h5 class="mt-4 text-white">Sigue a Traders Exitosos en Tiempo Real</h5>
                  <p class="text-white text-sm">Explora nuestra plataforma para encontrar a los traders más exitosos en tiempo real. Con nuestro sistema de copytrading, puedes acceder a perfiles detallados y estadísticas actualizadas para identificar a los traders que mejor se adaptan a tus objetivos financieros.</p>
                </div>
              </div>
            </div>
            <div class="col-sm-4 text-center">
              <div class="card z-index-2" style="background-color: var(--bgDark)">
                <div class="card-body p-3">
                  <img src="{{ asset('assets/img/placeholder/image2.png') }}" style="border-radius: 8px;" class="image img-fluid" width="auto" alt="">
                  <h5 class="mt-4 text-white">Conexión directa para resultados inmediatos.</h5>
                  <p class="text-white text-sm">Conecta tu plataforma de trading o tu broker directamente a la cuenta del trader que deseas copiar. Con esta conexión directa, tus operaciones se replicarán automáticamente en tiempo real, sin retrasos ni complicaciones, garantizando que no te pierdas ninguna oportunidad de mercado..</p>
                </div>
              </div>
            </div>
            <div class="col-sm-4 text-center">
              <div class="card z-index-2" style="background-color: var(--bgDark)">
                <div class="card-body p-3">
                  <img src="{{ asset('assets/img/placeholder/image2.png') }}" style="border-radius: 8px;" class="image img-fluid" width="auto" alt="">
                  <h5 class="mt-4 text-white">Replicación de operaciones y control total.</h5>
                  <p class="text-white text-sm">Una vez conectado, tu cuenta comenzará a replicar todas las operaciones del trader que has elegido, permitiéndote obtener los mismos resultados. Con nuestro Journal Web, puedes monitorear todas las operaciones en tiempo real y controlar tu riesgo de manera efectiva, asegurándote de que tu inversión esté siempre bajo control..</p>
                </div>
              </div>
            </div>
            <div class="col-sm-12 text-center mb-4 mt-4">
                <button class="btn btn-outline-primary btn-sm mt-4" type="button">Descubre</button>
                <a class="btn btn-link btn-sm mt-4" href="{{ url('register') }}" type="button">Regístrate</a>
            </div>
        </div>
    </div>
  </section>

  <section id="newsletter" class="p-4" style="background-color: var(--bg)">
    <div class="container" style="margin-top: 50px" >
        <div class="row">
          <div class="col-sm-6">
            <h3 class="text-white">Únete a nuestra plataforma hoy</h3>
            <p class="text-white">Descubre herramientas avanzadas y servicios personalizados para maximizar tu éxito en el trading.</p>
          </div>
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
            <a class="btn btn-link btn-sm mt-4" href="{{ url('register') }}" type="button">Regístrate</a>
            <a class="btn btn-outline-primary btn-sm mt-4"  type="button">Comienza</a>
          </div>
        </div>
    </div>
  </section>

  <section id="newsletter" class="p-4" style="background-color: var(--bgDark)">
    <div class="container" style="margin-top: 50px" >
        <div class="row">
          <div class="col-sm-6 offset-3">
            <h3 class="text-white">Preguntas</h3>
            <p class="text-white">Encuentra respuestas a las preguntas más frecuentes sobre nuestros servicios y plataforma.</p>
          </div>
          <div class="col-sm-6 offset-3">
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    ¿Qué es LAUZ y cómo puedo beneficiarme de usarlo?
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    ¿Cómo funciona el copytrading en LAUZ?
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    ¿Es seguro invertir con las herramientas de LAUZ?
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                    ¿Qué tipo de traders puedo encontrar en LAUZ?
                  </button>
                </h2>
                <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                    ¿Qué herramientas de análisis ofrece LAUZ?
                  </button>
                </h2>
                <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla.
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 offset-3 text-center mt-4 p-4" style="margin-top: 80px">
            <h3 class="text-white">¿Todavía tienes preguntas?</h3>
            <p class="text-white">Contáctanos para obtener más información</p>
            <button class="btn btn-outline-primary btn-sm mt-4" type="button">Contacto</button>
          </div>
        </div>
    </div>
  </section>

  <section id="union" class="p-4" style="background-color: var(--bg)">
    <div class="container" style="margin-top: 50px;margin-bottom: 50px;" >
        <div class="row">
          <div class="col-sm-6 p-4" style="align-content: center;">
            <h3 class="text-white" style="font-size: 35px;">Únete a nuestro boletín informativo</h3>
            <p class="text-white">Recibe actualizaciones y consejos de trading directamente en tu bandeja de entrada</p>
            <div class="row">
              <div style="display: flex; flex-direction: row; align-content: center;gap:10px">
                <input type="text" class="form-control" placeholder="Ingresa tu correo electrónico" style="background-color: var(--bgDark) !important; border-color: transparent !important;color: white; height: 40px; border-radius: 0px 30px 30px 0px; padding: 15px;">
              <button class="btn btn-outline-primary btn-sm " type="button">Suscribete</button>
              </div>
              <small class="text-white text-xs mt-3">Al hacer clic en Suscríbete, confirmas que estás de acuerdo con nuestros Términos y Condiciones.</small>
            </div>
          </div>
          <div class="col-sm-6">
            <img src="{{ asset('assets/img/placeholder/image3.png') }}" style="border-radius: 8px;" class="image img-fluid" width="auto" alt="">
          </div>
          
        </div>
    </div>
  </section>


  </main>

@endsection


@push('landing')
  <script>
    window.onload = function() {

    }
  </script>
@endpush