<?php

namespace bloquesModelo\bloqueInicioSesion;

if (! isset ( $GLOBALS ["autorizado"] )) {
    include ("../index.php");
    exit ();
}

include_once ("core/manager/Configurador.class.php");
include_once ("core/connection/Sql.class.php");

/**
 * IMPORTANTE: Se recomienda que no se borren registros. Utilizar mecanismos para - independiente del motor de bases de datos,
 * poder realizar rollbacks gestionados por el aplicativo.
 */



class Sql extends \Sql {
    
    var $miConfigurador;
    
    function getCadenaSql($tipo, $variable = '') {
        
        /**
         * 1.
         * Revisar las variables para evitar SQL Injection
         */
        $prefijo = $this->miConfigurador->getVariableConfiguracion ( "prefijo" );
        $idSesion = $this->miConfigurador->getVariableConfiguracion ( "id_sesion" );
        
        $claveEncriptada = $this->miConfigurador->fabricaConexiones->crypto->codificar ($_REQUEST ['contraseña']);
         $claveEncriptadaRegistro = $this->miConfigurador->fabricaConexiones->crypto->codificar ($_REQUEST ['contraseñaRegistro']); 
        switch ($tipo) {
            
            /**
             * Clausulas específicas
             */
            case 'insertarRegistro' :
                $cadenaSql = 'INSERT INTO ';
                $cadenaSql .= $prefijo . 'pagina ';
                $cadenaSql .= '( ';
                $cadenaSql .= 'nombre,';
                $cadenaSql .= 'descripcion,';
                $cadenaSql .= 'modulo,';
                $cadenaSql .= 'nivel,';
                $cadenaSql .= 'parametro';
                $cadenaSql .= ') ';
                $cadenaSql .= 'VALUES ';
                $cadenaSql .= '( ';
                $cadenaSql .= '\'' . $_REQUEST ['nombrePagina'] . '\', ';
                $cadenaSql .= '\'' . $_REQUEST ['descripcionPagina'] . '\', ';
                $cadenaSql .= '\'' . $_REQUEST ['moduloPagina'] . '\', ';
                $cadenaSql .= $_REQUEST ['nivelPagina'] . ', ';
                $cadenaSql .= '\'' . $_REQUEST ['parametroPagina'] . '\'';
                $cadenaSql .= ') ';
                break;
            case 'insertarRegistroxUsuario' :
                $cadenaSql = 'INSERT INTO ';
                $cadenaSql .=  'virtus_usuario ';
                $cadenaSql .= '( ';
                $cadenaSql .= 'nombre,';
                $cadenaSql .= 'apellido,';
                $cadenaSql .= 'correo,';
                $cadenaSql .= 'telefono,';
                $cadenaSql .= 'imagen,';
                $cadenaSql .= 'clave,';
                $cadenaSql .= 'tipo,';
                $cadenaSql .= 'estilo,';
                $cadenaSql .= 'idioma,';
                $cadenaSql .= 'estado,';
                $cadenaSql .= 'edad,';
                $cadenaSql .= 'sexo,';
                $cadenaSql .= 'usuario';
                $cadenaSql .= ') ';
                $cadenaSql .= 'VALUES ';
            	$cadenaSql .= '( ';
            	$cadenaSql .= '\'' . $_REQUEST ['nombreRegistro'] . '\', ';
            	$cadenaSql .= '\'' . $_REQUEST ['apellidoRegistro'] . '\', ';
            	$cadenaSql .= '\'' . 'vacio' . '\', ';
            	$cadenaSql .= '\'' .  'vacio'. '\', ';
                $cadenaSql .= '\'' .  'vacio'. '\', ';
                $cadenaSql .= '\'' .  $claveEncriptadaRegistro . '\', ';
                $cadenaSql .= '\'' .  '""'. '\', ';
                $cadenaSql .= '\'' .  'basico'. '\', ';
                $cadenaSql .= '\'' .  'es_es'. '\', ';
            	$cadenaSql .= '0, ';
                $cadenaSql .= '0, ';
                $cadenaSql .= '\'' .  'N'. '\', ';
                $cadenaSql .= '\'' . $_REQUEST ['usuarioRegistro']. '\' ';
            	$cadenaSql .= ') ';
                echo $cadenaSql;
                break;
            case 'actualizarRegistro' :
                $cadenaSql = 'INSERT INTO ';
                $cadenaSql .= $prefijo . 'pagina ';
                $cadenaSql .= '( ';
                $cadenaSql .= 'nombre,';
                $cadenaSql .= 'descripcion,';
                $cadenaSql .= 'modulo,';
                $cadenaSql .= 'nivel,';
                $cadenaSql .= 'parametro';
                $cadenaSql .= ') ';
                $cadenaSql .= 'VALUES ';
                $cadenaSql .= '( ';
                $cadenaSql .= '\'' . $_REQUEST ['nombrePagina'] . '\', ';
                $cadenaSql .= '\'' . $_REQUEST ['descripcionPagina'] . '\', ';
                $cadenaSql .= '\'' . $_REQUEST ['moduloPagina'] . '\', ';
                $cadenaSql .= $_REQUEST ['nivelPagina'] . ', ';
                $cadenaSql .= '\'' . $_REQUEST ['parametroPagina'] . '\'';
                $cadenaSql .= ') ';
                break;
            
            case 'buscarRegistro' :
                
                $cadenaSql = 'SELECT ';
                $cadenaSql .= 'id_pagina as PAGINA, ';
                $cadenaSql .= 'nombre as NOMBRE ';
               //$cadenaSql .= 'descripcion as DESCRIPCION,';
               //$cadenaSql .= 'modulo as MODULO,';
               // $cadenaSql .= 'nivel as NIVEL,';
               // $cadenaSql .= 'parametro as PARAMETRO ';
                $cadenaSql .= 'FROM ';
                $cadenaSql .= $prefijo . 'pagina ';
                //$cadenaSql .= 'WHERE ';
                //$cadenaSql .= 'nombre=\'' . $_REQUEST ['nombrePagina'] . '\' ';
                break;
            
             case 'buscarRegistroxUsuario' :
                
                $cadenaSql = 'SELECT ';
                $cadenaSql .= 'id_usuario as ID_USUARIO, ';
                 $cadenaSql .= 'clave as CLAVE ';
               //$cadenaSql .= 'descripcion as DESCRIPCION,';
               //$cadenaSql .= 'modulo as MODULO,';
               // $cadenaSql .= 'nivel as NIVEL,';
               // $cadenaSql .= 'parametro as PARAMETRO ';
                $cadenaSql .= 'FROM ';
                $cadenaSql .= $prefijo . 'usuario ';
                $cadenaSql .= 'WHERE ';
                $cadenaSql .= 'usuario=\'' . $_REQUEST ['usuario']  . '\' AND ';
                $cadenaSql .= 'clave=\'' . $claveEncriptada . '\' ';
                break;
            
            case 'borrarRegistro' :
                $cadenaSql = 'INSERT INTO ';
                $cadenaSql .= $prefijo . 'pagina ';
                $cadenaSql .= '( ';
                $cadenaSql .= 'nombre,';
                $cadenaSql .= 'descripcion,';
                $cadenaSql .= 'modulo,';
                $cadenaSql .= 'nivel,';
                $cadenaSql .= 'parametro';
                $cadenaSql .= ') ';
                $cadenaSql .= 'VALUES ';
                $cadenaSql .= '( ';
                $cadenaSql .= '\'' . $_REQUEST ['nombrePagina'] . '\', ';
                $cadenaSql .= '\'' . $_REQUEST ['descripcionPagina'] . '\', ';
                $cadenaSql .= '\'' . $_REQUEST ['moduloPagina'] . '\', ';
                $cadenaSql .= $_REQUEST ['nivelPagina'] . ', ';
                $cadenaSql .= '\'' . $_REQUEST ['parametroPagina'] . '\'';
                $cadenaSql .= ') ';
                break;
        
        }
        
        return $cadenaSql;
    
    }
}
?>
