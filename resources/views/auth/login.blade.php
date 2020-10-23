@extends('adminlte::auth.login')
<link rel="manifest" href="{{ asset('manisfest.json') }}">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="msapplication-starturl" content="/">
<link rel="stylesheet" href="https://loja704.com.br/css/dashboard/home.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
    function saveBeforeInstallPromptEvent(evt) {
        deferredInstallPrompt = evt;
        deferredInstallPrompt.prompt();
    }
    window.addEventListener('beforeinstallprompt', saveBeforeInstallPromptEvent);
</script>
