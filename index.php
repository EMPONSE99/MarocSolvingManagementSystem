<?php

require_once 'php_action/db_connect.php';

session_start();
$errors = array();

if($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        if($username == "")
            $error[] = "le nom d'utilisateur est requis";
            }
            if($password = "") {
                $errors[] = "Mots de passe est requis";
            } else {
            $sql = "SELECT * FROM users WHERE username='$username'";
            $result = $connect->query($sql);
            
            if($result->num_rows == 1) {
                $password = md5($password);
                // exists
                $mainSql = "SELECT * FROM users WHERE username = '$username' AND password ='$password'";
                $mainResult = $connect->query($mainSql);
                
                if($mainResult->num_rows == 1){
                    $value = $mainResult->fetch_assoc();
                    $user_id = $value['user_id'];
                    
                    // set session
                    $_SESSION['userId'] = $user_id;
                    
                    header('location: http://localhost/SystemBuild/dashboard.php');
                } else {
                    $errors[] = "Combinaison nom d'utilisateur / mot de passe incorrecte";
                
                }
            } else {
                $erros[] = "le nom d'utilisateur n'existe pas";
            }
            }
    
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maroc Solving Management System</title>
    <!-- linking Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Optional theme -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->
    <!-- font awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- custom css -->
    <link rel="stylesheet" href="custom\css\custom.css">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- jqueryui -->
    <!-- <link rel="stylesheet" type="text/css" href="assets\jquery-ui\jquery-ui.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row vertical">
            <div class="col-md-5 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel panel-info">
                    <div class="panel-heading"></div>
                    <h3 class="panel-title">Veuillez Vous Connecter</h3>
                    </div>
                    <div class="panel-body">
                        <div class="messeges">
                            <?php if($errors) {
	                            foreach ($errors as $key => $value) {
                                    echo '<div class="alert alert-warning" role="alert">
		                            <i class="glyphicon glyphicon-exclamation-sign"></i>
		                            '.$value.'</div>';
                                }
                            } ?>
                        </div>
                    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id="loginForm">
                        <div class="form-group">
                            <label for="username">Email</label>
                                <input type="email" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="email">
                                    <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais vos informations avec quiconque.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
            <!-- col-md-5 -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</body>
</html>


