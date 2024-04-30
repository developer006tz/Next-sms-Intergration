public function sendOtp($phone_number, $otp, $message = null)
  {
    if($message!=null){
      $sms = $message;
    }else{
      $sms="Your Login code is $otp";
    }


    $api_key = env('SMS_API_KEY');
    $secret_key = env('SMS_SECRET_KEY');
    $postData = array(
      'from' => 'HUKUEVENTS',
      'to' => $phone_number,
      'text' => utf8_encode($sms),
      'reference' => 'HUKUEVENTS'
    );

    $curl = curl_init();

    curl_setopt_array(
      $curl,
      array(
        CURLOPT_URL => 'https://messaging-service.co.tz/api/sms/v1/text/single',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($postData),
        CURLOPT_HTTPHEADER => array(
          'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
          'Content-Type: application/json',
          'Accept: application/json'
        ),
      )
    );
    $responses = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($responses, true);
    if (isset ($response['success']) && $response['success'] == false) {
      Otp::where('phone', $phone_number)->where('otp', $otp)->update(['send_status' => "failed"]);
      return false;
    } else {
      if ($response['messages'][0]['status']['groupName'] == 'PENDING') {
        Otp::where('phone', $phone_number)->where('otp', $otp)->update(['send_status' => "sent"]);


      } else {
        Otp::where('phone', $phone_number)->where('otp', $otp)->update(['send_status' => "failed"]);
        return false;
      }
    }
    return true;
  }
