<?php

require_once 'models/usuarioModel.php';

    class usuarioController{
        public function index(){
            echo "Controlador Usuarios, Accion Index";
        }

        public function registro(){
            require_once 'views/usuarios/registro.php';
        }

        public function save(){

            $errores = array();

            if(isset($_POST)){
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false ;
                $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : false ;
                $email = isset($_POST['email']) ? $_POST['email'] : false ;
                $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false ;

                if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
                    $nombre_valido = true;
                }else{
                    $nombre_valido = false;
                    $errores['nombre'] = "el nombre no es valido";
                }

                if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)){
                    $apellido_valido = true;
                }else{
                    $apellido_valido = false;
                    $errores['apellido'] = "el apellido no es valido";
                }

                if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) ){
                    $email_valido = true;
                }else{
                    $email_valido = false;
                    $errores['email'] = "el email no es valido";
                }

                if(!empty($contrasena)){
                    $contrasena_valido = true;
                }else{
                    $contrasena_valido = false;
                    $errores['password'] = "La Contraseña esta vacia";
                }

                if($nombre && $apellido && $email && $contrasena && $nombre_valido && $apellido_valido && $email_valido && $contrasena_valido){
                    $usuario = new usuario;
                    $usuario->setNombre($nombre);
                    $usuario->setApellidos($apellido);
                    $usuario->setEmail($email);
                    $usuario->setPassword($contrasena);

                    $save = $usuario->save();
                    if($save = true){
                        $_SESSION['register'] = "complete";
                    }else{
                        $_SESSION['register'] = 'failed';
                    }
                }else{
                    $_SESSION['errores'] = $errores;
                    $_SESSION['register'] = 'failed';
                }    
            }else{
                $_SESSION['register'] = 'failed';  
            }
            header("Location:".base_url."usuario/registro");
        }

        public function login(){
            if(isset($_POST)){
                // Identificar el usuario

                //Consulta a la base de datos
                $usuario = new usuario();
                $usuario->setEmail($_POST['email']);
                $usuario->setPassword($_POST['password']);
                
                $identity = $usuario->login();
                
                if($identity && is_object($identity)){
                    $_SESSION['identity'] = $identity;

                    if($identity->rol == 'admin'){
                        $_SESSION['admin'] = true;
                    }
                }else{
                    $_SESSION['error_login'] = "Email o Contraseña incorrectas";
                }
                //Crear Sesion
            }
            header("Location:".base_url);
        }

        public function logout(){

            if(isset($_SESSION['identity'])){
                unset($_SESSION['identity']);
            }

            if(isset($_SESSION['admin'])){
                unset($_SESSION['admin']);
            }

            header("Location:".base_url);
        }
    }

?>