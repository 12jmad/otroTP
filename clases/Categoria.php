<?php

    /**
     *
     */
    class Categoria
    {

      function __construct(argument)
      {
        // code...
      }

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
