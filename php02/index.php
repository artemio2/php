<?php
$search = $_GET["search"];
$url = 'https://www.googleapis.com/customsearch/v1?key=AIzaSyBMxyOcnbfqtzbTcbLXK6NK994CnT6mEcs&cx=700ba0602242244ab&q='.$search;
$search_text = htmlspecialchars($search);

if (isset($text)) echo $text;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h2>My Browser</h2>
<form method="GET" action="">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" value=""><br><br>
    <input type="submit" value="Submit">
</form>
<div class="gcse-search"></div>
<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$results = json_decode($response, true);
if (isset($results["items"])) {
    foreach ($results["items"] as $result) {
        echo "<a href='".$result["link"]."'>".$result["title"]."</a><br>";
        echo $result["snippet"]."<br><br>";
    }
} else echo "Empty result";
?>
</body>
</html>