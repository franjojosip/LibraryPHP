<?php require APP_ROOT . '/views/inc/header.php' ?>

<div class="d-flex flex-wrap">
    <div class="column-left">
        <h2>Top pick</h2>
        <h4>Convenience store woman</h4>
        <p>After 18 years of working at a convenience store, Keiko strikes up a friendship with a cynical, bitter young man.</p>
        <div id="top-pick">
            <img src="<?php echo URL_ROOT; ?>/public/images/article_story.png" class="customImg" alt="Top pick book">
        </div>
    </div>
    <div class="column-center">
        <div id="slideShow" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="<?php echo URL_ROOT; ?>/public/images/journal.png" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?php echo URL_ROOT; ?>/public/images/book_club.png" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?php echo URL_ROOT; ?>/public/images/explore.png" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#slideShow" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#slideShow" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="column-right">
        <h2>Staff picks</h2>
        <h4>Follow Me to Ground</h4>
        <p>A haunting debut filled with magical realism and folklore, Ada is a bewitching but strong heroine who challenges the conventions of womanhood and the basic ideals of the human body.</p>
        <div id="staff-pick">
            <img src="<?php echo URL_ROOT; ?>/public/images/staff_pick.png" class="customImg" alt="Staff picks book">
        </div>
    </div>
</div>
<br>
<hr />
<h3 id="activitiesHeader">Library Activites & Groups</h3>
<div class="card-columns">
    <div class="card w-100 mb-2">
        <div class="card-body">
            <img class="card-img" src="<?php echo URL_ROOT; ?>/public/images/community.jpeg" alt="Card image cap">
            <h5 class="card-title mt-2 mb-0">COVID-19: Community Support Resource</h5>
        </div>
    </div>
    <div class="card w-100 mb-2">
        <div class="card-body">
            <img class="card-img" src="<?php echo URL_ROOT; ?>/public/images/get_help.jpeg" alt="Card image cap">
            <h5 class="card-title mt-2 mb-0">Get Help: Ask PLMikanovci</h5>
        </div>
    </div>
    <div class="card w-100 mb-2">
        <div class="card-body">
            <img class="card-img" src="<?php echo URL_ROOT; ?>/public/images/online_classes.jpeg" alt="Card image cap">
            <h5 class="card-title mt-2 mb-0">Online classes & Events</h5>
        </div>
    </div>
    <div class="card w-100 mb-2">
        <div class="card-body">
            <img class="card-img" src="<?php echo URL_ROOT; ?>/public/images/e_books.jpeg" alt="Card image cap">
            <h5 class="card-title mt-2 mb-0">E-Books & More</h5>
        </div>
    </div>
    <div class="card w-100 mb-2">
        <div class="card-body">
            <img class="card-img" src="<?php echo URL_ROOT; ?>/public/images/remote.png" alt="Card image cap">
            <h5 class="card-title mt-2 mb-0">Remote Learning Support for Kids, Teens</h5>
        </div>
    </div>
    <div class="card w-100 mb-2">
        <div class="card-body">
            <img class="card-img" src="<?php echo URL_ROOT; ?>/public/images/newspapers.jpeg" alt="Card image cap">
            <h5 class="card-title mt-2 mb-0">Newspapers, Magazines & Databases</h5>
        </div>
    </div>
</div>
<?php require APP_ROOT . '/views/inc/footer.php' ?>