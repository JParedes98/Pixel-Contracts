@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <section>
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">
    
                        <li role="presentation" class="active">
                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                <span class="round-tab">
                                    <i class="fas fa-info"></i>
                                </span>
                            </a>
                        </li>
    
                        <li role="presentation" class="disabled">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                <span class="round-tab">
                                    <i class="far fa-address-card"></i>
                                </span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                <span class="round-tab">
                                    <i class="fas fa-file-contract"></i>       
                                </span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled">
                                <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step 4">
                                    <span class="round-tab">
                                        <i class="fas fa-briefcase"></i>
                                    </span>
                                </a>
                        </li>
                        <li role="presentation" class="disabled">
                                <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Step 5">
                                    <span class="round-tab">
                                        <i class="fas fa-archive"></i>
                                    </span>
                                </a>
                        </li>
                        <li role="presentation" class="disabled">
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                <span class="round-tab">
                                        <i class="fas fa-pencil-alt"></i>                                       
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
    
                <form role="form" action="{{route('contract-consolidated')}}" method="POST" class="disableSelection" >
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$contrato->id}}">
                    <div class="tab-content"><br>
                        <h3 class="text-center">CONTRATO PRIVADO DE SERVICIOS</h3>
                    
                        @if ($errors->has('contract_signature'))
                            <p class="text-danger text-center h4">{{ $errors->first('contract_signature') }}</p>
                        @endif

                        <div class="tab-pane active" role="tabpanel" id="step1" style="margin:0; padding:0;">
                            <h3>DATOS GENERALES</h3>
                            <p class="text-justify">
                                    Nosotros: Por una parte, Daniel Alberto Bernhard Lutz, mayor de edad, soltero, licenciado en finanzas, hondureño y 
                                    de éste domicilio, con número de cédula de identidad 0501-2006-15856, en su condición de Representante Legal de la Sociedad 
                                    PIXEL S.A. C.V.; la que de aquí en adelante y para los efectos de este contrato se denominará como EL PROVEEDOR, y por otra parte, 
                                    <strong>"{{$contrato->legal_representative_name}}"</strong> , mayor de edad, {{$contrato->legal_representative_marital_status}}, con domicilio en la ciudad de {{$contrato->legal_representative_home}},
                                    con número de cédula de Identidad <strong>"{{$contrato->legal_representative_id_number}}"</strong>., quién comparece en su condición de Representante Legal de la 
                                    sociedad <strong>"{{$contrato->company_social_reason}}"</strong>, con RTN <strong>"{{$contrato->legal_representative_rtn}}"</strong> quien en adelante y para efectos del presente 
                                    contrato se conocerá como <strong>COMERCIO AFILIADO manifiestan que han convenido en celebrar como al efecto lo hacen, un CONTRATO 
                                    PRIVADO  DE PRESTACIÓN DE SERVICIOS DE LA PLATAFORMA DE PAGO PIXELPAY</strong>, bajo las siguientes clausulas y condiciones:
                            </p>
                            <br>
                            
                            <h3 class="text-center">CLAUSULAS</h3>
                            <P class="text-justify">
                                <strong>PRIMERO: DEFINICIONES</strong> Los siguientes términos tendrán el significado que se les otorga a continuación:
                            </P>
                                <ul class="text-justify">
                                    <li>
                                        <strong>PIXEL S.A.:</strong> operadora del programa <strong>PIXEL PAY</strong>
                                    </li>
                                    <li>
                                            <strong>COMERCIO AFILIADO:</strong> negocios y establecimientos que utilizan PixelPay para el envio de cobros y 
                                            para recibir PAGOS de manera virtual.
                                    </li>
                                    <li>
                                        <strong>PAGOS:</strong>transacción realizada por un CLIENTE en el COMERCIO AFILIADO por medio de tarjeta de crédito
                                         o débito, como pago total o parcial de sus facturas por consumo en los COMERCIOS AFILIADOS.
                                    </li>
                                    <li>
                                        <strong>CLIENTE:</strong> usuario final realizando un pago al COMERCIO AFILIADO
                                    </li>
                                    <li>
                                        <strong>HISTORIAL DE PAGOS: </strong> bitácora del COMERCIO AFILIADO detallando el estatus  de cada cobro.
                                    </li>
                                </ul>
                            <p class="text-justify">
                                    Los títulos empleados en el presente contrato tienen carácter meramente indicativo y en modo alguno afectan la extensión 
                                    y alcance de las disposiciones incluidas en los artículos que designan. Todos los términos y estipulaciones de este 
                                    contrato se interpretarán y cumplirán por las partes de buena fe, recurriendo en caso de duda a una interpretación orgánica 
                                    del presente, de la legislación aplicable y de los principios establecidos en el derecho nacional e internacional.
                            </p>
                            <br>
                            <p class="text-justify">
                                <strong>SEGUNDO: OBJETO DEL CONTRATO:</strong> Manifiesta <strong>EL PROVEEDOR </strong>que como propietarios exclusivo de 
                                la plataforma de pagos conocida como PIXELPAY, a través de esta, se dedica a proveer un servicio que les permite a los usuarios 
                                de la Aplicación, cobrar a sus clientes en línea por medio de  envió de correo electrónico, mensajes de texto, o a través de 
                                su tienda virtual, para que el cliente ingrese la información de su tarjeta de crédito o débito para que el pago sea procesado. 
                                La plataforma le genera un recibo al CLIENTE y el registro del depósito al <strong>COMERCIO AFILIADO </strong>que está 
                                comercializando un bien o servicio.
                            <br>

                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-primary next-step">Siguiente</button></li>
                            </ul>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="step2" style="margin:0; padding:0;">
                            <h3>CLAUSULAS</h3>

                            <p class="text-justify">
                                    <strong>TERCERA: OBLIGACIONES PIXEL S.A.: </strong> El Proveedor se compromete a prestar los Servicios de conformidad 
                                    con las siguientes obligaciones y condiciones:
                                </p>
                        
                                <ol class="text-justify">
                                    <li>
                                        <strong>PIXEL S.A. </strong> preverá el soporte técnico adecuado para el buen desempeño en funcionamiento y uso
                                         de la plataforma de acuerdo al período de tiempo que ambas partes hayan designado como duración de este contrato.
                                    </li>
                                    <li>
                                        <strong>PIXEL</strong> preverá al <strong>COMERCIO AFILIADO</strong> reporteria estadística de las transacciones 
                                        realizadas mediante la plataforma. En la medida que lo permita la ley, EL PROVEEDOR, se reserva el derecho de 
                                        modificar o suspender, periódicamente y en cualquier momento, ya sea de forma permanente o temporal, funciones 
                                        características del servicio <strong>PIXELPAY</strong>, sin responsabilidad ante usted, excepto cuando lo prohíba la ley. 
                                        <strong>PIXEL S.A.</strong> se esfuerza por garantizar que la información contenida en su sitio sea exacta y confiable. Sin embargo, 
                                        <strong>PIXELPAY</strong> y la World Wide Web (o la Wed) no son infalibles y en oportunidades es posible que se produzcan errores. 
                                        Por lo tanto, en la medida que lo permita la vigente, <strong>PIXEL S.A.</strong>  no acepta ninguna responsabilidad por la seguridad 
                                        de las características de los servicios del COMERCIO AFILIADO, el contenido del COMERCIO AFILIADO, el contenido 
                                        enviado o cualquier otra característica del sitio. Usted reconoce que su confianza en dicho material y/o sistemas 
                                        será a su propio riesgo. 
                                    </li>
                                </ol>
                                <br>
                                <p class="text-justify">
                                    <strong>CUARTA: OBLIGACIONES DEL COMERCIO AFILIADO: </strong>El Comercio Afiliado derivadas del presente contrato, tendrá entre 
                                    otras las siguientes obligaciones y condiciones:
                                    
                                    <ul class="text-justify">
                                        <li><strong>PLATAFORMA DE ADMINISTRACION: EL COMERCIO AFILIADO</strong> tiene acceso a la plataforma de administración (Backoffice) 
                                            para ver reporteria, crear usuarios, delegar permisos de sus usuarios, entre otros.
                                        </li>
                                        <li>
                                            Utilizar de manera responsable la información proporcionada por la plataforma.
                                        </li>
                                        <li>
                                            Notificar al PROVEEDOR cuando haya anomalías o fallas en el funcionamiento de la plataforma. 
                                        </li>
                                        <li>
                                            <strong>EL COMERCIO AFILIADO</strong> se compromete a salvaguardar la información que pase en sus sistemas.
                                        </li>
                                        <li>
                                            <strong>EL COMERCIO AFILIADO </strong>conviene que durante la vigencia del presente contrato no podrá celebrar 
                                            contratos similares al presente con otras personas naturales o jurídicas.
                                        </li>
                                    </ul>
                                </p>
                                <br>      
                                <h4>EL PROVEEDOR</h4>
                                <table class="tablaContrato">
                                        <tbody>
                                          <tr>
                                            <th scope="row">Contacto</th>
                                            <td>Daniel Alberto Bernhard Lutz</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Direccion</th>
                                            <td>Edificio Tecnocomp, Ave. Circunvalación 5 y 6 Calle “A” N.O.</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Telefono</th>
                                            <td>(504) 2504-3200</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Correo</th>
                                            <td>info@pixel.hn</td>
                                          </tr>
                                        </tbody>
                                </table>
                                <br>
                                <h4>EL COMERCIO AFILIADO</h4>
                                <table class="tablaContrato">
                                        <tbody>
                                          <tr>
                                              <th scope="row">Contacto</th>
                                              <td>{{$contrato->contact_name}}</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Direccion</th>
                                            <td>{{$contrato->company_adress}}</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Telefono</th>
                                            <td>{{$contrato->company_tel}}</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Correo</th>
                                            <td>{{$contrato->company_email}}</td>
                                          </tr>
                                        </tbody>
                              </table>
                              <br>
                              <p class="text-justify">
                                    Cualquier notificación o comunicación conforme a esos lineamientos se considerará cursada cuando se le entregue 
                                    en forma personal, por correo electrónico, o en caso que se le envié por correo, en la fecha de recepción o a los 
                                    tres (3) días de su fecha de despacho por correo, lo que ocurra antes. Estos nombres y domicilios podrán modificarse 
                                    por escrito de acuerdo con las disposiciones Precedentes.
                              </p>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
                                <li><button type="button" class="btn btn-primary next-step">Siguiente</button></li>
                            </ul>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="step3" style="margin:0; padding:0;">
                            <h3>CLAUSULAS</h3>

                            <p class="text-justify">
                                    <strong>QUINTO: FORMA DE PAGO: </strong>El COMERCIO AFILIADO pagará al PROVEEDOR una comisión sobre el volumen de ventas
                                     facturado a través de la plataforma PIXELPAY por un mes calendario mas el impuesto correspondiente. Dicho porcentaje se 
                                     aplicará conforme a la tabla que se encuentra en vigencia por EL PROVEEDOR y que EL COMERCIO AFILIADO declara conocer y 
                                     aceptar, tal y como se muestra en la propuesta económica incluida en el “Anexo 1” del presente contrato. El cobro será 
                                     facturado en los primeros cinco días del mes. EL COMERCIO AFILIADO cancelará el pago por el servicio dentro de los siete 
                                     (7) días calendarios de presentada la factura. En caso de incumplimiento de PAGO por parte del comercio a partir del Octavo 
                                     (8) dia de presentada la factura, correrá con un interés por mora del 3% mensual sobre el monto adeudado.
                                    En el evento de una falta de pago por parte del comercio por mas de treinta (30) días de presentada la factura, EL 
                                    PROVEEDOR se reserva el derecho de suspender el servicio. Una vez sanada la deuda, habrá un cargo de reinstalación de la
                                     plataforma por un monto de cincuenta Dólares Americanos ($50.00).
                                </p>
                                <br>
                                <p class="text-justify">
                                    <strong>SEXTO: PLAZO: </strong>LAS PARTES convienen que el presente Contrato tenga una vigencia de tres  (3) años. El 
                                    Contrato podrá ser renovado automáticamente por mismo período de tiempo, en el extremo que ninguna de las partes 
                                    manifieste por escrito su deseo de dar por terminado el contrato, con treinta (30) días antes de su vencimiento. 
                                </p>
                                <br>
                                <p class="text-justify">
                                    <strong>SEPTIMO: TERMINACION ANTICIPADA DEL CONTRATO: </strong>No obstante el plazo indicado en la cláusula anterior, 
                                    ambas partes tendrán el derecho de dar por terminado anticipadamente el plazo del presente contrato en los siguientes 
                                    casos y condiciones: 
                                    <ol class="text-justify">
                                        <li>
                                            Por mutuo acuerdo entre las partes, debidamente acordado con por lo menos treinta dias de antelación a la 
                                            efectiva cesación del servicio.
                                        </li>
                                        <li>
                                            La ocurrencia de caso fortuito o fuerza mayor (ajenos a la voluntad de las partes), que provoquen el cese de las 
                                            operaciones mercantiles de alguna de las dos partes cuya naturaleza impida el futuro cumplimiento de las 
                                            obligaciones principales a que se comprometen.
                                        </li>
                                        <li>
                                            Por incumplimiento de alguna de las partes con respecto a  sus obligaciones contraídas en el presente contrato. 
                                        </li>
                                    </ol>
                                </p>
                                <br>
                                <p class="text-justify">
                                    <strong>OCTAVO: LIBERACION DE RESPONSABILIDAD: </strong>Manifiesta el Comercio Afiliado, que el Proveedor no será 
                                    legalmente responsable por transacciones mediante la plataforma de pago PIXELPAY, que se hayan efectuado con tarjetas 
                                    que hubiesen sido robadas, clonadas u obtenidas mediante cualquier otro medio delictuoso.  
                                </p>
                                <br>
                                <p class="text-justify">
                                    <strong>NOVENO: NOTIFICACIONES: </strong>Cualquier notificación u otra comunicación requerida o que pueda cursarse 
                                    en relación con este Contrato deberá emitirse por escrito y entregarse en forma personal, o correo certificado o 
                                    expreso, con el acuse de recibido correspondiente a los siguientes domicilios:
                                </p>
                                <br>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
                                <li><button type="button" class="btn btn-primary next-step">Siguiente</button></li>
                            </ul>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="step4" style="margin:0; padding:0;">
                            <h3>CLAUSULAS</h3> 
                            <p class="text-justify">
                                    <strong>DÉCIMO: CARÁCTER DE INDEPENDIENTE.</strong> Las partes convienen y dejan expresa constancia que el Contrato no 
                                    generó, genera ni generará nexo laboral entre EL PROVEEDOR y EL COMERCIO AFILIADO, ni entre EL PROVEEDOR y los empleados 
                                    y/o personas que contrate EL COMERCIO AFILIADO para la ejecución del presente contrato. Sus relaciones se regirán solamente 
                                    por las normas civiles y mercantiles correspondientes. EL COMERCIO AFILIADO asumirá por su cuenta cualquier reclamo 
                                    relacionado con accidentes de trabajo, enfermedades o riesgos profesionales, así como cualquier otro tipo de responsabilidad 
                                    ante sus trabajadores o prestadores de servicios. Es entendido que las relaciones de trabajo serán únicamente entre 
                                    EL COMERCIO AFILIADO y sus trabajadores, y de ahí que todo derecho, obligación, prestación, reclamación, acción o 
                                    petición de cualquier índole en el ramo laboral, de previsión y seguridad social, así como civiles, penales o 
                                    administrativos, en relación al contrato Privado de Gestión de Residuos contenido en el presente instrumento, serán 
                                    cumplidos y asumidos total y exclusivamente por EL COMERCIO AFILIADO; estas mismas disposiciones contenidas en esta 
                                    cláusula, le serán aplicables al PROVEEDOR, debiendo asumir sus riesgos laborales y exonerando de cualquier responsabilidad 
                                    al COMERCIO AFILIADO.
                              </p>
                              <br>
                              <p class="text-justify">
                                  <strong>DÉCIMO PRIMERO: CESIÓN DEL CONTRATO. </strong>Ambas partes acuerdan que las razones principales que les mueven a 
                                  celebrar este contrato son la capacidad comercial y entereza de las partes, y éstas se caracterizan por ser estrictamente 
                                  personales. Por tal razón, EL COMERCIO AFILIADO, no podrá, por cualquier medio directo o indirecto, vender, donar, permutar 
                                  o ceder en cualquier forma sus residuos a terceros. Si EL COMERCIO AFILIADO así lo hiciere, sin tener el consentimiento 
                                  previo y por escrito de EL PROVEEDOR, éste podrá dar por terminado con justa causa el presente contrato. 
                              </p>
                              <br>
                              <p class="text-justify">
                                    <strong>DÉCIMO SEGUNDO: USO DE INFORMACION:</strong>  El Proveedor establece que ha desarrollado la plataforma tecnológica PIXELPAY, la 
                                    cual designa de su propiedad intelectual  y a la cual brinda acceso como servicio al COMERCIO AFILIADO; el cual no podrá 
                                    cambiar, subarrendar o duplicar dicha plataforma y software. EL COMERCIO AFILIADO, tendrá acceso a dicha información 
                                    siempre y cuando este contrato se encuentre vigente, la información no podrá ser compartida con terceros. 
                              </p>
                              <br>
                              <p class="text-justify">
                                    <strong>DÉCIMO TERCERO: PROPIEDAD INTELECTUAL  Y/O PROPIEDAD INDUSTRIAL: EL COMERCIO AFILIADO</strong> reconoce que todo derecho a la 
                                    propiedad intelectual del uso de los productos, la metodología de comercialización de los productos y cualquier otra 
                                    explotación comercial que se pueda hacer a través del producto y que le sea revelada, debe ser propiedad única y 
                                    exclusivamente de <strong>PIXEL S.A.</strong> Ningún derecho o licencia de dicho derecho a la propiedad intelectual le es transmitido 
                                    al <strong>COMERCIO AFILIADO.</strong> Consecuentemente, cualquiera sea la razón de la desvinculación comercial entre las partes; 
                                    ninguna podrá retener para si los desarrollos (software, hardware, Información Confidencial, etc.) que la otra 
                                    hubiera empleado o comprometido en función de sus obligaciones en los términos de este contrato. De igual forma, 
                                    será manejada la información, datos, elementos, diseños, fórmulas, patentes, fotografías y demás información o cosas 
                                    análogas que el COMERCIO AFILIADO, entregue al proveedor, para el cumplimiento de este contrato.
                              </p>
                              <br>
                              <p class="text-justify">
                                  <strong>DÉCIMO CUARTO: CONFIDENCIALIDAD: </strong>Además de las obligaciones que emanan de la naturaleza de este contrato ambas partes
                                   estarán obligadas a:
                                   <ol class="text-justify">
                                       <li>
                                            Mantener la información confidencial en estricta reserva y no revelar ningún dato de la información a ninguna 
                                            otra parte, relacionada o no, sin el consentimiento previo escrito de la parte afectada.
                                       </li>
                                       <li>
                                            Instruir al personal que estará encargado de recibir la información confidencial, debiendo suscribir el 
                                            correspondiente acuerdo de confidencialidad si fuere necesario. Divulgar la información confidencial únicamente a las 
                                            personas autorizadas para su recepción dentro de la organización.
                                       </li>
                                       <li>
                                            Tratar confidencialmente toda la información recibida directa o indirectamente y no utilizar ningún dato de esa 
                                            información de ninguna manera distinta al propósito del presente contrato.
                                       </li>
                                       <li>
                                            No manejar, usar, explorar, o divulgar la información confidencial a ninguna persona o entidad por ningún motivo 
                                            en contravención a lo dispuesto en este Contrato, salvo que sea expresamente autorizado.
                                       </li>
                                       <li>
                                            e. Información Confidencial será extendida como: todo tipo de información que las partes transmiten o 
                                            generan con motivo de la relación comercial entre las partes y este contrato; ya sea que se presente en forma 
                                            escrita, verbal, visual o por cualquier otro medio y sin importar el soporte material en el cual se contenga e 
                                            incluyendo pero no limitado a información técnica (en forma enunciativa mas no limitativa, lo siguiente: 
                                            información comercial, de proceso y estrategias comerciales y modelos operativos, la aplicación y mejoras de 
                                            invenciones, patentes, avisos comerciales, modelos de utilidad, diseños digitales, “Know How”, información 
                                            jurídica, financiera o de cualquier otro tipo), así como cualquier información comercial: volúmenes de ventas 
                                            o cartera de clientes a la que pudiesen acceder con motivo de este contrato. 
                                       </li>
                                       <li>
                                            f. Cada una de las partes reconoce y acepta que la Información Confidencial que hay recibido por cualquier
                                             medio o forma y en cualquier momento, así como aquella que en lo futuro reciba conforme al presente contrato, 
                                             es y continuara siendo propiedad exclusiva de la parte propietaria.
                                       </li>
                                       <li>
                                            Por lo anterior, ninguna de las partes podrá retener o conservar indebidamente la Información Confidencial
                                             que le haya sido proporcionada conforme al presente Contrato y podrá divulgar la Información Confidencial, por 
                                             el periodo de cinco (5) años a partir de la fecha de terminación de vigencia del presente contrato.
                                       </li>
                                       <li>
                                            <strong>EL COMERCIO AFILIADO</strong> no podrá explotar económicamente, considerar como propiedad suya o 
                                            hacer uso para fines que no estén establecidos en este contrato, la información brindada por parte de <strong>PIXEL S.A.</strong> 
                                            y tampoco podrá ofrecer el mismo servicio o similar a este ni durante ni después de la relación que nazca de este 
                                            contrato.
                                       </li>
                                       <li>
                                            i. Cualquier violación a la confidencialidad por parte del Comercio Afiliado o de su personal lo hará responsable
                                             de las indemnizaciones pertinentes por los perjuicios causados, cuya cantidad se valora en la suma de cincuenta
                                              mil Dólares Americanos ($50,000.00). Manifiesta EL PROVEEDOR, que el COMERCIO AFILIADO, no será legalmente 
                                              responsable por violaciones de confidencialidades de terceros o extraños, como “Hackers” o similares, u obtenidas
                                               y divulgadas mediante cualquier otro medio delictuoso. Este acuerdo aplica de manera bilateral, teniendo que 
                                               comprobar la parte afectada culpabilidad en el mal manejo de dicha información. 
                                       </li>
                                   </ol>
                              </p>
                              <br>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
                                <li><button type="button" class="btn btn-primary next-step">Siguiente</button></li>
                            </ul>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="step5" style="margin:0; padding:0;">
                            <h3>CLAUSULAS</h3>
                            <p class="text-justify">
                                    <strong>DÉCIMO QUINTO: SOLUCIÓN DE CONTROVERSIAS.</strong>  Las partes acuerdan que para toda controversia relacionada o derivada de este 
                                    Contrato, será sometida a la decisión de un Tribunal Arbitral, bajo las reglas y disposiciones del Reglamento del Centro de 
                                    Conciliación y Arbitraje de la Cámara de Comercio e Industrias de Cortés, por lo que expresa y voluntariamente renuncian a 
                                    la jurisdicción de los Tribunales de Justicia de la República que les compete, y se someten a la del Centro de Conciliación 
                                    y Arbitraje de la Cámara de Comercio e Industrias de Cortés, ubicado en San Pedro Sula. 
                              </p>
                              <p class="text-justify">
                                    Este Tribunal Arbitral estará compuesto por tres (3) árbitros, cada parte nombrará (y sufragará los honorarios de) un 
                                    árbitro y el Centro de Conciliación y Arbitraje nombrará al tercer árbitro, cuyos honorarios serán divididos exactamente 
                                    entre las partes. Este contrato se regirá e interpretará según las leyes de la República de Honduras.
                              </p>
                              <p class="text-justify">
                                    El arbitraje tendrá una duración máxima de cuatro (4) meses. El idioma del arbitraje será el español.
                              </p>
                              <p class="text-justify">
                                    La decisión a la que llegue el Tribunal Arbitral tendrá el carácter de cosa juzgada para las partes, y será objeto 
                                    únicamente de los recursos que la ley específicamente señala.
                              </p>
                              <br>
                              <p class="text-justify">
                                    <strong>DÉCIMO SEXTO: LEGISLACIÓN APLICABLE:</strong> Para la aplicación e interpretación de este contrato se utilizarán 
                                    las fuentes de derecho de la República de Honduras.
                              </p>
                              <br>
                              <p class="text-justify">
                                    <strong>DÉCIMO SEPTIMO:</strong> CONSENTIMIENTO EXPRESO Y FIRMA:   Manifiestan las partes que la redacción de este contrato representa
                                    su voluntad completa y que deroga cualquier entendimiento previo, contractual o no, entre las partes sobre las materias 
                                    aquí acordadas y que las cláusulas y contenido contractual les representa un beneficio mutuo, y que conocen y asumen las 
                                    consecuencias de toda responsabilidad que las obligaciones de este contrato le generan, por lo que se comprometen a su 
                                    estricto cumplimiento. En fe de lo cual, firman el presente contrato en duplicado, en la ciudad de San Pedro Sula a los 
                                    ({{$contrato->contract_date->format('d')}}) días del mes de {{$contrato->getContractMonthLocalized()}} del año {{$contrato->contract_date->format('Y')}}.
                              </p>
                              <br>
                            @if ($contrato->contract_attachments)
                                <div class="attachments_container">
                                    <h3 class="text-warning">Anexos Contrato PixelPay-{{$contrato->company_social_reason}} </h3>
                                    <p>Los anexos relacionados al contrato se encuentran adjuntos en un archivo PDF, favor revisar los mismos en el siguiente link.</p>
                                    <a class="btn btn-primary" href="{{route('get-once-contract-attachments', ['id' => $contrato->id])}}" target="_blank" id="btn-anexos">ANEXOS DE CONTRATO</a>
                                    <div class="switch_container">
                                        <label class="switch">
                                            <input type="checkbox" id="agree" name="agree">
                                            <span class="slider round"></span>
                                        </label>
                                        <strong>Estoy de acuerdo que he leido los anexos del contrato</strong>
                                    </div>
                                </div>
                            @endif

                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
                                <li><button type="button" class="btn btn-primary next-step">Siguiente</button></li>
                                
                            </ul>

                        </div>
                        <div class="tab-pane" role="tabpanel" id="complete" style="margin:0; padding:0;">
                            <div class="container">
                                <h4 class="text-center">CONSOLIDACIÓN DE CONTRATO</h4>
                                <h6 class="text-center">FIRMA </h6>
                                <canvas width="800" height="500"></canvas>
                                <p class="signature-border">Firmar Aqui</p>
                                <input type="hidden" name="contract_signature">
                                <input type="hidden" name="legal_representative_rtn" value="{{ $contrato->legal_representative_rtn }}">
                                <div class="tab-pane" style="text-align:center;" role="tabpanel" id="complete">
                                    <button type="button" style="width:120px;" class="btn btn-default prev-step">Anterior</button>
                                    <button type="button" style="width:120px;" class="clearSign btn btn-success">Limpiar Firma</button>
                                    <button type="button" style="width:120px;" class="submitForm btn btn-primary">Firmar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
       </div>
    </div>
@endsection