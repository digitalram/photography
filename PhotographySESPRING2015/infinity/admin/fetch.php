<?php
include('db.php');
$con = @mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
@mysql_select_db(DB_NAME) or die(mysql_error());




	for ($i = 1; $i <= 20; $i++) 
	{
	    $result = mysql_query("SELECT *
		FROM attendees
		ORDER BY RAND();");

						
		while ($row = mysql_fetch_assoc($result)) 
		{
				$Choice1 = array($row["Choice_".$i."_Last"], $row["Choice_".$i."_First"]);				

			$choice = "
			SELECT *
			FROM reviewers
			WHERE Last_Name = '$Choice1[0]' AND First_Name = '$Choice1[1]'";

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
									`session`.S_id = 'F1' AND
									(
										`session`.Time_1 = $row[Id] OR
										`session`.Time_2 = $row[Id] OR
										`session`.Time_3 = $row[Id] OR
										`session`.Time_4 = $row[Id] OR
										`session`.Time_5 = $row[Id] OR
										`session`.Time_6 = $row[Id]
									)

									";

						$attres = mysql_query($attqry) or die (mysql_error());

						while ($sressults = mysql_fetch_assoc($attres)) 
						{


							if ($sressults["T1"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND  Time_1 IS NULL AND S_id LIKE '$row[Day]_'";

								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
								
							}

							if ($sressults["T2"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND Time_2 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T3"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND Time_3 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T4"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND Time_4 IS NULL AND AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T5"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND Time_5 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T6"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F1' AND Time_6 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}
						}


					} 
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
									`session`.S_id = 'F2' AND
									(
										`session`.Time_1 = $row[Id] OR
										`session`.Time_2 = $row[Id] OR
										`session`.Time_3 = $row[Id] OR
										`session`.Time_4 = $row[Id] OR
										`session`.Time_5 = $row[Id] OR
										`session`.Time_6 = $row[Id]
									)


									";

						$attres = mysql_query($attqry) or die (mysql_error());


						while ($sressults = mysql_fetch_assoc($attres)) 
						{

							if ($sressults["T1"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND  Time_1 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
								
							}

							if ($sressults["T2"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND Time_2 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
								
							}

							if ($sressults["T3"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND Time_3 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T4"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND Time_4 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T5"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND Time_5 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T6"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F2' AND Time_6 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}
						}



					} 
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
									`session`.S_id = 'F3' AND
									(
										`session`.Time_1 = $row[Id] OR
										`session`.Time_2 = $row[Id] OR
										`session`.Time_3 = $row[Id] OR
										`session`.Time_4 = $row[Id] OR
										`session`.Time_5 = $row[Id] OR
										`session`.Time_6 = $row[Id]
									)

									";

						$attres = mysql_query($attqry) or die (mysql_error());

						$foundFlag = false;

						while ($sressults = mysql_fetch_assoc($attres)) 
						{

							if ($sressults["T1"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND  Time_1 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
								
							}

							if ($sressults["T2"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND Time_2 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
								
							}

							if ($sressults["T3"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND Time_3 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T4"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND Time_4 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T5"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND Time_5 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T6"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'F3' AND Time_6 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}
						}


					} 
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
									`session`.S_id = 'S1' AND
									(
										`session`.Time_1 = $row[Id] OR
										`session`.Time_2 = $row[Id] OR
										`session`.Time_3 = $row[Id] OR
										`session`.Time_4 = $row[Id] OR
										`session`.Time_5 = $row[Id] OR
										`session`.Time_6 = $row[Id]
									)
									";

						$attres = mysql_query($attqry) or die (mysql_error());


						while ($sressults = mysql_fetch_assoc($attres)) 
						{

							if ($sressults["T1"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND  Time_1 IS NULL  AND S_id LIKE '$row[Day]_' ";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
								
							}

							if ($sressults["T2"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND Time_2 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
								
							}

							if ($sressults["T3"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND Time_3 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T4"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND Time_4 IS NULL S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T5"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND Time_5 IS NULL S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T6"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S1' AND Time_6 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}
						}
						




					} 
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
									`session`.S_id = 'S2' AND
									(
										`session`.Time_1 = $row[Id] OR
										`session`.Time_2 = $row[Id] OR
										`session`.Time_3 = $row[Id] OR
										`session`.Time_4 = $row[Id] OR
										`session`.Time_5 = $row[Id] OR
										`session`.Time_6 = $row[Id]
									)
									";

						$attres = mysql_query($attqry) or die (mysql_error());


						while ($sressults = mysql_fetch_assoc($attres)) 
						{

							if ($sressults["T1"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND  Time_1 IS NULL  AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
								
							}

							if ($sressults["T2"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND Time_2 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
								
							}

							if ($sressults["T3"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND Time_3 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T4"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND Time_4 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T5"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND Time_5 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T6"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S2' AND Time_6 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}
						}



					} // end while sessionresults
				}

				else
				{
					
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
									`session`.S_id = 'S3' AND
									(
										`session`.Time_1 = $row[Id] OR
										`session`.Time_2 = $row[Id] OR
										`session`.Time_3 = $row[Id] OR
										`session`.Time_4 = $row[Id] OR
										`session`.Time_5 = $row[Id] OR
										`session`.Time_6 = $row[Id]
									)
									";

						$attres = mysql_query($attqry) or die (mysql_error());


						while ($sressults = mysql_fetch_assoc($attres)) 
						{

							if ($sressults["T1"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_1 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND  Time_1 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
								
							}

							if ($sressults["T2"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_2 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND Time_2 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
								
							}

							if ($sressults["T3"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_3 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND Time_3 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T4"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_4 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND Time_4 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T5"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_5 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND Time_5 IS NULL AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}

							if ($sressults["T6"] === NULL)
							{
								$insert = "UPDATE `session` SET Time_6 = $row[Id] WHERE Rev_id = $sessionresults[Rev_id]  AND S_id = 'S3' AND Time_6 IS NULL AND AND S_id LIKE '$row[Day]_'";
								mysql_query($insert);
								if (mysql_affected_rows())
								break 2;
							}
						}


						

					} 
				}



			}
		}
			



	}


			
	


?>
