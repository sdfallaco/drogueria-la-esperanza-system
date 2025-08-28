<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($nombre, $email, $token)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarConfirmacion() {

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST']; // Servidor SMTP de Gmail
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT']; // Puerto SMTP de Gmail
        $mail->Username = $_ENV['EMAIL_USER']; // Tu correo electrónico de Gmail
        $mail->Password = $_ENV['EMAIL_PASS']; // Tu contraseña de Gmail
        $mail->SMTPSecure = 'tls'; // O 'ssl' si prefieres utilizar SSL
        
        $mail->setFrom('info@drogueriaesperanza.com', 'Droguería La Esperanza'); // Tu dirección de correo electrónico y nombre
        $mail->addAddress($this->email, $this->nombre); // Dirección de correo electrónico y nombre del destinatario
        $mail->Subject = 'Confirma tu cuenta';
        
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        
        $contenido = "<html>";
        $contenido .= "<p><Strong>Hola " . $this->nombre . "</strongp> Has creado tu cuenta en Drogueria la Esperanza. Solo debes confirmarla presionando el siguiente enlace:</p>";
        $contenido .= "<p> Presiona aquí: <a href='". $_ENV['LA_ESPERANZA'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a> </p>";
        $contenido .="<p>Si no solicitaste esta cuenta, puedes ignorar este mensaje.</p>";
        $contenido .= "</html>";
        
        $mail->Body = $contenido;
        
        // Envía el correo electrónico
        if($mail->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function enviarInstrucciones() {
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST']; // Servidor SMTP de Gmail
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT']; // Puerto SMTP de Gmail
        $mail->Username = $_ENV['EMAIL_USER']; // Tu correo electrónico de Gmail
        $mail->Password = $_ENV['EMAIL_PASS']; // Tu contraseña de Gmail
        $mail->SMTPSecure = 'tls'; // O 'ssl' si prefieres utilizar SSL
        
        $mail->setFrom('info@drogueriaesperanza.com', 'Droguería La Esperanza'); // Tu dirección de correo electrónico y nombre
        $mail->addAddress($this->email, $this->nombre); // Dirección de correo electrónico y nombre del destinatario
        $mail->Subject = 'Restablece tu password';
        
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        
        $contenido = "<html>";
        $contenido .= "<p><Strong>Hola " . $this->nombre . "</strongp> Has solicitado restablecer tu password presionando el siguiente enlace para hacerlo:</p>";
        $contenido .= "<p> Presiona aquí: <a href='". $_ENV['LA_ESPERANZA'] . "/recuperar?token=" . $this->token . "'>Restablecer Password</a> </p>";
        $contenido .="<p>Si no solicitaste esta cuenta, puedes ignorar este mensaje.</p>";
        $contenido .= "</html>";
        
        $mail->Body = $contenido;
        
        // Envía el correo electrónico
        if($mail->send()) {
            return true;
        } else {
            return false;
        }
    }
}

