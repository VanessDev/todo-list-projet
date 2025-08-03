<?php
// On démarre la session pour stocker les tâches utilisateur
session_start();

// On sépare la logique PHP dans un fichier dédié
require_once 'logic.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Organis'Tâches</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fichier CSS externe pour le style du projet -->
    <link rel="stylesheet" href="style/style.css">
</head>

<body>

    <!-- Inclusion de l'en-tête du site (menu, logo, etc.) -->
    <?php include 'header.php'; ?>

    <main class="main-site">
        <section class="card-container">
            <!-- Carte : Colonne des tâches professionnelles -->
            <div class="card" style="background-image: url('img/background-pro.jpg');">
                <div class="card-overlay">
                    <h3>Liste de tâches Pro</h3>

                    <!-- Formulaire pour ajouter une nouvelle tâche -->
                    <form method="post" class="add-form">
                        <input type="text" name="task_pro" placeholder="Nouvelle tâche..." required>

                        <!-- Menu déroulant pour sélectionner la priorité -->
                        <select name="priority_pro">
                            <option value="high">Urgent</option>
                            <option value="medium">Moins urgent</option>
                            <option value="low">À faire plus tard</option>
                        </select>

                        <button type="submit" name="add_pro_task">Ajouter</button>
                    </form>

                    <!-- Liste dynamique des tâches -->
                    <?php foreach ($_SESSION['pro_tasks'] as $i => $task): ?>
                        <div class="task-item <?= $task['priority'] ?>">
                            <form method="post">
                                <!-- On envoie l'index de la tâche à cocher -->
                                <input type="hidden" name="check_pro_index" value="<?= $i ?>">

                                <!-- Checkbox pour marquer comme fait -->
                                <input type="checkbox" onchange="this.form.submit()" <?= $task['done'] ? 'checked' : '' ?>>

                                <!-- Texte de la tâche avec effet barré si cochée -->
                                <label style="<?= $task['done'] ? 'text-decoration: line-through; opacity: 0.6;' : '' ?>">
                                    <?= htmlspecialchars($task['text']) ?>
                                </label>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- Carte : Colonne des tâches personnelles -->
            <div class="card" style="background-image: url('img/background-perso.jpg');">
                <div class="card-overlay">
                    <h3>Liste de tâches Perso</h3>

                    <!-- Formulaire pour ajouter une nouvelle tâche perso -->
                    <form method="post" class="add-form">
                        <input type="text" name="task_perso" placeholder="Nouvelle tâche perso..." required>

                        <!-- Menu déroulant pour sélectionner la priorité -->
                        <select name="priority_perso">
                            <option value="high">Urgent</option>
                            <option value="medium">Moins urgent</option>
                            <option value="low">À faire plus tard</option>
                        </select>

                        <button type="submit" name="add_perso_task">Ajouter</button>
                    </form>

                    <!-- Liste dynamique des tâches perso -->
                    <?php foreach ($_SESSION['perso_tasks'] as $i => $task): ?>
                        <div class="task-item <?= $task['priority'] ?>">
                            <form method="post">
                                <input type="hidden" name="check_perso_index" value="<?= $i ?>">
                                <input type="checkbox" onchange="this.form.submit()" <?= $task['done'] ? 'checked' : '' ?>>
                                <label style="<?= $task['done'] ? 'text-decoration: line-through; opacity: 0.6;' : '' ?>">
                                    <?= htmlspecialchars($task['text']) ?>
                                </label>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </section>
    </main>

    <!-- Inclusion du pied de page -->
    <?php include 'footer.php'; ?>

</body>

</html>