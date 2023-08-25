<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $date_naissance = $_POST["date_naissance"];
        $photo_piece = file_get_contents($_FILES["photo_piece"]["tmp_name"]);
        
        $code_ticket = strtoupper(substr($nom, 0, 3) . substr($prenom, 0, 3));
        
        $db = new SQLite3('festival_tickets.db');
        $query = "INSERT INTO acheteurs (nom, prenom, date_naissance, photo_piece, code_ticket)
                VALUES ('$nom', '$prenom', '$date_naissance', :photo_piece, '$code_ticket')";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':photo_piece', $photo_piece, SQLITE3_BLOB);
        $stmt->execute();
        
        $db->close();
        
        echo "Inscription confirmée !";
    }
?>