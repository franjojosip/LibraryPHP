<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h1 id="mainHeader">Mikanovci Public Library</h1>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo URL_ROOT ?>">
            <img src="<?php echo URL_ROOT ?>/public/images/library_icon.svg" alt="Logo img">
        </a>
    </nav>
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo URL_ROOT ?>/pages/books">Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo URL_ROOT ?>/pages/genres">Genres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo URL_ROOT ?>/pages/authors">Authors</a>
            </li>
            <?php
            if (isset($_SESSION['user_id']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin']) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL_ROOT ?>/users">Users</a>
                </li>
            <?php endif; ?>
        </ul>
        <ul class="navbar-nav mr-right">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <span class="navbar-text pl-6">User logged:</span>
                <li class="nav-item dropdown pr-5">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> <?php echo $_SESSION['user_name']; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?php echo URL_ROOT ?>/users/changepassword"><i class="fa fa-key"></i> Change password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo URL_ROOT ?>/users/logout"><i class="fa fa-power-off"></i> Logout</a>
                    </div>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL_ROOT ?>/users/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL_ROOT ?>/users/register"><i class="fa fa-sign-in"></i> Sign in </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>