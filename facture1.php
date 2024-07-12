
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/fontawesome/4.2.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
    <form action="store.php" method="post">

        <div class="form-group">
            <label for="date">Date</label>  
            <input type="date" class="form-control" name="date" id="date">
        </div>
        <div class="form-group">
            <label for="montantTotal">MontantTotal</label>
            <input type="text" class="form-control" name="montantTotal" id="montantTotal">
        </div>
        <div class="form-group">
            <label for="etat">Etat</label>
            <input type="text" class="form-control" name="etat" id="etat">
        </div>
        <div class="form-group">
            <label for="idClient">IdClient</label>
            <input type="text" class="form-control" name="idC" id="idClient">
        </div>
        <div class="form-group">
            <label for="idPaiement">IdPaiement</label>
            <input type="text" class="form-control" name="idP" id="idPaiement">
        </div>

        <button type="submit" onclick="document.location='index.php'" class="btn btn-primary">Submit</button>
    </form>

</body>
