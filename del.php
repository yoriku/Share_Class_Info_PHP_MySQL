<?php
header("Content-type: text/html; charset=utf-8");
if(empty($_GET)){
	header("Location:index.php");
	exit();
}
$display = False;
$content_id = $_GET["content_id"];
if(isset($_POST['del'])) {
    $display = True;
    try{
        require_once('dbconnect.php');
        $pdo = db_connect();
        $statement = $pdo->prepare("DELETE FROM content WHERE content_id LIKE (:content_id)");
        if($statement){
            $statement->bindValue(':content_id', $content_id, PDO::PARAM_INT);

            if($statement->execute()){
                $results = True;  
            }else{
                $results = False;  
            }
        }
        $pdo = null;	

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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js" ></script>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">(工学部２類用)授業情報共有</a>
    </div>
</nav>

<!--ここまでが上部ヘッダーユニット-->

<?php if($results == True): ?>
    <div class="alert alert-success text-center" role="alert">正常に削除しました</div>
<?php elseif($results == False && $display == True): ?>
    <div class="alert alert-danger text-center" role="alert">エラーが発生しました</div>
<?php endif; ?>

<div class="container text-center">
    <br>
    <?php if($display == False): ?>
        <h1>この情報を削除しますか？</h1>
    <?php endif; ?>
    <br>
    <form method="post">  
        <input type="hidden" name="content_id" value="<?=$content_id?>">
        <a class="btn btn-outline-dark btn-rounded btn-lg" href="index.php">戻る</a>
        <?php if($display == False): ?>
            <button type="submit" class="btn btn-danger btn-rounded" name="del">削除</button>
        <?php endif; ?>
    </form>
</div>
</body>
</html>
