<?php
header('Content-Type: application/json');

// Configurazione database
$host = 'localhost';
$db   = 'db-name';
$user = 'user-name';
$pass = '******';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $azione = $_GET['azione'] ?? '';

    switch($azione) {
        case 'lista':
            $stmt = $pdo->query("SELECT id, nome, livello FROM schemi ORDER BY data_creazione DESC");
            echo json_encode($stmt->fetchAll());
            break;

        case 'carica':
            $id = $_GET['id'] ?? 0;
            $stmt = $pdo->prepare("SELECT * FROM schemi WHERE id = ?");
            $stmt->execute([$id]);
            $risultato = $stmt->fetch();
            
            if ($risultato) {
                echo json_encode($risultato);
            } else {
                echo json_encode(["status" => "error", "message" => "Schema non trovato"]);
            }
            break;
			
		case 'salva':
            $nome = $_POST['nome'] ?? '';
            $schema = $_POST['schema'] ?? '';
            $livello = $_POST['livello'] ?? 'medio';

            if (empty($nome) || empty($schema)) {
                throw new Exception("Nome o schema mancanti");
            }

            // 1. Controlliamo se esiste già uno schema con questo nome
            $checkStmt = $pdo->prepare("SELECT id FROM schemi WHERE nome = ?");
            $checkStmt->execute([$nome]);
            $esistente = $checkStmt->fetch();

            if ($esistente) {
                // 2. Se esiste, facciamo un UPDATE
                $stmt = $pdo->prepare("UPDATE schemi SET schema_iniziale = ?, livello = ? WHERE nome = ?");
                $stmt->execute([$schema, $livello, $nome]);
                echo json_encode(["status" => "success", "message" => " aggiornato correttamente"]);
            } else {
                // 3. Se non esiste, facciamo un INSERT
                $stmt = $pdo->prepare("INSERT INTO schemi (nome, schema_iniziale, livello) VALUES (?, ?, ?)");
                $stmt->execute([$nome, $schema, $livello]);
                echo json_encode(["status" => "success", "message" => " salvato correttamente"]);
            }
            break;
/*			
        case 'salva':
            $nome = $_POST['nome'] ?? 'Sudoku senza nome';
            $schema = $_POST['schema'] ?? '';
            $livello = $_POST['livello'] ?? 'medio';

            if (empty($schema)) {
                throw new Exception("Dati dello schema mancanti");
            }

            $stmt = $pdo->prepare("INSERT INTO schemi (nome, schema_iniziale, livello) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $schema, $livello]);
            echo json_encode(["status" => "success", "id" => $pdo->lastInsertId()]);
            break;
*/
        default:
            echo json_encode(["status" => "error", "message" => "Azione non valida"]);
    }

} catch (PDOException $e) {
    // Errore specifico del database
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Errore DB: " . $e->getMessage()]);
} catch (Exception $e) {
    // Altri tipi di errori
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>