<?php
require_once ('includes/pdo.php');
require_once 'clases/Conexion.php';
require_once 'clases/Producto.php';
if(isset($_POST["id"])){
    $producto = new Producto();
    $id=(int)$_POST["modificar_l"];
    $unProducto=$producto->buscarPorId($id);
    
}
var_dump($id);
function obtenerListaMarcas(){
  $db=Conexion::conectar();
  try {
    $sql = "SELECT id_marca,marca 
      FROM marcas";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $variable = $stmt->fetchAll(PDO::FETCH_ASSOC);//array asociado
    $stmt->closeCursor();
    return $variable;  
  } catch (\Exception $e) {
    echo "Error al obtener Lista de Marcas";
    $e->getMessage();
  }  
}
function obtenerListaCategorias(){
  $db=Conexion::conectar();

  try {
    $sql = "SELECT id_categoria,categoria
      FROM categorias";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $variable = $stmt->fetchAll(PDO::FETCH_ASSOC);//array asociado
    $stmt->closeCursor();
    return $variable;
  } catch (\Exception $e) {
    echo "Error al obtener Lista de Categorias";
    $e->getMessage();
  }
}

if (isset($_POST["modificar_id"])&& $_POST ){
    $id=$unProducto->getId();//de alguna manera le tiene que llegar un id 
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio= $_POST["precio"];
    $stock = $_POST["stock"];
    $marca = $_POST["marca"];
    $categoria = $_POST["categoria"];
    $descuento = $_POST["descuento"];
    $img = "img/productos/phone.jpg";
    $producto->modificarProducto($id,$nombre, $descripcion,$precio, $stock, $marca, $categoria, $descuento, $img);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include 'includes/head.php';?>
<title>ABM Productos</title>

<body>

  <?php include 'includes/headerAdm.php'; ?>

  <main>
    
    <div class="container">
    <div class="card-body">
              <form class="modificarProducto" action="" method="post">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="<?=$unProducto->getNombre();?>">
                </div>
                <div class="form-group">
                  <label for="descripcion">Descripcion</label>
                  <textarea class="form-control" id="descripcion" rows="8" cols="80" name="descripcion" value="<?=$unProducto->getDescripcion();?>"></textarea>
                </div>
                <div class="form-group">
                  <label for="precio">Precio:</label>
                  <input type="number" class="form-control" id="precio" name="precio" min="0" value="<?=$unProducto->getPrecio();?>">
                </div>
                <div class="form-group">
                  <label for="stock">stock</label>
                  <input type="number" class="form-control" id="stock" name="stock" min="0" value="<?=$unProducto->getStock();?>">
                </div>
                <div class="form-group">
                  <label for="marca">Marca</label>
                  <select class="form-control" id="marca" name="marca">
                    <?php 
                      $marcas=obtenerListaMarcas($db);
                      foreach ($marcas as $key => $value) { 
                    ?>
                      <option value="<?=$value["id_marca"];?>"><?=$value["marca"];?></option>
                    <?php 
                      } 
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="categoria">Categoria</label>
                  <select class="form-control" id="categoria" name="categoria">
                  <?php 
                      $marcas=obtenerListaCategorias($db);
                      foreach ($marcas as $key => $value) { 
                    ?>
                      <option value="<?=$value["id_categoria"];?>"><?=$value["categoria"];?></option>
                    <?php 
                      } 
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="descuento">descuento</label>
                  <input type="number" class="form-control" id="descuento" name="descuento" min="0" max="100" value="<?=$unProducto->getDescuento();?>">
                </div>
                <div class="form-group">
                  <label for="img">Imagen</label>
                  <input type="file" class="form-control-file" id="img" name="img">
                </div>
                <button type="submit" class="btn btn-primary mb-2" name="modificar_id">Modificar</button>
              </form>
            </div>
    </div>

  </main>

  <?php
  include 'includes/footer.php';
  include 'includes/scriptBootstrap.php';
  ?>

</body>
</html>
