<!DOCTYPE html>
<html>
<head>
    <title>My PDF</title>
</head>
<body>
    <h1>Welcome, {{ json_decode(Crypt::decrypt($dadosCriptografados))->nomeUsuario }}!</h1>
   
</body>
</html>