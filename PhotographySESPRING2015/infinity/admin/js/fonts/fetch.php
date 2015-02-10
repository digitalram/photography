<?php
include('config/db.php');
$con = @mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
@mysql_select_db(DB_NAME) or die(mysql_error());

$result = mysql_query("SELECT *
FROM attendees
ORDER BY RAND();");



if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}


//fetch attendee and choices
while ($row = mysql_fetch_assoc($result)) 
{


		// go through each choice
		for ($i = 1; $i <= 20; $i++) 
		{
		    	
				$Choice1 = array($row["Choice_".$i."_Last"], $row["Choice_".$i."_First"]);
					
				echo $row['Day']."<br>";
				$choice = "
				SELECT *
				FROM reviewers
				WHERE reviewers.Last_Name LIKE '$Choice1[0]'";

				$sql_res = mysql_query($choice) or die (mysql_error());

				while ($revChoice = mysql_fetch_assoc($sql_res)) 
				{


					if ($revChoice['F1_id'] == 'x')
					{

						$revquery = "SELECT * 
						FROM `session`
						WHERE Rev_id = $revChoice[Id] AND S_id = 'F1'";

						$revresults = mysql_query($revquery) or die (mysql_error());

						while ($sessionresults = mysql_fetch_assoc($revresults)) 
						{

							$attqry = "
										SELECT
										Max(`session`.Time_1) AS T1,
										Max(`session`.Time_2) AS T2,
										Max(`session`.Time_3) AS T3,
										Max(`session`.Time_4) AS T4,
										Max(`session`.Time_5) AS T5,
										Max(`session`.Time_6) AS T6
										FROM `session`
										WHERE
										`session`.Time_1 = $row[Id] OR
										`session`.Time_2 = $row[Id] OR
										`session`.Time_3 = $row[Id] OR
										`session`.Time_4 = $row[Id] OR
										`session`.Time_5 = $row[Id] OR
										`session`.Time_6 = $row[Id]


										";

							$attres = mysql_query($attqry) or die (mysql_error());

							while ($sressults = mysql_fetch_assoc($attres)) 
							{


								if ($sressults["T1"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND S_id LIKE 'F_' AND  Time_1 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
									
								}

								if ($sressults["T2"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND S_id LIKE 'F_' AND Time_2 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T3"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND S_id LIKE 'F_' AND Time_3 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T4"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND S_id LIKE 'F_' AND Time_4 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T5"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND S_id LIKE 'F_' AND Time_5 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T6"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND S_id LIKE 'F_' AND Time_6 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}
							}


						} // end while sessionresults
					}



					if ($revChoice['F2_id'] == 'x')
					{

						$revquery = "SELECT * 
						FROM `session`
						WHERE Rev_id = $revChoice[Id] AND S_Id = 'F2'";

						$revresults = mysql_query($revquery) or die (mysql_error());

						while ($sessionresults = mysql_fetch_assoc($revresults)) 
						{

							$attqry = "
										SELECT
										Max(`session`.Time_1) AS T1,
										Max(`session`.Time_2) AS T2,
										Max(`session`.Time_3) AS T3,
										Max(`session`.Time_4) AS T4,
										Max(`session`.Time_5) AS T5,
										Max(`session`.Time_6) AS T6
										FROM `session`
										WHERE
										`session`.Time_1 = $row[Id] OR
										`session`.Time_2 = $row[Id] OR
										`session`.Time_3 = $row[Id] OR
										`session`.Time_4 = $row[Id] OR
										`session`.Time_5 = $row[Id] OR
										`session`.Time_6 = $row[Id]


										";

							$attres = mysql_query($attqry) or die (mysql_error());


							while ($sressults = mysql_fetch_assoc($attres)) 
							{

								if ($sressults["T1"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND S_id LIKE 'F_' AND  Time_1 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
									
								}

								if ($sressults["T2"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND S_id LIKE 'F_' AND Time_2 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
									
								}

								if ($sressults["T3"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND S_id LIKE 'F_' AND Time_3 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T4"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND S_id LIKE 'F_' AND Time_4 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T5"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND S_id LIKE 'F_' AND Time_5 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T6"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND S_id LIKE 'F_' AND Time_6 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}
							}



						} // end while sessionresults
					}


					if ($revChoice['F3_id'] == 'x')
					{
						// get session slots
						$revquery = "SELECT * 
						FROM `session`
						WHERE Rev_id = $revChoice[Id] AND S_id = 'F3'";

						$revresults = mysql_query($revquery) or die (mysql_error());

						while ($sessionresults = mysql_fetch_assoc($revresults)) 
						{


							$attqry = "
										SELECT
										Max(`session`.Time_1) AS T1,
										Max(`session`.Time_2) AS T2,
										Max(`session`.Time_3) AS T3,
										Max(`session`.Time_4) AS T4,
										Max(`session`.Time_5) AS T5,
										Max(`session`.Time_6) AS T6
										FROM `session`
										WHERE
										`session`.Time_1 = $row[Id] OR
										`session`.Time_2 = $row[Id] OR
										`session`.Time_3 = $row[Id] OR
										`session`.Time_4 = $row[Id] OR
										`session`.Time_5 = $row[Id] OR
										`session`.Time_6 = $row[Id]


										";

							$attres = mysql_query($attqry) or die (mysql_error());

							$foundFlag = false;

							while ($sressults = mysql_fetch_assoc($attres)) 
							{

								if ($sressults["T1"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND S_id LIKE 'F_' AND  Time_1 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
									
								}

								if ($sressults["T2"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND S_id LIKE 'F_' AND Time_2 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
									
								}

								if ($sressults["T3"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND S_id LIKE 'F_' AND Time_3 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T4"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND S_id LIKE 'F_' AND Time_4 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T5"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND S_id LIKE 'F_' AND Time_5 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T6"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND S_id LIKE 'F_' AND Time_6 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}
							}


						} // end while sessionresults
					}


					if ($revChoice['S1_id'] == 'x')
					{
						// get session slots
						$revquery = "SELECT * 
						FROM `session`
						WHERE Rev_id = $revChoice[Id] AND S_id = 'S1'";

						$revresults = mysql_query($revquery) or die (mysql_error());

						while ($sessionresults = mysql_fetch_assoc($revresults)) 
						{


							$attqry = "
										SELECT
										Max(`session`.Time_1) AS T1,
										Max(`session`.Time_2) AS T2,
										Max(`session`.Time_3) AS T3,
										Max(`session`.Time_4) AS T4,
										Max(`session`.Time_5) AS T5,
										Max(`session`.Time_6) AS T6
										FROM `session`
										WHERE
										`session`.Time_1 = $row[Id] OR
										`session`.Time_2 = $row[Id] OR
										`session`.Time_3 = $row[Id] OR
										`session`.Time_4 = $row[Id] OR
										`session`.Time_5 = $row[Id] OR
										`session`.Time_6 = $row[Id]

										";

							$attres = mysql_query($attqry) or die (mysql_error());


							while ($sressults = mysql_fetch_assoc($attres)) 
							{

								if ($sressults["T1"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND S_id LIKE 'S_' AND  Time_1 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
									
								}

								if ($sressults["T2"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND S_id LIKE 'S_'  AND Time_2 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
									
								}

								if ($sressults["T3"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND S_id LIKE 'S_'  AND Time_3 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T4"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND S_id LIKE 'S_'  AND Time_4 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T5"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND S_id LIKE 'S_'  AND Time_5 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T6"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND S_id LIKE 'S_'  AND Time_6 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}
							}
							




						} // end while sessionresults
					}


					if ($revChoice['S2_id'] == 'x')
					{
						// get session slots
						$revquery = "SELECT * 
						FROM `session`
						WHERE Rev_id = $revChoice[Id] AND S_id = 'S2'";

						$revresults = mysql_query($revquery) or die (mysql_error());

						while ($sessionresults = mysql_fetch_assoc($revresults)) 
						{


							$attqry = "
										SELECT
										Max(`session`.Time_1) AS T1,
										Max(`session`.Time_2) AS T2,
										Max(`session`.Time_3) AS T3,
										Max(`session`.Time_4) AS T4,
										Max(`session`.Time_5) AS T5,
										Max(`session`.Time_6) AS T6
										FROM `session`
										WHERE
										`session`.Time_1 = $row[Id] OR
										`session`.Time_2 = $row[Id] OR
										`session`.Time_3 = $row[Id] OR
										`session`.Time_4 = $row[Id] OR
										`session`.Time_5 = $row[Id] OR
										`session`.Time_6 = $row[Id]


										";

							$attres = mysql_query($attqry) or die (mysql_error());


							while ($sressults = mysql_fetch_assoc($attres)) 
							{

								if ($sressults["T1"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND S_id LIKE 'S_'  AND  Time_1 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
									
								}

								if ($sressults["T2"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND S_id LIKE 'S_'  AND Time_2 IS NULL AND Time_1 <> $row[Id] AND Time_2 <> $row[Id] AND Time_3 <> $row[Id]  AND Time_4 <> $row[Id]
										AND Time_5 <> $row[Id] AND Time_6 <> $row[Id]";
									mysql_query($insert);
									break;
									
								}

								if ($sressults["T3"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND S_id LIKE 'S_'  AND Time_3 IS NULL AND Time_1 <> $row[Id] AND Time_2 <> $row[Id] AND Time_3 <> $row[Id]  AND Time_4 <> $row[Id]
										AND Time_5 <> $row[Id] AND Time_6 <> $row[Id]";
									mysql_query($insert);
									break;
								}

								if ($sressults["T4"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND S_id LIKE 'S_'  AND Time_4 IS NULL AND Time_1 <> $row[Id] AND Time_2 <> $row[Id] AND Time_3 <> $row[Id]  AND Time_4 <> $row[Id]
										AND Time_5 <> $row[Id] AND Time_6 <> $row[Id]";
									mysql_query($insert);
									break;
								}

								if ($sressults["T5"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND S_id LIKE 'S_'  AND Time_5 IS NULL AND Time_1 <> $row[Id] AND Time_2 <> $row[Id] AND Time_3 <> $row[Id]  AND Time_4 <> $row[Id]
										AND Time_5 <> $row[Id] AND Time_6 <> $row[Id]";
									mysql_query($insert);
									break;
								}

								if ($sressults["T6"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND S_id LIKE 'S_'  AND Time_6 IS NULL AND Time_1 <> $row[Id] AND Time_2 <> $row[Id] AND Time_3 <> $row[Id]  AND Time_4 <> $row[Id]
										AND Time_5 <> $row[Id] AND Time_6 <> $row[Id]";
									mysql_query($insert);
									break;
								}
							}



						} // end while sessionresults
					}


					if ($revChoice['S3_id'] == 'x')
					{
											// get session slots
						$revquery = "SELECT * 
						FROM `session`
						WHERE Rev_id = $revChoice[Id]";

						$revresults = mysql_query($revquery) or die (mysql_error());

						while ($sessionresults = mysql_fetch_assoc($revresults)) 
						{

							$attqry = "
										SELECT
										Max(`session`.Time_1) AS T1,
										Max(`session`.Time_2) AS T2,
										Max(`session`.Time_3) AS T3,
										Max(`session`.Time_4) AS T4,
										Max(`session`.Time_5) AS T5,
										Max(`session`.Time_6) AS T6
										FROM `session`
										WHERE
										`session`.Time_1 = $row[Id] OR
										`session`.Time_2 = $row[Id] OR
										`session`.Time_3 = $row[Id] OR
										`session`.Time_4 = $row[Id] OR
										`session`.Time_5 = $row[Id] OR
										`session`.Time_6 = $row[Id]


										";

							$attres = mysql_query($attqry) or die (mysql_error());


							while ($sressults = mysql_fetch_assoc($attres)) 
							{

								if ($sressults["T1"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND S_id LIKE 'S_'  AND  Time_1 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
									
								}

								if ($sressults["T2"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND S_id LIKE 'S_'  AND Time_2 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
									
								}

								if ($sressults["T3"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND S_id LIKE 'S_'  AND Time_3 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T4"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND S_id LIKE 'S_'  AND Time_4 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T5"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND S_id LIKE 'S_'  AND Time_5 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}

								if ($sressults["T6"] === NULL)
								{
									$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND S_id LIKE 'S_'  AND Time_6 IS NULL OR $row[Id] NOT IN (Time_1, Time_2, Time_3, Time_4, Time_5, Time_6)";
									mysql_query($insert);
									break;
								}
							}


							

						} 
					}
					


				}



		}// end foor loop


			
	
}

?>
