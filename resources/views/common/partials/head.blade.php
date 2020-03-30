<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Add A Title' }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $title ?? 'Add A Title' }}" />
    <meta property="og:description" content="{{ $description ?? '' }}" />
    <meta property="og:url" content="{{ $meta_url ?? 'https://directory.usecleaver.com' }}{{ $path }}" />
    <meta property="og:site_name" content="Cleaver Directory" />
    <meta property="og:image" content="{{ $meta_image ?? 'https://directory.cleaver.com/assets/image/social-image.png' }}" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="{{ $description ?? '' }}" />
    <meta name="twitter:title" content="{{ $title ?? 'Add A Title' }}" />
    <meta name="twitter:site" content="@aschmelyun" />
    <meta name="twitter:image" content="{{ $meta_image ?? 'https://directory.cleaver.com/assets/image/social-image.png' }}" />

    <link rel="apple-touch-icon" sizes="57x57" href="/assets/images/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/images/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/images/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/images/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/images/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/images/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/images/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/images/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/images/icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assets/images/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/icons/favicon-16x16.png">
    <meta name="msapplication-TileImage" content="/assets/images/icons/ms-icon-144x144.png">
    <link rel="icon" href="/assets/images/icons/favicon-32x32.png" type="image/png">

    <meta name="theme-color" content="#d53f8c">

    <link rel="stylesheet" type="text/css" href="{{ $mix['/assets/css/app.css'] }}">
</head>