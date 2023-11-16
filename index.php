<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convertisseur de Devises</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playpen+Sans:wght@100&family=Sanchez&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>


<div class="converter">   
    <h1 class="titre" >Money</h1>   

        <?php
        $api = '258ddfcbb9da9e4b974b555659545cea';
        $ch = curl_init("https://open.er-api.com/v6/latest?apikey=$api");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $exchange_data = json_decode($json, true);


        $rates = $exchange_data['rates'];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $amount = $_POST["amount"];
        $from_currency = $_POST["from_currency"];
        $to_currency = $_POST["to_currency"];

        $from_rate = $rates[$from_currency];
        $to_rate = $rates[$to_currency];

        $converted_amount = $amount * ($to_rate / $from_rate);
        $conversionResult = number_format($converted_amount, 3);    
        }
        ?>

    <form method="post" action="">

    <div class="contenair1" >
    <select class="selection1"  name="from_currency" required>
        <?php
        foreach ($rates as $currency => $rate) {
            echo "<option value=\"$currency\">$currency</option>";
            }
        ?>
    </select>
    <label for="amount"></label>
    <input class="champ1"  type="text" name="amount" required>
    </div>



    <i id="fleche" class="fa-solid fa-arrow-right-arrow-left"></i>



    <div class="contenair1" >
    <select class= "selection1" name="to_currency" required>
        <?php
        foreach ($rates as $currency => $rate) {
            echo "<option value=\"$currency\" >$currency</option>";
        }
        ?>
    </select>
    <input class="champ1" type="text"  value="<?php echo isset($conversionResult) ? $conversionResult : ''; ?>" required>
    </div>

    <br>
    <button class="convertir"  type="submit">calculate</button>
    <br>

    </form>

</div>


</body>
</html>