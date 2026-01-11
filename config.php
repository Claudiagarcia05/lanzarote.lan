<?php

    // includes/config.php

    // Definir separador de directorios según el sistema operativo
    define('DS', DIRECTORY_SEPARATOR);

    // Definir ruta base del proyecto
    define('BASE_PATH', dirname(dirname(__FILE__)));

    // Detectar sistema operativo
    define('IS_WINDOWS', stripos(PHP_OS, 'WIN') === 0);
    define('IS_LINUX', !IS_WINDOWS);

    // Configuración de rutas
    class PathConfig {
        private static $paths = [];
        
        public static function init() {
            // Rutas principales
            self::$paths = [
                'assets' => BASE_PATH . DS . 'assets',
                'css' => BASE_PATH . DS . 'css',
                'js' => BASE_PATH . DS . 'js',
                'img' => BASE_PATH . DS . 'img',
                'includes' => BASE_PATH . DS . 'includes',
                'lang' => BASE_PATH . DS . 'lang',
                'tpl' => BASE_PATH . DS . 'tpl',
                'tablas' => BASE_PATH . DS . 'tablas',
                'node_modules' => BASE_PATH . DS . 'node_modules',
                'plantilla' => BASE_PATH . DS . 'assets' . DS . 'plantilla'
            ];
        }
        
        public static function get($key) {
            return self::$paths[$key] ?? BASE_PATH;
        }
        
        public static function url($path = '') {
            // Obtener la URL base del proyecto
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'];
            $script = dirname($_SERVER['SCRIPT_NAME']);
            
            // Limpiar barras dobles
            $baseUrl = rtrim($protocol . '://' . $host . $script, '/');
            $path = ltrim($path, '/');
            
            return $baseUrl . ($path ? '/' . $path : '');
        }
        
        public static function file($relativePath) {
            // Normalizar ruta para cualquier SO
            $path = str_replace(['/', '\\'], DS, $relativePath);
            return BASE_PATH . DS . $path;
        }
    }

    // Inicializar configuración
    PathConfig::init();