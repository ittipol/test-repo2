<html lang="en-US">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pay Portal</title>
    </head>
    <body>

        <?php

            $action = "https://uatkpgw.kasikornbank.com/pgpayment/payment.aspx"; // url gateway

            $data = array(
                "MERCHANT2" => "451001605682521",
                "TERM2" => "70352168",
                "AMOUNT2" => "1000", // price of product, accept only 12 character
                "URL2" => "http://pp/kbank.php", // go back to page
                "RESPURL" => "https://pp/kbank.php", // this url is require SSL certification at least 128 bit
                "IPCUST2" => "128.199.64.178", // server ip address of merchant website
                "DETAIL2" => "Payment Test", // detail of product or service
                "INVMERCHANT" => "150429173450", // invoice number, only digit
                "FILLSPACE" => "", // want to know card type, input only Y or N
                "SHOPID" => "",
                "PAYTERM2" => "", // month
                "md5_secret" => "SzabTAGU5fQYgHkVGU5f4re8pLw5423Q",
            );

            $str = "";
            foreach ($data as $key => $value) {
                $str .= $value;
            }

            $checksum = md5($str);

            echo $str."<br/>".$checksum;;

        ?>

        <form name="sendform" method="post" action="<?php echo $action; ?>"> 
            <input type="hidden" id="MERCHANT2" name="MERCHANT2" value="<?php echo $data['MERCHANT2']; ?>">
            <input type="hidden" id="TERM2" name="TERM2" value="<?php echo $data['TERM2']; ?>">
            <input type="hidden" id="AMOUNT2" name="AMOUNT2" value="<?php echo $data['AMOUNT2']; ?>">
            <input type="hidden" id="URL2" name="URL2" value="<?php echo $data['URL2']; ?>">
            <input type="hidden" id="RESPURL" name="RESPURL" value="<?php echo $data['RESPURL']; ?>">
            <input type="hidden" id="IPCUST2" name="IPCUST2" value="<?php echo $data['IPCUST2']; ?>"> 
            <input type="hidden" id="DETAIL2" name="DETAIL2" value="<?php echo $data['DETAIL2']; ?>">
            <input type="hidden" id="INVMERCHANT" name="INVMERCHANT" value="<?php echo $data['INVMERCHANT']; ?>">
            <input type="hidden" id="FILLSPACE" name="FILLSPACE" value="">  <!--Option-->
            <input type="text" name="SHOPID" id="SHOPID" value="">  <!--Option-->
            <input type="text" id="PAYTERM2" name="PAYTERM2" value="">  <!--Option-->
            <input type="text" id="CHECKSUM" value="<?php echo $checksum; ?>">

            <input type="submit"> 
        </form>

    </body>
</html>