<?php
session_start();

require_once '../models/authentificator.php';

if (!empty($_COOKIE['access_token'])) {
    verify_token($_COOKIE['access_token']);
} else {
    $_SESSION['access_denied'] = true;
}

if (!empty($_SESSION['access_denied'])) {
    $_SESSION['auth_failed'] = 'Отказано в доступе';
    header('Location: ../models/logout.php');
    die;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PVS Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anta&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anta&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Saira+Semi+Condensed:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <?php if (!empty($_SESSION['access_accepted'])) : ?>
        <!-- Левая панель -->
        <div class="container">
            <section class="leftPanel">
                <!-- Динамическая информация пользователя -->
                <div class="profile">
                    <p class="clock">13:45</p>
                    <img class="panelIcon" src="../views/img/warning_icon.png" alt="error">
                    <div class="profileContent">
                        <div style="text-align: center;">
                            <img class="userIcon" src="../views/img/user_icon.png" alt="error">
                        </div>
                        <?php echo '<p>' . $_SESSION['username'] . '</p>'; ?>
                        <h3>Уведомления</h3>
                    </div>
                </div>
                <!-- Область уведомлений -->
                <div class="notifyArea">
                    <div class="notifyBlock">
                        <div class="notifyUpperString">
                            <h3>11:26</h3>
                            <h3>Реализован</h3>
                            <img src="../views/img/close_icon.png" alt="error">
                        </div>
                        <div class="notifyLowerString">
                            <p>A-12345</p>
                            <p>N-34005900008411</p>
                        </div>
                    </div>
                    <div class="notifyBlock">
                        <div class="notifyUpperString">
                            <h3>11:26</h3>
                            <h3>Реализован</h3>
                            <img src="../views/img/close_icon.png" alt="error">
                        </div>
                        <div class="notifyLowerString">
                            <p>A-12345</p>
                            <p>N-34005900008411</p>
                        </div>
                    </div>
                    <div class="notifyBlock">
                        <div class="notifyUpperString">
                            <h3>11:26</h3>
                            <h3>Реализован</h3>
                            <img src="../views/img/close_icon.png" alt="error">
                        </div>
                        <div class="notifyLowerString">
                            <p>A-12345</p>
                            <p>N-34005900008411</p>
                        </div>
                    </div>
                    <div class="notifyBlock">
                        <div class="notifyUpperString">
                            <h3>11:26</h3>
                            <h3>Реализован</h3>
                            <img src="../views/img/close_icon.png" alt="error">
                        </div>
                        <div class="notifyLowerString">
                            <p>A-12345</p>
                            <p>N-34005900008411</p>
                        </div>
                    </div>
                </div>
                <!-- Панель кнопок -->
                <div class="buttonPanel">
                    <a href="../models/logout.php"><img class="logoutImage" src="../views/img/logout_icon.png" alt="error"></a>

                    <img class="addImage" src="../views/img/add_icon.png" alt="error">
            </section>

            <!-- Правая панель -->
            <section class="rightPanel">
                <div class="header">
                    <div>
                        <a href="">PVS</a>
                    </div>
                </div>

                <div class="mainArea">
                    <!-- Левая часть (область изменений) -->
                    <div class="mainAreaLeft">
                        <div>
                            <a href="">
                                <button class="catalogBtn">
                                    <p>Категории товаров</p>
                                </button>
                            </a>
                        </div>
                        <div class="changeList">
                            <h3>Список изменений</h3>
                            <div class="listing">
                                <img src="../views/img/back_icon.png" alt="error">
                                <p>3/5</p>
                                <img src=" ../views/img/next_icon.png" alt="error">
                            </div>
                            <div class="changeBlock">
                                <div class="changeBlockHeader">
                                    <p>A-12345</p>
                                    <p>N-34005900008411</p>
                                </div>
                                <p>Удаление записи</p>
                                <div class="changeBlockFooter">
                                    <p>Изменения внесены</p>
                                    <div class="changeInfo">
                                        <p>10.07.2024</p>
                                        <p>16:35</p>
                                        <p>Александр</p>
                                    </div>
                                </div>
                            </div>
                            <div class="changeBlock">
                                <div class="changeBlockHeader">
                                    <p>A-12345</p>
                                    <p>N-34005900008411</p>
                                </div>
                                <p>Удаление записи</p>
                                <div class="changeBlockFooter">
                                    <p>Изменения внесены</p>
                                    <div class="changeInfo">
                                        <p>10.07.2024</p>
                                        <p>16:35</p>
                                        <p>Александр</p>
                                    </div>
                                </div>
                            </div>
                            <div class="changeBlock">
                                <div class="changeBlockHeader">
                                    <p>A-12345</p>
                                    <p>N-34005900008411</p>
                                </div>
                                <p>Удаление записи</p>
                                <div class="changeBlockFooter">
                                    <p>Изменения внесены</p>
                                    <div class="changeInfo">
                                        <p>10.07.2024</p>
                                        <p>16:35</p>
                                        <p>Александр</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button class="changeConfirmBtn">
                                    <p>Подтвердить</p>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Правая часть (информационная облать) -->
                    <div class="mainAreaRight">
                        <h1>Список товаров</h1>
                        <!-- Панель поиска и пагинации -->
                        <div class="navbar">
                            <div class="navpanel">
                                <div>
                                    <select class="navOptions" name="stage" id="stage">
                                        <option value="active">
                                            <p>Активные</p>
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <button class="navPagging" style="background-color: #BC46E8;">
                                        <p>1</p>
                                    </button>
                                </div>
                                <div>
                                    <button class="navPagging">
                                        <p>2</p>
                                    </button>
                                </div>
                                <div>
                                    <button class="navPagging">
                                        <p>3</p>
                                    </button>
                                </div>
                                <div>
                                    <button class="navPagging">
                                        <p>4</p>
                                    </button>
                                </div>
                                <div>
                                    <button class="navPagging">
                                        <p>5</p>
                                    </button>
                                </div>
                            </div>
                            <p>7/14</p>
                            <form class="searchPanel" action="">
                                <div>
                                    <input class="searchbar" type="text" placeholder="Поиск">
                                </div>
                                <div>
                                    <button class="searchBtn">
                                        <p>Найти</p>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Отображение элементов -->
                        <div class="contentContainer">
                            <div style="margin-top: 55px;" class="element">
                                <div class="content">
                                    <img src="../views/img/green_indication.png" alt="error">
                                    <h3>A-12345 | N-34005900008411</h3>
                                    <h2>0% Фасовочная лента "Золотой цыплёнок"</h2>
                                    <h3>10.07.2024 10:30 | 15.07.2024 10:30</h3>
                                    <div class="editPanel">
                                        <img src="../views/img/pencil_icon.png" alt="error">
                                        <img src="../views/img/bin_icon.png" alt="error">
                                    </div>
                                </div>
                            </div>
                            <div class="element">
                                <div class="content">
                                    <img src="../views/img/green_indication.png" alt="error">
                                    <h3>A-12345 | N-34005900008411</h3>
                                    <h2>0% Фасовочная лента "Золотой цыплёнок"</h2>
                                    <h3>10.07.2024 10:30 | 15.07.2024 10:30</h3>
                                    <div class="editPanel">
                                        <img src="../views/img/pencil_icon.png" alt="error">
                                        <img src="../views/img/bin_icon.png" alt="error">
                                    </div>
                                </div>
                            </div>
                            <div class="element">
                                <div class="content">
                                    <img src="../views/img/green_indication.png" alt="error">
                                    <h3>A-12345 | N-34005900008411</h3>
                                    <h2>0% Фасовочная лента "Золотой цыплёнок"</h2>
                                    <h3>10.07.2024 10:30 | 15.07.2024 10:30</h3>
                                    <div class="editPanel">
                                        <img src="../views/img/pencil_icon.png" alt="error">
                                        <img src="../views/img/bin_icon.png" alt="error">
                                    </div>
                                </div>
                            </div>
                            <div class="element">
                                <div class="content">
                                    <img src="../views/img/green_indication.png" alt="error">
                                    <h3>A-12345 | N-34005900008411</h3>
                                    <h2>0% Фасовочная лента "Золотой цыплёнок"</h2>
                                    <h3>10.07.2024 10:30 | 15.07.2024 10:30</h3>
                                    <div class="editPanel">
                                        <img src="../views/img/pencil_icon.png" alt="error">
                                        <img src="../views/img/bin_icon.png" alt="error">
                                    </div>
                                </div>
                            </div>
                            <div class="element">
                                <div class="content">
                                    <img src="../views/img/green_indication.png" alt="error">
                                    <h3>A-12345 | N-34005900008411</h3>
                                    <h2>0% Фасовочная лента "Золотой цыплёнок"</h2>
                                    <h3>10.07.2024 10:30 | 15.07.2024 10:30</h3>
                                    <div class="editPanel">
                                        <img src="../views/img/pencil_icon.png" alt="error">
                                        <img src="../views/img/bin_icon.png" alt="error">
                                    </div>
                                </div>
                            </div>
                            <div class="element">
                                <div class="content">
                                    <img src="../views/img/green_indication.png" alt="error">
                                    <h3>A-12345 | N-34005900008411</h3>
                                    <h2>0% Фасовочная лента "Золотой цыплёнок"</h2>
                                    <h3>10.07.2024 10:30 | 15.07.2024 10:30</h3>
                                    <div class="editPanel">
                                        <img src="../views/img/pencil_icon.png" alt="error">
                                        <img src="../views/img/bin_icon.png" alt="error">
                                    </div>
                                </div>
                            </div>
                            <div class="element">
                                <div class="content">
                                    <img src="../views/img/green_indication.png" alt="error">
                                    <h3>A-12345 | N-34005900008411</h3>
                                    <h2>0% Фасовочная лента "Золотой цыплёнок"</h2>
                                    <h3>10.07.2024 10:30 | 15.07.2024 10:30</h3>
                                    <div class="editPanel">
                                        <img src="../views/img/pencil_icon.png" alt="error">
                                        <img src="../views/img/bin_icon.png" alt="error">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <p class="footerText">Product verification system</p>
                    </div>
                </div>
            </section>

        </div>
    <?php endif; ?>
</body>

</html>