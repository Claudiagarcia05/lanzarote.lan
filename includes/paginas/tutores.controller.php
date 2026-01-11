<?php

    class TutoresController {
        public static function pintar() {
            $pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
            $porPagina = LISTADO_TOTAL_POR_PAGINA;

            $total = Tutor::total();
            $tutores = Tutor::paginar($pagina, $porPagina);

            $filas = '';
            foreach ($tutores as $tutor) {

                $filas .= "
                    <tr>
                        <td>{$tutor->id}</td>
                        <td>{$tutor->nombre}</td>
                        <td>{$tutor->email}</td>
                        <td>{$tutor->antiguedad}</td>
                        <td>
                            <a href=\"?seccion=tutores&accion=editar&id={$tutor->id}\" class=\"btn btn-sm btn-primary\">Editar</a>
                            <a href=\"?seccion=tutores&accion=eliminar&id={$tutor->id}\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('¿Eliminar tutor?');\">Eliminar</a>
                        </td>
                    </tr>
                ";
            }

            $nav = Template::navegacion($total, $pagina, "tutores");

            return "
                <div class=\"container contenido\">
                    <section class=\"page-section\">
                        <h2>Gestión de Tutores</h2>
                        <a href=\"?seccion=tutores&accion=crear\" class=\"btn btn-success mb-3\">Nuevo tutor</a>

                        <table class=\"table table-striped\">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Antigüedad</th>
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

                $tutor = new Tutor([
                    'nombre'     => Campo::val('nombre'),
                    'email'      => Campo::val('email'),
                    'antiguedad' => Campo::val('antiguedad'),
                ]);

                $tutor->save();

                header("Location: ?seccion=tutores");
                exit;
            }

            $form = new Formulario();
            $form->add(new Text("nombre"));
            $form->add(new Text("email"));
            $form->add(new RadioButton("antiguedad", [
                "2018" => "2018",
                "2019" => "2019",
                "2020" => "2020",
                "2021" => "2021",
                "2022" => "2022",
                "2023" => "2023",
                "2024" => "2024",
                "2025" => "2025"
            ]));

            return "
                <div class='container contenido'>
                    <section class='page-section'>
                        <h2>Nuevo Tutor</h2>
                        <form method='post'>
                            {$form->pintar()}
                            <button type='submit' class='btn btn-primary'>Guardar</button>
                            <a href='?seccion=tutores' class='btn btn-secondary'>Volver</a>
                        </form>
                    </section>
                </div>
            ";
        }

        public static function editar() {
            $id = $_GET['id'] ?? null;
            $tutor = Tutor::find($id);

            if (!$tutor) {
                return "<p>Tutor no encontrado.</p>";
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $tutor->nombre     = Campo::val('nombre');
                $tutor->email      = Campo::val('email');
                $tutor->antiguedad = Campo::val('antiguedad');

                $tutor->save();

                header("Location: ?seccion=tutores");
                exit;
            }

            $form = new Formulario();
            $form->add(new Text("nombre", $tutor->nombre));
            $form->add(new Text("email", $tutor->email));
            $form->add(new RadioButton("antiguedad", [
                "2018" => "2018",
                "2019" => "2019",
                "2020" => "2020",
                "2021" => "2021",
                "2022" => "2022",
                "2023" => "2023",
                "2024" => "2024",
                "2025" => "2025"
            ], $tutor->antiguedad));

            return "
                <div class='container contenido'>
                    <section class='page-section'>
                        <h2>Editar Tutor</h2>
                        <form method='post'>
                            {$form->pintar()}
                            <button type='submit' class='btn btn-primary'>Guardar cambios</button>
                            <a href='?seccion=tutores' class='btn btn-secondary'>Volver</a>
                        </form>
                    </section>
                </div>
            ";
        }

        public static function eliminar() {
            $id = $_GET['id'] ?? null;
            $tutor = Tutor::find($id);

            if ($tutor) {
                $tutor->delete();
            }

            header("Location: ?seccion=tutores");
            exit;
        }
    }