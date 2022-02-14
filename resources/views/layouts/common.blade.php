<!DOCTYPE html>
<html lang="ja">
<head>
<meta name="viewport" content="width=700px">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<style>:root{font-size:12pt;background-color:#f5f0ea;color:#333;font-family:'Noto Sans JP','ヒラギノ角ゴ ProN','Hiragino Kaku Gothic ProN','メイリオ',Meiryo,'ＭＳ Ｐゴシック','MS PGothic',sans-serif}body{margin:0;padding:0;-webkit-text-size-adjust:100%}form{margin-bottom:0}header{background:linear-gradient(#D00,#000);height:3.5rem;width:100%;display:table}span.nama{padding:0 0 0 1rem;display:table-cell;font-size:18pt;font-style:italic;vertical-align:middle}span.slbtn{padding:0 1rem 0 0;display:table-cell;vertical-align:middle;text-align:right}a.titl{color:white;text-decoration:none}input[type="submit"].yhhb,button.yhhb{vertical-align:bottom;font-size:14pt;padding:.14rem 1rem;margin-left:.5rem}div.boya{margin:1rem}input[type="submit"],button{background:linear-gradient(#D00,#000);border:1.5px;border-radius:1rem;border-style:solid;border-color:black;color:white;box-shadow:2px 2px 2px rgba(0,0,0,.4);vertical-align:top}div.htle{font-size:26pt;text-shadow:2px 2px 2px rgba(0,0,0,.4)}</style>
<link rel="preload" href="/css/style.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="/css/style.css"></noscript>
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet"></noscript>
<script>/*! loadCSS. [c]2017 Filament Group, Inc. MIT License */(function(a){if(!a.loadCSS){a.loadCSS=function(){}}var b=loadCSS.relpreload={};b.support=(function(){var d;try{d=a.document.createElement("link").relList.supports("preload")}catch(f){d=false}return function(){return d}})();b.bindMediaToggle=function(e){var f=e.media||"all";function d(){if(e.addEventListener){e.removeEventListener("load",d)}else{if(e.attachEvent){e.detachEvent("onload",d)}}e.setAttribute("onload",null);e.media=f}if(e.addEventListener){e.addEventListener("load",d)}else{if(e.attachEvent){e.attachEvent("onload",d)}}setTimeout(function(){e.rel="stylesheet";e.media="only x"});setTimeout(d,3000)};b.poly=function(){if(b.support()){return}var d=a.document.getElementsByTagName("link");for(var e=0;e<d.length;e++){var f=d[e];if(f.rel==="preload"&&f.getAttribute("as")==="style"&&!f.getAttribute("data-loadcss")){f.setAttribute("data-loadcss",true);b.bindMediaToggle(f)}}};if(!b.support()){b.poly();var c=a.setInterval(b.poly,500);if(a.addEventListener){a.addEventListener("load",function(){b.poly();a.clearInterval(c)})}else{if(a.attachEvent){a.attachEvent("onload",function(){b.poly();a.clearInterval(c)})}}}if(typeof exports!=="undefined"){exports.loadCSS=loadCSS}else{a.loadCSS=loadCSS}}(typeof global!=="undefined"?global:this));</script>
@yield('additionalHead')
<title>@yield('title') | アメミュ練習室予約システム</title>
</head>
<body>
    <div class="oya">
        @include('layouts.header')
    <div class="boya">
        @yield('contents')
        @yield('table')
    </div>
</div>
</body>
</html>
