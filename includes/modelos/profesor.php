<?php

    class Profesor {
        public $id;
        public $nombre;
        public $apellidos;
        public $especialidad;
        public $activo;

        public function __construct($datos = []) {
            $this->id           = $datos['id']           ?? null;
            $this->nombre       = $datos['nombre']       ?? null;
            $this->apellidos    = $datos['apellidos']    ?? null;
            $this->especialidad = $datos['especialidad'] ?? null;
            $this->activo       = $datos['activo']       ?? 'S';
        }
        
        public static function paginar($pagina, $porPagina) {
            $offset = ($pagina - 1) * $porPagina;

            $q = new Query("SELECT * FROM profesores ORDER BY apellidos, nombre LIMIT $offset, $porPagina");
            $lista = [];

            while ($fila = $q->recuperar()) {
                $lista[] = new self($fila);
            }

            return $lista;
        }

        public static function total() {
            $q = new Query("SELECT COUNT(*) AS total FROM profesores");
            $fila = $q->recuperar();

            return $fila['total'];
        }

        public static function find($id) {
            $q = new Query("SELECT * FROM profesores WHERE id = '{$id}'");
            $fila = $q->recuperar();

            return $fila ? new self($fila) : null;
        }

        public function save() {
            if ($this->id) {
                new Query("
                    UPDATE profesores SET
                        nombre = '{$this->nombre}',
                        apellidos = '{$this->apellidos}',
                        especialidad = '{$this->especialidad}',
                        activo = '{$this->activo}',
                        usuario_modi = 'admin',
                        ip_modi = '127.0.0.1',
                        fecha_modi = NOW()
                    WHERE id = '{$this->id}'
                ");
            } else {
                new Query("
                    INSERT INTO profesores (nombre, apellidos, especialidad, activo, usuario_alta, ip_alta)
                    VALUES (
                        '{$this->nombre}',
                        '{$this->apellidos}',
                        '{$this->especialidad}',
                        '{$this->activo}',
                        'admin',
                        '127.0.0.1'
                    )
                ");
            }
        }

        public function delete() {
            new Query("DELETE FROM profesores WHERE id = '{$this->id}'");
        }
    }