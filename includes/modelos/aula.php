<?php

    class Aula {

        public $id;
        public $nombre;
        public $letra;
        public $numero;
        public $planta;

        public function __construct($datos = []) {
            $this->id     = $datos['id']     ?? null;
            $this->nombre = $datos['nombre'] ?? null;
            $this->letra  = $datos['letra']  ?? null;
            $this->numero = $datos['numero'] ?? null;
            $this->planta = $datos['planta'] ?? null;
        }

        public static function paginar($pagina, $porPagina) {
            $offset = ($pagina - 1) * $porPagina;

            $q = new Query("SELECT * FROM aulas ORDER BY planta, numero LIMIT $offset, $porPagina");
            $lista = [];

            while ($fila = $q->recuperar()) {
                $lista[] = new self($fila);
            }

            return $lista;
        }

        public static function total() {
            $q = new Query("SELECT COUNT(*) AS total FROM aulas");
            $fila = $q->recuperar();

            return $fila['total'];
        }

        public static function find($id) {
            $q = new Query("SELECT * FROM aulas WHERE id = '{$id}'");
            $fila = $q->recuperar();

            return $fila ? new self($fila) : null;
        }

        public function save() {
            if ($this->id) {
                new Query("
                    UPDATE aulas SET
                        nombre = '{$this->nombre}',
                        letra  = '{$this->letra}',
                        numero = '{$this->numero}',
                        planta = '{$this->planta}',
                        usuario_modi = 'admin',
                        ip_modi = '127.0.0.1',
                        fecha_modi = NOW()
                    WHERE id = '{$this->id}'
                ");
            } else {
                new Query("
                    INSERT INTO aulas (nombre, letra, numero, planta, usuario_alta, ip_alta)
                    VALUES (
                        '{$this->nombre}',
                        '{$this->letra}',
                        '{$this->numero}',
                        '{$this->planta}',
                        'admin',
                        '127.0.0.1'
                    )
                ");
            }
        }

        public function delete() {
            new Query("DELETE FROM aulas WHERE id = '{$this->id}'");
        }
    }