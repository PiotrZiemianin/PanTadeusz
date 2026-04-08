<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Pan Tadeusz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="bg-dark text-white text-center py-4">
        <h1>Pan Tadeusz</h1>
    </header>
    <div class="container-fluid flex-grow-1 mt-4 mb-5">
        <div class="row">
            <aside class="col-md-3 bg-light p-3">
                <h4 class="text-center">Spis treści</h4>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="index.php">Strona główna</a></li>
                    <li class="nav-item">
                        <?php
                            for($k=1;$k<=12;$k++){
                                $class = (isset($_GET['k']) && $_GET['k'] == $k) ? 'active' : '';
                                echo "<a href='?k=$k.html' class='nav-link'>Księga $k</a>";
                            }
                        ?>
                    </li>
                </ul>
            </aside>
            <main class="col-md-9">
                <?php
                if (isset($_GET['k'])){
                    $k = $_GET['k'];
                    include_once "k$k";
                } else {
                    echo '<img src="Pan_Tadeusz.png" class="img-fluid mt-3" alt="Pan Tadeusz">';
                }
                ?>
            </main>
        </div>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">Wykonał: <strong>Piotr Ziemianin</strong></p>
    </footer>
</body>
</html>
