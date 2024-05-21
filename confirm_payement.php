<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $etudiant_id = $_POST['etudiant_id'] ?? '';
    $montant = $_POST['montant'] ?? '';
    $date_paiement = $_POST['date_paiement'] ?? '';

    // Vérification si les champs ne sont pas vides
    if (!empty($etudiant_id) && !empty($montant) && !empty($date_paiement)) {
        try {
            $db = new PDO("mysql:host=localhost;dbname=student", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $req = "INSERT INTO paiement (etudiant_id, montant, date_paiement) VALUES (:etudiant_id, :montant, :date_paiement)";
            $reqPrepa = $db->prepare($req);

            $res = $reqPrepa->execute([
                "etudiant_id" => $etudiant_id,
                "montant" => $montant,
                "date_paiement" => $date_paiement
            ]);

            if ($res) {
                echo "Enregistrement effectué avec succès";
                header("Location: payement.php");
                exit; // Assurez-vous de terminer le script après la redirection
            } else {
                echo "Échec de l'enregistrement";
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Veuillez remplir tous les champs";
    }
}
?>
