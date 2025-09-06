<?php

	header("Access-Control-Allow-Origin: https://graphene-bsm.com");

	class proberunner {

		/**
		 * launches probe through runner to get DB response
		 * @param string $source
		 * @param string $query
		 * @param string $cred_id database user's ID
		 * @param string $cred_pass database user's password
		 * @return array
		 */
		public static function launchDB($source, $query, $cred_id, $cred_pass) {
			$probeSettings	= explode('|', $source);
			$username		= $cred_id;
			$password		= $cred_pass;
			$options		= array(
				PDO::ATTR_ERRMODE 				=> PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE	=> PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES		=> false
			);
			try {
				$connectionP = new PDO("mysql:host=$probeSettings[0];dbname=$probeSettings[1]", $username, $password, $options);
				$sqlP = $query;
				$statementP = $connectionP->prepare($sqlP);
				$statementP->execute();
				$status = "OK";
				$resultP = $statementP->fetchAll(PDO::FETCH_ASSOC);
				$result = addslashes(json_encode($resultP, JSON_PRETTY_PRINT));
			} catch(PDOException $errorP) {
				$status = "ERROR";
				$result = $sqlP . "<br>" . $errorP->getMessage();
			}
			return array($status, $result);
		}

		/**
		 * launches probe through runner to get WS/API response
		 * @param string $url
		 * @param string $data (if non, send "false")
		 * @param string $method
		 * @param string $cred_id API user
		 * @param string $cred_pass API key
		 * @param string $headers (optional, default is "false")
		 * @return array
		 */
		public static function launchWS($url, $data = false, $method, $cred_id, $cred_pass, $headers = false) {
			$curl = curl_init();
			switch ($method) {
				case "POST":
					curl_setopt($curl, CURLOPT_POST, 1);
					if ($data)
						curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
					break;
				case "PUT":
					curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
					if ($data)
						curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
					break;
				case "DELETE":
					curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
					break;
				default:
					if ($data)
						$url = sprintf("%s?%s", $url, stripslashes($data));
			}
			// OPTIONS:
			//if ($cred_pass != "") { $utoken = authTkn($url, $cred_id, $cred_pass); $url = 'https://api-site.com/v1/apps/' . $cred_id . '/reviews?utoken=' . $utoken; }
			curl_setopt($curl, CURLOPT_URL, $url);
			$apikey = "";
			if ($cred_id != "")
				$apikey = 'APIKEY: '.$cred_id;
			if (!$headers) {
				curl_setopt($curl, CURLOPT_HTTPHEADER, array(
					$apikey,
					'Content-Type: application/json',
				));
			} else {
				curl_setopt($curl, CURLOPT_HTTPHEADER, array(
					$apikey,
					'Content-Type: application/json',
					$headers
				));
			}
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			if ($cred_id != "" && $cred_pass != "")
				curl_setopt($curl, CURLOPT_USERPWD, $cred_id.":".$cred_pass);
			// run
			$response	= curl_exec($curl);
			$state		= "";
			$result		= "";
			if (!$response) {
				$state	= "Connection Failure";
				$result = "ERROR : Connection Failure";
				die("Connection Failure");
			}
			curl_close($curl);
			// get info
			if ($response) {
				$output = json_decode($response);
				if (isset($output->status) && isset($output->data)) {
					$state	= $output->status;
					$result = $output->data;
				} else {
					$state	= "Connected";
					$result = json_decode($response);
				}
			}
			return array($state, addslashes(json_encode($result, JSON_PRETTY_PRINT)));
		}

		/**
		 * gets API token from provided credentials
		 * @param string $url
		 * @param string $cred_id API user
		 * @param string $cred_pass API key
		 * @return string
		 */
		public static function authTkn($url, $cred_id, $cred_pass) {
			$curl = curl_init();
			$auth_data = array(
				'client_id' 		=> $cred_id,
				'client_secret' 	=> $cred_pass,
				'grant_type' 		=> 'client_credentials'
			);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $auth_data);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			$result = curl_exec($curl);
			if (!$result) {
				die("Connection Failure");
			}
			curl_close($curl);
			return $result;
		}

	}
