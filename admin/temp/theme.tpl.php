<!DOCTYPE html>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Logo设置 - 蝉知企业门户系统</title>
    <meta name='keywords' content=''>
    <meta name='description' content=''>
    <link href="<?php echo $this->relativeDir.'/css/all.css'; ?>" rel="stylesheet" />
    <link href="<?php echo $this->relativeDir.'/css/admin.css'; ?>" rel="stylesheet" />
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
        <div class='col-md-2'>
            <ul class='nav nav-list leftmenu affix'>
                <li class='active'>
                    <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=ui&f=setlogo' >
                        LOGO设置<i class="icon-chevron-right"></i>
                    </a>
                </li>
                <li>
                    <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=ui&f=settheme' >
                        主题风格<i class="icon-chevron-right"></i>
                    </a>
                </li>
                <li>
                    <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=slide&f=admin' >
                        幻灯片设置<i class="icon-chevron-right"></i>
                    </a>
                </li>
                <li>
                    <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=block&f=admin' >
                        区块管理<i class="icon-chevron-right"></i>
                    </a>
                </li>
                <li>
                    <a href='/shirlyWorkSpace/yida/microTogether/chanzhieps/www/admin.php?m=block&f=pages' >
                        布局设置<i class="icon-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class='col-md-10'>
            <form method='post' id='ajaxForm' enctype='multipart/form-data'>
                <table class='table table-form'>
                    <caption>Logo设置</caption> 
                    <tr>
                        <th class='w-150px'></th> 
                        <td class='v-middle'>
                            <input type='file' name='files' id='files'  />
                            <input type='submit' id='submit' class='btn btn-primary' value='保存' data-loading='稍候...' />       
                        </td>
                    </tr>
                </table>
            </form>
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
