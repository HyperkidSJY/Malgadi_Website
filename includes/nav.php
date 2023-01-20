<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>NAVBAR</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/nav-bootstrap.css">
    <link rel="stylesheet" href="../css/nav.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

    
<body>
    <nav class="my-navbar">
        <div class="logo">
            <a href="../home/index.php"><img src="../photos/home-logo.png" alt=""></a>
        </div>
        <form action="search.php">
            <input type="search" name="" id="search" placeholder="Search for items...">
            <button><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
        <ul>
            <li class="drop"><a role="link" aria-disabled="true">Categories<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                <ul class="drop-items">
                    <li class="d-item"><a href="">Basic Components</a></li>
                    <li class="d-item"><a href="">Robotics</a></li>
                    <li class="d-item"><a href="">Controllers</a></li>   
                    <li class="d-item"><a href="">Sensors</a></li>   
                    <li class="d-item"><a href="">IC</a></li>   
                    <li class="d-item"><a href="">Kits</a></li>   
                    <li class="d-item"><a href="">EG Kits</a></li>   
                </ul>
            </li>
        </ul>
        <div class="my-nav-items">
            <ul>
                <li class="item"><a href="">Home</a></li>
                <li class="item"><a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i>Cart</a></li>
                <li class="item"><a href=""><i class="fa fa-truck fa-flip-horizontal"></i>Track Order</a></li>
                <li class="item"><a href="">Special Order</a></li>
            </ul>
        </div>
        
    </nav>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div id="dismiss">
                <i class="fa fa-arrow-left"></i>
            </div>

            <div class="side-logo">
                <a href="../home/index.php"><img src="../photos/home-logo.png" alt=""></a>
            </div>

            <ul class="list-unstyled components">
                <li><a href="#">Home</a></li>
                <li><a href="#">Cart<i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                <li><a href="#">Track Order<i class="fa fa-truck"></i></a></li>
                <li><a href="#">Special Order</a></li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Categories<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Basic Components</a>
                        </li>
                        <li>
                            <a href="#">Robotics</a>
                        </li>
                        <li>
                            <a href="#">Controllers</a>
                        </li>
                        <li>
                            <a href="#">Sensors</a>
                        </li>
                        <li>
                            <a href="#">I.C</a>
                        </li>
                        <li>
                            <a href="#">Kits</a>
                        </li>
                        <li>
                            <a href="#">E.G Kits</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <div class="logo">
                        <a href="../home/index.php"><img src="../photos/home-logo.png" alt=""></a>
                    </div>
                    <form action="search.php">
                        <input type="search" name="" id="search" placeholder="Search for items...">
                    </form>
                    <button class="srch-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <button class="close-btn"><i class="fa fa-times" aria-hidden="true"></i></button>
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                </div>
            </nav>
        </div>
    </div>

    <!-- <div class="overlay"></div> -->

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script>
        const drop = document.querySelector(".drop");
        const dropitems = document.querySelector(".drop-items");
        drop.addEventListener("mouseover", ()=>{
            dropitems.classList.add("show");
        });
    
        drop.addEventListener("mouseout", ()=>{
            dropitems.classList.remove("show");
        });

        
    </script>
    <script>
        const logo = document.querySelector(".container-fluid .logo");
        const sidebar = document.querySelector("#sidebarCollapse");
        const srch_btn = document.querySelector(".srch-btn");
        const close_btn = document.querySelector(".close-btn");
        const search = document.querySelector(".container-fluid form");
        const srch_input = document.querySelector(".container-fluid form input");
        srch_btn.addEventListener("click", ()=>{
            srch_btn.style.display="none";
            logo.style.display = "none";
            close_btn.classList.add("show-close");
            sidebar.style.display = "none";
            search.classList.add("show-srch");
            srch_input.focus();
        });
        close_btn.addEventListener("click", ()=>{
            srch_btn.style.display="block";
            logo.style.display = "block";
            close_btn.classList.remove("show-close");
            sidebar.style.display = "block";
            search.classList.remove("show-srch");
            srch_input.blur();
        });
        
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
</body>

</html>