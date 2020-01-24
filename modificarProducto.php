<?php

function guardarArchivo($file,$nombre="text"){
  if($file["name"]!=""){
      $nombreArchivo=$file["name"];
  $archivo=$file["tmp_name"];
  $ext=pathinfo($nombreArchivo,PATHINFO_EXTENSION);
  $miArchivo="img/productos/".$nombre;
   //ruta actual
  $nombre="phone".uniqid();
  if (!file_exists($miArchivo)) {
      mkdir($miArchivo, 0777, true);
  }
  $directorio = opendir($miArchivo);
  $cont=0;
  $archivoEliminar="";
  while ($archivoDir = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
  {
      if (!is_dir($archivoDir))//verificamos si es o no un directorio
          {
      //var_dump ($archivoDir );
          if(preg_match("/phone/i" ,$archivoDir)){//encuentra un archivo que coincida con el patron
              $cont++;
              $archivoEliminar=$archivoDir;   
          }
      }
  }
  if($cont>1){
      unlink($miArchivo."/".$archivoEliminar);
  }
  $miArchivo=$miArchivo."/".$nombre.".".$ext;
  move_uploaded_file($archivo,$miArchivo);
  return $miArchivo;
  }
  return null;
}
require_once 'clases/Conexion.php';
require_once 'clases/Producto.php';
echo "<pre>";
var_dump($_POST);
echo "</pre>";
$producto = new Producto();
if(isset($_POST["id"]) && isset($_POST["modificar_l"])){
    $id=(int)$_POST["modificar_l"];
    $unProducto=$producto->buscarPorId($id); 
}
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
  
    $id= ((int)$_POST["idM"]);//de alguna manera le tiene que llegar un id 
    if($_FILES){
      $img=guardarArchivo($_FILES["img"],$_POST["nombre"]);  
    }else{
      $img=$_POST["imagenActual"];
    }
    
    //var_dump($imagen);
   // $img = "img/productos/phone.jpg";
    $producto->modificarProducto($id,$img);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include 'includes/head.php';?>
<title>ABM Productos</title>

<body>

  <?php include 'includes/headerAdm.php'; ?>

 

  <main class="mb-3">
    
  <div class="container bg-white">
        <div class="mb-2 py-3 px-1 d-flex flex-row justify-content-betwee bg-">
            <h1 class="col-10">Modificar Producto</h1>
            <a href="abmProducto.php" class="btn btn-primary col-2 py-3">Volver Atras</a>
        </div>
    <div class="card-body">
              <form class="modificarProducto" action="" method="post" enctype="multipart/form-data">
              <input type="number" class="form-control" id="id" name="idM" value="<?=$unProducto->getId();?>" readonly hidden>
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="<?=$unProducto->getNombre();?>">
                </div>
                <div class="form-group">
                  <label for="descripcion">Descripcion</label>
                  <pre>
                  <textarea class="form-control" id="descripcion" rows="8" cols="80" name="descripcion" value="">
                                  <?=$unProducto->getDescripcion();
                                  ?>
                  </textarea>
                  </pre>
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
                <div class="form-group text-center">
                  <label for="img" class="col-12">Imagen</label>
                  <img src="<?=$unProducto->getImg();?>" alt="" sizes="" width="100px" class="col-5">
                  <input type="text" name="imagenActual" value="<?=$unProducto->getImg();?>" readonly hidden>
                  <label for="img" class="text-left col-12">Cambiar</label>
                  <input type="file" class="form-control-file" id="img" name="img" class="">
                </div>
                <button type="submit" class="btn btn-primary mb-2" name="modificar_id" value="">Modificar</button>
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
