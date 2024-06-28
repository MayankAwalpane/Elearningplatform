<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
$select_comments->execute([$user_id]);
$total_comments = $select_comments->rowCount();

$select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
$select_bookmark->execute([$user_id]);
$total_bookmarked = $select_bookmark->rowCount();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parul University</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color:#f0f0f0;
        }
    </style>

</head>

<body>

    <?php include 'components/user_header.php'; ?>

    <!-- quick select section starts  -->

    <section class="quick-select">

        <h1 class="heading"> NAAC A++ </h1>


        <div class="box-container">

            <?php
            if ($user_id != '') {
            ?>

                <div class="box">
                    <h3 class="title"><span>Notification &nbsp;</span><i class="fa-solid fa-bell"></i></h3>
                    <div class="flex">
                        <a href="#"><i class="fa-solid fa-bell"></i><span>New Cource Release</span></a>
                        <a href="#"><i class="fa-regular fa-newspaper"></i><span>Cource Status &ensp;</span></a>
                        <a href="#"><i class="fa-solid fa-thumbtack"></i><span>Current Video</span></a>

                    </div>
                </div>
                <div class="box">
                    
                    <h3 class="title">Student Dashboard</h3>
                    <p>Watch Videos: <span><?= $total_likes; ?></span></p>
                    <a href="likes.php" class="inline-btn">View History</a>
                    <p>Total completed : <span><?= $total_comments; ?></span></p>
                    <a href="comments.php" class="inline-btn">Completed cource</a>
                    <p>Saved playlist : <span><?= $total_bookmarked; ?></span></p>
                    <a href="bookmark.php" class="inline-btn">Your Library</a>
                </div>

               
            <?php
            } else {
            ?>
                <div class="box" style="text-align: center;">

                    <h3 class="title">Please Login or Register</h3>
                    <div class="flex-btn" style="padding-top: .5rem;">
                        <a href="login.php" class="option-btn">Login</a>
                        <a href="register.php" class="option-btn">Register</a>
                    </div>
                </div>
            <?php
            }
            ?>

            <!---Mayank ---->

            <div class="box1">

                <style>
                    .box1 {
                        background: transparent;
                        background-color: #f0f0f0;
                        color: black;
                    }
                </style>
                <h1 class="title"> Calender</h1>
                <div class="container">
                    <div class="calendar">
                        <div class="header1">

                            <div class="month"></div>
                            <div class="btns">
                                <div class="btn today-btn">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <div class="btn prev-btn">
                                    <i class="fas fa-chevron-left"></i>
                                </div>
                                <div class="btn next-btn">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="weekdays">
                            <div class="day">Sun</div>
                            <div class="day">Mon</div>
                            <div class="day">Tue</div>
                            <div class="day">Wed</div>
                            <div class="day">Thu</div>
                            <div class="day">Fri</div>
                            <div class="day">Sat</div>
                        </div>
                        <div class="days">
                            <!-- Din yaha se shuru hua h! -->
                        </div>
                    </div>
                </div>
                <style>
                    .calendar {

                        max-width: 400px;
                        margin: auto;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        padding: 10px;
                        margin-bottom: 10px solid #000;
                        background-color: #fff;
                    }

                    .header1 {

                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        background-color: #f0f0f0;

                    }


                    .month {
                        font-size: 35px;
                        font-style: inherit;
                        font-weight: bold;
                    }

                    .btns .btn {
                        cursor: pointer;
                        padding: 2px;
                        border-radius: 6px;
                    }

                    .weekdays {
                        display: flex;
                        justify-content: space-between;
                        margin-bottom: 10px;
                    }

                    .day {
                        width: calc(100% / 7);
                        text-align: center;
                        font-weight: bold;
                    }

                    .days {
                        display: flex;
                        flex-wrap: wrap;
                    }

                    .day {
                        width: calc(100% / 7);
                        text-align: center;
                        padding: 5px;
                    }

                    .prev-date,
                    .next-date {
                        color: #aaa;
                    }

                    .current-date {
                        background-color: #007bff;
                        color: white;
                        border-radius: 50%;
                    }

                    .events {
                        margin-top: 20px;
                    }

                    .event {
                        background-color: #f0f0f0;
                        padding: 5px;
                        margin-bottom: 5px;
                        border-radius: 3px;
                    }
                </style>
                <script>
                    const daysContainer = document.querySelector(".days"),
                        nextBtn = document.querySelector(".next-btn"),
                        prevBtn = document.querySelector(".prev-btn"),
                        month = document.querySelector(".month"),
                        todayBtn = document.querySelector(".today-btn");

                    const months = [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December",
                    ];

                    const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

                    // get current date
                    const date = new Date();

                    // get current month
                    let currentMonth = date.getMonth();

                    // get current year
                    let currentYear = date.getFullYear();

                    // function to render days
                    function renderCalendar() {
                        // get prev month current month and next month days
                        date.setDate(1);
                        const firstDay = new Date(currentYear, currentMonth, 1);
                        const lastDay = new Date(currentYear, currentMonth + 1, 0);
                        const lastDayIndex = lastDay.getDay();
                        const lastDayDate = lastDay.getDate();
                        const prevLastDay = new Date(currentYear, currentMonth, 0);
                        const prevLastDayDate = prevLastDay.getDate();
                        const nextDays = 7 - lastDayIndex - 1;

                        // update current year and month in header
                        month.innerHTML = `${months[currentMonth]} ${currentYear}`;

                        // update days html
                        let days = "";

                        // prev days html
                        for (let x = firstDay.getDay(); x > 0; x--) {
                            days += `<div class="day prev">${prevLastDayDate - x + 1}</div>`;
                        }

                        // current month days
                        for (let i = 1; i <= lastDayDate; i++) {
                            // check if its today then add today class
                            if (
                                i === new Date().getDate() &&
                                currentMonth === new Date().getMonth() &&
                                currentYear === new Date().getFullYear()
                            ) {
                                // if date month year matches add today
                                days += `<div class="day today">${i}</div>`;
                            } else {
                                //else dont add today
                                days += `<div class="day ">${i}</div>`;
                            }
                        }

                        // next MOnth days
                        for (let j = 1; j <= nextDays; j++) {
                            days += `<div class="day next">${j}</div>`;
                        }

                        // run this function with every calendar render
                        hideTodayBtn();
                        daysContainer.innerHTML = days;
                    }

                    renderCalendar();

                    nextBtn.addEventListener("click", () => {
                        // increase current month by one
                        currentMonth++;
                        if (currentMonth > 11) {
                            // if month gets greater that 11 make it 0 and increase year by one
                            currentMonth = 0;
                            currentYear++;
                        }
                        // rerender calendar
                        renderCalendar();
                    });

                    // prev monyh btn
                    prevBtn.addEventListener("click", () => {
                        // increase by one
                        currentMonth--;
                        // check if let than 0 then make it 11 and deacrease year
                        if (currentMonth < 0) {
                            currentMonth = 11;
                            currentYear--;
                        }
                        renderCalendar();
                    });

                    // go to today
                    todayBtn.addEventListener("click", () => {
                        // set month and year to current
                        currentMonth = date.getMonth();
                        currentYear = date.getFullYear();
                        // rerender calendar
                        renderCalendar();
                    });

                    // lets hide today btn if its already current month and vice versa

                    function hideTodayBtn() {
                        if (
                            currentMonth === new Date().getMonth() &&
                            currentYear === new Date().getFullYear()
                        ) {
                            todayBtn.style.display = "none";
                        } else {
                            todayBtn.style.display = "flex";
                        }
                    }
                </script>
            </div>

            <div class="box tutor">
                <h3 class="title">Login as Admin</h3>
                <p>Make sure you’re trying to log into your own website.</p>
                <a href="admin/register.php" class="inline-btn">get started</a>
            </div>

        </div>
        

    </section>

    <!-- quick select section ends -->

    <!-- courses section starts  -->

    <section class="courses">


        <h1 class="heading">Latest Courses</h1>

        <div class="box-container">

            <?php
            $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE status = ? ORDER BY date DESC LIMIT 6");
            $select_courses->execute(['active']);
            if ($select_courses->rowCount() > 0) {
                while ($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)) {
                    $course_id = $fetch_course['id'];

                    $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
                    $select_tutor->execute([$fetch_course['tutor_id']]);
                    $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
            ?>
                    <div class="box">
                        <div class="tutor">
                            <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
                            <div>
                                <h3><?= $fetch_tutor['name']; ?></h3>
                                <span><?= $fetch_course['date']; ?></span>
                            </div>
                        </div>
                        <img src="uploaded_files/<?= $fetch_course['thumb']; ?>" class="thumb" alt="">
                        <h3 class="title"><?= $fetch_course['title']; ?></h3>
                        <a href="playlist.php?get_id=<?= $course_id; ?>" class="inline-btn">view playlist</a>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no courses added yet!</p>';
            }
            ?>

        </div>

        <div class="more-btn">
            <a href="courses.php" class="inline-option-btn">View More</a>
        </div>

    </section>

    <!-- courses section ends -->

    <!-- footer section starts  -->
    <?php include 'components/footer.php'; ?>
    <!-- footer section ends -->

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>