<?php
require '../Models/db_connection.php';

session_start();
if (!isset($_SESSION['user'])) {
    // Redirigir al login si no hay sesión activa
    header('Location: ../index.html');
    exit();
}

if (isset($_POST['id'])) {
    // Obtener el ID del ticket desde el POST
    $ticketId = $_POST['id'];

    // Consulta para obtener los detalles del ticket con el ID proporcionado
    $stmt = $pdo->prepare("SELECT * FROM ticket WHERE Id_cliente = :id");
    $stmt->bindParam(':id', $ticketId, PDO::PARAM_INT);
    $stmt->execute();
    
    // Obtener los resultados
    $ticket = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($ticket) {
        // Mostrar los detalles del ticket
        echo "<h4>Detalles del Ticket Aseguratte-{$ticket['Id_cliente']}</h4>";
        echo "<p><strong>Nombre:</strong> " . htmlspecialchars($ticket['Nombre']) . "</p>";
        echo "<p><strong>Apellido:</strong> " . htmlspecialchars($ticket['Apellido']) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($ticket['Email']) . "</p>";
        echo "<p><strong>Teléfono:</strong> " . htmlspecialchars($ticket['Telefono']) . "</p>";
        echo "<p><strong>Fecha de Origen:</strong> " . htmlspecialchars($ticket['Fecha_origen']) . "</p>";
    } else {
        echo "<p>No se encontraron detalles para este ticket.</p>";
    }
} else {
    echo "<p>Falta el ID del ticket.</p>";
}
?>