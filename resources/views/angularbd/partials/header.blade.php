<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="https://www.php.net/favicon.ico">
<title>{{ env('EVENT_TITLE', 'Give event title') }}</title>
<meta name="Description"
      content="Discuss & share your issues, ideas, tips & tricks with other php developers from Bangladesh. Be a part of the community to grow all along.">
<meta name="Keywords"
      content="php, javascript, developers, dhaka, bangladesh, programmers, open source, js, phpXperts, meetup, 20, 2020, bangladesh, meetup, php-dhaka, php-bangladesh, daffodil">
<meta name="robots" content="index, follow"/>
<meta property="og:url" content="{{ env('EVENT_FACEBOOK_LINK') }}"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="{{ env('EVENT_TITLE', '') }}"/>
<meta property="og:description"
      content="Discuss & share your issues, ideas, tips & tricks with other developers at phpXperts DevCon 2020. Be a part of the community to grow all along."/>
<meta property="og:image"
      content="{{ asset('phpxperts/images/social-media-promo.jpg') }}"/>
{{--<link rel="stylesheet" href="./assets/styles/main.css">--}}
<link rel="stylesheet" href="{{ asset('phpxperts/styles/main.css') }}">
