<style type="text/css">
    body {
        padding-top: 20px;
        padding-bottom: 60px;
    }

    /* Custom container */
    .container {
        margin: 0 auto;
        max-width: 1000px;
    }
    .container > hr {
        margin: 60px 0;
    }

    /* Main marketing message and sign up button */
    .jumbotron {
        margin: 80px 0;
        text-align: center;
    }
    .jumbotron h1 {
        font-size: 100px;
        line-height: 1;
    }
    .jumbotron .lead {
        font-size: 24px;
        line-height: 1.25;
    }
    .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
    }

    /* Supporting marketing content */
    .marketing {
        margin: 60px 0;
    }
    .marketing p + h4 {
        margin-top: 28px;
    }


    /* Customize the navbar links to be fill the entire space of the .navbar */
    .navbar .navbar-inner {
        padding: 0;
    }
    .navbar .nav {
        margin: 0;
        display: table;
        width: 100%;
    }
    .navbar .nav li {
        display: table-cell;
        width: 1%;
        float: none;
    }
    .navbar .nav li a {
        font-weight: bold;
        text-align: center;
        border-left: 1px solid rgba(255,255,255,.75);
        border-right: 1px solid rgba(0,0,0,.1);
    }
    .navbar .nav li:first-child a {
        border-left: 0;
        border-radius: 3px 0 0 3px;
    }
    .navbar .nav li:last-child a {
        border-right: 0;
        border-radius: 0 3px 3px 0;
    }
</style>
<div class="container">
    <?php Fw_Module::getModule('masthead')?>
    <div class="jumbotron">
        <h1>Do it simple!</h1>
        <p class="lead">
            Create fast and strong PHP webapps is simple, because we can use
            advanced technologies and a lot of design patterns. The wheel has been
            invented. Why do you think in reinvent it again?
        </p>
        <a class="btn btn-large btn-inverse" href="https://github.com/ivgam">Get started today</a>
    </div>
    <hr>
    <div class="row-fluid">
        <div class="span4">
            <h2>MVC</h2>
            <p>
                All the MVC's haven't the same implementation. For this, we use 
                a very common implementation, that uses a Dispatcher and a Router 
                to ensure that all the request pass, firstly, for the index file. 
                This allows you to securize more quickly and efficiently, 
                your app.
            </p>
            <p><a class="btn" href="<?= BASE_URI?>static/wiki#mvc">View details &raquo;</a></p>
        </div>
        <div class="span4">
            <h2>Admin Panel</h2>
            <p>
                Sometimes, when you create an APP, you know perfectly what are
                the different views that you offer to the user but...what are
                the different views that you use? Butler, offers a CRUD
                environment that allows to manage a high percentage of the
                possible apps that you need to do.
            </p>
            <p><a class="btn" href="<?= BASE_URI?>static/wiki">View details &raquo;</a></p>
        </div>
        <div class="span4">
            <h2>Bootstrap</h2>
            <p>
                Responsive, viewport, mobile, HTML5, CSS3, design...Wait a
                moment! What do you say? Don't worry, we use Bootstrap a great
                CSS Framework that reduces the design time. This site is designed
                with a default template of Bootstrap, feels good, no?
            </p>
            <p><a class="btn" href="<?= BASE_URI?>static/wiki">View details &raquo;</a></p>
        </div>
    </div>
    <?php Fw_Module::getModule('footer')?>    
</div>