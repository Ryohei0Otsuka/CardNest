<?php
// funcs.php をインクルードして PDO インスタンスを取得
include "funcs.php";
$pdo = db_con();

// ページング用のパラメータを取得
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$perPage = 10; // 1ページあたりのリスト数

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchKeyword = '%'.h($_GET['search']).'%';
} else {
    $searchKeyword = '';
}

// 全体のリスト数を初期化
$totalRows = 0;

$query = "SELECT * FROM cardnest_company";
if (!empty($searchKeyword)) {
    $query .= " WHERE company LIKE :keyword";
}


$stmt = $pdo->prepare("$query LIMIT :offset, :perPage");
$stmt->bindValue(':offset', ($page - 1) * $perPage, PDO::PARAM_INT);
$stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT); 
if (!empty($searchKeyword)) {
    $stmt->bindValue(':keyword', $searchKeyword, PDO::PARAM_STR);
}

$stmt->execute();

$company = '';

while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $company .= '<li>';
    $company .= '<a href="company.php?id='.$result["id"].'">';
    $company .= $result["company"];
    $company .= '</a>';
    $company .= '</li>';
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Nest</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="CSS/style00.css">
    <link rel="icon" href="img/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Noto+Sans+JP:wght@100..900&family=Sawarabi+Mincho&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <header class="header">
            <div class="top-link">
                <a href="index.php">
                    <p class="title">Card Nest</p>
                    <img src="img/icon.jpg" alt="Card Nest">
                </a>
            </div>
            <div class="search">
                <form action="index.php" method="get" autocomplete="off">
                    <label for="search">会社名検索</label>
                    <input type="text" id="search" name="search">
                    <button type="submit">検索</button>
                </form>
            </div>
        </header>
        <hr>
        <main>
            <div>
                <p class="list-title">登録会社一覧</p>
            </div>

            <div class="company-list">
                <ul>
                    <?= $company ?>
                </ul>
            </div>

            <?php if ($totalRows > $perPage) : ?>
                <div class="pagination-wrapper">
                    <div class="pagination">
                        <?php if ($page > 1) : ?>
                            <a href="?page=1">≪</a>
                            <a href="?page=<?= $page - 1 ?>">＜</a>
                        <?php endif; ?>

                        <?php for ($i = max(1, $page - $numArrows); $i <= min(ceil($totalRows / $perPage), $page + $numArrows); $i++) : ?>
                            <a href="?page=<?= $i ?>" <?= $i === $page ? 'class="current"' : '' ?>><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < ceil($totalRows / $perPage)) : ?>
                            <a href="?page=<?= $page + 1 ?>">＞</a>
                            <a href="?page=<?= ceil($totalRows / $perPage) ?>">≫</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div>
                <a class="new-regi" href="regist-company.php">
                    <p>会社データ登録</p>
                </a>
            </div>

        </main>
    </div>
</body>

</html>