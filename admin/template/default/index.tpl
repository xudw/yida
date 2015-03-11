<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="易达团队" />
    <meta name="description" content="易达团队开发" />
    <title>登录页</title>
    <link href="{res file=all.css}" rel="stylesheet" />
    <link href="{res file=admin.css}" rel="stylesheet" />
    <script src="./common/js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="{lib file=bigfoucs.js}" type="text/javascript"></script>
    <style>
        label{display: block;}
        body{background-color:#f6f5f5}
        .admin{width: 360px; margin: 0 auto 20px; padding: 19px 29px 29px; background-color: #fff; border: 1px solid #ddd;
        -moz-box-shadow:0px 1px 15px rgba(0,0,0,0.15); -webkit-box-shadow:0px 1px 15px rgba(0,0,0,0.15); box-shadow:0px 1px 15px rgba(0,0,0,0.15);}
        .admin input{margin-bottom: 10px;}
        #logo{display: block; margin: 0 auto; text-align: center;}
        #logo img{width: 200px; padding: 0 0 10px 0;}
        #logo h1 {margin: 0;line-height: 50px;font-size: 40px;font-family: 微软雅黑;padding: 0 0 10px 0;}
        .input-block-level{width: 100%;}
    </style>
</head>
<body>
    <form method="post" id='ajaxForm' class='radius shadow admin'>
        <div id='logo'>
            <!-- <img src='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/theme//default/images/main/logo.login.png'  /> -->
            <h1>易达CMS</h1>
        </div>
        <div id='responser' class='text-center'></div>
        <input type='text' name='account' id='account' value='' class='input-block-level' placeholder='请输入用户名或Email' />
        <input type='password' name='password' id='password' value='' class='input-block-level' placeholder='请输入密码' />
        <input type='hidden' name='referer' id='referer' value='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php'  />
        <input type='submit' id='submit' class='btn btn-primary btn-block' value='登录' data-loading='稍候...' /> 
    </form>
</body>
</html>