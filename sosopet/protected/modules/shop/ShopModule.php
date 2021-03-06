<?php
Yii::setPathOfAlias('shop' , dirname(__FILE__));
class ShopModule extends CWebModule
{
	public $version = '0.7-svn';

	// Is the Shop in debug Mode?
	public $debug = true;

  // Whether the installer should install some demo data
	public $installDemoData = true;

	// Enable this to use the shop module together with the yii user
	// management module. Optional registration when ordering a product
	// will be enabled, for example.
	public $useWithYum = false;

	// Names of the tables
	public $sellsTable='app_sell';
	public $qnasTable='app_qna';
	public $lifestylesTable='app_post';
	public $appImageTable='app_image';
	
	public $countryTable = 'shop_country';
	public $categoryTable = 'shop_category';
	public $productsTable = 'shop_products';
	public $orderTable = 'shop_order';
	public $orderPositionTable = 'shop_order_position';
	public $customerTable = 'shop_customer';
	public $pointTable = 'shop_point';
	public $addressTable = 'shop_address';
	public $imageTable = 'shop_image';
	public $shippingMethodTable = 'shop_shipping_method';
	public $paymentMethodTable = 'shop_payment_method';
	public $taxTable = 'shop_tax';
	public $productSpecificationTable = 'shop_product_specification';
	public $productVariationTable = 'shop_product_variation';
	public $storeTable = 'shop_store';
	public $wishlistTable = 'shop_wishlist';
	public $favoriteTable = 'shop_favorite';
	public $chatImageTable = 'shop_chat_image';
	public $currencySymbol = '$';
	public $currency = 'HKD';
	public $productView = 'view';
	public $sellView = 'view';
	public $lifestyleView = 'view';
	public $qnaView = 'view';

	// Set this to a valid email address to send a message once a order
	// comes in.
	public $orderNotificationEmail = false;
	public $orderNotificationFromEmail = 'do@not-reply.org';
	public $orderNotificationReplyEmail = 'do@not-reply.org';

	public $enableLogging = true;

	public $titleOptions = array('mr' => 'Mr.', 'ms' => 'Mrs.');
	 
	public $genderOptions = array('M' => 'Male', 'F' => 'Female');

	// See docs/tcpdf.txt on how to enable PDF Generation of Invoices
	public $useTcPdf = false;
	public $tcPdfPath = 'ext.tcpdf.tcpdf';
	public $slipViewPdf = '/order/pdf/slip';
	public $invoiceViewPdf = '/order/pdf/invoice';
	public $headerViewPdf = '/order/pdf/header';
	public $footerViewPdf = '/order/pdf/footer';

	public $logoPath = 'logo.jpg';

	// Set this to an array to only allow various countries, for example
	// public $validCountries = array('Germany', 'Swiss', 'China'),
	/*
	public $validCountries = array(
									 "Afghanistan" => "Afghanistan",
									 "Albania" => "Albania",
									 "Algeria" => "Algeria",
									 "Antigua and Barbuda" => "Antigua and Barbuda",
									 "Argentina" => "Argentina",
									 "Armenia" => "Armenia",
									 "Australia" => "Australia",
									 "Austria" => "Austria",
									 "Azerbaijan" => "Azerbaijan",
									 "Bahamas" => "Bahamas",
									 "Bahrain" => "Bahrain",
									 "Bangladesh" => "Bangladesh",
									 "Barbados" => "Barbados",
									 "Belarus" => "Belarus",
									 "Belgium" => "Belgium",
									 "Belize" => "Belize",
									 "Benin" => "Benin",
									 "Bhutan" => "Bhutan",
									 "Bolivia" => "Bolivia",
									 "Bosnia and Herzegovina" => "Bosnia and Herzegovina",
									 "Botswana" => "Botswana",
									 "Brazil" => "Brazil",
									 "Brunei" => "Brunei",
									 "Bulgaria" => "Bulgaria",
									 "Burkina Faso" => "Burkina Faso",
									 "Burundi" => "Burundi",
									 "Cambodia" => "Cambodia",
									 "Cameroon" => "Cameroon",
									 "Canada" => "Canada",
									 "Cape Verde" => "Cape Verde",
									 "Central African Republic" => "Central African Republic",
									 "Chad" => "Chad",
									 "Chile" => "Chile",
									 "China" => "China",
									 "Colombi" => "Colombi",
									 "Comoros" => "Comoros",
									 "Congo (Brazzaville)" => "Congo (Brazzaville)",
									 "Congo" => "Congo",
									 "Costa Rica" => "Costa Rica",
									 "Cote d'Ivoire" => "Cote d'Ivoire",
									 "Croatia" => "Croatia",
									 "Cuba" => "Cuba",
									 "Cyprus" => "Cyprus",
									 "Czech Republic" => "Czech Republic",
									 "Denmark" => "Denmark",
									 "Djibouti" => "Djibouti",
									 "Dominica" => "Dominica",
									 "Dominican Republic" => "Dominican Republic",
									 "East Timor (Timor Timur)" => "East Timor (Timor Timur)",
									 "Ecuador" => "Ecuador",
									 "Egypt" => "Egypt",
									 "El Salvador" => "El Salvador",
									 "Equatorial Guinea" => "Equatorial Guinea",
									 "Eritrea" => "Eritrea",
									 "Estonia" => "Estonia",
									 "Ethiopia" => "Ethiopia",
									 "Fiji" => "Fiji",
									 "Finland" => "Finland",
									 "France" => "France",
									 "Gabon" => "Gabon",
									 "Gambia, The" => "Gambia, The",
									 "Georgia" => "Georgia",
									 "Germany" => "Germany",
									 "Ghana" => "Ghana",
									 "Greece" => "Greece",
									 "Grenada" => "Grenada",
									 "Guatemala" => "Guatemala",
									 "Guinea" => "Guinea",
									 "Guinea-Bissau" => "Guinea-Bissau",
									 "Guyana" => "Guyana",
									 "Haiti" => "Haiti",
									 "Honduras" => "Honduras",
									 "Hungary" => "Hungary",
									 "Iceland" => "Iceland",
									 "India" => "India",
									 "Indonesia" => "Indonesia",
									 "Iran" => "Iran",
									 "Iraq" => "Iraq",
									 "Ireland" => "Ireland",
									 "Israel" => "Israel",
									 "Italy" => "Italy",
									 "Jamaica" => "Jamaica",
									 "Japan" => "Japan",
									 "Jordan" => "Jordan",
									 "Kazakhstan" => "Kazakhstan",
									 "Kenya" => "Kenya",
									 "Kiribati" => "Kiribati",
									 "Korea, North" => "Korea, North",
									 "Korea, South" => "Korea, South",
									 "Kuwait" => "Kuwait",
									 "Kyrgyzstan" => "Kyrgyzstan",
									 "Laos" => "Laos",
									 "Latvia" => "Latvia",
									 "Lebanon" => "Lebanon",
									 "Lesotho" => "Lesotho",
									 "Liberia" => "Liberia",
									 "Libya" => "Libya",
									 "Liechtenstein" => "Liechtenstein",
									 "Lithuania" => "Lithuania", "Thailand" => "Thailand",
									 "Luxembourg" => "Luxembourg",
									 "Macedonia" => "Macedonia",
									 "Madagascar" => "Madagascar",
									 "Malawi" => "Malawi",
									 "Malaysia" => "Malaysia",
									 "Maldives" => "Maldives",
									 "Mali" => "Mali",
									 "Malta" => "Malta",
									 "Marshall Islands" => "Marshall Islands",
									 "Mauritania" => "Mauritania",
									 "Mauritius" => "Mauritius",
									 "Mexico" => "Mexico",
									 "Micronesia" => "Micronesia",
									 "Moldova" => "Moldova",
									 "Monaco" => "Monaco",
									 "Mongolia" => "Mongolia",
									 "Morocco" => "Morocco",
									 "Mozambique" => "Mozambique",
									 "Myanmar" => "Myanmar",
									 "Namibia" => "Namibia",
									 "Nauru" => "Nauru",
									 "Nepa" => "Nepa",
									 "Netherlands" => "Netherlands",
									 "New Zealand" => "New Zealand",
									 "Nicaragua" => "Nicaragua",
									 "Niger" => "Niger",
									 "Nigeria" => "Nigeria",
									 "Norway" => "Norway",
									 "Oman" => "Oman",
									 "Pakistan" => "Pakistan",
									 "Palau" => "Palau",
									 "Panama" => "Panama",
									 "Papua New Guinea" => "Papua New Guinea",
									 "Paraguay" => "Paraguay",
									 "Peru" => "Peru",
									 "Philippines" => "Philippines",
									 "Poland" => "Poland",
									 "Portugal" => "Portugal",
									 "Qatar" => "Qatar",
									 "Romania" => "Romania",
									 "Russia" => "Russia",
									 "Rwanda" => "Rwanda",
									 "Saint Kitts and Nevis" => "Saint Kitts and Nevis",
									 "Saint Lucia" => "Saint Lucia",
									 "Saint Vincent" => "Saint Vincent",
									 "Samoa" => "Samoa",
									 "San Marino" => "San Marino",
									 "Sao Tome and Principe" => "Sao Tome and Principe",
									 "Saudi Arabia" => "Saudi Arabia",
									 "Senegal" => "Senegal",
									 "Serbia and Montenegro" => "Serbia and Montenegro",
									 "Seychelles" => "Seychelles",
									 "Sierra Leone" => "Sierra Leone",
									 "Singapore" => "Singapore",
									 "Slovakia" => "Slovakia",
									 "Slovenia" => "Slovenia",
									 "Solomon Islands" => "Solomon Islands",
									 "Somalia" => "Somalia",
									 "South Africa" => "South Africa",
									 "Spain" => "Spain",
									 "Sri Lanka" => "Sri Lanka",
									 "Sudan" => "Sudan",
									 "Suriname" => "Suriname",
									 "Swaziland" => "Swaziland",
									 "Sweden" => "Sweden",
									 "Switzerland" => "Switzerland",
									 "Syria" => "Syria",
									 "Taiwan" => "Taiwan",
									 "Tajikistan" => "Tajikistan",
									 "Tanzania" => "Tanzania",
									 "Thailand" => "Thailand",
									 "Togo" => "Togo",
									 "Tonga" => "Tonga",
									 "Trinidad and Tobago" => "Trinidad and Tobago",
									 "Tunisia" => "Tunisia",
									 "Turkey" => "Turkey",
									 "Turkmenistan" => "Turkmenistan",
									 "Tuvalu" => "Tuvalu",
									 "Uganda" => "Uganda",
									 "Ukraine" => "Ukraine",
									 "United Arab Emirates" => "United Arab Emirates",
									 "United Kingdom" => "United Kingdom",
									 "United States" => "United States",
									 "Uruguay" => "Uruguay",
									 "Uzbekistan" => "Uzbekistan",
									 "Vanuatu" => "Vanuatu",
									 "Vatican City" => "Vatican City",
									 "Venezuela" => "Venezuela",
									 "Vietnam" => "Vietnam",
									 "Yemen" => "Yemen",
									 "Zambia" => "Zambia",
									 "Zimbabwe" => "Zimbabwe"
									);
	public $country_us = "United States";
	public $country_ca = "Canada";
									*/
	public $validCountries = array('AF' => 'AFGHANISTAN',
								'AX' => 'ALAND ISLANDS',
								'AL' => 'ALBANIA',
								'DZ' => 'ALGERIA',
								'AS' => 'AMERICAN SAMOA',
								'AD' => 'ANDORRA',
								'AO' => 'ANGOLA',
								'AI' => 'ANGUILLA',
								'AQ' => 'ANTARCTICA',
								'AG' => 'ANTIGUA AND BAR-BUDA',
								'AR' => 'ARGENTINA',
								'AM' => 'ARMENIA',
								'AW' => 'ARUBA',
								'AU' => 'AUSTRALIA',
								'AT' => 'AUSTRIA',
								'AZ' => 'AZERBAIJAN',
								'BS' => 'BAHAMAS',
								'BH' => 'BAHRAIN',
								'BD' => 'BANGLADESH',
								'BB' => 'BARBADOS',
								'BY' => 'BELARUS',
								'BE' => 'BELGIUM',
								'BZ' => 'BELIZE',
								'BJ' => 'BENIN',
								'BM' => 'BERMUDA',
								'BT' => 'BHUTAN',
								'BO' => 'BOLIVIA',
								'BA' => 'BOSNIA AND HERZE-GOVINA',
								'BW' => 'BOTSWANA',
								'BV' => 'BOUVET ISLAND',
								'BR' => 'BRAZIL',
								'IO' => 'BRITISH INDIAN OCEAN TERRITORY',
								'BN' => 'BRUNEI DARUSSALAM',
								'BG' => 'BULGARIA',
								'BF' => 'BURKINA FASO',
								'BI' => 'BURUNDI',
								'KH' => 'CAMBODIA',
								'CM' => 'CAMEROON',
								'CA' => 'CANADA',
								'CV' => 'CAPE VERDE',
								'KY' => 'CAYMAN ISLANDS',
								'CF' => 'CENTRAL AFRICAN REPUBLIC',
								'TD' => 'CHAD',
								'CL' => 'CHILE',
								'CN' => 'CHINA',
								'CX' => 'CHRISTMAS ISLAND',
								'CC' => 'COCOS (KEELING) ISLANDS',
								'CO' => 'COLOMBIA',
								'KM' => 'COMOROS',
								'CG' => 'CONGO',
								'CD' => 'CONGO, THE DEMO-CRATIC REPUBLIC OF THE',
								'CK' => 'COOK ISLANDS',
								'CR' => 'COSTA RICA',
								'CI' => 'COTE D IVOIRE',
								'HR' => 'CROATIA',
								'CU' => 'CUBA',
								'CY' => 'CYPRUS',
								'CZ' => 'CZECH REPUBLIC',
								'DK' => 'DENMARK',
								'DJ' => 'DJIBOUTI',
								'DM' => 'DOMINICA',
								'DO' => 'DOMINICAN REPUBLIC',
								'EC' => 'ECUADOR',
								'EG' => 'EGYPT',
								'SV' => 'EL SALVADOR',
								'GQ' => 'EQUATORIAL GUINEA',
								'ER' => 'ERITREA',
								'EE' => 'ESTONIA',
								'ET' => 'ETHIOPIA',
								'FK' => 'FALKLAND ISLANDS (MALVINAS)',
								'FO' => 'FAROE ISLANDS',
								'FJ' => 'FIJI',
								'FI' => 'FINLAND',
								'FR' => 'FRANCE',
								'GF' => 'FRENCH GUIANA',
								'PF' => 'FRENCH POLYNESIA',
								'TF' => 'FRENCH SOUTHERN TERRITORIES',
								'GA' => 'GABON',
								'GM' => 'GAMBIA',
								'GE' => 'GEORGIA',
								'DE' => 'GERMANY',
								'GH' => 'GHANA',
								'GI' => 'GIBRALTAR',
								'GR' => 'GREECE',
								'GL' => 'GREENLAND',
								'GD' => 'GRENADA',
								'GP' => 'GUADELOUPE',
								'GU' => 'GUAM',
								'GT' => 'GUATEMALA',
								'GG' => 'GUERNSEY',
								'GN' => 'GUINEA',
								'GW' => 'GUINEA-BISSAU',
								'GY' => 'GUYANA',
								'HT' => 'HAITI',
								'HM' => 'HEARD ISLAND AND MCDONALD ISLANDS',
								'VA' => 'HOLY SEE (VATICAN CITY STATE)',
								'HN' => 'HONDURAS',
								'HK' => 'HONG KONG',
								'HU' => 'HUNGARY',
								'IS' => 'ICELAND',
								'IN' => 'INDIA',
								'ID' => 'INDONESIA',
								'IR' => 'IRAN, ISLAMIC REPUB-LIC OF',
								'IQ' => 'IRAQ',
								'IE' => 'IRELAND',
								'IM' => 'ISLE OF MAN',
								'IL' => 'ISRAEL',
								'IT' => 'ITALY',
								'JM' => 'JAMAICA',
								'JP' => 'JAPAN',
								'JE' => 'JERSEY',
								'JO' => 'JORDAN',
								'KZ' => 'KAZAKHSTAN',
								'KE' => 'KENYA',
								'KI' => 'KIRIBATI',
								'KP' => 'KOREA, DEMOCRATIC PEOPLES REPUBLIC OF',
								'KR' => 'KOREA, REPUBLIC OF',
								'KW' => 'KUWAIT',
								'KG' => 'KYRGYZSTAN',
								'LA' => 'LAO PEOPLES DEMO-CRATIC REPUBLIC',
								'LV' => 'LATVIA',
								'LB' => 'LEBANON',
								'LS' => 'LESOTHO',
								'LR' => 'LIBERIA',
								'LY' => 'LIBYAN ARAB JAMA-HIRIYA',
								'LI' => 'LIECHTENSTEIN',
								'LT' => 'LITHUANIA',
								'LU' => 'LUXEMBOURG',
								'MO' => 'MACAO',
								'MK' => 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF',
								'MG' => 'MADAGASCAR',
								'MW' => 'MALAWI',
								'MY' => 'MALAYSIA',
								'MV' => 'MALDIVES',
								'ML' => 'MALI',
								'MT' => 'MALTA',
								'MH' => 'MARSHALL ISLANDS',
								'MQ' => 'MARTINIQUE',
								'MR' => 'MAURITANIA',
								'MU' => 'MAURITIUS',
								'YT' => 'MAYOTTE',
								'MX' => 'MEXICO',
								'FM' => 'MICRONESIA, FEDER-ATED STATES OF',
								'MD' => 'MOLDOVA, REPUBLIC OF',
								'MC' => 'MONACO',
								'MN' => 'MONGOLIA',
								'MS' => 'MONTSERRAT',
								'MA' => 'MOROCCO',
								'MZ' => 'MOZAMBIQUE',
								'MM' => 'MYANMAR',
								'NA' => 'NAMIBIA',
								'NR' => 'NAURU',
								'NP' => 'NEPAL',
								'NL' => 'NETHERLANDS',
								'AN' => 'NETHERLANDS ANTI-LLES',
								'NC' => 'NEW CALEDONIA',
								'NZ' => 'NEW ZEALAND',
								'NI' => 'NICARAGUA',
								'NE' => 'NIGER',
								'NG' => 'NIGERIA',
								'NU' => 'NIUE',
								'NF' => 'NORFOLK ISLAND',
								'MP' => 'NORTHERN MARIANA ISLANDS',
								'NO' => 'NORWAY',
								'OM' => 'OMAN',
								'PK' => 'PAKISTAN',
								'PW' => 'PALAU',
								'PS' => 'PALESTINIAN TERRI-TORY, OCCUPIED',
								'PA' => 'PANAMA',
								'PG' => 'PAPUA NEW GUINEA',
								'PY' => 'PARAGUAY',
								'PE' => 'PERU',
								'PH' => 'PHILIPPINES',
								'PN' => 'PITCAIRN',
								'PL' => 'POLAND',
								'PT' => 'PORTUGAL',
								'PR' => 'PUERTO RICO',
								'QA' => 'QATAR',
								'RE' => 'REUNION',
								'RO' => 'ROMANIA',
								'RU' => 'RUSSIAN FEDERATION',
								'RW' => 'RWANDA',
								'SH' => 'SAINT HELENA',
								'KN' => 'SAINT KITTS AND NEVIS',
								'LC' => 'SAINT LUCIA',
								'PM' => 'SAINT PIERRE AND MIQUELON',
								'VC' => 'SAINT VINCENT AND THE GRENADINES',
								'WS' => 'SAMOA',
								'SM' => 'SAN MARINO',
								'ST' => 'SAO TOME AND PRINC-IPE',
								'SA' => 'SAUDI ARABIA',
								'SN' => 'SENEGAL',
								'CS' => 'SERBIA AND MON-TENEGRO',
								'SC' => 'SEYCHELLES',
								'SL' => 'SIERRA LEONE',
								'SG' => 'SINGAPORE',
								'SK' => 'SLOVAKIA',
								'SI' => 'SLOVENIA',
								'SB' => 'SOLOMON ISLANDS',
								'SO' => 'SOMALIA',
								'ZA' => 'SOUTH AFRICA',
								'GS' => 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS',
								'ES' => 'SPAIN',
								'LK' => 'SRI LANKA',
								'SD' => 'SUDAN',
								'SR' => 'SURINAME',
								'SJ' => 'SVALBARD AND JAN MAYEN',
								'SZ' => 'SWAZILAND',
								'SE' => 'SWEDEN',
								'CH' => 'SWITZERLAND',
								'SY' => 'SYRIAN ARAB REPUB-LIC',
								'TW' => 'TAIWAN, PROVINCE OF CHINA',
								'TJ' => 'TAJIKISTAN',
								'TZ' => 'TANZANIA, UNITED REPUBLIC OF',
								'TH' => 'THAILAND',
								'TL' => 'TIMOR-LESTE',
								'TG' => 'TOGO',
								'TK' => 'TOKELAU',
								'TO' => 'TONGA',
								'TT' => 'TRINIDAD AND TOBAGO',
								'TN' => 'TUNISIA',
								'TR' => 'TURKEY',
								'TM' => 'TURKMENISTAN',
								'TC' => 'TURKS AND CAICOS ISLANDS',
								'TV' => 'TUVALU',
								'UG' => 'UGANDA',
								'UA' => 'UKRAINE',
								'AE' => 'UNITED ARAB EMIR-ATES',
								'GB' => 'UNITED KINGDOM',
								'US' => 'UNITED STATES',
								'UM' => 'UNITED STATES MINOR OUTLYING ISLANDS',
								'UY' => 'URUGUAY',
								'UZ' => 'UZBEKISTAN',
								'VU' => 'VANUATU',
								'VE' => 'VENEZUELA',
								'VN' => 'VIET NAM',
								'VG' => 'VIRGIN ISLANDS, BRIT-ISH',
								'VI' => 'VIRGIN ISLANDS, U.S.',
								'WF' => 'WALLIS AND FUTUNA',
								'EH' => 'WESTERN SAHARA',
								'YE' => 'YEMEN',
								'ZM' => 'ZAMBIA',
								'ZW' => 'ZIMBABWE',
								);
	public $validCountries_zh = array('AA' => '中�?',
								'AX' => 'ALAND ISLANDS',
								'AL' => 'ALBANIA',
								'DZ' => 'ALGERIA',
								'AS' => 'AMERICAN SAMOA',
								'AD' => 'ANDORRA',
								'AO' => 'ANGOLA',
								'AI' => 'ANGUILLA',
								'AQ' => 'ANTARCTICA',
								'AG' => 'ANTIGUA AND BAR-BUDA',
								'AR' => 'ARGENTINA',
								'AM' => 'ARMENIA',
								'AW' => 'ARUBA',
								'AU' => 'AUSTRALIA',
								'AT' => 'AUSTRIA',
								'AZ' => 'AZERBAIJAN',
								'BS' => 'BAHAMAS',
								'BH' => 'BAHRAIN',
								'BD' => 'BANGLADESH',
								'BB' => 'BARBADOS',
								'BY' => 'BELARUS',
								'BE' => 'BELGIUM',
								'BZ' => 'BELIZE',
								'BJ' => 'BENIN',
								'BM' => 'BERMUDA',
								'BT' => 'BHUTAN',
								'BO' => 'BOLIVIA',
								'BA' => 'BOSNIA AND HERZE-GOVINA',
								'BW' => 'BOTSWANA',
								'BV' => 'BOUVET ISLAND',
								'BR' => 'BRAZIL',
								'IO' => 'BRITISH INDIAN OCEAN TERRITORY',
								'BN' => 'BRUNEI DARUSSALAM',
								'BG' => 'BULGARIA',
								'BF' => 'BURKINA FASO',
								'BI' => 'BURUNDI',
								'KH' => 'CAMBODIA',
								'CM' => 'CAMEROON',
								'CA' => 'CANADA',
								'CV' => 'CAPE VERDE',
								'KY' => 'CAYMAN ISLANDS',
								'CF' => 'CENTRAL AFRICAN REPUBLIC',
								'TD' => 'CHAD',
								'CL' => 'CHILE',
								'CN' => 'CHINA',
								'CX' => 'CHRISTMAS ISLAND',
								'CC' => 'COCOS (KEELING) ISLANDS',
								'CO' => 'COLOMBIA',
								'KM' => 'COMOROS',
								'CG' => 'CONGO',
								'CD' => 'CONGO, THE DEMO-CRATIC REPUBLIC OF THE',
								'CK' => 'COOK ISLANDS',
								'CR' => 'COSTA RICA',
								'CI' => 'COTE D IVOIRE',
								'HR' => 'CROATIA',
								'CU' => 'CUBA',
								'CY' => 'CYPRUS',
								'CZ' => 'CZECH REPUBLIC',
								'DK' => 'DENMARK',
								'DJ' => 'DJIBOUTI',
								'DM' => 'DOMINICA',
								'DO' => 'DOMINICAN REPUBLIC',
								'EC' => 'ECUADOR',
								'EG' => 'EGYPT',
								'SV' => 'EL SALVADOR',
								'GQ' => 'EQUATORIAL GUINEA',
								'ER' => 'ERITREA',
								'EE' => 'ESTONIA',
								'ET' => 'ETHIOPIA',
								'FK' => 'FALKLAND ISLANDS (MALVINAS)',
								'FO' => 'FAROE ISLANDS',
								'FJ' => 'FIJI',
								'FI' => 'FINLAND',
								'FR' => 'FRANCE',
								'GF' => 'FRENCH GUIANA',
								'PF' => 'FRENCH POLYNESIA',
								'TF' => 'FRENCH SOUTHERN TERRITORIES',
								'GA' => 'GABON',
								'GM' => 'GAMBIA',
								'GE' => 'GEORGIA',
								'DE' => 'GERMANY',
								'GH' => 'GHANA',
								'GI' => 'GIBRALTAR',
								'GR' => 'GREECE',
								'GL' => 'GREENLAND',
								'GD' => 'GRENADA',
								'GP' => 'GUADELOUPE',
								'GU' => 'GUAM',
								'GT' => 'GUATEMALA',
								'GG' => 'GUERNSEY',
								'GN' => 'GUINEA',
								'GW' => 'GUINEA-BISSAU',
								'GY' => 'GUYANA',
								'HT' => 'HAITI',
								'HM' => 'HEARD ISLAND AND MCDONALD ISLANDS',
								'VA' => 'HOLY SEE (VATICAN CITY STATE)',
								'HN' => 'HONDURAS',
								'HK' => 'HONG KONG',
								'HU' => 'HUNGARY',
								'IS' => 'ICELAND',
								'IN' => 'INDIA',
								'ID' => 'INDONESIA',
								'IR' => 'IRAN, ISLAMIC REPUB-LIC OF',
								'IQ' => 'IRAQ',
								'IE' => 'IRELAND',
								'IM' => 'ISLE OF MAN',
								'IL' => 'ISRAEL',
								'IT' => 'ITALY',
								'JM' => 'JAMAICA',
								'JP' => 'JAPAN',
								'JE' => 'JERSEY',
								'JO' => 'JORDAN',
								'KZ' => 'KAZAKHSTAN',
								'KE' => 'KENYA',
								'KI' => 'KIRIBATI',
								'KP' => 'KOREA, DEMOCRATIC PEOPLES REPUBLIC OF',
								'KR' => 'KOREA, REPUBLIC OF',
								'KW' => 'KUWAIT',
								'KG' => 'KYRGYZSTAN',
								'LA' => 'LAO PEOPLES DEMO-CRATIC REPUBLIC',
								'LV' => 'LATVIA',
								'LB' => 'LEBANON',
								'LS' => 'LESOTHO',
								'LR' => 'LIBERIA',
								'LY' => 'LIBYAN ARAB JAMA-HIRIYA',
								'LI' => 'LIECHTENSTEIN',
								'LT' => 'LITHUANIA',
								'LU' => 'LUXEMBOURG',
								'MO' => 'MACAO',
								'MK' => 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF',
								'MG' => 'MADAGASCAR',
								'MW' => 'MALAWI',
								'MY' => 'MALAYSIA',
								'MV' => 'MALDIVES',
								'ML' => 'MALI',
								'MT' => 'MALTA',
								'MH' => 'MARSHALL ISLANDS',
								'MQ' => 'MARTINIQUE',
								'MR' => 'MAURITANIA',
								'MU' => 'MAURITIUS',
								'YT' => 'MAYOTTE',
								'MX' => 'MEXICO',
								'FM' => 'MICRONESIA, FEDER-ATED STATES OF',
								'MD' => 'MOLDOVA, REPUBLIC OF',
								'MC' => 'MONACO',
								'MN' => 'MONGOLIA',
								'MS' => 'MONTSERRAT',
								'MA' => 'MOROCCO',
								'MZ' => 'MOZAMBIQUE',
								'MM' => 'MYANMAR',
								'NA' => 'NAMIBIA',
								'NR' => 'NAURU',
								'NP' => 'NEPAL',
								'NL' => 'NETHERLANDS',
								'AN' => 'NETHERLANDS ANTI-LLES',
								'NC' => 'NEW CALEDONIA',
								'NZ' => 'NEW ZEALAND',
								'NI' => 'NICARAGUA',
								'NE' => 'NIGER',
								'NG' => 'NIGERIA',
								'NU' => 'NIUE',
								'NF' => 'NORFOLK ISLAND',
								'MP' => 'NORTHERN MARIANA ISLANDS',
								'NO' => 'NORWAY',
								'OM' => 'OMAN',
								'PK' => 'PAKISTAN',
								'PW' => 'PALAU',
								'PS' => 'PALESTINIAN TERRI-TORY, OCCUPIED',
								'PA' => 'PANAMA',
								'PG' => 'PAPUA NEW GUINEA',
								'PY' => 'PARAGUAY',
								'PE' => 'PERU',
								'PH' => 'PHILIPPINES',
								'PN' => 'PITCAIRN',
								'PL' => 'POLAND',
								'PT' => 'PORTUGAL',
								'PR' => 'PUERTO RICO',
								'QA' => 'QATAR',
								'RE' => 'REUNION',
								'RO' => 'ROMANIA',
								'RU' => 'RUSSIAN FEDERATION',
								'RW' => 'RWANDA',
								'SH' => 'SAINT HELENA',
								'KN' => 'SAINT KITTS AND NEVIS',
								'LC' => 'SAINT LUCIA',
								'PM' => 'SAINT PIERRE AND MIQUELON',
								'VC' => 'SAINT VINCENT AND THE GRENADINES',
								'WS' => 'SAMOA',
								'SM' => 'SAN MARINO',
								'ST' => 'SAO TOME AND PRINC-IPE',
								'SA' => 'SAUDI ARABIA',
								'SN' => 'SENEGAL',
								'CS' => 'SERBIA AND MON-TENEGRO',
								'SC' => 'SEYCHELLES',
								'SL' => 'SIERRA LEONE',
								'SG' => 'SINGAPORE',
								'SK' => 'SLOVAKIA',
								'SI' => 'SLOVENIA',
								'SB' => 'SOLOMON ISLANDS',
								'SO' => 'SOMALIA',
								'ZA' => 'SOUTH AFRICA',
								'GS' => 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS',
								'ES' => 'SPAIN',
								'LK' => 'SRI LANKA',
								'SD' => 'SUDAN',
								'SR' => 'SURINAME',
								'SJ' => 'SVALBARD AND JAN MAYEN',
								'SZ' => 'SWAZILAND',
								'SE' => 'SWEDEN',
								'CH' => 'SWITZERLAND',
								'SY' => 'SYRIAN ARAB REPUB-LIC',
								'TW' => 'TAIWAN, PROVINCE OF CHINA',
								'TJ' => 'TAJIKISTAN',
								'TZ' => 'TANZANIA, UNITED REPUBLIC OF',
								'TH' => 'THAILAND',
								'TL' => 'TIMOR-LESTE',
								'TG' => 'TOGO',
								'TK' => 'TOKELAU',
								'TO' => 'TONGA',
								'TT' => 'TRINIDAD AND TOBAGO',
								'TN' => 'TUNISIA',
								'TR' => 'TURKEY',
								'TM' => 'TURKMENISTAN',
								'TC' => 'TURKS AND CAICOS ISLANDS',
								'TV' => 'TUVALU',
								'UG' => 'UGANDA',
								'UA' => 'UKRAINE',
								'AE' => 'UNITED ARAB EMIR-ATES',
								'GB' => 'UNITED KINGDOM',
								'US' => 'UNITED STATES',
								'UM' => 'UNITED STATES MINOR OUTLYING ISLANDS',
								'UY' => 'URUGUAY',
								'UZ' => 'UZBEKISTAN',
								'VU' => 'VANUATU',
								'VE' => 'VENEZUELA',
								'VN' => 'VIET NAM',
								'VG' => 'VIRGIN ISLANDS, BRIT-ISH',
								'VI' => 'VIRGIN ISLANDS, U.S.',
								'WF' => 'WALLIS AND FUTUNA',
								'EH' => 'WESTERN SAHARA',
								'YE' => 'YEMEN',
								'ZM' => 'ZAMBIA',
								'ZW' => 'ZIMBABWE',
								);								
	public $country_us = "US";
	public $country_ca = "CA";
	public $validStates = array(
							"Alberta" => "Alberta",
							"BC" => "British Columbia",
							"Manitoba" => "Manitoba",
							"New Burnswick" => "New Burnswick",
							"Newfoundland and Labrador" => "Newfoundland and Labrador",
							"Nova Scotia" => "Nova Scotia",
							"Northwest Territories" => "Northwest Territories",
							"Nunavut" => "Nunavut",
							"Ontario" => "Ontario",
							"Prince Edward Island" => "Prince Edward Island",
							"Quebec" => "Quebec",
							"Saskatchewan" => "Saskatchewan",
							"Yukon" => "Yukon",
							"" => "---------------",
							"Alabama" => "Alabama",
							"Alaska" => "Alaska",
							"Arizona" => "Arizona",
							"Arkansas" => "Arkansas",
							"California" => "California",
							"Colorado" => "Colorado",
							"Connecticut" => "Connecticut",
							"Delaware" => "Delaware",
							"District of Columbia" => "District of Columbia",
							"Florida" => "Florida",
							"Georgia" => "Georgia",
							"Hawaii" => "Hawaii",
							"Idaho" => "Idaho",
							"Illinois" => "Illinois",
							"Indiana" => "Indiana",
							"Iowa" => "Iowa",
							"Kansas" => "Kansas",
							"Kentucky" => "Kentucky",
							"Louisiana" => "Louisiana",
							"Maine" => "Maine",
							"Maryland" => "Maryland",
							"Massachusetts" => "Massachusetts",
							"Michigan" => "Michigan",
							"Minnesota" => "Minnesota",
							"Mississippi" => "Mississippi",
							"Missouri" => "Missouri",
							"Montana" => "Montana",
							"Nebraska" => "Nebraska",
							"Nevada" => "Nevada",
							"New Hampshire" => "New Hampshire",
							"New Jersey" => "New Jersey",
							"New Mexico" => "New Mexico",
							"New York" => "New York",
							"North Carolina" => "North Carolina",
							"North Dakota" => "North Dakota",
							"Ohio" => "Ohio",
							"Oklahoma" => "Oklahoma",
							"Oregon" => "Oregon",
							"Pennsylvania" => "Pennsylvania",
							"Rhode Island" => "Rhode Island",
							"South Carolina" => "South Carolina",
							"South Dakota" => "South Dakota",
							"Tennessee" => "Tennessee",
							"Texas" => "Texas",
							"Utah" => "Utah",
							"Vermont" => "Vermont",
							"Virginia" => "Virginia",
							"Washington" => "Washington",
							"West Virginia" => "West Virginia",
							"Wisconsin" => "Wisconsin",
							"Wyoming" => "Wyoming"
						);
	
	public $slipView = '/order/slip';
	public $invoiceView = '/order/invoice';
	public $headerView = '/order/header';
	public $footerView = '/order/footer';

	public $dateFormat = 'Y/m/d';

	// Set this to the id of the weight specification to enable weight
	// calculation in the delivery slip and invoice. 1 is for the demo
	// data. Set to NULL to disable weight calculation.
	public $weightSpecificationId = 1;

	public $notifyAdminEmail = null;

	// If a price is NULL in the database, which price should be used instead?
	public $defaultPrice = 0.00;
	public $discountPrecision = 0;

	public $termsView = '/order/terms';
	public $successAction = array('//shop/order/success');
	public $failureAction = array('//shop/order/failure');

	public $loginUrl = array(
			'/site/login', 'action' => '%2525F%2525Fshop%2525Forder%2525Fcreate');

	public $orderConfirmTemplate = "Dear {title} {firstname} {lastname}, \n your order #{order_id} has been taken";

	//public $adminLayout = 'application.modules.shop.views.layouts.shopAdmin';
	//public $layout = 'application.modules.shop.views.layouts.shop';
	public $porletLayout = 'application.views.layouts.main';
	public $adminLayout = 'application.views.layouts.shopAdmin';
	//public $layout = 'application.views.layouts.shopGuest';
	public $layout = 'shop.views.layouts.main';
	public $layout_stephen = 'shop.views.layouts.main_stephen';
	// Set this to enable Paypal payment. See docs/paypal.txt
	public $payPalMethod = 1;
	public $payPalTestMode = true;
	public $payPalUrl = '//shop/order/paypal';
	public $payPalBusinessEmail = '';
	public $payPalLog = '../logs/ipn.log';
	
	public $payPercentage = 0;
	//public $payPalAPIUsername = 'julianjc82-co-kixify_api1.yahoo.com.hk';
	public $payPalAPIUsername = '';
	public $payPalAPIPassword = '';
	public $payPalAPISignature = '';
	public $payPalAPIAppID = '';
	public $payPalAPLog = '../logs/ipnap.log';
	

	// Rich text editor for the product description textarea.
	// for example, set this to the path of your ckeditor installation
	// to enable it
	public $rtepath = false; // Don't use an Rich text Editor
	public $rteadapter = false; // Don't use an Adapter


	// Set $allowPositionLiveChange to false if you have too many Variations in
	// an article. Changing of variations is not possible in the shopping cart
	// view anymore then.
	public $allowPositionLiveChange = true;

	// Set Store Banner, Logo, Product Images
	public $imageUploadPath = 'images/uploads/';
	public $imageThumbUploadPath= 'images/uploads/thumb/';
	public $imageWidthThumb = 100;
	public $imageWidth = 200;
	public $imageLimit = 0;
	public $bannerWidth = 1020;
	public $bannerHeight = 250;
	public $bannerDisplayWidth = 1020;
	public $bannerDisplayHeight = 250;
	public $bannerUploadPath = 'images/banner';
	public $logoWidth = 1020;
	public $logoHeight = 250;
	public $logoDisplayWidth = 1020;
	public $logoDisplayHeight = 250;
	public $logoUploadPath = 'images/logo';
	public $productImageWidth = 500;
	public $productImageHeight = 500;
	public $productImageThumbWidth = 250;
	public $productImageThumbHeight = 250;
	// Where the uploaded product images are stored, started from approot/:
	public $productImagesFolder = 'images/product/'; 
	public $productThumbImagesFolder = 'images/product/thumb/';
	
	public $sellImagesFolder = 'images/app_img/SELL/';
	public $sellThumbImagesFolder = 'images/app_img/SELL/thumb/';
	
	public $lifestyleImagesFolder = 'images/app_img/LIFESTYLE/';
	public $lifestyleThumbImagesFolder = 'images/app_img/LIFESTYLE/thumb/';
	
	public $qnaImagesFolder = 'images/app_img/QNA/';
	public $qnaThumbImagesFolder = 'images/app_img/QNA/thumb/';
	
	
	// Images uploaded by the customer (for example, for Poster Shops)
	public $uploadedImagesFolder = 'uploadedimages'; 
	
	public $chatImagesFolder = 'images/chat/'; 
	public $chatThumbImagesFolder = 'images/chat/thumb/';
	
	
	// No of products to display
	public $noOfNewShoes = 20;
	public $noOfFeatureShoes = 4;
	public $noOfShoes = 9;
	
	public $featureProductFee = 0;
	public $galleryProductFee = 0;
	public $featureDays = 7;
	public $payPalHandlingFeePercentage = 0.04;
	
	// Product Option
	public $conditionOpt = array('Brand New' => 'Brand New', 'Used' => 'Used', 'Pre-Order' => 'Pre-Order');
	
	public $petStatusOpt = array('1' => 'Pet Lost', '0' => 'At Home', '2'=>'Found & at Home','3'=>'Pets for adoption','4'=>'Pet boarding required');
	
	// Links
	public $facebookLink = "#";
	public $rssLink = "#";
	public $twitterLink = "#";
	public $dribbbleLink = "#";
	public $youtubeLink = "#";
	public $skypeLink = "#";
	
	
	public function init()
	{
		$this->setImport(array(
			'shop.models.*',
			'shop.components.*',
		));
		
		// Update admin layout
		//if(!Yii::app()->user->isGuest)
		//	$this->layout = $this->adminLayout;
		
		$this->payPalAPIUsername=AppProfile::model()->getPayPalAPIUsername();
		$this->payPalAPIPassword=AppProfile::model()->getPayPalAPIPassword();
		$this->payPalAPISignature=AppProfile::model()->getPayPalAPISignature();
		$this->payPalAPIAppID=AppProfile::model()->getPayPalAPIAppID();
		$this->payPalBusinessEmail=AppProfile::model()->getPayPalBusinessEmail();
		$this->payPalTestMode=AppProfile::model()->getPayPalTestMode();
		$this->payPercentage=AppProfile::model()->getPayPercentage();
		$this->featureProductFee=AppProfile::model()->getFeatureProductFee();
		$this->galleryProductFee=AppProfile::model()->getGalleryProductFee();
		$this->imageLimit=AppProfile::model()->getImageLimit();
		$this->payPalHandlingFeePercentage=AppProfile::model()->getPayPalHandlingFeePercentage();
		$this->facebookLink=AppProfile::model()->getFacebookLink();
		$this->rssLink=AppProfile::model()->getRSSLink();
		$this->twitterLink=AppProfile::model()->getTwitterLink();
		$this->dribbbleLink=AppProfile::model()->getDribbbleLink();
		$this->youtubeLink=AppProfile::model()->getYouTubeLink();
		$this->skypeLink=AppProfile::model()->getSkypeLink();

	}

	public function beforeControllerAction($controller, $action)
	{
		if (Yii::app()->language=='zh'){
			$this->genderOptions= array('M' => Yii::t('shop','Male'), 'F' => Yii::t('shop','Female'));
			$this->petStatusOpt = array('1' => Yii::t('shop','Pet Lost').'', '0' => Yii::t('shop','At Home'), '2'=>Yii::t('shop','Found & at Home'),'3'=>Yii::t('shop','Pets for adoption'),'4'=>Yii::t('shop','Pet boarding required'));
		}
		if(parent::beforeControllerAction($controller, $action))
		{
			return true;
		}
		else
			return false;
	}
}
