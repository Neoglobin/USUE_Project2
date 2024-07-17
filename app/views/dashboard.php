<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PVS</title>
    <link rel="stylesheet" href="css/dashboard.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anta&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anta&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Saira+Semi+Condensed:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Левая панель -->
    <div class="container">
        <section class="leftPanel">
            <!-- Динамическая информация пользователя -->
            <div class="profile">
                <p class="clock">13:45</p>
                <img class="panelIcon" src="../views/img/warning_icon.png" alt="error">
                <div class="profileContent">
                    <img class="userIcon" src="../views/img/user_icon.png" alt="error">
                    <p>Александр</p>
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
                <img class="logoutImage" src="../views/img/logout_icon.png" alt="error">
                <img class="addImage" src="../views/img/add_icon.png" alt="error">
            </div>
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
                    </div>
                </div>
            </div>
        </section>

    </div>
</body>

</html>