<!DOCTYPE html>
<link href="styles.css" rel="stylesheet"/>
<html>
    <head>
        <meta charset="UTF-8">
 
        <!-- If IE use the latest rendering engine -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
         
        <!-- Set the page to the width of the device and set the zoon level -->
        <meta name="viewport" content="width = device-width, initial-scale = 1">

        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <title>KMKitchen</title>

        <style>
            .jumbotron{
                background-color:#13599C;
                opacity: 0.9;
                color: white;
                font-size: 120%;
            }
            /* Adds borders for tabs */
            .tab-content {
                border-left: 1px solid #ddd;
                border-right: 1px solid #ddd;
                border-bottom: 1px solid #ddd;
                padding: 10px;
            }
            .nav-tabs {
                margin-bottom: 0;
            }
        </style>

    </head>
    
    <body>
        <div class="container">

        <div class="page-header">
            <h1><img src="logo.png" alt="KMKitchen" width=350 height=100></h1>
        </div>

        <div class="jumbotron">
        <p1>
            <strong>Welcome to KMKitchen!</strong>
            <br><br>
            Our mission is to help chefs of all kinds find the perfect recipes and freshest ingredients.
            This site was founded by two college-age food enthusiasts and at-home cooks, Kate and Max. Whether you are looking for a
            dorm room snack, family dinner, or picnic out, we hope you can use this site to conveniently find recipes that match your
            pantry. Using data from Edamam.com and Google Maps, we have put together a way to search for recipes based on your ingredients
            at home, and then find the best market to pick up the rest of the goods. 
            <br><br>
            Simply type in one or more ingredients you have at home, and the site will give you up to 30 fun recipes based on your 
            entry. You can also see the closest grocery stores and farmers markets for you to gather extra supplies. <strong>Bon appetit!</strong>   
        </p1>
        </div>
        
        <br>
        <h2>
            <form action="recipes.php" method="post">
                <div class="box">
                    <div class="container-1">
                        <span class="icon"><i class="fa fa-search"></i></span>
                        <input type="search" id="search" name="ingredients" placeholder="Enter an ingredient..." type="text"/>
                    </div>
                </div>
            </form>
        </h2>
            <style>
                h2 {
                    text-align: center;
                    color: #FDFEFE;
                }
                .container-1 input#search{
                    width: 300px;
                    height: 40px;
                    background: #D6DBDF;
                    opacity: 0.9;
                    border: none;
                    font-size: 10pt;
                    float: center;
                    color: black;
                    padding-left: 30px;
                    -webkit-border-radius: 5px;
                    -moz-border-radius: 5px;
                    border-radius: 5px;
                    }
                ::-webkit-input-placeholder {
                    color: #515A5A;
                }
            </style>
        <br><br>
    </div>
        <h2>
        <a href="map.php">Local food near me</a></li>
        </h2>
    
    </body>
</html>