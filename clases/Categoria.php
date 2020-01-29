<?php

<<<<<<< HEAD
    class Categoria
    {
        private $id_categoria;
        private $categoria;

        public function listarcategorias()
        {
            $link = Conexion::conectar();
            $sql = "SELECT id_categoria, categoria
                        FROM categorias";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }

        public function verCategoriaPorID()
        {
            
        }

        public function agregarCategoria()
        {
            $categoria = $_POST['categoria'];
            $link = Conexion::conectar();
            $sql = "INSERT INTO categorias
                        VALUES
                            ( default, :categoria )";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);

            if( $stmt->execute() ){
                $this->setId_categoria($link->lastInsertId());
                $this->setCategoria($categoria);
                return true;
            }
            return false;



        }

        public function modificarCategoria()
        {
            
        }

        public function eliminarCategoria()
        {

        }
        
        
        /**
         * @return mixed
         */
        public function getId__categoria()
        {
            return $this->id_categoria;
        }

        /**
         * @param mixed $id_categoria
         */
        public function setId_categoria($id_categoria)
        {
            $this->id_categoria = $id_categoria;
        }

        /**
         * @return mixed
         */
        public function getCategoria()
        {
            return $this->categoria;
        }

        /**
         * @param mixed $categoria
         */
        public function setCategoria($categoria)
        {
            $this->categoria = $categoria;
        }

        

    }
=======
    /**
     *
     */
    class Categoria
    {

<<<<<<< HEAD
      function __construct(argument)
      {
        // code...
      }

=======
>>>>>>> 35de5664e2c3b65f696137834099d6e6b4892312
      private $id;
      private $categoria;



    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Categoria
     *
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of Categoria
     *
     * @param mixed $categoria
     *
     * @return self
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

}

?>
>>>>>>> 1be9b0cc95ebf8a229f4cbc4590f5cc0c9d54af0
