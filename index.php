<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Pan Tadeusz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="bg-danger text-white text-center py-4">
        <h1>Pan Tadeusz</h1><br>
        <h5>Adam Mickiewicz</h5>
    </header>
    <div class="container-fluid flex-grow-1 mt-4 mb-5">
        <div class="row">
            <aside class="col-md-3 bg-light p-3">
                <h4 class="text-center">Spis treści</h4>
                <ul class="nav flex-column">
                    <li class="nav-item "><a class="nav-link" href="index.php">Strona główna</a></li>
                    <li class="nav-item ">
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
                    echo '                
                    <div class="container">
                        <div class="row">
                            <div class="col">';
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $nick = $_POST['nick'];
                        $email = $_POST['email'];
                        $comment = $_POST['comment'];
                         echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Przesłane dane:<ul>
                                    <li>Pseudonim: '.$nick.'</li>
                                    <li>Adres e-mail: '.$email.'</li>
                                    <li>Komentarz: '.$comment.'</li>
                                </ul>
                                Komentarz czeka na weryfikację!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        $row =[$nick,$email,$comment,'unverified'];
                        $fp = fopen('comments.csv','a');
                        fputcsv ($fp,$row,';','"','');
                        fclose ($fp);
                    }
                    $rows = array_map(fn($v) => str_getcsv($v,";"), file('comments.csv'));
                    $header = array_shift($rows);
                    $comments = array();
                    foreach ($rows as $row){
                        $comments[] = array_combine($header,$row);
                    }
                    foreach ($comments as $comment){
                        if($comment["Status"] ==  'approved'){
                            echo '
                            <div class="card mb-3">
                                <div class="card-header text-bg-danger">
                                    '.$comment["E-mail"].'
                                </div>
                                <div class="card-body">
                                    <figure>
                                        <blockquote class="blockquote">
                                            <p>'.$comment["Komentarz"].'</p>
                                        </blockquote>
                                        <figcaption class="blockquote-footer">
                                            '.$comment["Pseudonim"].'
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>';
                        }
                    }
                    echo'
                            </div>
                            <div class="col">
                                <img src="Pan_Tadeusz.png" class="img-fluid mt-3 rounded" alt="Pan Tadeusz">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="nick" class="form-label">Pseudonim</label>
                                        <input name="nick" type="text" class="form-control" id="nick" placeholder="podaj pseudonim">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Adres e-mail</label>
                                        <input name="email" type="email" class="form-control" id="email" placeholder="podaj adres e-mail">
                                    </div>
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Komentarz</label>
                                        <textarea name="comment" class="form-control" id="comment" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <button type=""submit class="btn btn-danger">Prześlij</button>
                                    </div>
                                </form>                 
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </main>
        </div>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">Wykonał: <strong>Piotr Ziemianin. Akademia Nauk Stosowanych w Nowym Targu</strong></p>
    </footer>
</body>
</html>


