<!doctype html>
<html>
<head>
    <title></title>
    <?=$this->getMeta()?>
</head>
<body>
    <h1>Main layout</h1>
    <p><?=$content?></p>

    <?php
        $logs = \R::getDatabaseAdapter()
            ->getDatabase()
            ->getLogger();

        //debug($logs);

    ?>
</body>
</html>