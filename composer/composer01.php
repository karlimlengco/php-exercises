<?php

/**
 * Copyright 2017 REVLV Solutions Inc
 * Licensed under the GNU GPLv3
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 */
require_once('../../utils/index.php');
require_once('../../vendor/autoload.php');

/**
 * Your software lead decided that you need to use environment variables
 * show them who's boss now
 *
 * Repository:
 * https://github.com/vlucas/phpdotenv
 */


/**
 * Perform tests here, don't change anything here beyond this point.
 */
a($_ENV['S3_BUCKET_SECRET'], 'm918239xkdas12301293559');
a($_ENV['GITHUB_API_SECRET'], 's4lm0n$t34k!5D0p3');
