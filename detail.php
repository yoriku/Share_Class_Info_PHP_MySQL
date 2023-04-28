<?php
header("Content-type: text/html; charset=utf-8");
if(empty($_GET)){
	header("Location:index.php");
	exit();
}
$classname = $_GET["classname"];
$class_id = $_GET["class_id"];

try{
    require_once('dbconnect.php');
    $pdo = db_connect();
    $statement = $pdo->prepare("SELECT * FROM content WHERE (class_id) LIKE (:class_id)");
    if($statement){
        $statement->bindValue(':class_id', $class_id, PDO::PARAM_INT);

        if($statement->execute()){
            //レコード件数取得
            $row_count = $statement->rowCount();
            while($row = $statement->fetch()){
                $rows[] = $row;
            }
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
?>

<!DOCTYPE html>
<html>
<head>
<html lang="ja">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
    <link href="src/alert.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js" ></script>
<title>授業情報共有</title>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">(工学部２類用)授業情報共有</a>
    </div>
</nav>

<div class="container text-center">
<!--ここまでが上部ヘッダーユニット-->
<?php if ($results == True): ?>
	<br><h1><?=htmlspecialchars($classname,ENT_QUOTES,'UTF-8')?>の情報</h1><br>

<?php if($row_count === 0): ?>
<p>登録情報はありません<br>下のボタンより追加してください</p>
<?php endif; ?>


<table class="table text-left">
    <tbody>
        <?php foreach($rows as $row): ?> 
            <tr>
                <td><?=htmlspecialchars($row['content'],ENT_QUOTES,'UTF-8')?></td>
                <td>
                    <form action="del.php" method="get">
                            <input type="hidden" name="content_id" value="<?=$row['content_id']?>">
                            <button type="submit" value="detail" class="btn btn-light btn-rounded"><i class="fas fa-trash-can"></i></button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

 
<?php else: ?>
	<div class="alert alert-danger text-center" role="alert">エラーが発生しました</div>
<?php endif; ?>
<br>
<br>
</div>
<div class="fixed-bottom m-4">
    <div class="position-absolute bottom-0 start-0">
        <a class="btn btn-secondary btn-floating btn-lg" href="regiclass.php">
            <i class="fas fa-angle-left"></i>
        </a>
    </div>
    <div class="position-absolute bottom-0 end-0">
        <form action="regidetail.php" method="get">
            <input type="hidden" name="class_id" value="<?=$class_id?>">
            <button type="submit" value="search" class="btn btn-primary btn-rounded btn-lg">情報を追加する  <i class="fas fa-pen"></i></button>
        </form>
    </div>

</div>

</div>
</body>
</html>
