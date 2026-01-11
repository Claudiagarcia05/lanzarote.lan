<?php

    class ProfesoresController {
        public static function pintar() {
            $pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
            $porPagina = LISTADO_TOTAL_POR_PAGINA;

            $total = Profesor::total();
            $profesores = Profesor::paginar($pagina, $porPagina);

            $filas = '';
            foreach ($profesores as $prof) {

                $activo = ($prof->es_tutor == 'S') ? 'Sí' : 'No';

                $filas .= "
                    <tr>
                        <td>{$prof->id}</td>
                        <td>{$prof->nombre}</td>
                        <td>{$prof->email}</td>
                        <td>{$activo}</td>
                        <td>
                            <a href=\"?seccion=profesores&accion=editar&id={$prof->id}\" class=\"btn btn-sm btn-primary\">Editar</a>
                            <a href=\"?seccion=profesores&accion=eliminar&id={$prof->id}\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('¿Eliminar profesor?');\">Eliminar</a>
                        </td>
                    </tr>
                ";
            }

            $nav = Template::navegacion($total, $pagina, "profesores");

            return "
                <div class=\"container contenido\">
                    <section class=\"page-section\">
                        <h2>Gestión de Profesores</h2>
                        <a href=\"?seccion=profesores&accion=crear\" class=\"btn btn-success mb-3\">Nuevo profesor</a>

                        <table class=\"table table-striped\">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Es tutor</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {$filas}
                            </tbody>
                        </table>

                        {$nav}
                    </section>
                </div>
            ";
        }

        public static function crear() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $prof = new Profesor([
                    'nombre'   => Campo::val('nombre'),
                    'email'    => Campo::val('email'),
                    'es_tutor' => Campo::val('es_tutor') ? 'S' : 'N',
                ]);

                $prof->save();

                header("Location: ?seccion=profesores");
                exit;
            }

            $form = new Formulario();
            $form->add(new Text("nombre"));
            $form->add(new Text("email"));
            $form->add(new Checkbox("es_tutor"));

            return "
                <div class='container contenido'>
                    <section class='page-section'>
                        <h2>Nuevo Profesor</h2>
                        <form method='post'>
                            {$form->pintar()}
                            <button type='submit' class='btn btn-primary'>Guardar</button>
                            <a href='?seccion=profesores' class='btn btn-secondary'>Volver</a>
                        </form>
                    </section>
                </div>
            ";
        }

        public static function editar() {
            $id = $_GET['id'] ?? null;
            $prof = Profesor::find($id);

            if (!$prof) {
                return "<p>Profesor no encontrado.</p>";
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $prof->nombre   = Campo::val('nombre');
                $prof->email    = Campo::val('email');
                $prof->es_tutor = Campo::val('es_tutor') ? 'S' : 'N';

                $prof->save();

                header("Location: ?seccion=profesores");
                exit;
            }

            $form = new Formulario();
            $form->add(new Text("nombre", $prof->nombre));
            $form->add(new Text("email", $prof->email));
            $form->add(new Checkbox("es_tutor", $prof->es_tutor));

            return "
                <div class='container contenido'>
                    <section class='page-section'>
                        <h2>Editar Profesor</h2>
                        <form method='post'>
                            {$form->pintar()}
                            <button type='submit' class='btn btn-primary'>Guardar cambios</button>
                            <a href='?seccion=profesores' class='btn btn-secondary'>Volver</a>
                        </form>
                    </section>
                </div>
            ";
        }

        public static function eliminar() {
            $id = $_GET['id'] ?? null;
            $prof = Profesor::find($id);

            if ($prof) {
                $prof->delete();
            }

            header("Location: ?seccion=profesores");
            exit;
        }
    }