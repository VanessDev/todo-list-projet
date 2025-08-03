<?php
    session_start();

    if (!isset($_SESSION["lists"])) {
        $_SESSION["lists"] = [];
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $action = $_POST["action"] ?? "";

        if ($action === "add") {
            $title = htmlspecialchars(trim($_POST["title"] ?? ""));
            $task = htmlspecialchars(trim($_POST["task"] ?? ""));
            $type = htmlspecialchars(trim($_POST["type"] ?? "default"));
            $priority = htmlspecialchars(trim($_POST["priority"] ?? "low"));

            if (!empty($title) && !empty($task)) {
                if (!isset($_SESSION["lists"][$title])) {
                    $_SESSION["lists"][$title] = [
                        "type" => $type,
                        "tasks" => []
                    ];
                }

                array_unshift($_SESSION["lists"][$title]["tasks"], [
                    "text" => $task,
                    "priority" => $priority
                ]);
            }

        } elseif ($action === "deleteTask") {
            $title = $_POST["title"] ?? "";
            $index = $_POST["taskIndex"] ?? "";

            if (isset($_SESSION["lists"][$title]["tasks"][$index])) {
                unset($_SESSION["lists"][$title]["tasks"][$index]);
                $_SESSION["lists"][$title]["tasks"] = array_values($_SESSION["lists"][$title]["tasks"]);
            }

        } elseif ($action === "deleteList") {
            $title = $_POST["title"] ?? "";
            unset($_SESSION["lists"][$title]);
        }
    }

    $lists = $_SESSION["lists"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../asset/style/style.css">
</head>
<body>
    <header>
        <?php include "../asset/header.php"; ?>
    </header>
    <main class="main-site">

        <form method="POST" class="add-form">
            <input type="text" name="title" placeholder="Titre de la liste" required>
            <input type="text" name="task" placeholder="Nouvelle tâche" required>
            
            <select name="type" required>
                <option value="work">Professionnel</option>
                <option value="personal">Personnel</option>
                <option value="shopping">Courses</option>
                <option value="default">Autres</option>
            </select>

            <select name="priority" required>
                <option value="low">Peu important</option>
                <option value="medium">important</option>
                <option value="high">Urgent</option>
            </select>

            <button type="submit" name="action" value="add">Ajouter une tâche</button>
        </form>
        <div class="card-container">
            <?php foreach ($lists as $title => $data): 
                $type = $data["type"];
                $img = match ($type) {
                    "work" => "../asset/img/background-work-list.png",
                    "personal" => "../asset/img/background-home-list.png",
                    "shopping" => "../asset/img/background-shopping-list.png",
                    default => "../asset/img/background-other-list.png"
                };
            ?>
            <div class="card" style="background-image: url('<?= $img ?>');">
                <div class="card-overlay">
                    <h2><?= htmlspecialchars($title) ?></h2>

                    <!-- Supprimer toute la liste -->
                    <form method="POST" class="delete-form">
                        <input type="hidden" name="title" value="<?= htmlspecialchars($title) ?>">
                        <button type="submit" name="action" value="deleteList">🗑️ Supprimer la liste</button>
                    </form>

                    <ul>
                        <?php foreach ($data["tasks"] as $i => $task): ?>
                            <li class="task-item <?= htmlspecialchars($task["priority"]) ?>">
                                <?= htmlspecialchars($task["text"]) ?>

                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="title" value="<?= htmlspecialchars($title) ?>">
                                    <input type="hidden" name="taskIndex" value="<?= $i ?>">
                                    <button type="submit" name="action" value="deleteTask">🗑️</button>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php endforeach; ?>
        </div>


    </main>
    <footer>
        <?php include "../asset/footer.php"; ?>
    </footer>
</body>
</html>