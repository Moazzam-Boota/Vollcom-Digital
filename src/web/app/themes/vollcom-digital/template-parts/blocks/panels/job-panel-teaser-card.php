<?php
/**
 * Job Post type Carddeck Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

/**
 *  Loop through post objects (assuming this is a multi-select field) ( don't setup postdata )
 *  Using this method, the $post object is never changed so all functions need a seccond parameter of the post ID in question.
 */
?>


<?php

the_content();
// Print job postings
$hostname = 'vollcom-digital';
$lang = wpml_get_current_language(); // Depending on implementation of multilingual content
//$positions = simplexml_load_file('https://' . $hostname . '.jobs.personio.de/xml?language=' . $lang);
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://' . $hostname . '.jobs.personio.de/xml?language=' . $lang,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET'
));

$response = curl_exec($curl);
$positions = simplexml_load_string($response);
curl_close($curl);
?>
<?php
$index = 0;
$idsToShow = [];
foreach ($positions as $key=>$position) {

    ?>


    <!--Job Panel Card-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <?php if ($index <= 7) {
        $status = "display: block;";

    } ?>
    <?php if ($index <= 7) {
        array_push($idsToShow, 'count-' . $index);

    } ?>
    <?php if ($index > 7) {
        $status = "display: none;";

    } ?>

    <div id="count-<?php echo $index; ?>" class="col mb-4 " style="margin-bottom: 18px !important; <?php echo $status; ?>" >
        <article>
            <div class="card border-left border-right border-bottom h-100 z-depth-0 hover-shadow border wow"
                 data-wow-delay="0.6s">
                <div id="class-job"
                     class="card-body justify-content-between align-items-stretch align-self-center">
                    <img src="http://www.vollcom-digital.com/app/uploads/2020/10/vollcom-digital-logo-cube.svg"
                         class="vollcom-cube">
                    <div class="labels">
                    <span class="Frontend-Developer-fmd">
                        <a class="Frontend-Developer-fmd" href=<?php
                        if ($lang == strval('de')) {
                            echo get_home_url() . 'new-jobs/?id=' . $position->id;

                        } else {
                            echo get_home_url() . '/new-jobs/?id=' . $position->id;

                        } ?>>
                            <?php echo $position->name; ?>
<!--                            --><?php //echo esc_html(get_the_title($post_object->ID)); ?>
                        </a>
                    </span>
                        <p class="Munich-Germany-or-remote"><?= $position->office ?>
                            , <?= $position->employmentType ?></p>
                    </div>
                    <?php if (!empty(get_permalink())): ?>
                    <?php endif; ?>
                </div>
            </div>
        </article>
    </div>

    <!--/.Job Panel Card-->
    <?php $index++; }

if ($lang == strval('de') && $index > 7) {?>
    <div onclick="myFunction()" id="myBtn" class="load-more"><span class="load-more-text">mehr laden</span><i
                style="cursor: pointer;" class="fa fa-angle-down"> </i></div>
<?php } else if ($index > 7) { ?>
    <div id="myBtn" onclick="myFunction()" class="load-more"><span class="load-more-text">load more</span><i
                style="cursor: pointer;" class="fa fa-angle-down"> </i></div>
<?php } ?>
<?php
$total = count($idsToShow) ?>
<script type="text/javascript">
    let count = <?php echo (int)$total; ?>;
    let total = 7;
    let allRecordLength = <?php echo (int)count($positions) ?>
</script>
<script type="text/javascript">
    function myFunction() {
        let tempArray = [];
        total += count;

        console.log(allRecordLength)
        for (let i = 7; i <= total; i++) {
            tempArray.push(`count-${i}`)
        }
        console.log(count, total, "test");
        if (total >= allRecordLength - 1) {
            let btn = document.getElementById('myBtn');
            btn.style.display = "none";
        }

        tempArray.map((k) => {
            console.log(k);
            var x = document.getElementById(k);
            if (x.style.display === "none") {
                x.style.display = "block";
            }
        })
    }
</script>



<style>
    .Frontend-Developer-fmd {
        width: 540px;
        height: 30px;
        margin: 4.7px 0 0.2px 0px;
        font-family: Roboto;
        font-size: 18px;
        font-weight: bold;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.33;
        letter-spacing: normal;
        text-align: left;
        color: #181347;
    }

    #class-job {
        margin-left: -12rem;
    }

    .load-more-text {
        width: 72px;
        height: 21px;
        margin: 0 10px 0 0;
        font-family: Roboto;
        font-size: 16px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.88;
        letter-spacing: normal;
        text-align: center;
        color: #07a8c4;
        cursor: pointer;
    }


    .fa-angle-down:before {
        content: "\f107";
        color: darkturquoise;
    }

    .load-more {
        width: 94px;
        height: 21px;
        margin: 25px 0px 0px -45%;
        text-align: right;
    }

    .Munich-Germany-or-remote {
        width: 540px;
        height: 31px;
        margin: 5.2px 0 0 0px;
        font-family: Roboto;
        font-size: 16px;
        font-weight: normal;
        font-stretch: normal;
        font-style: normal;
        line-height: 1.5;
        letter-spacing: normal;
        text-align: left;
        color: slategray;
    }

    img.vollcom-cube {
        width: 55px;
        height: 63px;
        margin: 1px 24px 0.8px 142px;
        object-fit: contain;
    }

    @media only screen and (max-width: 600px) {

        .load-more {
            margin: 0px 0px 0px -39%;
        }

        .labels {
            padding-left: 111px;
        }

        img.vollcom-cube {
            margin: 1px -59px 0.8px 4px;
        }

        .Munich-Germany-or-remote {
            width: 224px !important;
            margin: 3.2px 0 0 7px;
        }

        .Frontend-Developer-fmd {
            margin: 4.7px 0 0.2px 0px;
        }

        #class-job {
            margin-left: 2rem !important;
        }

        img.vollcom-cube {
            margin: 1px -59px 0.8px -19px !important;
        }

        .labels {
            padding-left: 0px !important;
            margin-left: 86px !important;
        }

    }
</style>