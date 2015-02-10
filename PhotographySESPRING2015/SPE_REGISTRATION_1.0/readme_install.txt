______________________________________________________________________________________________
SPE Registration BY Lee Jones, Zachary Walters, Nicole Tomac, Henry Simington, Awa Sisay, 
	Xin Yang, Greg Bradley, Nick Buckman, Cassie Roberts

CSCI 4700-01, Software Engineering
______________________________________________________________________________________________

Server Installation:
	-Copy all files to the server
	-Run "_CREATESTATEMENTS.sql" to create your database (found in directory "databaseFiles")
	-Edit "config.php" to have the appropriate connection string for your database
	-Ensure that Apache has appropriate privileges to write to the "outputFiles" directory
______________________________________________________________________________________________
Note:
	This website was developed using the following technologies:
	-PHP 5.4.4-14+deb7u7 (cli)
	-Apache/2.2.22(Debian)
	-MySQL Server version: 5.5.35-0+wheezy1
	-MySQL client version: 5.5.35
		using: PHP extension: mysqli
	-phpMyAdmin 3.4.11.1deb2
______________________________________________________________________________________________
Pages:
	"login.php" - this is the access point for administrators and reviewers 
		Default administrator login is User name: "Admin" password: "photo1"
		to access as a reviewer register a new user.
	"attendee.php" - this is the access point for attendees (students and professionals)
		no login required.
______________________________________________________________________________________________
