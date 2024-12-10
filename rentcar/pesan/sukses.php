<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ra : Market</title>
    <style>
        body{
            width: 100vw;
            height: 100vh;
            display: grid;
            place-items: center;
            overflow: hidden;
            background: cyan;
        }
        .card{
            padding: 5rem;
            display: grid;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
        }
        span:nth-child(1){
            font-size: 5rem;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            color: #fff;
            font-weight: 700;
            text-transform: uppercase;
        }
        
        /* body {
            background-color: red;
            color: white;
            text-align: center;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        .er {
            margin-top: 120px;
            font-size: 40px;
        }*/
        a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- <div class="er">
        <h1>ERROR</h1>
        <h2>Username atau Password anda <b>salah</b></h2>
        <a href="../index.php" title="Klik untuk kembali">Silahkan Login ulang</a>
    </div> -->
    <center>
    <div class="card">
        <span>Pesanan Berhasil</span>
        <span style="font-size: 1rem; color:#fff;">Silahkan lanjutkan dengan membayar pesanan</span><br><br>
        <div class="flex">
            <a href="pesan.php">Back</a>
        </div>
    </div>
    </center>
</body>
</html>