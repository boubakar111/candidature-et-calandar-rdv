<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="fullcalendar/fullcalendar.min.css"/>
    <link rel="stylesheet" href="css/style.css">
    <script src="fullcalendar/lib/jquery.min.js"></script>
    <script src="fullcalendar/lib/moment.min.js"></script>
    <script src="fullcalendar/fullcalendar.min.js"></script>

    <script src="js/calendar.js"></script>

    <style>
        body {
            margin-top: 80px;
            text-align: center;
            font-size: 12px;
            font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
        }


    </style>
</head>
<body>
<header>
    <nav class="topNav">
        <div class="menuFlex">
            <div class="logo">

            </div>
            <div class="menu-toggle">
                <a href="#"><i class="fas fa-bars"></i></a>
            </div>
            <div class="menuDeskTop">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="calendar.php ">Calendrier </a></li>
                    <li><a href="#"></a></li>
                </ul>
            </div>
        </div>
        <div class="menu">
            <!--Mobile Dropdown Menu-->
            <ul>
                <a href="index.html">
                    <li>Home</li>
                </a>
                <a href="calendar.php ">
                    <li>Calendrier</li>
                </a>

            </ul>
        </div>
    </nav>
</header>

<h2>PHP Calendar et  JavaScript FullCalendar</h2>

<div class="response"></div>
<div id='calendar'></div>
</body>


</html>