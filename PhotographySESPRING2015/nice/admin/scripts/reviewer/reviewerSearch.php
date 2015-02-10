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

	// pagination calc
	$offset = ($page - 1) * $perPage;

	// get total
	$count = framework::getOne("
	SELECT
		COUNT(*) as count
	FROM users AS u

	JOIN reviewers AS r
	ON (
		r.user_id = u.user_id
	)

	". (($registrationPeriodId == 0) ? "LEFT " : "") ."JOIN session AS s
	ON (
		". ((!empty($registrationPeriodId)) ? "s.registration_period_id = '". $registrationPeriodId ."' AND " : "") ."
		s.reviewer_id = r.reviewer_id
	)

	WHERE
		first_name LIKE '%". $search ."%'
		OR
		last_name LIKE '%". $search ."%'
	");

	$ret["total"] = $count["count"];

	// pull data
	$reviewers = framework::getMany("
	SELECT
		r.reviewer_id,
		u.first_name,
		u.last_name,
		u.email_address,
		rp.year,
		rp.registration_period_id,
		s.table_num,
		r.friday_morning,
		r.friday_midday,
		r.friday_afternoon,
		r.saturday_morning,
		r.saturday_midday,
		r.saturday_afternoon
	FROM users AS u

	JOIN reviewers AS r
	ON (
		r.user_id = u.user_id
	)

	". (($registrationPeriodId == 0) ? "LEFT " : "") ."JOIN session AS s
	ON (
		". ((!empty($registrationPeriodId)) ? "s.registration_period_id = '". $registrationPeriodId ."' AND " : "") ."
		r.reviewer_id = s.reviewer_id
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

	$ret["data"] = $reviewers;

	echo json_encode($ret);

?>