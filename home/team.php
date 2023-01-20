<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/team.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <title>Team</title>
</head>
<body>
<?php require '../includes/nav.php'; ?>
  <div id="te-nav_large">
    <nav class="te-menu">
      <input type="checkbox" class="te-menu-open" name="menu-open" id="menu-open"/>
      <label class="te-menu-open-button" for="menu-open">
        <span class="te-hamburger te-hamburger-1"></span>
        <span class="te-hamburger te-hamburger-2"></span>
        <span class="te-hamburger te-hamburger-3"></span>
      </label>
      
      <a href="#" class="te-menu-item" onclick="show(2021);"> <i>2021-22</i> </a>
      <a href="#" class="te-menu-item" onclick="display(members_2020_1, 2020, 1); display(members_2020_2, 2020, 2); show(2020);"> <i>2020-21</i> </a>
      <a href="#" class="te-menu-item" onclick="display(members_2019_1, 2019, 1); display(members_2019_2, 2019, 2); show(2019);"> <i>2019-20</i> </a>
      <a href="#" class="te-menu-item" onclick="display(members_2018_1, 2018, 1); display(members_2018_2, 2018, 2); show(2018);"> <i>2018-19</i> </a>
      <a href="#" class="te-menu-item" onclick="display(members_2017_1, 2017, 1); display(members_2017_2, 2017, 2); show(2017);"> <i>2017-18</i> </a>
      <a href="#" class="te-menu-item" onclick="display(members_2016_1, 2016, 1); display(members_2016_2, 2016, 2); show(2016);"> <i>2016-17</i> </a>
    </nav>
    
    
    <!-- filters -->
    <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
        <defs>
          <filter id="shadowed-goo">
              
              <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="10" />
              <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
              <feGaussianBlur in="goo" stdDeviation="3" result="shadow" />
              <feColorMatrix in="shadow" mode="matrix" values="0 0 0 0 0  0 0 0 0 0  0 0 0 0 0  0 0 0 1 -0.2" result="shadow" />
              <feOffset in="shadow" dx="1" dy="1" result="shadow" />
              <feComposite in2="shadow" in="goo" result="goo" />
              <feComposite in2="goo" in="SourceGraphic" result="mix" />
          </filter>
          <filter id="goo">
              <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="10" />
              <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
              <feComposite in2="goo" in="SourceGraphic" result="mix" />
          </filter>
        </defs>
    </svg>
  </div>

  <div class="te-container_1" id="te-nav_small">
    <!-- <input type="checkbox" id="toggle" checked/> -->
    <div>
    <button class="te-button" for="toggle" onclick="display_navbar_mobile()"></button>
    </div>
    <br>
    <nav class="te-nav">
      <ul>
          <li><a href="#" onclick="show(2021);">2021-22</a></li>
          <li><a href="#" onclick="display(members_2020_1, 2020, 1); display(members_2020_2, 2020, 2); show(2020);">2020-21</a></li>
          <li><a href="#" onclick="display(members_2019_1, 2019, 1); display(members_2019_2, 2019, 2); show(2019);">2019-20</a></li>
          <li><a href="#" onclick="display(members_2018_1, 2018, 1); display(members_2018_2, 2018, 2); show(2018);">2018-19</a></li>
          <li><a href="#" onclick="display(members_2017_1, 2017, 1); display(members_2017_2, 2017, 2); show(2017);">2017-18</a></li>
          <li><a href="#" onclick="display(members_2016_1, 2016, 1); display(members_2016_2, 2016, 2); show(2016);">2016-17</a></li>
        </ul>
    </nav>
  </div>
    <!-- <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
          Select Year
        </button>
        <ul class="dropdown-menu" aria-labelledby="#dropdownMenuButton">
          <li><a class="dropdown-item" href="#te-main1">2016-17</a></li>
          <li><a class="dropdown-item" href="#te-main3">2017-18</a></li>
          <li><a class="dropdown-item" href="#te-main5">2018-19</a></li>
          <li><a class="dropdown-item" href="#te-main7">2019-20</a></li>
          <li><a class="dropdown-item" href="#te-main9">2020-21</a></li>
          <li><a class="dropdown-item" href="#te-main11">2021-22</a></li>
        </ul>
    </div> -->

    <div class="container-xxl pb-3">
      <div class="container-fluid">
        <div id="te-yr-2021">
          <h1 class="te-heading">Team of Electronics 2021-22</h1>
          <div id="te-main-2021-1" class="row g-4"></div>
          <h1 class="te-heading">Team of Book 2021-22</h1>
          <div id="te-main-2021-2" class="row g-4"></div>
        </div>
        <div id="te-yr-2020">
          <h1 class="te-heading">Team of Electronics 2020-21</h1>
          <div id="te-main-2020-1" class="row g-4"></div>
          <h1 class="te-heading">Team of Book 2020-21</h1>
          <div id="te-main-2020-2" class="row g-4"></div>
        </div>

        <div id="te-yr-2019">
          <h1 class="te-heading">Team of Electronics 2019-20</h1>
          <div id="te-main-2019-1" class="row g-4"></div>
          <h1 class="te-heading">Team of Book 2019-20</h1>
          <div id="te-main-2019-2" class="row g-4"></div>
        </div>

        <div id="te-yr-2018">
          <h1 class="te-heading">Team of Electronics 2018-19</h1>
          <div id="te-main-2018-1" class="row g-4"></div>
          <h1 class="te-heading">Team of Book 2018-19</h1>
          <div id="te-main-2018-2" class="row g-4"></div>
        </div>

        <div id="te-yr-2017">
          <h1 class="te-heading">Team of Electronics 2017-18</h1>
          <div id="te-main-2017-1" class="row g-4"></div>
          <h1 class="te-heading">Team of Book 2017-18</h1>
          <div id="te-main-2017-2" class="row g-4"></div>
        </div>

        <div id="te-yr-2016">
          <h1 class="te-heading">Team of Electronics 2016-17</h1>
          <div id="te-main-2016-1" class="row g-4"></div>
          <h1 class="te-heading">Team of Book 2016-17</h1>
          <div id="te-main-2016-2" class="row g-4"></div>
        </div>
    </div>
  </div>
  <?php include("../includes/ec-footer.php") ?>
    <script src="../js/team.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>