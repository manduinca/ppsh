<!-- Menu de navegacion superior -->
<div class="pg-opt">
  <div class="container">
   <div class="row">
      <div class="col-md-6">
        <h2>Ordenar</h2>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb">
          <li><a href="#">Inicio</a></li>
          <li class="active">Ordenar</li>
        </ol>
      </div>
   </div>
  </div>
</div> 
	
    <!-- CONTENIDO ORDENAR -->
<section class="slice bg-white">	
  <div class="container">
		<!-- PROGRESO DEL ORDEN -->
    <ol class="progtrckr hidden-xs" data-progtrckr-steps="4">
      <li class="progtrckr-done">Fecha</li>
      <li class="progtrckr-todo">Orden</li>
      <li class="progtrckr-todo">Datos</li>
      <li class="progtrckr-todo">Confirmar</li>
    </ol>

		 <!-- ORDEN 2 -->
		<div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <div class="panel panel-default panel-sidebar-1">
               <div class="panel-heading">
                   <h2>Fecha de recojo</h2>
               </div>
               <div class="panel-body bb">
                   <form role="form" class="form-light">
                       <label for="">Seleccione una fecha</label>
                       <div class="input-group">
                           <input type="text" class="form-control left">
                           <span class="input-group-btn">
                               <button class="btn btn-base" type="button">Fecha</button>
                           </span>
                       </div>
                   </form>
               </div>

               <div class="panel-body bb">
				          <label for="">Para el día 5 de marzo, tenemos disponible los siguientes horarios</label>
                       <table class="table table-cart-subtotal">
                          <tbody>
                            <tr>
                              <td colspan="2" class="no-padding">
                                <div class="form-group">
                                  <form role="form" class="form-light">
                                      <select class="form-control">
                                          <option>de 07:00am a 08:00am</option>
												                  <option>de 08:00am a 09:00am</option>
												                  <option>de 09:00am a 10:00am</option>
												                  <option>de 10:00am a 11:00am</option>
												                  <option>de 11:00am a 12:00am</option>
												                  <option>de 02:00pm a 03:00pm</option>
												                  <option>de 03:00pm a 04:00pm</option>
												                  <option>de 04:00pm a 05:00pm</option>
												                  <option>de 05:00pm a 06:00pm</option>
												                  <option>de 06:00pm a 07:00pm</option>
												                  <option>de 07:00pm a 08:00pm</option>
												                  <option>de 08:00pm a 09:00pm</option>
												                  <option>de 09:00pm a 10:00pm</option>
                                      </select>
                                  </form>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                       </table>
                </div>
            </div>
        </div>
			
		   <div class="col-md-4">
               <div class="panel panel-default panel-sidebar-1">
                   <div class="panel-heading">
                       <h2>Fehca de entrega</h2>
                   </div>
                   <div class="panel-body bb">
                       <form role="form" class="form-light">
                           <label for="">Seleccione una fecha</label>
                           <div class="input-group">
                               <input type="text" class="form-control left">
                               <span class="input-group-btn">
                                   <button class="btn btn-base" type="button">Fecha</button>
                               </span>
                           </div>
                       </form>
                   </div>
                   <div class="panel-body bb">
				       <label for="">Para el día 5 de marzo, tenemos disponible los siguientes horarios</label>
                       <table class="table table-cart-subtotal">
                           <tbody>
                               <tr>
                                   <td colspan="2" class="no-padding">
                                       <div class="form-group">
                                           <form role="form" class="form-light">
                                               <select class="form-control">
                                                   <option>de 7:00am a 8:00am</option>
												   <option>de 8:00am a 9:00am</option>
												   <option>de 9:00am a 10:00am</option>
												   <option>de 10:00am a 11:00am</option>
												   <option>de 11:00am a 12:00am</option>
												   <option>de 2:00pm a 3:00pm</option>
												   <option>de 3:00pm a 4:00pm</option>
												   <option>de 4:00pm a 5:00pm</option>
												   <option>de 5:00pm a 6:00pm</option>
												   <option>de 6:00pm a 7:00pm</option>
												   <option>de 7:00pm a 8:00pm</option>
												   <option>de 8:00pm a 9:00pm</option>
												   <option>de 9:00pm a 10:pm</option>
                                               </select>
                                           </form>
                                       </div>
                                   </td>
                               </tr>
                           </tbody>
                       </table>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-12">
                       <a href="<?=base_url() ?>home/order2" class="btn btn-lg btn-block btn-alt btn-icon btn-icon-right btn-icon-go pull-right">
                           <span>Siguiente paso</span>
                       </a>
                   </div>
               </div>
           </div>
		   <div class="col-md-2"></div>
    </div>
  </div>
</section>