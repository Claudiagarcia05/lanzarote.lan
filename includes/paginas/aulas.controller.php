<?php

    class AulasController {
        public static function pintar() {
            $pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
            $porPagina = LISTADO_TOTAL_POR_PAGINA;

            $total = Aula::total();
            $aulas = Aula::paginar($pagina, $porPagina);

            $filas = '';
            foreach ($aulas as $aula) {

                $planta = [
                    'P' => 'Primera',
                    'S' => 'Segunda',
                    'T' => 'Tercera'
                ][$aula->planta] ?? '-';

                $filas .= "
                    <tr>
                        <td>{$aula->id}</td>
                        <td>{$aula->nombre}</td>
                        <td>{$aula->letra}</td>
                        <td>{$aula->numero}</td>
                        <td>{$planta}</td>
                        <td>
                            <a href=\"?seccion=aulas&accion=editar&id={$aula->id}\" class=\"btn btn-sm btn-primary\">Editar</a>
                            <a href=\"?seccion=aulas&accion=eliminar&id={$aula->id}\" class=\"btn btn-sm btn-danger\" onclick=\"return confirm('¿Eliminar aula?');\">Eliminar</a>
                        </td>
                    </tr>
                ";
            }

            $nav = Template::navegacion($total, $pagina, "aulas");

            return "
                <div class=\"container contenido\">
                    <section class=\"page-section\">
                        <h2>Gestión de Aulas</h2>
                        <a href=\"?seccion=aulas&accion=crear\" class=\"btn btn-success mb-3\">Nueva aula</a>

                        <table class=\"table table-striped\">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Letra</th>
                                    <th>Número</th>
                                    <th>Planta</th>
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

                $aula = new Aula([
                    'nombre' => Campo::val('nombre'),
                    'letra'  => Campo::val('letra'),
                    'numero' => Campo::val('numero'),
                    'planta' => Campo::val('planta'),
                ]);

                $aula->save();

                header("Location: ?seccion=aulas");
                exit;
            }

            return "
                <div class=\"container contenido\">
                    <section class=\"page-section\">
                        <h2>Nueva Aula</h2>
                        <form method=\"post\">
                            <div class=\"mb-3\">
                                <label class=\"form-label\">Nombre del aula</label>
                                <input type=\"text\" name=\"nombre\" class=\"form-control\" required>
                            </div>

                            <div class=\"mb-3\">
                                <label class=\"form-label\">Letra del aula</label>
                                <select name=\"letra\" class=\"form-select\" required>
                                    <option value=\"\">Seleccione...</option>
                                    <option value=\"D\">D (Lomo Derecho)</option>
                                    <option value=\"I\">I (Lomo Izquierdo)</option>
                                </select>
                            </div>

                            <div class=\"mb-3\">
                                <label class=\"form-label\">Número del aula</label>
                                <input type=\"number\" name=\"numero\" class=\"form-control\" required>
                            </div>

                            <div class=\"mb-3\">
                                <label class=\"form-label\">Planta</label>
                                <select name=\"planta\" class=\"form-select\" required>
                                    <option value=\"P\">Primera</option>
                                    <option value=\"S\">Segunda</option>
                                    <option value=\"T\">Tercera</option>
                                </select>
                            </div>

                            <button type=\"submit\" class=\"btn btn-primary\">Guardar</button>
                            <a href=\"?seccion=aulas\" class=\"btn btn-secondary\">Volver</a>
                        </form>
                    </section>
                </div>
            ";
        }

        public static function editar() {
            $id = $_GET['id'] ?? null;
            $aula = Aula::find($id);

            if (!$aula) {
                return "<p>Aula no encontrada.</p>";
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $aula->nombre = Campo::val('nombre');
                $aula->letra  = Campo::val('letra');
                $aula->numero = Campo::val('numero');
                $aula->planta = Campo::val('planta');

                $aula->save();

                header("Location: ?seccion=aulas");
                exit;
            }

            return "
                <div class=\"container contenido\">
                    <section class=\"page-section\">
                        <h2>Editar Aula</h2>
                        <form method=\"post\">
                            <div class=\"mb-3\">
                                <label class=\"form-label\">Nombre</label>
                                <input type=\"text\" name=\"nombre\" class=\"form-control\" value=\"{$aula->nombre}\" required>
                            </div>

                            <div class=\"mb-3\">
                                <label class=\"form-label\">Letra</label>
                                <select name=\"letra\" class=\"form-select\" required>
                                    <option value=\"D\" ".($aula->letra=='D'?'selected':'').">D</option>
                                    <option value=\"I\" ".($aula->letra=='I'?'selected':'').">I</option>
                                </select>
                            </div>

                            <div class=\"mb-3\">
                                <label class=\"form-label\">Número</label>
                                <input type=\"number\" name=\"numero\" class=\"form-control\" value=\"{$aula->numero}\" required>
                            </div>

                            <div class=\"mb-3\">
                                <label class=\"form-label\">Planta</label>
                                <select name=\"planta\" class=\"form-select\" required>
                                    <option value=\"P\" ".($aula->planta=='P'?'selected':'').">Primera</option>
                                    <option value=\"S\" ".($aula->planta=='S'?'selected':'').">Segunda</option>
                                    <option value=\"T\" ".($aula->planta=='T'?'selected':'').">Tercera</option>
                                </select>
                            </div>

                            <button type=\"submit\" class=\"btn btn-primary\">Guardar cambios</button>
                            <a href=\"?seccion=aulas\" class=\"btn btn-secondary\">Volver</a>
                        </form>
                    </section>
                </div>
            ";
        }

        public static function eliminar() {
            $id = $_GET['id'] ?? null;
            $aula = Aula::find($id);

            if ($aula) {
                $aula->delete();
            }

            header("Location: ?seccion=aulas");
            exit;
        }
    }