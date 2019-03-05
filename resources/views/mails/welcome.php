<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Commerce Mail</title>
    <style>
        h3{
            padding:15px 20px;
            background:#008030;
            text-align:center;
            color:#f5f5f5;
            border:1px solid #222;
            border-radius:3px;
        }
        p{
            padding: 20px 30px;
            background: #e5e5e5;
            color: #222;

        }
        img{
            width:200px;
            height:200px;
            display:block;
            margin:15px auto;
            border:2px solid #333;
            padding: 5px;
        }
    </style>
</head>
<body>

<h3>My E-Commerce Beauty Mail</h3>

<img src="<?php echo $image_link; ?>" alt="" >

<p><?php echo $content; ?></p>
    
</body>
</html>