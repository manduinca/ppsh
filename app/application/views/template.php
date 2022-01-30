<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>SENCICO</title>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyALagnmY4oYwhho-vZQzK0STeu8lhDSBDo"></script>
		<script type="text/javascript" src="<?=base_url()?>static/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>static/js/gmaps.js"></script>
		<script type="text/javascript" src="<?=base_url()?>static/js/highcharts.js"></script>
		<script type="text/javascript" src="<?=base_url()?>static/js/highcharts-exporting.js"></script>
		<script type="text/javascript" src="<?=base_url()?>static/js/export-csv.js"></script>
		<link href='<?=base_url()?>static/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
		<link href='<?=base_url()?>static/css/estilo.css' rel='stylesheet' type='text/css' />
		<link href='<?=base_url()?>static/css/redesSociales.css' rel='stylesheet' type='text/css' />
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-149873321-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
		    function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'UA-149873321-1');
		</script>

		<script type="text/javascript">
			var map;
            function log10(n) {
                return Math.log(n) / Math.log(10);
            }
			$(document).ready(function(){
				var chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						type: 'line',
                        zoomType: 'xy'
					},
					title: {
						text: null,
						x: -20 //center
					},
                    xAxis: {
                        title: {
                            text: 'Aceleración espectral (g)'
                        },
						gridLineWidth: 1,
						gridZIndex: 4,
                        labels: {
                            formatter: function() {
                                return Math.pow(10, this.value).toFixed(3);
                            }
                        }
                    },
					yAxis: {
						title: {
							text: 'Probabilidad anual de excedencia (1/años)'
						},
                        max: 0,
                        min: -4,
                        startOnTick: false,
						plotLines: [
							{	value: Math.log10(1/475),
								width: 1.5,
								color: '#FA5858',
								label: {
									text: '1/475 años'
								}
							},
							{	value: Math.log10(1/2475),
								width: 1.5,
								color: '#FA5858',
								label: {
									text: '1/2475 años'
								}
							}
						],
                        labels: {
                            formatter: function() {
                                return Math.pow(10, this.value).toFixed(4);
                            }
                        }
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'middle',
						borderWidth: 0
					},
                    plotOptions: {
                        series: {
                            marker: {
                                enabled: false
                            }
                        }
                    },
					series: [{
						name: '5 %',
						data: []
					}],
                    tooltip: {
                        formatter: function() {
							return '(' + Math.pow(10, this.x).toFixed(2) + ', ' + Math.pow(10, this.y).toFixed(4) + ')';
                        }
                    }
				});
				
				var chart2 = new Highcharts.Chart({
					chart: {
						renderTo: 'container2',
						type: 'line',
					},
					title: {
						text: null,
						x: -20 //center
					},
                    xAxis: {
                        title: {
                            text: 'Periodo estructural (s)'
                        },
						gridLineWidth: 1,
						gridZIndex: 4
                    },
					yAxis: {
						title: {
							text: 'Aceleración espectral (g)'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'middle',
						borderWidth: 0
					},
                    plotOptions: {
                        series: {
                            marker: {
                                enabled: false
                            }
                        }
                    },
					series: [{
						name: '',
						data: []
					}],
                    tooltip: {
                        formatter: function() {
                            return '(' + this.x.toFixed(3) + ', ' + this.y.toFixed(4) + ')';
                        }
                    }
				});
				
				var chart3 = new Highcharts.Chart({
					chart: {
						renderTo: 'container3',
						type: 'line',
					},
					title: {
						text: null,
						x: -20 //center
					},
                    xAxis: {
                        title: {
                            text: 'Periodo estructural (s)'
                        },
						gridLineWidth: 1,
						gridZIndex: 4
                    },
					yAxis: {
						title: {
							text: 'Aceleración espectral (g)'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'middle',
						borderWidth: 0
					},
                    plotOptions: {
                        series: {
                            marker: {
                                enabled: false
                            }
                        }
                    },
					series: [{
						name: '',
						data: []
					}],
                    tooltip: {
                        formatter: function() {
                            return '(' + this.x.toFixed(3) + ', ' + this.y.toFixed(3) + ')';
                        }
                    }
				});
				
				map = new GMaps({
					div: '#map',
					lat: -9.7,
					lng: -74.4,
					zoom: 6
				});
				
				var point = map.addMarker({
					lat: -12.1,
					lng: -77.0,
					draggable: true,
					dragend: function(e) {
						var lat = point.getPosition().lat().toFixed(1); 
						var lon = point.getPosition().lng().toFixed(1);
						$('#lat').val(lat);
						$('#long').val(lon);
					}
				});

				$('#lat').val(-12.1);
				$('#long').val(-77.0);

				$('#btn-calc-pos').click(function() {
					$('#modal-loading').modal('show');
					var coord = $('#lat').val() + "\n" + $('#long').val();
					$('.coordenada').text(coord);	
					$('.percent-prob').prop('checked', false);
					$('.percent-tr-norma').prop('checked', false);
					$('.percent-tr').prop('checked', false);
					for (var i = chart.series.length - 1; i > 0; i--) 
						chart.series[i].remove();
					var seriesLength = chart2.series.length;
					for (var i = seriesLength - 1; i > -1; i--) {
						var name = chart2.series[i].name;
						if (name == '475' || name == '1000' || name == '2475') {
							chart2.series[i].remove();
						}
					}
					seriesLength = chart3.series.length;
					for(var i = seriesLength - 1; i > 0; i--) {
						//if (name == '475')
							chart3.series[i].remove();
					}
					
					$('#tipo option[value=e30_2015]').prop('selected', 'selected');
					$('.tipo_suelo').hide();
					$('#suelo_e30_2015').show();
					$('#suelo_e30_2015 option[value=1]').prop('selected', 'selected');
					
					$.ajax({
						url: '<?=base_url()?>api/points/location',
						type: 'GET',
						async: false,
						data: {
							lat: $('#lat').val(),
							long: $('#long').val()
						},
						dataType: "json",
						success: function (result) {
							if(result.status == 'error') {
								alert('No hay informacion para esta coordenada.');
							} else {
								$('#id').val(parseInt(result.data));
							}
						}
					});
					$.ajax({
						url: '<?=base_url()?>api/points/serie_one',
						type: 'GET',
						async: true,
						data: {
							location: $('#id').val(),
							p: $('#period').val()
						},
						dataType: "json",
						success: function (result) {
							var name = 'CPAE latitud ' + $('#lat').val() + ' longitud '
									+ $('#long').val();
							chart.options.exporting.filename = name;
							if (result.status == 'error') {
								alert('No hay informacion para este punto para el grafico de probabilidades.');
							} else {
								data = result.data;
								var series = [];
								$.each(data, function(key, value) {
									series.push([log10(parseFloat(value.x)), log10(parseFloat(value.y))]);
								});
								chart.series[0].setData(series);
							}
						}
					});
					$.ajax({
						url: '<?=base_url()?>api/points/serie_two',
						type: 'GET',
						async: true,
						data: {
							location: $('#id').val(),
							tr: $('#tr').val()
						},
						dataType: "json",
						success: function (result) {
							var name = 'EPU latitud ' + $('#lat').val() + ' longitud '
									+ $('#long').val();
							chart2.options.exporting.filename = name;
							if (result.status == 'error') {
								alert('No hay informacion para este punto para el grafico de peligros.');
							} else {
								data = result.data;
								var series = [];
								$.each(data, function(key, value) {
									series.push([parseFloat(value.x), parseFloat(value.y)]);
								});
								chart2.series[0].update({name: $('#tr').val()}, false);
								chart2.series[0].setData(series);
							}
							$('#modal-loading').modal('hide');
						}
					});
					
					$.ajax({
						url: '<?=base_url()?>api/points/serie_three',
						type: 'GET',
						async: true,
						data: {
							location: $('#id').val(),
							type: $('#tipo').val(),
							ground: $('#suelo_' + $('#tipo').val()).val()
						},
						dataType: "json",
						success: function (result) {
							var name = 'ED latitud ' + $('#lat').val() + ' longitud '
									+ $('#long').val();
							chart3.options.exporting.filename = name;
							if (result.status == 'error') {
								alert('No hay informacion para este punto para el grafico de espectros.');
							} else {
								data = result.data;
								var series = [];
								$.each(data, function(key, value) {
									series.push([parseFloat(value.x), parseFloat(value.y)]);
								});
								chart3.series[0].update({name: $('#tipo option:selected').text() + ' <br /> ' + $('#suelo_' + $('#tipo').val() + ' option:selected').text()}, false);
								chart3.series[0].setData(series);
							}
						}
					});
				});

				$('#period').change(function() {
					//$('#modal-loading').modal('show');
					$.ajax({
						url: '<?=base_url()?>api/points/serie_one',
						type: 'GET',
						async: true,
						data: {
							location: $('#id').val(),
							p: $('#period').val()
						},
						dataType: "json",
						success: function (result) {
							$('.percent-prob').prop('checked', false);
							for (var i = chart.series.length - 1; i > 0; i--) 
								chart.series[i].remove();
								//if(chart.series[i].name != "5 %") chart.series[i].remove();
							if (result.status == 'error') {
								alert('No hay informacion para este punto para el grafico de probabilidades.');
							} else {
								data = result.data;
								var series = [];
								$.each(data, function(key, value) {
									series.push([log10(parseFloat(value.x)), log10(parseFloat(value.y))]);
								});
								chart.series[0].setData(series);
							}
							//$('#modal-loading').modal('hide');
						}
					});
				});
				$('#btn-calc-tr').click(function() {
					//$('#modal-loading').modal('show');
					/*$('.percent-tr').each(function(index) {
						if ($(this).is(':checked')) {
							var seriesLength = chart2.series.length;
							for (var i = seriesLength - 1; i > -1; i--) {
								if (chart2.series[i].name.indexOf($(this).val()) > -1) {
									cahart2.series[i].remove();
								}
							}
							$(this).prop('checked', false);
						}
					});*/
					if ($('#tr').val() > 10000) {
						alert("El tiempo de retorno no puede exceder a 10 000 años");
						$('#tr').val('100');
					}
					var seriesLength = chart2.series.length;
					for (var i = seriesLength - 1; i > -1; i--) {
						if (chart2.series[i].name.indexOf('%') > -1) {
							chart2.series[i].remove();
						}
					}
					$.ajax({
						url: '<?=base_url()?>api/points/serie_two',
						type: 'GET',
						async: true,
						data: {
							location: $('#id').val(),
							tr: $('#tr').val()
						},
						dataType: "json",
						success: function (result) {
							if (result.status == 'error') {
								alert('No hay información para este punto para el gráfico de peligros.');
							} else {
								data = result.data;
								var series = [];
								$.each(data, function(key, value) {
									series.push([parseFloat(value.x), parseFloat(value.y)]);
								});
								chart2.series[0].update({name: $('#tr').val()}, false);
								chart2.series[0].setData(series);
							}
							//$('#modal-loading').modal('hide');
						}
					});
					$('#amortiguamiento-2').val(0);
					return false;
				});

				$('.percent-tr-norma').click(function() {
					if ($(this).is(':checked')) {
						//$('#modal-loading').modal('show');
						var tr = $(this).val();
						$.ajax({
							url: '<?=base_url()?>api/points/serie_two',
							type: 'GET',
							async: true,
							data: {
								location: $('#id').val(),
								tr: tr
							},
							dataType: "json",
							success: function (result) {
								if (result.status == 'error') {
									alert('No hay información para este punto para el gráfico de peligros');
								} else {
									data = result.data;
									var series = [];
									$.each(data, function(key, value) {
										series.push([parseFloat(value.x), parseFloat(value.y)]);
									});
									chart3.addSeries({
										name: tr,
										data: series,
										plotOptions: {
											series: {
												marker: {
													enabled: false
												}
											}
										}
									});
								}
								//$('#modal-loading').modal('hide');
							}
						});
					} else {
						var seriesLength = chart3.series.length;
						for (var i = seriesLength - 1; i > -1; i--) {
							if (chart3.series[i].name == $(this).val()) {
								chart3.series[i].remove();
							}
						}
					}
				});

				$('.percent-tr').click(function() {
					if ($(this).is(':checked')) {
						//$('#modal-loading').modal('show');
						var tr = $(this).val();
						$.ajax({
							url: '<?=base_url()?>api/points/serie_two',
							type: 'GET',
							async: true,
							data: {
								location: $('#id').val(),
								tr: tr
							},
							dataType: "json",
							success: function (result) {
								if (result.status == 'error') {
									alert('No hay información para este punto para el gráfico de peligros');
								} else {
									data = result.data;
									var series = [];
									$.each(data, function(key, value) {
										series.push([parseFloat(value.x), parseFloat(value.y)]);
									});
									chart2.addSeries({
										name: tr,
										data: series,
										plotOptions: {
											series: {
												marker : {
													enabled: false
												}
											}
										}
									});
								}
								//$('#modal-loading').modal('hide');
							}
						});
					} else {
						var seriesLength = chart2.series.length;
						for (var i = seriesLength - 1; i > -1; i--) {
							if (chart2.series[i].name == $(this).val()) {
								chart2.series[i].remove();
							}
						}
					}
				});

				$('#tipo').change(function() {
					$('.tipo_suelo').hide();
					$('#suelo_' + $(this).val()).show();
					$('#suelo_' + $(this).val() + ' option[value=5]').prop('selected', 'selected');
				});
				$('.tipo_suelo').change(function() {
					//$('#modal-loading').modal('show');
					if($('#suelo_' + $('#tipo').val()).val() != 5) {
						$.ajax({
							url: '<?=base_url()?>api/points/serie_three',
							type: 'GET',
							async: true,
							data: {
								location: $('#id').val(),
								type: $('#tipo').val(),
								ground: $('#suelo_' + $('#tipo').val()).val()
							},
							dataType: "json",
							success: function (result) {
								if (result.status == 'error') {
									alert('No hay informacion para este punto para el grafico de espectros.');
								} else {
									data = result.data;
									var series = [];
									$.each(data, function(key, value) {
										series.push([parseFloat(value.x), parseFloat(value.y)]);
									});
									var seriesLength = chart3.series.length;
									var ban = 0;
									for (var i = seriesLength - 1; i > -1; i--) {
										if (chart3.series[i].name == $('#tipo option:selected').text() + ' <br /> ' + $('#suelo_' + $('#tipo').val() + ' option:selected').text()) {
											ban = 1;
										}
									}
									if(ban == 0) {
										chart3.addSeries({
											name: $('#tipo option:selected').text() + ' <br /> ' + $('#suelo_' + $('#tipo').val() + ' option:selected').text(),
											data: series,
											plotOptions: {
												series: {
													marker: {
														enabled: false
													}
												}
											}
										});
									}
									//chart3.series[0].setData(series);
								}
								//$('#modal-loading').modal('hide');
							}
						});
					}
				});
				$('.percent-prob').change(function() {
					var tmp = $(this).val() / 100;
					if ($(this).is(':checked')) {
						if (tmp < 0.05) {
							valor = 2 * (tmp + 1) / (1 + 14.68 * Math.pow(tmp, 0.865));
						} else {
							valor = Math.pow((0.05 / tmp), 0.4);
						}
						var series = [];
						data_series = chart.series[0].data;
						for (key in data_series) {
							series.push([parseFloat(data_series[key].x), log10(parseFloat(Math.pow(10, data_series[key].y) * valor))]);
						}
						chart.addSeries({
							name: (tmp * 100).toFixed() + ' %',
							data: series,
                            plotOptions: {
                                series: {
                                    marker: {
                                        enabled: false
                                    }
                                }
                            },
						});
					} else {
						var seriesLength = chart.series.length;
						for (var i = seriesLength - 1; i > -1; i--) {
							if (chart.series[i].name == (tmp * 100).toFixed() + ' %') {
								chart.series[i].remove();
							}
						}
					}
				});
				$('#btn-delete-suelo').click(function() {
					$('.percent-tr-norma').prop('checked', false);
					var seriesLength = chart3.series.length;
					for(var i = seriesLength - 1; i > -1; i--) {
						chart3.series[i].remove();
					}
					return false;
				});
				$('#amortiguamiento-2').change(function() {
					var seriesLength = chart2.series.length;
					for (var i = seriesLength - 1; i > -1; i--) {
						if (chart2.series[i].name.indexOf('%') > -1) {
							chart2.series[i].remove();
						} else {
							data_series = chart2.series[i].data;
							if ($(this).val() != 0) {
								var tmp = $(this).val() / 100;
								if (tmp > 0.05) {
									valor = 2 * (tmp + 1) / (1 + 14.68 * Math.pow(tmp, 0.865));
								} else {
									valor = Math.pow((0.05 / tmp), 0.4);
								}
								var series = [];
								for (key in data_series) {
									console.log(valor);
									series.push([parseFloat(data_series[key].x), parseFloat(data_series[key].y * valor)]);
								}
								chart2.addSeries({
									name: chart2.series[i].name + ', ' + (tmp * 100).toFixed() + '%',
									data: series,
									plotOptions: {
										series: {
											marker: {
												enabled: false
											}
										}
									}
								});
							}
						}
					}
				});
			});
			
		</script>
	</head>
	<body><!--
		<div class="header clearfix">
			<img src="<?=base_url()?>static/img/sencico_logo.svg" width="30%" style="padding: 1% 1% 0% 1%" />
		</div>-->
		<div class="container" style="padding: 2% 5% 5% 5%">
		<!--	<div class="row marketing">
				<div class="col-lg-8">
					<h2>Peligro Sísmico en el Perú</h2>
				</div>
			</div>-->
			<br />
			<div class="row marketing">
				<div class="col-lg-12">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#tab_map">Selección de coordenada</a></li>
						<li><a data-toggle="tab" href="#home">Probabilidad anual de excedencia</a></li>
						<li><a data-toggle="tab" href="#menu1">Espectro de peligro uniforme</a></li>
						<li><a data-toggle="tab" href="#menu2">Espectro de diseño</a></li>
						<li><a data-toggle="tab" href="#menu3">Información</a></li>
					</ul>
					<div class="tab-content">
						<input id="id" type="text" style="display: none" value="" />
						<div id="tab_map" class="tab-pane fade in active">
							<br />
							<div class="row" style="text-align: center">
								<div class="col-lg-9" id="map" style="height: 800px;"></div>
								<div class="col-lg-3">
									<div class="row" style="text-align: center">
										<div class="col-lg-6">
											<label for="sel1">Latitud: </label>
										</div>
										<div class="col-lg-6">
											<input id="lat" name="lat" type="text" class="form-control col-lg-2" value="-10.1" />
										</div>
									</div>
									<br />
									<div class="row" style="text-align: center">
										<div class="col-lg-6">
											<label for="sel1">Longitud: </label>
										</div>
										<div class="col-lg-6">
											<input id="long" name="long" type="text" class="form-control col-lg-2" value="-77.0" />
										</div>
									</div>
									<br />
									<a id="btn-calc-pos" class="btn btn-primary">Seleccionar coordenada</a>
								</div>
							</div>
						</div>
						<div id="home" class="tab-pane fade">
							<br />
							<div class="row" style="text-align: center">
								<div class="col-lg-1" style="text-align: left">
									<label for="sel1">Latitud: <br/> Longitud:</label>
								</div>
								<div class="col-lg-1">
									<label class="coordenada" style="font-size: 1.2em" for="sel1"></label>
								</div>
								<div class="col-lg-9">
									<div class="col-lg-2">
										<label for="sel1">Periodo(s):</label>
									</div>
									<div class="col-lg-2">
										<select id="period" class="form-control col-lg-1">
											<option>0.00</option>
											<option>0.05</option>
											<option>0.075</option>
											<?php for ($i = 2; $i <=20; $i++) : ?>
											<option><?=number_format($i*0.05, 2) ?></option>
											<?php endfor; ?>
											<?php for ($j = 11; $j <=30; $j++) : ?>
											<option><?=number_format($j*0.1, 2) ?></option>
											<?php endfor; ?>
										</select>
									</div>
									<div class="col-lg-1">
										<input class="percent-prob" type="checkbox" value="2" />
										<label >2 %</label> 
									</div>
									<div class="col-lg-1">
										<input class="percent-prob" type="checkbox" value="3" />
										<label >3 %</label> 
									</div>
									<div class="col-lg-1">
										<input class="percent-prob" type="checkbox" value="4" />
										<label >4 %</label> 
									</div>
									<div class="col-lg-1">
										<input class="percent-prob" type="checkbox" value="6" />
										<label >6 %</label> 
									</div>
									<div class="col-lg-1">
										<input class="percent-prob" type="checkbox" value="7" />
										<label >7 %</label> 
									</div>
									<div class="col-lg-1">
										<input class="percent-prob" type="checkbox" value="8" />
										<label >8 %</label> 
									</div>
									<div class="col-lg-1">
										<input class="percent-prob" type="checkbox" value="9" />
										<label >9 %</label> 
									</div>
									<div class="col-lg-1">
										<input class="percent-prob" type="checkbox" value="10" />
										<label >10 %</label> 
									</div>
								</div>
							</div>
							<br />
							<div id="container" style="min-width: 80%; height: 80%; margin: 0 auto"></div>
						</div>
						<div id="menu1" class="tab-pane fade">
							<br />
							<div class="row" style="text-align: center">
								<div class="col-lg-1" style="text-align: left">
									<label for="sel1">Latitud: <br/> Longitud:</label>
								</div>
								<div class="col-lg-1">
									<label class="coordenada" style="font-size: 1.2em" for="sel1"></label>
								</div>
								<div class="col-lg-2">
									<label for="sel1">Periodo de retorno (años) :</label>
								</div>
								<div class="col-lg-2">
									<input id="tr" name="tr" type="text" class="form-control col-lg-2" value="100" />
								</div>
								<div class="col-lg-1">
									<a id="btn-calc-tr" href="#" class="btn btn-primary">Calcular</a>
								</div>
								<div class="col-lg-1">
									<input class="percent-tr" type="checkbox" value="475" />
									<label>475</label>
								</div>
								<div class="col-lg-1">
									<input class="percent-tr" type="checkbox" value="1000" />
									<label>1000</label>
								</div>
								<div class="col-lg-1">
									<input class="percent-tr" type="checkbox" value="2475" />
									<label>2475</label>
								</div>
								<div class="col-lg-2">
									<select id="amortiguamiento-2" class="form-control col-lg-2">
										<option value="0">5 %</option>
										<option value="2">2 %</option>
										<option value="3">3 %</option>
										<option value="4">4 %</option>
										<option value="6">6 %</option>
										<option value="7">7 %</option>
										<option value="8">8 %</option>
										<option value="9">9 %</option>
										<option value="10">10 %</option>
									</select>
								</div>
							</div>
							<br />
							<div id="container2" style="min-width: 80%; height: 80%; margin: 0 auto" ></div>
						</div>
						<div id="menu2" class="tab-pane fade">
							<br />
							<div class="row" style="text-align: center">
								<div class="col-lg-1" style="text-align: left">
									<label for="sel1">Latitud: <br/> Longitud:</label>
								</div>
								<div class="col-lg-1">
									<label class="coordenada" style="font-size: 1.2em" for="sel1"></label>
								</div>
								<div class="col-lg-1">
									<label for="sel1">Tipo :</label>
								</div>
								<div class="col-lg-2">
									<select id="tipo" class="form-control col-lg-2">
										<option value="e30_2003">E.030-2006</option>
										<option value="e30_2015">E.030-2016</option>
										<option value="e30_2015_esp">E.030-2016 (Z específico)</option>
										<option value="ibc">IBC-2015</option>
									</select>
								</div>
								<div class="col-lg-1">
									<label for="sel1">Tipo de suelo :</label>
								</div>
								<div class="col-lg-2">
									<select id="suelo_e30_2003" class="tipo_suelo form-control col-lg-2">
										<option value="5"></option>
										<option value="0">S1: Roca o suelos rígidos</option>
										<option value="1">S2: Suelos intermedios</option>
										<option value="2">S3: Suelos flexibles o con estrato de gran espesor</option>
									</select>
									<select id="suelo_e30_2015" class="tipo_suelo form-control col-lg-2" style="display: none;">
										<option value="5"></option>
										<option value="0">S0: Roca dura</option>
										<option value="1">S1: Roca o suelos muy rígidos</option>
										<option value="2">S2: Suelos intermedios</option>
										<option value="3">S3: Suelos blandos</option>
									</select>
									<select id="suelo_e30_2015_esp" class="tipo_suelo form-control col-lg-2" style="display: none;">
										<option value="5"></option>
										<option value="0">S0: Roca dura</option>
										<option value="1">S1: Roca o suelos muy rígidos</option>
										<option value="2">S2: Suelos intermedios</option>
										<option value="3">S3: Suelos blandos</option>
									</select>
									<select id="suelo_ibc" class="tipo_suelo form-control col-lg-2" style="display: none;">
										<option value="5"></option>
										<option value="0">A: Roca muy dura</option>
										<option value="1">B: Roca</option>
										<option value="2">C: Roca blanda o suelo muy denso</option>
										<option value="3">D: Suelo firme</option>
										<option value="4">E: Suelo blando</option>
									</select>
								</div>
								<div class="col-lg-2">
									<a id="btn-delete-suelo" href="#" class="btn btn-primary">Borrar Espectros</a>
								</div>
								<div class="col-lg-2">
									<input class="percent-tr-norma" type="checkbox" value="475" />
									<label>Epu 475 años</label>
								</div>
							</div>
							<br />
							<div id="container3" style="min-width: 80%; height: 80%; margin: 0 auto" ></div>
						</div>
						<div id="menu3" class="tab-pane fade">
							<br />
							<p>
								Para sugerencias y consultas comuníquese con nosotros al telefóno <strong> 01 211 6300</strong> anexo <strong>2603</strong> y/o al correo <strong>gesparza@sencico.gob.pe</strong>
							</p>
							<br />
							<div class="row" style="text-align: center">
								<div class="col-lg-6">
									<h4 style="text-align:center">Manual de usuario</h4>
									<iframe src="http://docs.google.com/gview?url=<?=base_url()?>static/manual.pdf&embedded=true" style="width:500px; height:500px; margin: 0 auto; display:block;" frameborder="0"></iframe>
								</div>
								<div class="col-lg-6">
									<h4 style="text-align:center">Informe técnico</h4>
									<iframe src="http://docs.google.com/gview?url=<?=base_url()?>static/informe.pdf&embedded=true" style="width:500px; height:500px; margin: 0 auto; display:block;" frameborder="0"></iframe>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--
		<div id="copyrightContainer" class="row-fluid">
			<div id="nxZonaBloque10" class="container">
				<div class="bloqueZona10 infoFooter">
					<div class="tabla1 tablaBloque475">
						<div class="contenido1">
							<h1 class="logoFooter">
								SENCICO - SERVICIO NACIONAL DE CAPACITACIÓN PARA LA INDUSTRIA DE LA CONTRUCCIÓN <a href="http://www.sencico.gob.pe/index.php" target="_blank"><img alt="SENCICO - SERVICIO NACIONAL DE CAPACITACIÓN PARA LA INDUSTRIA DE LA CONTRUCCIÓN" src="<?=base_url()?>static/img/sencico_logo_2.svg" style="float:left" title="SENCICO - SERVICIO NACIONAL DE CAPACITACIÓN PARA LA INDUSTRIA DE LA CONTRUCCIÓN"></a>
							</h1>
							<p>
								<strong>SENCICO ©2015</strong><br>
								<a href="http://www.sencico.gob.pe/index.php#">Políticas de seguridad</a> - 
								<a href="http://www.sencico.gob.pe/publicaciones.php?id=322" target="_blank">Mapa del sitio</a> - 
								<a href="http://www.sencico.gob.pe/index.php#">Términos de buen uso</a>
							</p>
						</div>
					</div>
				</div>
				<div class="bloqueZona10 redesSociales">
					<div class="enlacesGenerales1 tablaBloque1300">
						<div class="contenido1">
							<ul class="enlace1">
								<li>
									<a href="http://www.youtube.com/user/1SENCICOTV" title="SENCICO TV" class="youtube" target="_blank"><span class="icon-"></span>Youtube</a>
								</li>
								<li>
									<a href="http://www.sencico.gob.pe/publicaciones.php?id=327" title="Correo Institucional" class="correo" target="_blank"><span class="icon-"></span>Correo Institucional</a>
								</li>
								<li>
									<a href="http://www.sencico.gob.pe/faq.php" title="Preguntas Frecuentes" class="preguntas" target="_blank"><span class="icon-"></span>Preguntas Frecuentes</a>
								</li>
							</ul>
						</div>
					</div>
				</div> -->
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="modal-loading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Calculando</h4>
					</div>
					<div class="modal-body">
						Espere mientras se calculan las curvas...
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
