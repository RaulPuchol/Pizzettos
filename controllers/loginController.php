<?php
include_once("models/UsuarioDAO.php"); // incluir el archivo de la clase UsuarioDAO

class loginController{
    public function login(){ // función que muestra la vista de login
        include_once("views/login.php");
    }
    public function register(){ // función que muestra la vista de registro
        include_once("views/register.php");
    }
    public function profile(){ // función que muestra la vista de perfil
        include_once("views/profile.php");
    }
    public function pedidos(){ // función que muestra la vista de pedidos
        include_once("views/pedidos.php");
    }

    public static function nombrePedido($emailCarrito) { // función que obtienes los pedidos de un usuario
        return UsuarioDAO::pedidos($emailCarrito);
    }

    public function createAccount(){ // función que crea una cuenta
        $email = $_POST['email'];
        $usuario = $_POST['nombre'];
        $passwd = $_POST['passwd'];
        $passwdHash = password_hash($passwd, PASSWORD_BCRYPT);

        UsuarioDAO::insertarUsuario($email, $usuario, $passwdHash);
    }

    public function getAccount($email, $passwd) { // función que inicia sesión
        //$email = $_POST['email'];
        //$passwd = $_POST['passwd'];

        $result = UsuarioDAO::iniciarsesion($email);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
    
            // Verificar la contraseña
            if (password_verify($passwd, $user['passwd'])) {
                session_destroy();
                session_start();
                $_SESSION['email'] = $email;
                UsuarioDAO::logLogin($email, date("Y-m-d H:i:s"), "Sesion iniciada");
                header ("Location: /dashboard/Pizzettos/Pizzettos/?controller=producto&action=index");
            } else {
                echo"<p>Usuario o Contraseña incorrectas</p>";
            }
        } else {
            echo"<p>Usuario o Contraseña incorrectas</p>";
        }
    }

    public function logout(){ // función que cierra sesión
        session_start();
        UsuarioDAO::logLogout($_SESSION['email'], date("Y-m-d H:i:s"), "Sesion cerrada");
        session_destroy();
        header ("Location: /dashboard/Pizzettos/Pizzettos/?controller=producto&action=index");
    }
}

?>