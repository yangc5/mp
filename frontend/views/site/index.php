<?php
/* @var $this yii\web\View */
$this->title = 'Meeting Planner';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Yii::t('frontend','Coming Soon') ?></h1>

        <p class="lead"><?= Yii::t('frontend','A new app to make scheduling as simple as it should be.') ?></p>

        <p><a class="btn btn-lg btn-success" href="/site/about"><?= Yii::t('frontend','Learn More') ?></a></p>
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

                <p><a class="btn btn-default" href="http://code.tutsplus.com/tutorials/building-your-startup-with-php-geolocation-and-google-places--cms-22729"><?= Yii::t('frontend','Episode 3') ?> &raquo;</a></p>
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
                <h2><?= Yii::t('frontend','Access Controls &amp; Polish') ?> </h2>

                <p><?= Yii::t('frontend','We circle back to polish some of what we\'ve built to date leveraging more of the Yii Framework.') ?> </p>

                <p><a class="btn btn-default" href="#"><?= Yii::t('frontend','Episode 5 (coming soon)') ?> &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2><?= Yii::t('frontend','TBD') ?></h2>

                <p><?= Yii::t('frontend','To be decided.') ?> </p>

                <p><a class="btn btn-default" href="#"><?= Yii::t('frontend','Episode 6 (tbd)') ?> &raquo;</a></p>
            </div>
        </div>

    </div>
	<!--- end row two --->

</div>
