<?php
/* @var $this yii\web\View */
$this->title = 'Meeting Planner';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Yii::t('frontend','Coming Soon') ?></h1>

        <p class="lead"><?= Yii::t('frontend','A new app to make scheduling as simple as it should be.') ?> </p>        
        <p class="lead">
          <?= Yii::t('frontend','Built step by step in a ') ?>
          <strong><a href="https://code.tutsplus.com/tutorials/building-your-startup-with-php-table-of-contents--cms-23316"><?= Yii::t('frontend','Tuts+ Tutorial Series') ?></a></strong>
          </p>

        <p><a class="btn btn-lg btn-success" href="./site/about"><?= Yii::t('frontend','Learn More') ?></a></p>
    </div>

    <div class="body-content">
		<!--- begin row one --->

        <div class="row">
            <div class="col-lg-4">
                <h2><?= Yii::t('frontend','Getting Started') ?></h2>

                <p><?= Yii::t('frontend','Follow along with our tutorial series at Tuts+ as we build Meeting Planner step by step. In this episode we talk about startups in general and the goals for our application.') ?></p>

                <p><a class="btn btn-default" href="http://code.tutsplus.com/tutorials/building-your-startup-with-php-getting-started--cms-21948"><?= Yii::t('frontend','Episode 1') ?> &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2><?= Yii::t('frontend','Feature Requirements') ?> </h2>

                <p><?= Yii::t('frontend','In Episode 2, we scope out the features that we\'ll need for a minimum viable product and the database schema that will support it.') ?> </p>

                <p><a class="btn btn-default" href="http://code.tutsplus.com/tutorials/building-your-startup-with-php-feature-requirements-and-database-design--cms-22618"><?= Yii::t('frontend','Episode 2') ?> &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2><?= Yii::t('frontend','Building Places') ?></h2>

                <p><?= Yii::t('frontend','In Episode 3, we build code to enable meeting places, integrating with HTML 5 Geolocation, Google Maps and Google Places.') ?> </p>

                <p><a class="btn btn-default" href="https://code.tutsplus.com/tutorials/building-your-startup-with-php-geolocation-and-google-places--cms-22729"><?= Yii::t('frontend','Episode 3') ?> &raquo;</a></p>
            </div>
        </div>

    </div>
		<!--- end row one --->

		<!--- begin row two --->
        <div class="row">
            <div class="col-lg-4">
                <h2><?= Yii::t('frontend','Localization with I18n') ?></h2>

                <p><?= Yii::t('frontend','Using Yii\'s built in localization capability we create the infrastructure for multiple languages') ?></p>

                <p><a class="btn btn-default" href="http://code.tutsplus.com/tutorials/building-your-startup-with-php-localization-with-i18n--cms-23102"><?= Yii::t('frontend','Episode 4 (coming soon)' ) ?> &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2><?= Yii::t('frontend','Access Controls, Ownership &amp; Polish') ?> </h2>

                <p><?= Yii::t('frontend','We circle back to polish some of what we\'ve built to date leveraging more of the Yii Framework.') ?> </p>

                <p><a class="btn btn-default" href="http://code.tutsplus.com/tutorials/building-your-startup-access-control-active-record-relations-and-slugs--cms-23109"><?= Yii::t('frontend','Episode 5 (coming soon)') ?> &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2><?= Yii::t('frontend','User Settings, Profile Images &amp; Contact Details') ?></h2>

                <p><?= Yii::t('frontend','Building support for infrastructure to support users.') ?> </p>

                <p><a class="btn btn-default" href="http://code.tutsplus.com/tutorials/building-your-startup-with-php-user-settings-profile-images-and-contact-details--cms-23196"><?= Yii::t('frontend','Episode 6 (coming soon)') ?> &raquo;</a></p>
            </div>
        </div>

    </div>
	<!--- end row two --->
		<!--- begin row three --->
        <div class="row">
            <div class="col-lg-4">
                <h2><?= Yii::t('frontend','Scheduling Meetings') ?></h2>

                <p><?= Yii::t('frontend','Beginning to build the schedule meeting functionality.') ?></p>

                <p><a class="btn btn-default" href="http://code.tutsplus.com/tutorials/building-your-startup-with-php-scheduling-a-meeting--cms-23252"><?= Yii::t('frontend','Episode 7 (coming soon)' ) ?> &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2><?= Yii::t('frontend','Scheduling Availability &amp; Choices') ?> </h2>

                <p><?= Yii::t('frontend','Building AJAX to simplify meeting availability and selections.') ?> </p>

                <p><a class="btn btn-default" href="http://code.tutsplus.com/tutorials/building-your-startup-with-php-scheduling-availability-and-choices--cms-23268"><?= Yii::t('frontend','Episode 8 (coming soon)') ?> &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2><?= Yii::t('frontend','Delivering the Meeting Announcement') ?></h2>

                <p><?= Yii::t('frontend','Building the support required to send a meeting request and handle responses from the participant.') ?> </p>

                <p><a class="btn btn-default" href="http://code.tutsplus.com/tutorials/building-your-startup-delivering-the-meeting-announcement--cms-23428"><?= Yii::t('frontend','Episode 9 (coming soon)') ?> &raquo;</a></p>
            </div>
        </div>

    </div>
	<!--- end row three --->	
</div>
