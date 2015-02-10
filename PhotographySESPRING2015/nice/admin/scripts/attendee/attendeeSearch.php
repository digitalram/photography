<?php

	require_once "../../../bootstrap.php";

	// basics
	$ret = array();
	$request = framework::getRequestVars();

	// params
	$search = framework::clean($request["search"]);
	$page = framework::clean($request["page"]);
	$perPage = framework::clean($request["perPage"]);
	$registrationPeriodId = framework::clean($request["registrationPeriodId"]);

	// fixme: hackish fix
	if($registrationPeriodId == 0) {
		$registrationPeriodId = "";
	}

	// pagination calc
	$offset = ($page - 1) * $perPage;

	// get total
	$count = framework::getOne("
	SELECT
		COUNT(*) as count
	FROM users AS u

	JOIN attendees AS a
	ON (
		a.user_id = u.user_id
	)

	". (($registrationPeriodId == 0) ? "LEFT " : "") ."JOIN session AS s
	ON (
		". ((!empty($registrationPeriodId)) ? "s.registration_period_id = '". $registrationPeriodId ."' AND " : "") ."
		(
			attendee_id1 = a.attendee_id
			OR
			attendee_id2 = a.attendee_id
			OR
			attendee_id3 = a.attendee_id
			OR
			attendee_id4 = a.attendee_id
			OR
			attendee_id5 = a.attendee_id
			OR
			attendee_id6 = a.attendee_id
		)
	)

	". (($registrationPeriodId == 0) ? "LEFT " : "") ."JOIN reviewers AS r
	ON (
		r.reviewer_id = s.reviewer_id
	)

	". (($registrationPeriodId == 0) ? "LEFT " : "") ."JOIN `users` AS ru
	ON (
		ru.user_id = r.user_id
	)

	". (($registrationPeriodId == 0) ? "LEFT " : "") ."JOIN registration_periods AS rp
	ON (
		rp.registration_period_id = s.registration_period_id
	)

	WHERE
		u.first_name LIKE '%". $search ."%'
		OR
		u.last_name LIKE '%". $search ."%'
	");



	$ret["total"] = $count["count"];

	// pull data
	$attendees = framework::getMany("
	SELECT
		a.attendee_id,
		u.first_name,
		u.last_name,
		u.email_address,
		a.attendee_type,
		rp.year,
		rp.registration_period_id,
		s.table_num,
		CONCAT(ru.first_name, ' ', ru.last_name) AS reviewer
	FROM users AS u

	JOIN attendees AS a
	ON (
		a.user_id = u.user_id
	)

	". (($registrationPeriodId == 0) ? "LEFT " : "") ."JOIN session AS s
	ON (
		". ((!empty($registrationPeriodId)) ? "s.registration_period_id = '". $registrationPeriodId ."' AND " : "") ."
		(
			attendee_id1 = a.attendee_id
			OR
			attendee_id2 = a.attendee_id
			OR
			attendee_id3 = a.attendee_id
			OR
			attendee_id4 = a.attendee_id
			OR
			attendee_id5 = a.attendee_id
			OR
			attendee_id6 = a.attendee_id
		)
	)

	". (($registrationPeriodId == 0) ? "LEFT " : "") ."JOIN reviewers AS r
	ON (
		r.reviewer_id = s.reviewer_id
	)

	". (($registrationPeriodId == 0) ? "LEFT " : "") ."JOIN `users` AS ru
	ON (
		ru.user_id = r.user_id
	)

	". (($registrationPeriodId == 0) ? "LEFT " : "") ."JOIN registration_periods AS rp
	ON (
		rp.registration_period_id = s.registration_period_id
	)

	WHERE
		u.first_name LIKE '%". $search ."%'
		OR
		u.last_name LIKE '%". $search ."%'

	LIMIT ". $offset .", ". $perPage ."
	");

	$ret["data"] = $attendees;

	echo json_encode($ret);


?>