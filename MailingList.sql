DROP DATABASE IF EXISTS mailingList;

CREATE DATABASE mailingList;

USE mailingList;

CREATE TABLE contacts
(
   UMID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   LastName varchar(30),
   FirstName varchar(30),
   Email varchar(64),
   Phone varchar(13),
   ProjectTitle varchar(60),
   TimeSlot varchar(160)
);
CREATE TABLE timeslot
(
   dateofslot varchar(30),
   starttime varchar(30),
   endtime varchar(64),
   availableslots varchar(13)
);

insert into timeslot values('04/19/2023','5.00pm','6.00pm','6');
insert into timeslot values('04/19/2023','6.00pm','7.00pm','6');
insert into timeslot values('04/19/2023','7.00pm','8.00pm','6');
insert into timeslot values('04/20/2023','5.00pm','6.00pm','6');
insert into timeslot values('04/20/2023','6.00pm','7.00pm','6');
insert into timeslot values('04/20/2023','7.00pm','8.00pm','6');




