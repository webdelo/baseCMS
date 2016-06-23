<nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
    <div class="container topnav">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand topnav" href="/">Rusanna</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li <?=($_SERVER['REQUEST_URI']=='/')?'class="active"':''?>><a href="/">Главная</a></li>
                <li <?=($_SERVER['REQUEST_URI']=='/services/')?'class="active"':''?>><a href="/services/">Услуги и цены</a></li>
                <li <?=($_SERVER['REQUEST_URI']=='/employees/')?'class="active"':''?>><a href="/employees/">Сотрудники</a></li>
                <li <?=($_SERVER['REQUEST_URI']=='/gallery/')?'class="active"':''?>><a href="/gallery/">Галерея</a></li>
                <li <?=($_SERVER['REQUEST_URI']=='/about/')?'class="active"':''?>><a href="/about/">О нас</a></li>
                <li <?=($_SERVER['REQUEST_URI']=='/contacts/')?'class="active"':''?>><a href="/contacts/">Контакты</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>