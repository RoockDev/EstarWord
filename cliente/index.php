<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Test Subir Foto Piloto</title>
</head>
<body>

    <h3>Subir foto para el Piloto con ID: 1</h3>
    
    <form action="http://127.0.0.1:8000/api/pilotos/2/foto" method="post" enctype="multipart/form-data">
        
        <p>Foto del Piloto:</p>
        <input type="file" name="image" />
        
        <input type="submit" value="Subir Foto" />
    </form>

</body>
</html>