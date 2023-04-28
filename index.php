<?php
header("Content-type: text/html; charset=utf-8");
try{
    require_once('dbconnect.php');
    $pdo = db_connect();
    $statement = $pdo->prepare("SELECT * FROM class");

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
    $pdo = null;	

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    $results = False; 
    
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
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
    <br>
<h1>授業に関して情報を共有するサイト</h1>
<br>
<!-- ここまでが上部ヘッダーユニット-->
<?php if($results == True): ?>
<div class="row">
<?php foreach((array)$rows as $row): ?>
    <div class="col-md-4">
        <div class="card text-center mb-6">
            <div class="card-body">
                <h3 class="card-title"><?=htmlspecialchars($row['classname'],ENT_QUOTES,'UTF-8')?></h3>
                <form action="detail.php" method="get">
                    <input type="hidden" name="class_id" value="<?=$row['class_id']?>">
                    <input type="hidden" name="classname" value="<?=$row['classname']?>">
                    <button type="submit" value="detail" class="btn btn-light btn-rounded">
                        詳細 <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<?php else: ?>
    <div class="alert alert-danger text-center" role="alert">エラーが発生しました</div>
<?php endif; ?>
<div class="fixed-bottom text-right m-4">
    <div class="position-absolute bottom-0 end-0">
        <a class="btn btn-primary btn-rounded btn-lg m-4" href="regiclass.php">授業を追加する <i class="fas fa-pen"></i></a>
    </div>
    
</div>
</div><!--container-end -->
</body>
</html>