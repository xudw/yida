<!DOCTYPE html>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>易达首页</title>
    <meta name='keywords' content=''>
    <meta name='description' content=''>
    <link href="<?php echo $this->relativeDir.'/css/all.css'; ?>" rel="stylesheet" />
    <link href="<?php echo $this->relativeDir.'/css/admin.css'; ?>" rel="stylesheet" />
    <style>
        #shortcutBox {margin-top:30px;}

        #shortcutBox .shortcut {
            transition: all .3s;
            -o-transition: all .3s;
            -moz-transition: all .3s;
            -webkit-transition: all .3s;
            text-align:center;
        }
        #shortcutBox .shortcut:hover {
            opacity: 0.8;
            -moz-opacity: 0.8;
            filter: alpha(opacity=80);
            transition: all .3s;
            -o-transition: all .3s;
            -moz-transition: all .3s;
            -webkit-transition: all .3s;
        }

        #shortcutBox h3 {
            line-height: 170px; 
            font-size:24px; 
            color: #FFFFFF; 
            font-weight: 500;
        }
        #shortcutBox a:hover{
            text-decoration: none;
        }

        @media(max-width:992px){
            #shortcutBox{
                margin-top: 20px;
            }
        }
        @media(max-width:768px){
            #shortcutBox{
                margin-top: -20px;
            }
        }

        .article-admin {
            background: #2D89EF;
        }
        .article-create {
            background: #B91D47;
        }
        .category {
            background: #00A300;
        }
        .company {
            background: #7F4311;
        }
        .site {
            background: #E3A21A;
        }
        .logo {
            background: #9F00A7;
        }
        .contact {
            background: #1E1E1E;
        }
    </style>

</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=admin&f=index' class='navbar-brand'>易达微信CMS</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class='nav navbar-nav'>
                <li class='active'>
                    <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=admin&f=index'>首页</a>
                </li>
                <li>
                    <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=article&f=admin'>文章</a>
                </li>
                <li>
                    <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=product&f=admin'>产品</a>
                </li>
                <li>
                    <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=site&f=setbasic'>站点</a>
                </li>
                <li>
                    <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=ui&f=setlogo'>界面</a>
                </li>
                <li>
                    <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=company&f=setbasic'>公司</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href='###' class='dropdown-toggle' data-toggle='dropdown'>
                        <i class='icon-globe icon-large'></i> &nbsp;简体<span class='caret'></span>
                    </a>
                    <ul class='dropdown-menu'>
                        <li>
                            <a rel='nofollow' href='javascript:selectLang("zh-tw")'>繁体</a>
                        </li>
                        <li>
                            <a rel='nofollow' href='javascript:selectLang("en")'>English</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/' target='_blank' class='navbar-link'>
                        <i class="icon-home icon-large"></i> 前台
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-user icon-large"></i> 11 <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=user&f=changePassword' data-toggle='modal'>修改密码</a>
                        </li>
                        <li>
                            <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=user&f=logout' >退出</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div id="body-content" class="row clearfix">
        <div class='container' id='shortcutBox'>
            <form method='post' id='ajaxForm' action='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=admin&f=ignore'>
                <div class="alert alert-danger">
                    <button type="submit" class="close">&times;</button>
                    <strong>警告：您现在的管理入口还是默认的admin.php，建议将admin.php改名以增强系统安全!</strong>
                </div>
            </form>

            <div class='row'>
                <div class='col-md-4 col-sm-6'> 
                    <div class="shortcut article-create">
                        <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=article&f=create' >
                            <h3>发布文章</h3>
                        </a>
                    </div>
                </div>
                <div class='col-md-4 col-sm-6'>
                    <div class="shortcut article-admin">
                        <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=product&f=create' >
                            <h3>添加产品</h3>
                        </a>
                    </div>
                </div>
                <div class='col-md-4 col-sm-6'>
                    <div class="shortcut category">
                        <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=comment&f=admin' >
                            <h3>处理评论</h3>
                        </a>
                    </div>
                </div>
                <div class='col-md-4 col-sm-6'>
                    <div class="shortcut site">
                        <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=site&f=setBasic' >
                            <h3>站点设置</h3>
                        </a>
                    </div>
                </div>
                <div class='col-md-4 col-sm-6'>
                    <div class="shortcut company">
                        <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=company&f=setBasic' >
                            <h3>公司信息</h3>
                        </a>
                    </div>
                </div>
                <div class='col-md-4 col-sm-6'>
                    <div class="shortcut contact">
                        <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=company&f=setcontact' >
                            <h3>联系方式</h3>
                        </a>
                </div>
                </div>      
            </div>
        </div>
    </div>

    <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
        <div class="collapse navbar-collapse navbar-ex6-collapse">
            <div class='navbar-text pull-right'> 
                <span id='poweredBy'>
                    <a href='http://www.chanzhi.org/?v=1.7' target='_blank'>蝉知1.7</a>
                </span>
            </div>
        </div>
    </nav>
</body>
</html>
