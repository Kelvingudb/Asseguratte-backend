


<?php

require '../Models/db_connection.php';

session_start();
if (!isset($_SESSION['user'])) {

    header('Location: ../index.html');
    exit();
}

$userName = $_SESSION['user']['Name_user'];

$stmt = $pdo->query("SELECT * FROM ticket");
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../css/dashboard.css" rel="stylesheet">
</head>
<body class=" bg-info-subtle">
    <header class="container-fluid w-100 bg-black d-flex justify-content-between align-items-center">
    <div class="container-sm">
        <h2 class="oswald-1 text-white custom-letter"> Aseguratte - Sistema Tickets</h2>
    </div>
   

    <div class="dropdown">
  <button class="btn text-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    <span>Hola, <?php echo $userName?> </span>
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="../Models/logout.php">Cerrar Sesion</a></li>
  </ul>
</div>
   
</header>
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-6 bg-dark">
                <h3 class="text-white">Tickets</h3>
                <div id="ticket-cards"  style="max-height: 100vh; overflow-y: auto;" class="row row-cols-1 g-3">
                    <?php foreach ($tickets as $ticket): ?>
                    <div class="col">
                      <div class="card bg-primary-subtle shadow z-3" onclick="showDetails(<?= $ticket['Id_cliente'] ?>)">
                        <div class="card-header bg-primary text-white"> 
                           <strong>Aseguratte-<?= htmlspecialchars($ticket['Id_cliente']) ?></strong>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Nombre: <?= htmlspecialchars($ticket['Nombre']) ?></p>
                            <p class="card-text">Apellido: <?= htmlspecialchars($ticket['Apellido']) ?></p>
                            <p class="card-text">Fecha de Origen: <?= htmlspecialchars($ticket['Fecha_origen']) ?></p>
                             </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Apartado para mostrar detalles del ticket -->
            <div class="col-md-6 mt-5 ">
             <div class="container-fluid bg-light z-3 shadow border" style="height:60%">
             <h3 class="text-center">Detalles del Ticket</h3>
                <div id="ticket-details" class="border p-3">
                    <p>Selecciona un ticket para ver los detalles.</p>
                </div>
            </div>
             </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function showDetails(ticketId) {
            // Realizar una petición AJAX para obtener los detalles del ticket
            $.ajax({
                url: '../Models/get_ticket_details.php',
                type: 'POST',
                data: { id: ticketId },
                success: function(response) {
                    $('#ticket-details').html(response);
                },
                error: function() {
                    $('#ticket-details').html('<p>Error al cargar los detalles del ticket.</p>');
                }
            });
        }
    </script>
</body>
</html>
