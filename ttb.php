<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "",
    'oauth_access_token_secret' => "",
    'consumer_key' => "",
    'consumer_secret' => ""
);

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name=' . $_GET["user"] . '&count=200';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                    ->performRequest();

 
//other code 
 
 
$decode = json_decode($response, true); //getting the file content as array
 
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8"></meta>
    <head>
        <title>OpenSpritz</title>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="spritz.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Droid+Sans+Mono' rel='stylesheet' type='text/css'>

        <style>

            body{

            }

            #container{
                width: 50%;
                margin-left: 25%;
                margin-right: 25%;
            }

            #result{
                text-align: center;
                font-size: 36px;
                font-family: 'Droid Sans Mono', sans-serif;
                padding-top: 36px;
                padding-bottom: 36px;
                min-height: 100px;
            }

            .start{
                color: #333333;
            }
            .pivot{
                color: #ff0000;
            }
            .end{
                color: #333333;
            }
        </style>

        <script>
        $( document ).ready(function() {

            $('#selector').on('change', function (e) {

                clearTimeouts();
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                var input = $('#spritz_me').text();
                var rez = spritzify(input, '#result', valueSelected);

            });
        });
        </script>

    </head>

    <body>
        <div id="container">

            <div id="result">
                Choose a WPM to start.
            </div>

            <select id="selector">
              <option value="300">300wpm</option>
              <option value="400">400wpm</option>
              <option value="500">500wpm</option>
              <option value="600">600wpm</option>
              <option value="700">700wpm</option>
              <option value="800">800wpm</option>
              <option value="900">900wpm</option>
              <option value="1000">1000wpm</option>
            </select> 


            <div id="spritz_me">
                <?php 
                foreach ($decode as $tweet) {
                    $tweet_text = $tweet["text"]; //get the tweet
                     echo " NEWTWEET NEWTWEET NEWTWEET ";
                     echo $tweet_text . " ";
                    } 
                 ?>
            </div>

        </div>
    </body>
</html>
