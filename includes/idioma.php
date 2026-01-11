<?php

    class Idioma {
        private static $instancia = null;

        public static $lit = array();

        private function __construct($idioma = 'ES') {

            // Ruta correcta: siempre apunta a /lang/es.txt dentro del proyecto
            $archivo = __DIR__ . '/../lang/es.txt';

            if (file_exists($archivo)) {

                $descriptor = fopen($archivo, 'r');

                if ($descriptor) {
                    while ($linea = fgets($descriptor)) {

                        $linea = trim($linea);

                        // Saltar líneas vacías
                        if ($linea === '') continue;

                        // Saltar líneas sin separador
                        if (!str_contains($linea, ':')) continue;

                        $partes_linea = explode(':', $linea, 2);

                        $clave = trim($partes_linea[0]);
                        $valor = trim($partes_linea[1]);

                        self::$lit[$clave] = $valor;
                    }

                    fclose($descriptor);
                }

            } else {
                // Si el archivo no existe, evitar errores
                self::$lit['error'] = "Archivo de idioma no encontrado: $archivo";
            }
        }

        public static function getInstancia(): Idioma {
            if (self::$instancia == null) {
                self::$instancia = new Idioma();
            }

            return self::$instancia;
        }

        static function lit($campo) {
            self::getInstancia();

            // Si la clave no existe, devolver algo seguro
            return self::$lit[$campo] ?? "[$campo]";
        }

        public function __clone() {
            
        }
    }