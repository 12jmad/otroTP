<?php

<<<<<<< HEAD
    class Marca
    {
        private $id_marca;
        private $marca;

        public function listarMarcas()
        {
            $link = Conexion::conectar();
            $sql = "SELECT id_marca, marca
                        FROM marcas";
            $stmt = $link->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }

        public function verMarcaPorID()
        {
            
        }

        public function agregarMarca()
        {
            $marca = $_POST['marca'];
            $link = Conexion::conectar();
            $sql = "INSERT INTO marcas
                        VALUES
                            ( default, :marca )";
            $stmt = $link->prepare($sql);
            $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);

            if( $stmt->execute() ){
                $this->setid_marca($link->lastInsertId());
                $this->setmarca($marca);
                return true;
            }
            return false;



        }

        public function modificarMarca()
        {
            
        }

        public function eliminarMarca()
        {

        }
        
        
        /**
         * @return mixed
         */
        public function getId__marca()
        {
            return $this->id_marca;
        }

        /**
         * @param mixed $id_marca
         */
        public function setId_marca($id_marca)
        {
            $this->id_marca = $id_marca;
        }

        /**
         * @return mixed
         */
        public function getMarca()
        {
            return $this->marca;
        }

        /**
         * @param mixed $marca
         */
        public function setMarca($marca)
        {
            $this->marca = $marca;
        }

        

    }
=======
/**
*
*/
class Marca
{

<<<<<<< HEAD
  function __construct(argument)
  {
    // code...
  }

=======
>>>>>>> 35de5664e2c3b65f696137834099d6e6b4892312
  private $id;
  private $marca;


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
  * Get the value of Marca
  *
  * @return mixed
  */
  public function getMarca()
  {
    return $this->marca;
  }

  /**
  * Set the value of Marca
  *
  * @param mixed $marca
  *
  * @return self
  */
  public function setMarca($marca)
  {
    $this->marca = $marca;

    return $this;
  }

}

?>
>>>>>>> 1be9b0cc95ebf8a229f4cbc4590f5cc0c9d54af0
