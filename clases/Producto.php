<?php
/**
*
*/
class Producto
{
  private $id;
  private $nombre;
  private $descripcion;
  private $precio;
  private $stock;
  private $marca;
  private $categoria;
  private $descuento;
  private $img;

  public function altaProducto(PDO $db, string $nombre, string $desc,float $precio,int $stock, int $marca, int $categoria, float $descuento, string $img)
  {
    try{
    $statement = $db->prepare("INSERT into productos(id_marca,id_categoria,nombre,descripcion,precio,cantidad,img,descuento) VALUES ( :idMarca, :idCategoria,:nombre, :descripcion, :precio, :cantidad, :img,:descuento)");

    $statement->bindValue(':idMarca', $marca,PDO::PARAM_INT);
    $statement->bindValue(":idCategoria", $categoria,PDO::PARAM_INT);
    $statement->bindValue(":nombre", $nombre,PDO::PARAM_STR);
    $statement->bindValue(":descripcion", $desc,PDO::PARAM_STR);
    $statement->bindValue(":precio", $precio);
    $statement->bindValue(":cantidad", $stock,PDO::PARAM_INT);
    $statement->bindValue(":img", $img,PDO::PARAM_STR);
    $statement->bindValue(":descuento", $descuento);

    $statement->execute();
    $statement->closeCursor();
    }catch (\Exception $e)
      {
        echo "Error al cargar poducto";
        $e->getMessage();
      }
    
 
  }

  public function modificarProducto(PDO $db,int $id,string $nombre, string $desc,float $precio,int $stock, int $marca, int $categoria, float $descuento, string $img)
  {
    try{
      $sql="UPDATE productos SET nombre=':nombre',descripcion=':descripcion',precio=:precio,cantidad=:cantidad,img=':img',descuento=:descuento,id_marca=:idMarca,id_categoria=:idCategoria WHERE id_producto = :id";
      $statement = $db->prepare($sql);
      $statement->bindValue(':id', $id,PDO::PARAM_INT);
      $statement->bindValue(':idMarca', $marca,PDO::PARAM_INT);
      $statement->bindValue(":idCategoria", $categoria,PDO::PARAM_INT);
      $statement->bindValue(":nombre", $nombre,PDO::PARAM_STR);
      $statement->bindValue(":descripcion", $desc,PDO::PARAM_STR);
      $statement->bindValue(":precio", $precio);
      $statement->bindValue(":cantidad", $stock,PDO::PARAM_INT);
      $statement->bindValue(":img", $img,PDO::PARAM_STR);
      $statement->bindValue(":descuento", $descuento);
  
      $statement->execute();
      $statement->closeCursor();
      }catch (\Exception $e)
        {
          echo "Error al modificar poducto";
          $e->getMessage();
        }
  }

  public function borrarProducto(PDO $db, $id)
  {
    try
    {

      $statement = $db->prepare("DELETE FROM productos WHERE id_producto = :id");

      $statement->bindValue(":id", $id);

      $statement->execute();

    }
    catch (\Exception $e)
    {
        echo "Error al borrar producto";
        $e->getMessage();
    }

  }
  


  /**
   * Get the value of id
   */ 
  public function getId():int
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */ 
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of nombre
   */ 
  public function getNombre():string
  {
    return $this->nombre;
  }

  /**
   * Set the value of nombre
   *
   * @return  self
   */ 
  public function setNombre($nombre)
  {
    $this->nombre = $nombre;

    return $this;
  }

  /**
   * Get the value of descripcion
   */ 
  public function getDescripcion():string
  {
    return $this->descripcion;
  }

  /**
   * Set the value of descripcion
   *
   * @return  self
   */ 
  public function setDescripcion($descripcion)
  {
    $this->descripcion = $descripcion;

    return $this;
  }

  /**
   * Get the value of stock
   */ 
  public function getStock():int
  {
    return $this->stock;
  }

  /**
   * Set the value of stock
   *
   * @return  self
   */ 
  public function setStock($stock)
  {
    $this->stock = $stock;

    return $this;
  }

  /**
   * Get the value of marca
   */ 
  public function getMarca():string
  {
    return $this->marca;
  }

  /**
   * Set the value of marca
   *
   * @return  self
   */ 
  public function setMarca($marca)
  {
    $this->marca = $marca;

    return $this;
  }

  /**
   * Get the value of categoria
   */ 
  public function getCategoria():string
  {
    return $this->categoria;
  }

  /**
   * Set the value of categoria
   *
   * @return  self
   */ 
  public function setCategoria($categoria)
  {
    $this->categoria = $categoria;

    return $this;
  }

  /**
   * Get the value of descuento
   */ 
  public function getDescuento():float
  {
    return $this->descuento;
  }

  /**
   * Set the value of descuento
   *
   * @return  self
   */ 
  public function setDescuento($descuento)
  {
    $this->descuento = $descuento;

    return $this;
  }

  /**
   * Get the value of img
   */ 
  public function getImg():string
  {
    return $this->img;
  }

  /**
   * Set the value of img
   *
   * @return  self
   */ 
  public function setImg($img)
  {
    $this->img = $img;

    return $this;
  }

  /**
   * Get the value of precio
   */ 
  public function getPrecio():float
  {
    return $this->precio;
  }

  /**
   * Set the value of precio
   *
   * @return  self
   */ 
  public function setPrecio($precio)
  {
    $this->precio = $precio;

    return $this;
  }
}

?>
