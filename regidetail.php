<?php
header("Content-type: text/html; charset=utf-8");
if(empty($_GET)){
	header("Location:index.php");
	exit();
}
$class_id = $_GET['class_id'];
if(isset($_POST['regi'])) {
    try{
        require_once('dbconnect.php');
        $pdo = db_connect();
        $statement = $pdo->prepare("INSERT INTO content (class_id, content) VALUES (:class_id, :content)");

        if($statement){
            $statement->bindValue(':class_id', $class_id, PDO::PARAM_INT);
            $statement->bindValue(':content', $_POST['content'], PDO::PARAM_STR);
            
            if($statement->execute()){
                $results = True;         
            }else{
                $results = False; 
            }
            $pdo = null;	
        }
    }catch (PDOException $e){
        print('Error:'.$e->getMessage());
        $results = False;
    } 
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<title>授業情報共有</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
    <link href="src/alert.css" rel="stylesheet" />
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">(工学部２類用)授業情報共有</a>
    </div>
</nav>

<!--ここまでが上部ヘッダーユニット-->

<?php if($results == True): ?>
    <div class="alert alert-success text-center" role="alert">登録しました</div>
<?php elseif($results == True): ?>
    <div class="alert alert-danger text-center" role="alert">エラーが発生しました</div>
<?php endif; ?>

<div class="container text-center">
    <br>
    <h1>新しく登録</h1>
    <form method="post">
        <div class="card mb-6">
            <div class="card-body">
                <h3 class="card-title">授業の詳細を登録</h3>
                <div class="form-outline mb-6">
                    <input type="text" name="content" id="form_class" class="form-control" required />
                    <label class="form-label" for="form_class">授業の詳細</label>
                </div>
                <div class="text_right">
                    <a class="btn btn-light btn-rounded" href="index.php">戻る</a>
                    <button type="submit" class="btn btn-primary btn-rounded" name="regi">登録</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js" ></script>

</body>
</html>
