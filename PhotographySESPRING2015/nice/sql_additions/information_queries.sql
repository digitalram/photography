-- These are misc. queries to report on the status of the system

-- Attendee keywords
SELECT
	CONCAT(users.first_name,' ',users.last_name) AS user,
	attendees.attendee_type AS type,
	keyword_definition.name as keyword
FROM
	users
	JOIN attendees ON users.user_id = attendees.user_id
	JOIN keyword ON attendees.attendee_id = keyword.attendee_id
	JOIN keyword_definition ON keyword.keyword_definition_id = keyword_definition.keyword_definition_id
ORDER BY
	type DESC,
	user,
	keyword;
	
-- Reviewer keywords
SELECT
	CONCAT(users.first_name,' ',users.last_name) AS user,
	reviewers.reviewer_type AS type,
	keyword_definition.name as keyword
FROM
	users
	JOIN reviewers ON users.user_id = reviewers.user_id
	JOIN keyword ON reviewers.reviewer_id = keyword.reviewer_id
	JOIN keyword_definition ON keyword.keyword_definition_id = keyword_definition.keyword_definition_id
ORDER BY
	type ASC,
	user,
	keyword;

-- Attendee opportunities
SELECT
	CONCAT(users.first_name,' ',users.last_name) AS user,
	attendees.attendee_type AS type,
	opportunity_definition.name as opportunity
FROM
	users
	JOIN attendees ON users.user_id = attendees.user_id
	JOIN opportunity ON attendees.attendee_id = opportunity.attendee_id
	JOIN opportunity_definition ON opportunity.opportunity_definition_id = opportunity_definition.opportunity_definition_id
ORDER BY
	type DESC,
	user,
	opportunity;
	
-- Reviewer opportunities
SELECT
	CONCAT(users.first_name,' ',users.last_name) AS user,
	reviewers.reviewer_type AS type,
	opportunity_definition.name as opportunity
FROM
	users
	JOIN reviewers ON users.user_id = reviewers.user_id
	JOIN opportunity ON reviewers.reviewer_id = opportunity.reviewer_id
	JOIN opportunity_definition ON opportunity.opportunity_definition_id = opportunity_definition.opportunity_definition_id
ORDER BY
	type ASC,
	user,
	opportunity;