<?php
include_once("models/UsuarioDAO.php");

class loginController{
    public function login(){
        include_once("views/login.php");
    }
    public function register(){
        include_once("views/register.php");
    }

    public function createAccount(){
        $email = $_POST['email'];
        $usuario = $_POST['nombre'];
        $passwd = $_POST['passwd'];
        $passwdHash = password_hash($passwd, PASSWORD_BCRYPT);

        UsuarioDAO::insertarUsuario($email, $usuario, $passwdHash);
    }

    public function getAccount() {
        $email = $_POST['email'];
        $passwd = $_POST['passwd'];

        $result = UsuarioDAO::iniciarsesion($email);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
    
            // Verificar la contraseña
            if (password_verify($passwd, $user['passwd'])) {
                session_destroy();
                session_start();
                $_SESSION['email'] = $email;

                header ("Location: /dashboard/Pizzettos/Pizzettos/?controller=producto&action=index");
            } else {
                return false; // Contraseña incorrecta
            }
        } else {
            return null; // Usuario no encontrado
        }
    }
}

?>