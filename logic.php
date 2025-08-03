    <?php
    // Si la session ne contient pas encore de tâches Pro, on les initialise
    if (!isset($_SESSION['pro_tasks'])) {
        $_SESSION['pro_tasks'] = [];
    }

    // Si l'utilisateur soumet une tâche via le formulaire
    if (isset($_POST['add_pro_task']) && !empty($_POST['task_pro'])) {
        $_SESSION['pro_tasks'][] = [
            'text' => htmlspecialchars($_POST['task_pro']), // on sécurise l'entrée
            'priority' => $_POST['priority_pro'],            // on récupère la priorité
            'done' => false                                  // tâche non cochée par défaut
        ];
    }

    // Si une case est cochée, on inverse son statut (fait/non fait)
    if (isset($_POST['check_pro_index'])) {
        $i = (int)$_POST['check_pro_index'];
        if (isset($_SESSION['pro_tasks'][$i])) {
            $_SESSION['pro_tasks'][$i]['done'] = !$_SESSION['pro_tasks'][$i]['done'];
        }
    }

    /////////////////////// LOGIC Liste tâches Personelles////////////////////

    // Si la session ne contient pas encore de tâches Perso, on les initialise
    if (!isset($_SESSION['perso_tasks'])) {
        $_SESSION['perso_tasks'] = [];
    }

    // Si l'utilisateur soumet une tâche via le formulaire
    if (!isset($_POST['add_perso_task']) && !empty($_POST['task_perso'])) {
        $_SESSION['perso_tasks'][] = [
            'text' => htmlspecialchars($_POST['task_perso']), // on sécurise l'entrée
            'priority' => $_POST['priority_perso'],            // on récupère la priorité
            'done' => false                                  // tâche non cochée par défaut
        ];
    }

    // Si une case est cochée, on inverse son statut (fait/non fait)
    if (isset($_POST['check_perso_index'])) {
        $i = (int)$_POST['check_perso_index'];
        if (isset($_SESSION['perso_tasks'][$i])) {
            $_SESSION['perso_tasks'][$i]['done'] = !$_SESSION['perso_tasks'][$i]['done'];
        }
    }