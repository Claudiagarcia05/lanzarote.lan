<?php

    class Template {
        public function __construct($templateDir='tpl') {
            $this->templateDir = rtrim($templateDir,'/');
        }

        public function render($file,$vars = []) {
            $path = "{$this->templateDir}/{$file}.tpl";

            if (!file_exists($path))
                throw new Exception("La plantilla {$file} no existe en {$this->templateDir}");

            $contenido = file_get_contents($path);

            foreach ($vars as $key => $value) {
                $contenido = preg_replace('/{{\s*'. preg_quote($key,'/') .'\s*}}/', htmlspecialchars($value),$contenido );
            }

            return $contenido;
        }

        static function header($titulo,$descripcion='',$author='1DAW') {
            $template = new Template();

            return $template->render('header',[
                'titulo'      => $titulo,
                'description' => $descripcion,
                'author'      => $author,
                'base'        => BASE_URL
            ]);
        }

        static function nav() {
            $template = new Template();

            return $template->render('navegacion',[
                'portfolio' => Idioma::lit('portfolio'),
                'acercade'  => Idioma::lit('acercade'),
                'contacto'  => Idioma::lit('contacto'),
                'usuarios'  => Idioma::lit('usuarios'),
                'horario'   => Idioma::lit('horario'),
                'aula'      => Idioma::lit('aula'),
                'base'      => BASE_URL
            ]);
        }

        static function footer() {
            $template = new Template();

            return $template->render('footer',[
                'base' => BASE_URL
            ]);
        }

        static function seccion($seccion) {
            switch($seccion) {

                case 'usuarios':
                    $contenido = UsuarioController::pintar();
                break;

                case 'horario':
                    $contenido = CalendarioController::pintar();
                break;

                case 'aulas':
                    if (isset($_GET['accion']) && $_GET['accion'] == 'crear') {
                        $contenido = AulasController::crear();
                    } elseif (isset($_GET['accion']) && $_GET['accion'] == 'editar') {
                        $contenido = AulasController::editar();
                    } elseif (isset($_GET['accion']) && $_GET['accion'] == 'eliminar') {
                        $contenido = AulasController::eliminar();
                    } else {
                        $contenido = AulasController::pintar();
                    }
                break;

                case 'tutores':
                    if (isset($_GET['accion']) && $_GET['accion'] == 'crear') {
                        $contenido = TutoresController::crear();
                    } elseif (isset($_GET['accion']) && $_GET['accion'] == 'editar') {
                        $contenido = TutoresController::editar();
                    } elseif (isset($_GET['accion']) && $_GET['accion'] == 'eliminar') {
                        $contenido = TutoresController::eliminar();
                    } else {
                        $contenido = TutoresController::pintar();
                    }
                break;

                case 'profesores':
                    if (isset($_GET['accion']) && $_GET['accion'] == 'crear') {
                        $contenido = ProfesoresController::crear();
                    } elseif (isset($_GET['accion']) && $_GET['accion'] == 'editar') {
                        $contenido = ProfesoresController::editar();
                    } elseif (isset($_GET['accion']) && $_GET['accion'] == 'eliminar') {
                        $contenido = ProfesoresController::eliminar();
                    } else {
                        $contenido = ProfesoresController::pintar();
                    }
                break;

                default:
                    $contenido = PortadaController::pintar();
                break;
            }

            return $contenido;
        }

        static function navegacion($total,$pagina,$seccion="usuarios") {
            if ($total == 0) return '';

            $pagina_actual = $pagina - 1;

            $pagina_anterior = $pagina_actual - 1;
            if ($pagina_anterior < 0) $pagina_anterior = 0;

            $pagina_siguiente = $pagina_actual + 1;

            $html = "<nav class=\"mt-3 mb-3\">";

            if ($pagina_actual > 0) {
                $html .= "<a href=\"".BASE_URL."{$seccion}/{$pagina_anterior}\" class=\"btn btn-secondary me-2\">&laquo; Anterior</a>";
            }

            $html .= "<a href=\"".BASE_URL."{$seccion}/{$pagina_siguiente}\" class=\"btn btn-secondary\">Siguiente &raquo;</a>";

            $html .= "</nav>";

            return $html;
        }
    }