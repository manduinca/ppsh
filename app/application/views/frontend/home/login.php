<!-- CONTENIDO INICIAR SESSION -->
        <div class="pg-opt"> 
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Iniciar sesión</h2>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb">
                        <li><a href="#">Inicio</a></li>
                        <li class="active">Sign in</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="slice bg-white">
        <div class="wp-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                        <div class="wp-block default user-form"> 
                            <div class="form-header">
                                <h2>Iniciar sesión en su cuenta</h2>
                            </div>
                            <div class="form-body">
                                <form action="" id="frmLogin" class="sky-form">                                    
                                    <fieldset>                  
                                        <section>
                                            <div class="form-group">
                                                <label class="label">Email</label>
                                                <label class="input">
                                                    <i class="icon-append fa fa-user"></i>
                                                    <input type="email" name="email">
                                                </label>
                                            </div>     
                                        </section>
                                        <section>
                                            <div class="form-group">
                                                <label class="label">Password</label>
                                                <label class="input">
                                                    <i class="icon-append fa fa-lock"></i>
                                                    <input type="email" name="email">
                                                </label>
                                            </div>     
                                        </section> 
                                        <section>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="checkbox"><input type="checkbox" name="remember" checked><i></i>No cerrar sesión</label>
                                                </div>
                                            </div>
                                        </section>

                                        <section>
												<a href="<?=base_url() ?>home/profile" class="btn btn-base btn-sign-in pull-right">Iniciar</a>
                                            <!--<button class="btn btn-base btn-icon btn-icon-right btn-sign-in pull-right" type="submit">
                                                <span>Iniciar</span>
                                            </button>
											-->
                                        </section>
                                    </fieldset>  
                                </form>    
                            </div>
                            <div class="form-footer">
                                <p>Olvidaste tu contraseña? <a href="#">Haga clic aquí para recuperar.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
    </section>