<?php 
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
    }

    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create"; //=> Đường dẫn đến trang thanh toán

    // Key 
    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';                    
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';   

   // Key Meowtech


    // Thông tin hiển thị trên trang thanh toán
    $orderInfo = "Thanh toán qua QR MoMo";
    $amount = $_POST['price']; //=> Thành tiền đơn hàng
    // $amount = 30000;
    $orderId = time() .""; //=> Mã đơn hàng
    $redirectUrl = "http://localhost/chatGPT2/payment_page/assets/api/api_result.php"; // => Sau khi thanh toán thành công trả về
    $ipnUrl = "http://localhost/chatGPT2/payment_page/assets/api/api_result.php";
    $extraData = $_POST['key'];


    $requestId = time() . "";
    $requestType = "captureWallet"; //=> Momo QRcode 
    //$requestType = "payWithATM"; //=> Momo ATM
    // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");

    //Tạo chữ ký điện tử cho giao dịch
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $secretKey);

    $data = array('partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi', 
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature);
    $result = execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);  // decode json

    header('Location: ' . $jsonResult['payUrl']);

?>