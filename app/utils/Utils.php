<?php


namespace utils;
use \model\Model;

use \PDO;
use \PDOException;
use \Exception;

require_once "../models/Model.php";


class Utils
{


    /**
     * Inicia conexión con una base de datos.
     * @return PDO Devuelve una conexión PDO
     */
    public static function connectBD()
    {
        require_once "global.php";
        // Definimos conBD
        $conBD = null;

        //Englobamos el codigo en un try/catch para que en caso de error de conexión
        //se lance un objeto PDOException
        try {
            //Para establecer una conexion, creamos una instancia de la clase PDO.
            //Se le pasarán como argumentos el host, el nombre de la base de datos, 
            //el usuario y su contraseña en caso de que tuviese una.
            //En mi caso, no he especificado contrasenia porque no tengo.
            //Si usase contraseá, la añadiría después de $DB_USER
            return $conBD = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_SCHEMA, DB_USER);
        } catch (PDOException $e) {
            //Llamamos a la funcion save_log_error de la misma clase
            self::save_log_error($e->getMessage());
            //Devolvemos $conBD, que será null si no se pudo realizar la conexion 
            //correctamente.
            return $conBD;
            //Alias de exit(), finaliza el script. 
            die();
        } catch (Exception $e) {
            //Llamamos a la funcion save_log_error de la misma clas
            self::save_log_error($e->getMessage());
            //Devolvemos $conBD, que será null si no se pudo realizar la conexion 
            //correctamente.
            return $conBD;
            //Alias de exit(), finaliza el script. 
            exit();
        }
    }









    /***********************************************************************
     *                                                                     *
     *                         EXCEPCIONES - LOG                           *
     *                                                                     *
     ***********************************************************************/

    /**
     * Guarda las excepciones en un log, indicando la fecha y hora en el que se produjo
     */
    public static function save_log_error($error, $path = "../logs/log.log")
    {
        //Utilizamos error_log que envia un mensaje de error según lo indicado
        //Le pasamos el error (que pasamos con print_r para que se vea más claro)
        //Indicamos que el tipo de registro es 3, lo que indica que el mensaje
        //se adjuntará al archivo de destino
        //Y por último la ruta del archivo
        //Utilizamos date para que saque la fecha y hora actual
        error_log(print_r(date("Y-m-d H:i:s") . ": " . $error . "\xA", true), 3, $path);

        try {
            // Utilizamos error_log para enviar el mensaje de error al archivo de log
            error_log(print_r(date("Y-m-d H:i:s") . ": " . $error . "\xA", true), 3, $path);
        } catch (Exception $e) {
            // Si se genera una excepción, la capturamos aquí y la mostramos o la guardamos en otro lugar si es necesario
            echo "Error al guardar en el log: " . $e->getMessage();
        }
    }






    /***********************************************************************
     *                                                                     *
     *                ENVIAR CORREO (CAMBIAR O INFORMAR PASSW)             *
     *                                                                     *
     ***********************************************************************/

    public static function generate_token_email_link($isEmail = false) {
        $token = hash("sha256", bin2hex(random_bytes(16))); // Generamos un token aleatorio
        $t_expires = date("Y-m-d H:i:s", time() + 6 * 300); //Ponemos que solo sean 30 minutos y usamos date para generar un valor que podamos guardar en la variable creada en la base de datos   
        $array_token = [];
        if($isEmail) {
           $array_token = ['reset_token_email_hash' => $token, 't_reset_token_email_expires_at' => $t_expires];
        }else{
            $array_token = ['reset_token_psswd_hash' => $token, 't_reset_token_psswd_expires_at' => $t_expires];
        }
        return $array_token; // Devolvemos un array 
    }

    public static function send_email(array $data) {
        // URL de la API
        $url = '';//'.sendinblue.com/v3/smtp/email';  https://api

        // API KEY
        $apiKey = '';//

        // VARIABLES NECESARIAS PARA EL CORREO ELECTRÓNICO
        $subject = $data["subject"]; // ASUNTO
        // CONTENIDO HTML
        // $htmlContent = '<p>Tu código de activación es: '.$data["codActivacion"].'</p>';        
        $htmlContent = self::content_email($data);
        $senderEmail = 'patas-arriba.info@soporte.com';
        //$senderEmail = 'paulamorenohermoso99@gmail.com';
        $senderName = 'Soporte';
        $recipientEmail = $data["email"];

        $data = array(
            'sender' => array('name' => $senderName, 'email' => $senderEmail),
            'to' => array(array('email' => $recipientEmail)),
            'subject' => $subject,
            'htmlContent' => $htmlContent
        );

        $data_string = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'api-key: ' . $apiKey
        ));

        $response = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($response, true);
    }

    public static function content_email(array $data) {        
        if ($data["subject"] == 1) {
            $msg = '<p class="message">Estimado ' . $data["name"] . ',</p>
                <p class="message">Te damos la bienvenida a ¡Patas arriba! Esperamos que disfrutes de tu experiencia.</p>
                <p class="message">Para comenzar en nuestra plataforma, necestiamos que verifiques tu cuenta mediante el código de acceso proporcionado:</p>
                <span style="display:inline-block; width:100%; text-align:center; color:#426081; text-weight:bold; margin-top:25px;">PaTasARRiba2023</span>
                <p class="message">Por favor, ingresa este código en la plataforma para completar tu registro.</p>
                <p class="message">¡Gracias por unirte a nosotros!</p>';
            } elseif ($data["subject"] == Constants::SEND_RESET_PSSWD_SUBJECT) {
                $msg = '<p class="message">' . $data["name"] . ',</p>
                    <p class="message">Le informamos que su contraseña ha sido modificada con éxito.</p>
                    <p class="message">Si usted no ha realizado la modificación, haga click en el siguiente botón para modificar la contraseña: </p>';
            }elseif($data["subject"] == Constants::SEND_RESET_EMAIL_SUBJECT){
                $msg = '<p class="message">Estimado ' . $data["name"] . ',</p>
                    <p class="message">Le informamos que se ha realizado un cambio en su dirección de correo electrónico en nuestra plataforma.A continuación, se le especificarán los cambios realizados: <br/></p>
                    <p class="message">Antiguo correo electrónico: ' . $data['old_email'] . '</p>
                    <p class="message">Nuevo correo electrónico: ' . $data['new_email'] . '</p>
                    <p class="message">Si no has realizado la modificación, por favor haga click en el botón de "Restablecer". En caso de que el enlace haya expirado, póngase en contacto con nuestro soporte en el número de teléfono proporcionado en el pie del mensaje</p>';
            }

        $emailContent = '<!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Recuperar contraseña</title>
            <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" type="text/css">
            <link rel="shortcut icon" href="../public/imgs/logos/logo1.png" type="image/x-icon">
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    background-color: #ffffff;
                    color: #000000;
                    font-family: "Lato", sans-serif;
                    font-size: 16px;
                    line-height: 1.5;
                }

                .container {
                    width: 100%;
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                }

                .logo {
                    text-align: center;
                    margin-bottom: 20px;
                    height: 70px;
                    background: #a8b9e0;
                    width: 70px;
                    padding: 1.3em;
                    border-radius: 50%;
                    box-sizing: border-box;
                    margin: 0 auto;
                }

                .logo img {
                    object-fit: contain;
                    width: 100%;
                    height: 100%;
                }

                .header {
                    padding: 1em;
                    background: #a8b9e0;
                    border-bottom: 5px solid #425C81;
                }

                .header h1 {
                    font-size: 1.5rem;
                    color: #fbfbfb;
                    letter-spacing: .5em;
                    font-weight: 300;
                }

                .title h3 {
                    font-size: 1.3rem;
                    color: #426081;
                }

                .title,
                .header {
                    margin: 0 auto;
                    text-align: center;
                    margin-bottom: 20px;
                    font-weight: bold;
                    text-transform: uppercase;
                }

                .content {
                    padding: 30px;
                    padding-top:10px;
                    border-radius: 4px;
                    margin-bottom: 20px;
                }

                .message {
                    margin-bottom: 20px;
                    color: gray;
                    font-size: .8em;
                }

                .button-container {
                    text-align: center;
                    margin: 3em;
                }

                .button {
                    display: inline-block;
                    background-color: #426081;
                    padding: 12px 24px;
                }

                .button-container a {
                    text-decoration: none;
                    color: white;
                    text-transform: uppercase;
                    font-size: 1rem;
                    padding: .5em 1em;
                }

                .footer {
                    background-color: #a8b9e0;
                    padding: 20px;
                    text-align: center;
                    color: #ffffff;
                }

                .footer p {
                    margin: 0;
                    padding: 0;
                    font-size: 14px;
                }
            </style>
        </head>

        <body>
            <div class="container">
                <div class="header">
                    <h1>PATAS ARRIBA</h1>
                </div>
                <div class="title">
                    <div class="logo">
                        <img src="https://www.pngkit.com/png/full/333-3331142_white-lock-png-download-white-padlock-icon-png.png" alt="Logo" />
                    </div>
                    <div style="width:75%; margin: 3em auto 0; text-align:center;">
                        <h3>' . $data["subject"] . '<h3>
                    </div>                    
                </div>
                <div class="content">
                    ' . $msg .
                    ((isset($data["link"])) ? '<div class="button-container">
                        <a href="' . $data["link"] . '" class="button"> Restablecer </a>
                    </div>' : "")
                    . (($data["subject"] != null) ? "<i class='message fst-italic'>Por favor, ignora este mensaje si has realizado la acción.</i>" : "") .
                    '<p class="message">Atentamente, </p>
                    <p class="message">¡Patas arriba!</p>
            </div>
                <div class="footer">
                    <p>Patas Arriba</p>
                    <p>C/ No existente 4, nº 3G</p>
                    <p>+111223344</p>
                </div>
            </div>
        </body>

        </html>';

        return $emailContent;
    }









    /***********************************************************************
     *                                                                     *
     *                               IMÁGENES                              *
     *                                                                     *
     ***********************************************************************/
    /**
     * Funcion para guardar una imagen
     * @param array $file Array con los datos de la imagen.
     * @return mixed Devuelve la ruta en la que se encuentra la imagen, si existe un problema, devuelve false
     */
    public static function save_img($file)
    {
        //Creamos una constante que es para el tamaño máximo permitido
        if(!defined('MAX_SIZE')){
            define("MAX_SIZE", 2097152);
        }
        //Definimos un array con posibles extensiones válidas para una imagen
        $extension = ["img/png", "img/jpeg", "img/gif", "image/svg", "image/jpg"];
        //Comprobamos si es una imagen.
        if (!getimagesize($file["tmp_name"]) && !in_array($file["type"], $extension)) {
            return false;
        }

        //Comprobamos que el tamaño sea menor al tamaño máximo permitido
        if ($file["size"] > MAX_SIZE) {
            return false;
        }

        $end = explode(".", $file["name"]);
        $file_name = uniqid() . "." . end($end);
        //Carpeta de destino
        // $file_path = "./public/imgs/schema" . $file_name;
        $file_path = "../../public/imgs/schema" . $file_name;

        //Usamos move_uploaded_file para mover el archivo subido a la carpeta indicada
        //Utilizamos $file["tmp_name] porque es la ubicación temporal donde se encuentra
        //el archivo subido, el segundo argumento es la ruta al repositorio
        move_uploaded_file($file["tmp_name"], $file_path);
        //Devolvemos la url
        return $file_path;
    }


    /**
     * Elimina la imagen especificada de la carpeta
     * @param String $file_path String con la ruta de la imagen (esta incluida)
     */
    public static function delete_img(String $file_path)
    {
        //Utilizamos file_exist para comprobar que el archivo existe
        if (!file_exists($file_path)) {
            return false;
        }

        //Eliminamos la imagen
        return unlink($file_path);
    }






    
    /***********************************************************************
     *                                                                     *
     *                               CHECK SESSION                         *
     *                                                                     *
     ***********************************************************************/

    public static function is_logged_in(){
        if(!empty($_SESSION['login']))
        {
            return true;
        }

        $cookie = $_COOKIE['remem'] ?? null;

        if($cookie && strstr($cookie, ":"))
        {
            $mo = new Model();

            $cookie_array = explode(":", $cookie);
            $token_key = $cookie_array[0];
            $token_value = $cookie_array[1];

            $query = "SELECT * FROM USERS WHERE TOKEN_KEY = '$token_key' LIMIT 1";
            $remember_user_array = $mo->query($query)[0];

            if($token_value == $remember_user_array['token_value']){
                $_SESSION['login'] = true;
                return true;
            }
        }
        return false;
    }
}

// var_dump(Utils::send_email(["subject" => 1, "content" => 1, "nombre" => "Rosalía", "email" => "thejokerjune@gmail.com", "url" => "twitter.com"]));
// var_dump(Utils::connectBD());