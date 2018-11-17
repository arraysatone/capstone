<?php 
    session_start();
?>

<!-- 

        ArraysAtOne Capstone 2018 - Maple Leaf Foods

        Kevin Baumgartner
        Jesse Berube
        Marc Harquail
        Alex Ireland

 -->
<!DOCTYPE html>

<!-- HTML -->
<html>

    <!-- Head -->
    <head>

        <!-- Meta -->
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="shortcut icon" type="image/png" href="./media/maple.png"/>
        <title>Temperature Monitor</title>

        <!-- Style Imports-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./css/style_xs.css">
    	<link rel="stylesheet" type="text/css" href="./css/style_sm.css">
        <link rel="stylesheet" type="text/css" href="./css/style_md.css">
        <link rel="stylesheet" type="text/css" href="./css/style_lg.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

        <!-- Script Imports -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <script src="./js/indexScript.js"></script>
    </head>

    <!-- Body -->
    <body>

        <!-- Navigation Bar -->
    	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">

                <!-- Logo -->
        		<a href="#"><img id="navbar-image" src="./media/maple.png" alt="logo"></a>

                <!-- Dropdown Menu -->
        		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        			<span class="navbar-toggler-icon"></span>
        		</button>

                <!-- Dropdown Items -->
        		<div class="collapse navbar-collapse" id="navbarNav">
        			<ul class="navbar-nav">
        				<li class="nav-item active">
        					<a class="nav-link" href="#">Cabinet<span class="sr-only">(current)</span></a>
        				</li>
        				<li class="nav-item">
        					<a class="nav-link" href="cabinet.html">Live View</a>
        				</li>
        				<li class="nav-item">
        					<a class="nav-link" href="trends.html">Trends</a>
        				</li>
        				<li class="nav-item">
        				    <!--?php
                                include './php/checkforuser.php';
                            ?-->
        				</li>
        			</ul>
        		</div>
            </div>
    	</nav>

        <!-- Cabinet List -->
    	<div class="row">
            <div class="col-lg-12">
              <p>
                <button uid="" type="button" class="newBtn newBtn-sq-nm bdrWhite" onclick=" window.location = 'cabinet.html'">
                    <div class="newBtnTitle">
                       <span class="newBtnTitleText">Cabinet 1</span>
                    </div>
                    <hr>
                    <div class="newBtnDisplay">
                        <p class="newBtnDisplayText colorSafe" id="cab2Temp">22&deg</p>
                    </div>
                    <div class="newBtnInfo">
                        <table>
                            <tr>
                                <td class="newBtnStatus colorSafe">
                                    <i class="fas fa-check-circle"></i>
                                </td>
                                <td class="newBtnText">
                                    <span class="newBtnTempText">Safe Temperature</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="newBtnStatus colorSafe">
                                    <i class="fas fa-check-circle"></i>
                                </td>
                                <td class="newBtnText">
                                    <span class="newBtnMotionText">Movement Stable</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </button>

            	<button uid="" type="button" class="newBtn newBtn-sq-nm bdrRed" onclick=" window.location = 'cabinet.html'">
                    <div class="newBtnTitle">
                	   <span class="newBtnTitleText">Cabinet 2</span>
                    </div>
                    <hr>
                    <div class="newBtnDisplay">
                        <p class="newBtnDisplayText colorSafe" id="cab2Temp">26&deg</p>
                    </div>
                    <div class="newBtnInfo">
                        <table>
                            <tr>
                                <td class="newBtnStatus colorSafe">
                                    <i class="fas fa-check-circle"></i>
                                </td>
                                <td class="newBtnText">
                                    <span class="newBtnTempText">Safe Temperature</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="newBtnStatus colorUnsafe">
                                    <i class="fas fa-exclamation-circle"></i>
                                </td>
                                <td class="newBtnText">
                                    <span class="newBtnMotionText">Movement Unstable</span>
                                </td>
                            </tr>
                        </table>
                    </div>
            	</button>

                <button uid="" type="button" class="newBtn newBtn-sq-nm bdrRed" onclick=" window.location = 'cabinet.html'">
                    <div class="newBtnTitle">
                       <span class="newBtnTitleText">Cabinet 3</span>
                    </div>
                    <hr>
                    <div class="newBtnDisplay">
                        <p class="newBtnDisplayText colorUnsafe" id="cab2Temp">28&deg</p>
                    </div>
                    <div class="newBtnInfo">
                        <table>
                            <tr>
                                <td class="newBtnStatus colorUnsafe">
                                    <i class="fas fa-exclamation-circle"></i>
                                </td>
                                <td class="newBtnText">
                                    <span class="newBtnTempText">Unsafe Temperature</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="newBtnStatus colorSafe">
                                    <i class="fas fa-check-circle"></i>
                                </td>
                                <td class="newBtnText">
                                    <span class="newBtnMotionText">Movement Stable</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </button>

                <button uid="" type="button" class="newBtn newBtn-sq-nm bdrRed" onclick=" window.location = 'cabinet.html'">
                    <div class="newBtnTitle">
                       <span class="newBtnTitleText">Cabinet 4</span>
                    </div>
                    <hr>
                    <div class="newBtnDisplay">
                        <p class="newBtnDisplayText colorUnsafe" id="cab2Temp">28&deg</p>
                    </div>
                    <div class="newBtnInfo">
                        <table>
                            <tr>
                                <td class="newBtnStatus colorUnsafe">
                                    <i class="fas fa-exclamation-circle"></i>
                                </td>
                                <td class="newBtnText">
                                    <span class="newBtnTempText">Unsafe Temperature</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="newBtnStatus colorUnsafe">
                                    <i class="fas fa-exclamation-circle"></i>
                                </td>
                                <td class="newBtnText">
                                    <span class="newBtnMotionText">Movement Unstable</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </button>
              </p>
            </div>
    	</div>
    </body>
</html>
