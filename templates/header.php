<!DOCTYPE html>

<html>

    <head>
        <link rel="stylesheet" type="text/css" href="../css/styles.css" />
        <title>
            OurStory - <?= htmlspecialchars($title) ?>
        </title>
    </head>

    <body>

        <div class="normal-holder content-holder" id="<?= $user == false ? "content-not-logged-in" : "content-logged-in" ?>">

            <div align="center"><h2>KeepInTouch</h2></div>
            <div align="center"><h3><?= $user == false ? "Not Logged In" : htmlspecialchars($user->getUsername()) ?></h3></div>

            <nav class="navbar-holder">
                <div id="navigation-bar">
                    <span class="nav-item"><a href="/keepintouch/controllers/index.php">Home</a></span>
                    <span class="nav-item"><a href="/keepintouch/controllers/register.php">Register</a></span>
                    <span class="nav-item"><a href="/keepintouch/controllers/login.php">Login</a></span>
                    <span class="nav-item"><a href="/keepintouch/controllers/logout.php">Logout</a></span>
                    <span class="nav-item"><a href="/keepintouch/controllers/newpost.php">New Post</a></span>
                    <?php if ($user != false): ?>
                        <span class="nav-item"><a href="/keepintouch/controllers/userhome.php?u=<?= $user->getId() ?>">My Page</a></span>
                    <?php endif; ?>
                </div>
            </nav>
