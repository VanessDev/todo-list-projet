<?php
session_start();

/////////////////////// LOGIC Liste tâches Pro ////////////////////

// Si la session ne contient pas encore de tâches Pro, on les initialise
if (!isset($_SESSION['pro_tasks'])) {
    $_SESSION['pro_tasks'] = [];
}

// Si l'utilisateur soumet une tâche via le formulaire Pro
if (isset($_POST['add_pro_task']) && !empty($_POST['task_pro'])) {
    $_SESSION['pro_tasks'][] = [
        'text' => htmlspecialchars($_POST['task_pro']),   // sécuriser l'entrée utilisateur
        'priority' => $_POST['priority_pro'],             // récupérer la priorité choisie
        'done' => false                                   // tâche non cochée par défaut
    ];
}

// Si une case est cochée dans la liste Pro
if (isset($_POST['check_pro_index'])) {
    $i = (int) $_POST['check_pro_index'];
    if (isset($_SESSION['pro_tasks'][$i])) {
        $_SESSION['pro_tasks'][$i]['done'] = !$_SESSION['pro_tasks'][$i]['done'];
    }
}

/////////////////////// LOGIC Liste tâches Perso ////////////////////

// Si la session ne contient pas encore de tâches Perso, on les initialise
if (!isset($_SESSION['perso_tasks'])) {
    $_SESSION['perso_tasks'] = [];
}

// Si l'utilisateur soumet une tâche via le formulaire Perso
if (isset($_POST['add_perso_task']) && !empty($_POST['task_perso'])) {
    $_SESSION['perso_tasks'][] = [
        'text' => htmlspecialchars($_POST['task_perso']),  // sécuriser l'entrée
        'priority' => $_POST['priority_perso'],            // récupérer la priorité
        'done' => false                                    // tâche non cochée
    ];
}

// Si une case est cochée dans la liste Perso
if (isset($_POST['check_perso_index'])) {
    $i = (int) $_POST['check_perso_index'];
    if (isset($_SESSION['perso_tasks'][$i])) {
        $_SESSION['perso_tasks'][$i]['done'] = !$_SESSION['perso_tasks'][$i]['done'];
    }
}
?>