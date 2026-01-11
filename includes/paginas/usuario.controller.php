<?php

    if (Campo::val('modo') == 'ajax') {
        define(
            'BOTON_ENVIAR',
            "<button onclick=\"fetchJSON('/usuarios/" . Campo::val('oper') . "/" . Campo::val('id') . "?modo=ajax','formulario');return false\" class=\"btn btn-primary\">" .
            Idioma::lit('enviar' . Campo::val('oper')) .
            "</button>"
        );
    } else {
        define(
            'BOTON_ENVIAR',
            "<button type=\"submit\" class=\"btn btn-primary\">" .
            Idioma::lit('enviar' . Campo::val('oper')) .
            "</button>"
        );
    }

    class UsuarioController {
        static $nick, $password, $oper, $id, $paso, $nombre, $apellidos, $email;

        static function pintar() {
            $contenido = '';

            self::inicializacion_campos();

            switch (Campo::val('oper')) {
                case 'cons':
                    $contenido = self::cons();
                    break;
                case 'modi':
                    $contenido = self::modi();
                    break;
                case 'baja':
                    $contenido = self::baja();
                    break;
                case 'alta':
                    $contenido = self::alta();
                    break;
                default:
                    $contenido = self::listado();
                    break;
            }

            if (Campo::val('modo') != 'ajax') {
                $h1cabecera = "<h1>" .
                    Idioma::lit('titulo' . Campo::val('oper')) . " " .
                    Idioma::lit(Campo::val('seccion')) .
                    "</h1>";
            }

            return "
            <div class=\"container contenido\">
                <section class=\"page-section usuarios\" id=\"usuarios\">
                    {$h1cabecera}
                    {$contenido}
                </section>
            </div>
            ";
        }

        static function inicializacion_campos() {
            self::$paso      = new Hidden(['nombre' => 'paso']);
            self::$oper      = new Hidden(['nombre' => 'oper']);
            self::$id        = new Hidden(['nombre' => 'id']);
            self::$nick      = new Text(['nombre' => 'nick']);
            self::$nombre    = new Text(['nombre' => 'nombre']);
            self::$apellidos = new Text(['nombre' => 'apellidos']);
            self::$password  = new Password(['nombre' => 'password']);
            self::$email     = new IEmail(['nombre' => 'email']);

            Formulario::cargar_elemento(self::$paso);
            Formulario::cargar_elemento(self::$oper);
            Formulario::cargar_elemento(self::$id);
            Formulario::cargar_elemento(self::$nick);
            Formulario::cargar_elemento(self::$password);
            Formulario::cargar_elemento(self::$nombre);
            Formulario::cargar_elemento(self::$apellidos);
            Formulario::cargar_elemento(self::$email);
        }

        static function formulario($boton_enviar = '', $errores = [], $mensaje_exito = '', $disabled = '') {
            Formulario::disabled($disabled);

            Campo::val('paso', '1');

            return Formulario::pintar('/usuarios/', $boton_enviar, $mensaje_exito);
        }

        static function sincro_form_bbdd($registro) {
            Formulario::sincro_form_bbdd($registro);
        }

        static function cons() {
            $usuario = new Usuario();
            $registro = $usuario->recuperar(Campo::val('id'));

            self::sincro_form_bbdd($registro);

            return self::formulario('', [], '', " disabled=\"disabled\" ");
        }

        static function baja() {
            $boton_enviar = BOTON_ENVIAR;
            $mensaje_exito = '';
            $disabled = " disabled=\"disabled\" ";

            if (!Campo::val('paso')) {
                $usuario = new Usuario();
                $registro = $usuario->recuperar(Campo::val('id'));
                self::sincro_form_bbdd($registro);

            } else {
                $usuario = new Usuario();

                $datos_actualizar = [
                    'fecha_baja' => date('Y-m-d')
                ];

                $usuario->actualizar($datos_actualizar, Campo::val('id'));

                $mensaje_exito = '<p class="centrado alert alert-success">' .
                    Idioma::lit('operacion_exito') .
                    '</p>';

                $boton_enviar = '';
            }

            return self::formulario($boton_enviar, [], $mensaje_exito, $disabled);
        }

        static function modi() {
            $boton_enviar = BOTON_ENVIAR;
            $mensaje_exito = '';
            $disabled = '';

            if (!Campo::val('paso')) {
                $usuario = new Usuario();
                $registro = $usuario->recuperar(Campo::val('id'));
                self::sincro_form_bbdd($registro);

            } else {
                $numero_errores = Formulario::validacion();

                if (!$numero_errores) {
                    $usuario = new Usuario();

                    $datos_actualizar = [
                        'nick'      => Campo::val('nick'),
                        'nombre'    => Campo::val('nombre'),
                        'apellidos' => Campo::val('apellidos'),
                        'email'     => Campo::val('email'),
                        'password'  => Campo::val('password')
                    ];

                    $usuario->actualizar($datos_actualizar, Campo::val('id'));

                    $mensaje_exito = '<p class="centrado alert alert-success">' .
                        Idioma::lit('operacion_exito') .
                        '</p>';

                    $disabled = " disabled=\"disabled\" ";
                    $boton_enviar = '';
                }
            }

            return self::formulario($boton_enviar, [], $mensaje_exito, $disabled);
        }

        static function alta() {
            $boton_enviar = BOTON_ENVIAR;
            $mensaje_exito = '';
            $disabled = '';

            if (Campo::val('paso')) {
                $numero_errores = Formulario::validacion();

                if (!$numero_errores) {
                    $nuevo_usuario = [
                        'nick'      => Campo::val('nick'),
                        'nombre'    => Campo::val('nombre'),
                        'apellidos' => Campo::val('apellidos'),
                        'email'     => Campo::val('email'),
                        'password'  => Campo::val('password')
                    ];

                    $usuario = new Usuario();
                    $usuario->insertar($nuevo_usuario);

                    $mensaje_exito = '<p class="centrado alert alert-success">' .
                        Idioma::lit('operacion_exito') .
                        '</p>';

                    $disabled = " disabled=\"disabled\" ";
                    $boton_enviar = '';
                }
            }

            return self::formulario($boton_enviar, [], $mensaje_exito, $disabled);
        }

        static function listado() {

            // Paginación segura
            $pagina = Campo::val('pagina') ?? 0;
            if (!is_numeric($pagina)) $pagina = 0;

            $offset = LISTADO_TOTAL_POR_PAGINA * $pagina;
            $pagina++;

            $usuario = new Usuario();

            // Mostrar solo usuarios activos (fecha_baja NULL)
            $datos_consulta = $usuario->get_rows([
                'where' => [
                    'fecha_baja' => null
                ],
                'limit'  => LISTADO_TOTAL_POR_PAGINA,
                'offset' => $offset
            ]);

            $listado_usuarios = '';
            $total_registros = 0;

            if (!empty($datos_consulta)) {
                foreach ($datos_consulta as $registro) {

                    $botonera = "
                        <a onclick=\"fetchJSON('".BASE_URL."usuarios/cons/{$registro['id']}?modo=ajax')\" data-bs-toggle=\"modal\" data-bs-target=\"#ventanaModal\" class=\"btn btn-secondary\"><i class=\"bi bi-search\"></i></a>
                        <a onclick=\"fetchJSON('".BASE_URL."usuarios/modi/{$registro['id']}?modo=ajax')\" data-bs-toggle=\"modal\" data-bs-target=\"#ventanaModal\" class=\"btn btn-primary\"><i class=\"bi bi-pencil-square\"></i></a>
                        <a onclick=\"fetchJSON('".BASE_URL."usuarios/baja/{$registro['id']}?modo=ajax')\" data-bs-toggle=\"modal\" data-bs-target=\"#ventanaModal\" class=\"btn btn-danger\"><i class=\"bi bi-trash\"></i></a>
                    ";

                    $listado_usuarios .= "
                        <tr>
                            <th style=\"white-space:nowrap\" scope=\"row\">{$botonera}</th>
                            <td>{$registro['nick']}</td>
                            <td>{$registro['nombre']}</td>
                            <td>{$registro['apellidos']}</td>
                            <td>{$registro['email']}</td>
                            <td>" . fmto_fecha($registro['fecha_alta']) . "</td>
                            <td>" . fmto_fecha($registro['fecha_baja']) . "</td>
                        </tr>
                    ";

                    $total_registros++;
                }
            }

            $barra_navegacion = Template::navegacion($total_registros, $pagina);

            return "
                <table class=\"table\">
                <thead>
                    <tr>
                    <th scope=\"col\">#</th>
                    <th scope=\"col\">Nick</th>
                    <th scope=\"col\">Nombre</th>
                    <th scope=\"col\">Apellidos</th>
                    <th scope=\"col\">Email</th>
                    <th scope=\"col\">Fecha Alta</th>
                    <th scope=\"col\">Fecha Baja</th>
                    </tr>
                </thead>
                <tbody>
                {$listado_usuarios}
                </tbody>
                </table>
                {$barra_navegacion}

                <a onclick=\"fetchJSON('".BASE_URL."usuarios/alta?modo=ajax')\" 
                data-bs-toggle=\"modal\" 
                data-bs-target=\"#ventanaModal\"
                class=\"btn btn-primary\">
                <i class=\"bi bi-file-earmark-plus\"></i> Alta usuario
                </a>
            ";
        }
    }