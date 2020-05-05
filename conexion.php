<?php

    $direccion='127.0.0.1';
    $usuario='root';
    $password='';
    $bd='eventopj_db';
	$miconex=new mysqli($direccion,$usuario,$password,$bd);
	//comprobar conexion
	if($miconex->connect_errno)
	{
		die("Fallo la conexion[".$miconex->connect_error."]");
	}

	function hora_bd($hora)
	{
		$hora_bd=date('H:i:s',strtotime($hora));
		return $hora_bd;
	}
	function fecha_mostrar($fecha)
	{
		$fecha_ver=date('d-m-Y',strtotime($fecha));
		return $fecha_ver;
	}

	function fecha_mostrar2($fecha)
	{
		date_default_timezone_set('America/Lima');
		setlocale(LC_TIME, 'spanish');

		$fecha_ver2=strftime('%A',strtotime($fecha))." ".date('d',strtotime($fecha)).strftime(' de %B',strtotime($fecha))." del ".date('Y',strtotime($fecha));
		return $fecha_ver2;
	}
	function hora_mostrar($hora)
	{
		$hora_ver=date('h:i A',strtotime($hora));
		return $hora_ver;
	}
	function fecha_hora_mostrar($hora)
	{
		$fecha_hora_ver=date('d-m-Y h:i A',strtotime($hora));
		return $fecha_hora_ver;
	}
	function fecha_actual()
	{
		date_default_timezone_set('America/Lima');
		$fecha_hoy=date("Y-m-d");
		return $fecha_hoy;
	}
?>
