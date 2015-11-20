<?

namespace bloquesModelo\bloqueInicioSesion;

if (! isset ( $GLOBALS ["autorizado"] )) {
    include ("../index.php");
    exit ();
}

include_once ("core/manager/Configurador.class.php");

class Frontera {
    
    var $ruta;
    var $sql;
    var $funcion;
    var $lenguaje;
    var $miFormulario;
    
    var 

    $miConfigurador;
    
    function __construct() {
        
        $this->miConfigurador = \Configurador::singleton ();
    
    }
    
    public function setRuta($unaRuta) {
        $this->ruta = $unaRuta;
    }
    
    public function setLenguaje($lenguaje) {
        $this->lenguaje = $lenguaje;
    }
    
    public function setFormulario($formulario) {
        $this->miFormulario = $formulario;
    }
    
    function frontera() {
        $this->html ();
    }
    
    function setSql($a) {
        $this->sql = $a;
    
    }
    
    function setFuncion($funcion) {
        $this->funcion = $funcion;
    
    }
    
    function html() {
    	
        //conexion a la BD para validacion inicio de sesion
        $this->ruta=$this->miConfigurador->getVariableConfiguracion("rutaBloque");
        $conexion='estructura';
        $esteRecurso=$this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);
        
        
        if(isset($_REQUEST['opcion'])){
            
              if($_REQUEST['botonInicioSesion']=='true'){
                  $auxiliar = $this->sql->getCadenaSql("buscarRegistroxUsuario");
                   $matrizItems=$esteRecurso->ejecutarAcceso($auxiliar, "busqueda");
                //si no esta vacia
                if(!empty($matrizItems)){
                    
                    $_REQUEST['opcion']='ingresa';
                }
                else{
                   
                    $_REQUEST['opcion']='accesoDenegado';
                   
                }
             
                switch ($_REQUEST['opcion']){
                    
        		case "ingresa":
        			include_once ($this->ruta . "/formulario/tabla.php");
        			break;
                        case "accesoDenegado":
                                echo"<script>alert('Usuario o contraseña incorrecta')</script>"; 
        			include_once ($this->ruta . "/formulario/contenido.php");
        		break;    
        	}
                  
              }
              if($_REQUEST['botonRegistro']=='true'){
                  
                    if(!empty($_REQUEST['nombreRegistro']) AND !empty($_REQUEST['apellidoRegistro']) AND !empty($_REQUEST['usuarioRegistro']) AND !empty($_REQUEST['contraseñaRegistro']) ){
                        if($_REQUEST['contraseñaRegistro']==$_REQUEST['confirmaContraseña']){
                        $auxiliar = $this->sql->getCadenaSql("insertarRegistroxUsuario");
                        echo $esteRecurso->ejecutarAcceso($auxiliar, "acceso");
                       
                        $_REQUEST['opcion']='ingresa';
                        }
                        else{
                            
                            $_REQUEST['opcion']='accesoDenegado';
                        }    
                    }
                        
                  
                    
                    else{
                         $_REQUEST['opcion']='accesoDenegado';
                    }
                     switch ($_REQUEST['opcion']){
                    
        		case "ingresa":
        			//nclude_once ($this->ruta . "/formulario/tabla.php");
                               
        			break;
                        case "accesoDenegado":
                                echo"<script>alert('Verifique la contraseña o que todos los campos esten suministrados')</script>"; 
        			include_once ($this->ruta . "/formulario/contenido.php");
        		break;    
        	      }
                    
                  }
              
            
                
        }
         
        else{
        	include_once ($this->ruta . "/formulario/contenido.php");
        }
       
    }

}
?>
