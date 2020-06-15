<!DOCTYPE html>
<html>
<head>
    <title><?= $host ?> - <?= $dn['name'] ?> - <?= $dn['title'] ?></title>
    <meta name="description" content="<?= $dn['description'] ?>" />
    <meta name="keywords" content="<?= $dn['keywords'] ?>" />
    <meta content='width=device-width, initial-scale=1' name='viewport'>
    <meta content='notranslate' name='google'>
    <link rel="icon" type="image/png" href="<?= $ico ?>" sizes="64x64" />
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' rel='stylesheet'>
    <style>
        body {
            font-family: '微软雅黑', sans-serif; }
        #index .login {
            position:fixed;
            top:0vh;
            right:0;
            text-align: right;
        }
        #index .landing {
            position: fixed;
            /*top: 30vh;*/
            bottom: 3vh;
            left: 0;
            right: 0;
            text-align: center; }
        #index .domain {
            font-size: 60px;
            font-weight: 700; }
        /*#index .domain span {
            color: #08d; }*/
        @media (max-width: 500px) {
            #index .domain {
                font-size: 40px; } }
        #index .lucky {
            background: #08d;
            border: 1px solid #048;
            padding: 0.3rem 2rem;}
        #index .lucky:hover {
            background: #19e; }
        #domains h1 {
            font-weight: 700; }
        #domains h3 {
            margin-top: 1rem;
            font-weight: 700; }
        #domains .category {
            margin: 1rem 0;
            font-size: 17px;
            background-color: #08d;
            color: white;
            padding: 8px 10px; }
        #domains ul {
            padding-left: 0;
            list-style-type: none; }
        #domains li {
            line-height: 1.5; }

    </style>
</head>
<body id='index'>

<script src='https://cdn.jsdelivr.net/npm/bubbly-bg@1.0.0/dist/bubbly-bg.js'></script>
<script>
    var getRandomColorBg = function(){
        return "rgba(" + Math.round(Math.random() * 255) + "," + Math.round(Math.random() * 255) + ',' + Math.round(Math.random() * 255) + ',0.2)';
    }
    var getRandomColor = function(){
        return "rgb(" + Math.round(Math.random() * 255) + "," + Math.round(Math.random() * 255) + ',' + Math.round(Math.random() * 10) + ')';
    }
    function onReady() {
        const host = window.location.hostname;

        // remove www
        if (host.startsWith('www.')) {
            const naked = host.replace('www.', '');
            window.location.replace('//' + naked);
            return;
        }

        // fix up domain text
        const parts = host.split('.');
        if (parts.length == 2) {
            const base = parts[0];
            const tld = parts[1];
            //document.title = host;
            document.querySelector('.domain').innerHTML = base + '<span>.' + tld + '</span>';
        }

        document.querySelector('.domain').style.color = getRandomColor();
        document.querySelector('.domain span').style.color = getRandomColor();

        bubbly({
            colorStart: getRandomColorBg(),
            colorStop: getRandomColorBg(),
            compose: 'source-over',
            //bubbleFunc: () => `hsla(203, 100%, 43%, ${Math.random() * 0.3})`,
            bubbleFunc: () => `hsla(${Math.random() * 360}, 100%, 50%, ${Math.random() * 0.25})`,
        });
    }
    document.addEventListener('DOMContentLoaded', onReady, false);
</script>
<div class="login">
    <div>
        <a class="btn-success small" href="/user/login" target="_blank">添加我的域名</a>
        <a class="btn-success small" href="/yuming.tar.gz" target="_blank">下载源码</a>
    </div>
</div>
<div class='landing'>
    <div>
        <?php
        if ($dn['logo'] != null) {
            echo '<img src="' . $dn['logo'] . '">';
        }
        ?>
        <div class='domain'>
            <span><?= $dn['domain'] ?></span>
        </div>
        <div class='mb-4'>
            <?= unserialize(base64_decode($dn['data'])) ?>
        </div>
        <div class='mb-4'>
            <?= $dn['description'] ?>
        </div>
        <div class='mb-4'>
            <p class="small text-danger"><?= $dn['domain'] ?>域名非常有价值，目前正在出售，如果你需要请不要错过机会！</p>
        </div>
        <button type="button" class="btn btn-info">价格：<?= $dn['price'] ?></button>
        <?php
        if ($dn['email'] != null) {
            echo '<a class="btn btn-primary" href="mailto:"'.$dn['email'].'">邮箱：'.$dn['email'].'</a>'."\r\n";
        }
        if ($dn['qq'] != null) {
            echo '<button type="button" class="btn btn-info">QQ：'.$dn['qq'].'</button>'."\r\n";
        }
        if ($dn['tel'] != null) {
            echo '<button type="button" class="btn btn-success">电话：'.$dn['tel'].'</button>'."\r\n";
        }
        if ($dn['mobile'] != null) {
            echo '<button type="button" class="btn btn-success">手机：'.$dn['mobile'].'</button>'."\r\n";
        }
        ?>
    </div>
    <div style="padding-top: 0.375em">
        <a class="btn btn-primary" href="http://whois.chinaz.com/<?= $dn['domain'] ?>" target="_blank">Whois</a>
        <a class="btn btn-primary" href="http://seo.chinaz.com/<?= $dn['domain'] ?>" target="_blank">Chinaz权重</a>
        <a class="btn btn-primary" href="http://www.aizhan.com/seo/<?= $dn['domain'] ?>" target="_blank">爱站权重</a>
    </div>
    <div style="padding-top: 0.375em">
        <a class="btn btn-primary" href="mailto:<?= $user['email'] ?>"><?= $user['email'] ?></a>
        <p class="small">
            域名所有者简介：<?= $user['profile'] ?>
        </p>
        <div style="display: none">
            <?= $user['statistic'] ?>
            <?= $_data['sys']['count'] ?>
        </div>
    </div>
</div>
</body>
</html>