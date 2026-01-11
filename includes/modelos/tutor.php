<?php

    class Tutor {

        public $id;
        public $nombre;
        public $apellidos;
        public $curso_id;

        public function __construct($datos = []) {
            $this->id        = $datos['id']        ?? null;
            $this->nombre    = $datos['nombre']    ?? null;
            $this->apellidos = $datos['apellidos'] ?? null;
            $this->curso_id  = $datos['curso_id']  ?? null;
        }

        public static function paginar($pagina, $porPagina) {
            $offset = ($pagina - 1) * $porPagina;

            $q = new Query("SELECT * FROM tutores ORDER BY apellidos, nombre LIMIT $offset, $porPagina");
            $lista = [];

            while ($fila = $q->recuperar()) {
                $lista[] = new self($fila);
            }

            return $lista;
        }

        public static function total() {
            $q = new Query("SELECT COUNT(*) AS total FROM tutores");
            $fila = $q->recuperar();

            return $fila['total'];
        }

        public static function find($id) {
            $q = new Query("SELECT * FROM tutores WHERE id = '{$id}'");
            $fila = $q->recuperar();

            return $fila ? new self($fila) : null;
        }

        public function save() {
            if ($this->id) {
                new Query("
                    UPDATE tutores SET
                        nombre = '{$this->nombre}',
                        apellidos = '{$this->apellidos}',
                        curso_id = '{$this->curso_id}',
                        usuario_modi = 'admin',
                        ip_modi = '127.0.0.1',
                        fecha_modi = NOW()
                    WHERE id = '{$this->id}'
                ");
            } else {
                new Query("
                    INSERT INTO tutores (nombre, apellidos, curso_id, usuario_alta, ip_alta)
                    VALUES (
                        '{$this->nombre}',
                        '{$this->apellidos}',
                        '{$this->curso_id}',
                        'admin',
                        '127.0.0.1'
                    )
                ");
            }
        }

        public function delete() {
            new Query("DELETE FROM tutores WHERE id = '{$this->id}'");
        }
    }