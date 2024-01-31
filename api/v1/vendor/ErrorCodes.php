<?php

class ErrorCodes {
    const HTTP_CODE_200 = 200;
    const HTTP_CODE_400 = 400;
    const HTTP_CODE_404 = 404;
    const HTTP_CODE_500 = 500;
    const HTTP_CODE_501 = 501;


    /**
     * Funcion para establecer la cabecera de respuesta a 200.
     * set header and http_response_code
     */
    public static function setHeader200() {
        header("HTTP/1.1 " .self::HTTP_CODE_200." OK" , true, self::HTTP_CODE_200);
        http_response_code(self::HTTP_CODE_200);
    }

     /**
     * Funcion para establecer la cabecera de respuesta a 400.
     * set header and http_response_code
     */
    public static function setHeader400() {
        header("HTTP/1.1 " .self::HTTP_CODE_400." Not Found" , true, self::HTTP_CODE_400);
        http_response_code(self::HTTP_CODE_400);
    }

    /**
     * Funcion para establecer la cabecera de respuesta a 404.
     * set header and http_response_code
     */
    public static function setHeader404() {
        header("HTTP/1.1 " .self::HTTP_CODE_404." Not Found" , true, self::HTTP_CODE_404);
        http_response_code(self::HTTP_CODE_404);
    }

    /**
     * Funcion para establecer la cabecera de respuesta a 500.
     * set header and http_response_code
     */
    public static function setHeader500() {
        header("HTTP/1.1 ".self::HTTP_CODE_500." Not Found" , true, self::HTTP_CODE_500);
        http_response_code(self::HTTP_CODE_500);
    }

    /**
     * Funcion para establecer la cabecera de respuesta a 501.
     * set header and http_response_code
     */
    public static function setHeader501() {
        header("HTTP/1.1 ".self::HTTP_CODE_501." Not Implemented" , true, self::HTTP_CODE_501);
        http_response_code(self::HTTP_CODE_501);
    }
}

?>