      <?php 

   $pin= "641009";
                $fulladdress = sprintf('%s', $pin);
		$key =  "AIzaSyDGy47FZsKtki4K51YqHnrh62FaRKzTEdE";
        $response = file_get_contents(sprintf('https://maps.googleapis.com/maps/api/geocode/json?address=%s&key=%s', urlencode($fulladdress), $key));
        $jsonResponse = json_decode($response);

var_dump($jsonResponse);
 ?>