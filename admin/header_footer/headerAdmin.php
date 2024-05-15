<!--Header Admin-->
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Espace d'administration</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="./../../assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- CDN Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/css/styles.css" rel="stylesheet" />
    <!-- CDN datatables -->
    <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/r-2.2.9/datatables.min.css" />-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Datatables  -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/r-2.2.9/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#clients').DataTable();
        });
    </script>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-warning" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top"><img src="./../../assets/img/logo.jpg" alt="Logo ADC" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link text-dark" href="/admin/tableaux/tabClients.php">Clients</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/admin/tableaux/tabInstruments.php">Instruments</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/admin/tableaux/tabEntretiens.php">Entretiens</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/admin/tableaux/tabInstrument_Locations.php">INSTRUMENTS LOUÉS</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/admin/tableaux/tabLocations.php">Locations</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/admin/tableaux/tabForfaits.php">Forfaits</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/admin/tableaux/tabVilles.php">Villes</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="/index.php">Site</a></li>
                </ul>
                <a class="btn btn-dark btn-social mx-2" href="https://www.facebook.com/latelierdesclarinettes"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
    </nav>