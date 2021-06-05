<html>

<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">

<title>apply</title>
</head>

<body>

<div class="a">

    <div class = "header">
        <h1>
            男子卓球部目標管理フォーム
        </h1>
    </div>

    <div class="mainap">
        </br>

    <?php
        if('POST' == $_SERVER['REQUEST_METHOD']){
            db_write();     
        }
        else{
            form_write();
        }

    function db_write(){ 
        try {
            $mysqltime = date ("Y-m-d H:i:s");
            $db = new PDO('mysql:host=157.112.147.201;dbname=kotababattc_bb1','kotababattc_shu','asdfghjkl');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q = $db->prepare("INSERT INTO niigatattc (year,name,improve,objective,task,time) VALUES (:year,:name,:improve,:objective,:task,:time)");
            $q->bindParam(':year', $_POST['year']);
            $q->bindParam(':improve', $_POST['improve']);
            $q->bindParam(':objective', $_POST['objective']);
            $q->bindParam(':name', $_POST['name']);
            $q->bindParam(':task', $_POST['task']);
            $q->bindParam(':time', $mysqltime);
            $q->execute();
        }catch(PDOException $e){
            echo"データベースに接続できません　もう一度やり直してください：".$e->getMessage();?>
            <META http-equiv="Refresh" content="100;apply.php"><?php
        }

        if($q === false){
            $error = $db->errorinfo();
            print "データ挿入が出来ませんでした。<br>";
            print "SQL Error={$error[0]},DB Error={$error[1]},Message={$error[2]}";?>
            </br><META http-equiv="Refresh" content="100;apply.php"><?php
        }
        echo "<p>フォームを送信しました。</p>";
    }

    function form_write(){       
        ?>
           
                    <form action="apply.php" method="post">
                        <p>学年：
                            <select name = "year" value="1">
                                <?php for($i=1;$i<=4;$i++){?>
                                    <option value="<?php echo $i; ?>"><?php echo $i ?></option><?php } ?>
                            </select>
                            </br>
                            名前：<input type="text" name = "name" ></br>
                        </p>
                        <div class="textarea">
                            先月の目標に対する反省点・改善点:</br><textarea class = "box3"name = "improve" rows= "6" cols="50" wrap="soft" placeholder="ここに記入してください"></textarea>
                        </div>
                        <div class="textarea">
                            月間目標:</br><textarea class = "box3"name = "objective" rows= "2" cols="50" wrap="soft" placeholder="例：春大会ベスト８"></textarea>
                        </div>
                        <div class="textarea">
                            目標達成の為の課題:</br><textarea class = "box3"name = "task" rows= "6" cols="50" wrap="soft" placeholder="ここに記入してください"></textarea>
                        </div>
                        
                        </br>
                        </br>
                        <div class="textarea">
                            <input type="submit">
                        </div>
                    </form>
                <?php
        }   
                
                
        ?>
    </div>

    <footer>
        <div class="wrapper">
            <p><small>&copy; 2021 NIIGATA UNIV</small></p>
        </div>

    </footer>
</div>
</body>
</html>