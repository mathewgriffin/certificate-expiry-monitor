<?php
// Copyright (C) 2019 Remy van Elst

// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU Affero General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU Affero General Public License for more details.

// You should have received a copy of the GNU Affero General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.

$version = 1.4;
$title = "Certificate Expiry Monitor";

$current_folder = get_current_folder();

# timeout in seconds
$timeout = 2;

date_default_timezone_set('UTC');

ini_set('default_socket_timeout', 2);

$random_blurp = rand(1000,99999);

$current_domain = $_SERVER['WEBSITE_ADDRESS'];
$current_link = $current_domain;

// set this to a location outside of your webroot so that it cannot be accessed via the internets.
$file_location = '/certificate-expiry-monitor/storage/';
$pre_check_file = "{$file_location}pre_checks.json";
$check_file = "{$file_location}checks.json";
$deleted_check_file = "{$file_location}deleted_checks.json";

?>