<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"> </script>
</head>
<style>
body, html{
    height: 100%;
    margin: 0;
}
.loader{
    background-image: url("/assets/loading.gif");

    height: 100%;
    
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
<body id = loadingPage>
</body>
<script type="text/javascript">
    $("#loadingPage").append("<div class = 'loader'></div>");
    setTimeout(function(){
        $("#loadingPage").remove();
    },3000);
</script>
</html>