<!-- Optional header components (ex: slider) -->
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
            <li class="progtrckr-done"><a>Fecha</a></li>
            <li class="progtrckr-done"><a>Orden</a></li>
            <li class="progtrckr-done"><a>Datos</a></li>
            <li class="progtrckr-done">Confirmar</li>
         </ol>
		 
		 <!-- ORDEN 4 -->

		      <div class="row">
				   <div class="col-md-2"></div>
                   <div class="col-md-8">
				   
					<div class="panel panel-default">
					  <!-- Default panel contents -->
					 
					  <div class="panel-body">
					   <div class="row">
					      <div class="col-md-9">
						    <center>
							 <h1>Orden: AXD45T<h1/>
							</center>	
						  </div>
					      <div class="col-md-3">
						    <center>
							  <img src="<?=base_url() ?>static/images/logo-primos-blanco.png" style="height:30px;">
							  primos.pe
							  (01) 975561187
							  reservas@primos.pe
						    </center>	
						  </div>
					   </div>
					  
						<div class="row">
						  <div class="col-md-9">
						      <div class="row">
							     <div class="col-md-3"><strong>Reservado por: </strong></div>
								 <div class="col-md-9">Russel Collad Vidal</div>
							  </div>
							  <div class="row">
							     <div class="col-md-3"><strong>Entregar a: </strong></div>
								 <div class="col-md-9">Russel Collad Vidal</div>
							  </div>
							   <div class="row">
							     <div class="col-md-3"><strong>Direccion: </strong></div>
								 <div class="col-md-9">Av. Saragoza 345 Pabellon J</div>
							  </div>
							  <div class="row">
							     <div class="col-md-3"><strong>Telefono: </strong></div>
								 <div class="col-md-9">(01) 975561187</div>
							  </div>
							  <div class="row">
							     <div class="col-md-3"><strong>Correo: </strong></div>
								 <div class="col-md-9">russelcv@gmail.com</div>
							  </div>
							  <div class="row">
							     <div class="col-md-3"><strong>Fehca Reserva: </strong></div>
								 <div class="col-md-9">sabado 27 febrero, 2016 - 10:45am</div>
							  </div>
							  <div class="row">
							     <div class="col-md-3"><strong>Fehca Entrega: </strong></div>
								 <div class="col-md-9">martes 01 febrero, 2016 - 3:45pm  </div>
							  </div>
						  </div>
						</div>
					  </div>	
					  <!-- Table -->
					  <table class="table table-responsive table-striped">
                            <tbody>
                                <tr>
                                    <th>Producto</th>
                                    <th>Descripcion</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
									<th>Opcion</th>	
                                </tr>
                            
                                <tr>
                                    <td><img src="<?=base_url() ?>static/images/products/male-businessman.png" class="img-center" alt=""></td>
                                    <td><a href="">Camisa</a></td>
                                    <td>RON 300.99</td>
                                    <td>
										<input type="number" name="cant" value="2" style="width:60px; text-align:center; margin-right:5px; height:34px;">
									</td>
                                    <td>S/.8</td>
									<td class="remove-cell"><a href="" class="cart-remove" title="Remove item"><i class="fa fa-times-circle fa-2x"></i></a></td>
                                </tr>
                                <tr>
                                    <td><img src="<?=base_url() ?>static/images/products/female-black-dress.png" class="img-center" alt=""></td>
                                    <td><a href="">Vestido Largo</a></td>
                                    <td>RON 300.99</td>
                                    <td>
									   <input type="number" name="cant" value="2" style="width:60px; text-align:center; margin-right:5px; height:34px;">
									</td>
                                    <td>S/.12</td>
									<td class="remove-cell"><a href="" class="cart-remove" title="Remove item"><i class="fa fa-times-circle fa-2x"></i></a></td>
                                </tr>
                                <tr>
                                    <td><img src="<?=base_url() ?>static/images/products/black-tie.png" class="img-center" alt=""></td>
                                    <td><a href="">Corbata</a></td>
                                    <td>RON 300.99</td>
                                    <td>
										<input type="number" name="cant" value="1" style="width:60px; text-align:center; margin-right:5px; height:34px;">
									</td>
                                    <td>S/.6</td>
									<td class="remove-cell"><a href="" class="cart-remove" title="Remove item"><i class="fa fa-times-circle fa-2x"></i></a></td>									
                                </tr>
								
                            </tbody>
                        </table>
						<div class="panel-footer">Panel footer</div>
					</div>		
					
                   </div>
				 <div class="col-md-2"></div>
               </div>
				<div class="row">
				   <div class="col-md-2"></div>
				    <div class="col-md-4">
                       <a href="<?=base_url() ?>home/order3" class="btn btn-lg btn-block btn-alt btn-icon btn-icon btn-icon-go pull-right">
                           <span>Anterior paso</span>
                       </a>
                   </div>
                   <div class="col-md-4">
                       <a href="#" class="btn btn-lg btn-block btn-base btn-icon btn-icon-right btn-icon-go pull-right">
                           <span>Confirmar</span>
                       </a>
                   </div>
				   <div class="col-md-2"></div>
               </div>
		
    </div>
</section>