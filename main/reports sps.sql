DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Apr`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
   SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
           
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company 

);
set @Wknds = (SELECT
   
  sum(b.Dist)  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-04-06', '2024-04-07', '2024-04-13', '2024-04-14', '2024-04-20', '2024-04-21', '2024-04-27', '2024-04-28') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Aug`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  


);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-08-03', '2024-08-04', '2024-08-10', '2024-08-11', '2024-08-17', '2024-08-18', '2024-08-24', '2024-08-25','2024-08-31') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Branch_Apr`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company  and b.Branch = Brnch);
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  and b.Branch = Brnch ); 
set @Distance =(SELECT
 
   SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
           
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  and b.Branch = Brnch  AND a.distance > 1

);
set @Wknds = (SELECT
   
  sum(b.Dist)  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-04-06', '2024-04-07', '2024-04-13', '2024-04-14', '2024-04-20', '2024-04-21', '2024-04-27', '2024-04-28') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Branch_Aug`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company and Branch = Brnch );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  and b.Branch = Brnch ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company and b.Branch = Brnch  


);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-08-03', '2024-08-04', '2024-08-10', '2024-08-11', '2024-08-17', '2024-08-18', '2024-08-24', '2024-08-25','2024-08-31') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Branch_Dec`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company  and Branch = Brnch);
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  and b.Branch = Brnch  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  and b.Branch = Brnch


);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN  ('2024-12-01', '2024-12-07', '2024-12-08', '2024-12-14', '2024-12-15', '2024-12-21', '2024-12-22', '2024-12-28','2024-12-29') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Branch_Feb`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company and Branch = Brnch);
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company and b.Branch = Brnch ); 
set @Distance =(SELECT
 
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company and b.Branch = Brnch  AND a.distance > 1

);
set @Wknds = (SELECT
   
   FORMAT( sum(b.Distance),0,'en_US')  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and 
     Branch = Brnch 
    ) a
JOIN
    (
        SELECT
            device_id,
          distance ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-02-03', '2024-02-04', '2024-02-10', '2024-02-11', '2024-02-17', '2024-02-18', '2024-02-24', '2024-02-25')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Branch_Jan`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `BranchName` VARCHAR(100))
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company and Branch = BranchName );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company and b.Branch = BranchName  ); 
set @Distance =(SELECT
 
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company and b.Branch = BranchName  AND a.distance > 1

);
set @Wknds = (SELECT
   
   FORMAT( sum(b.Distance),0,'en_US')  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = BranchName
    ) a
JOIN
    (
        SELECT
            device_id,
          distance ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-01-06', '2024-01-07', '2024-01-13', '2024-01-14', '2024-01-20', '2024-01-21', '2024-01-27', '2024-01-28')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Branch_July`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company  and Branch = Brnch);
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  and b.Branch = Brnch ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  and b.Branch = Brnch


);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-07-06', '2024-07-07', '2024-07-13', '2024-07-14', '2024-07-20', '2024-07-21', '2024-07-27', '2024-07-28') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Branch_June`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company and Branch = Brnch );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company and b.Branch = Brnch  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company and B.Branch = Brnch 


);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-06-01', '2024-06-02', '2024-06-08', '2024-06-09', '2024-06-15', '2024-06-16', '2024-06-22', '2024-06-23','2024-06-29','2024-06-30') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Branch_Mar`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company  and Branch = Brnch);
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  and b.Branch = Brnch ); 
set @Distance =(SELECT
 
   SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
           
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company   and b.Branch = Brnch AND a.distance > 1

);
set @Wknds = (SELECT
   
  sum(b.Dist)  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-03-02', '2024-03-03', '2024-03-09', '2024-03-10', '2024-03-16', '2024-03-17', '2024-03-23', '2024-03-24','2024-03-30','2024-03-31') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Branch_May`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company and Branch = Brnch );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company and b.Branch = Brnch   ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company and b.Branch = Brnch

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-05-04', '2024-05-05', '2024-05-11', '2024-05-12', '2024-05-18', '2024-05-19', '2024-05-25', '2024-05-26') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Branch_Nov`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company and Branch = Brnch );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company and b.Branch = Brnch  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  and b.Branch = Brnch

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN('2024-11-02', '2024-11-03', '2024-11-09', '2024-11-10', '2024-11-16', '2024-11-17', '2024-11-23', '2024-11-24','2024-11-30')GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Branch_Oct`(IN `Company` INT(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company and Branch = Brnch);
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company and b.Branch = Brnch  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  and Branch = Brnch

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN('2024-10-05', '2024-10-06', '2024-10-12', '2024-10-13', '2024-10-19', '2024-10-20', '2024-10-26', '2024-10-27')GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Branch_Sept`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company  and Branch = Brnch);
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  and b.Branch = Brnch ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  and b.Branch = Brnch

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-09-07', '2024-09-08', '2024-09-14', '2024-09-15', '2024-09-21', '2024-09-22', '2024-09-28', '2024-09-29')
     GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Dec`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  AND a.distance > 1

);
set @Wknds = (SELECT
   
   FORMAT( sum(b.Distance),0,'en_US')  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          distance ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-12-01', '2024-12-07', '2024-12-08', '2024-12-14', '2024-12-15', '2024-12-21', '2024-12-22', '2024-12-28','2024-12-29')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Feb`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(100), IN `TODATE` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  AND a.distance > 1

);
set @Wknds = (SELECT
   
   FORMAT( sum(b.Distance),0,'en_US')  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          distance ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-02-03', '2024-02-04', '2024-02-10', '2024-02-11', '2024-02-17', '2024-02-18', '2024-02-24', '2024-02-25')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Jan`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  AND a.distance > 1

);
set @Wknds = (SELECT
   
   FORMAT( sum(b.Distance),0,'en_US')  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          distance ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-01-06', '2024-01-07', '2024-01-13', '2024-01-14', '2024-01-20', '2024-01-21', '2024-01-27', '2024-01-28')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_July`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  


);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-07-06', '2024-07-07', '2024-07-13', '2024-07-14', '2024-07-20', '2024-07-21', '2024-07-27', '2024-07-28') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Jun`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  


);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-03-02', '2024-03-03', '2024-03-09', '2024-03-10', '2024-03-16', '2024-03-17', '2024-03-23', '2024-03-24','2024-03-30','2024-03-31') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Mar`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
   SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
           
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company 

);
set @Wknds = (SELECT
   
  sum(b.Dist)  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-03-02', '2024-03-03', '2024-03-09', '2024-03-10', '2024-03-16', '2024-03-17', '2024-03-23', '2024-03-24','2024-03-30','2024-03-31') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_May`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-03-02', '2024-03-03', '2024-03-09', '2024-03-10', '2024-03-16', '2024-03-17', '2024-03-23', '2024-03-24','2024-03-30','2024-03-31') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Nov`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN('2024-11-02', '2024-11-03', '2024-11-09', '2024-11-10', '2024-11-16', '2024-11-17', '2024-11-23', '2024-11-24','2024-11-30')GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Oct`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN('2024-10-05', '2024-10-06', '2024-10-12', '2024-10-13', '2024-10-19', '2024-10-20', '2024-10-26', '2024-10-27')GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_Sept`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-09-07', '2024-09-08', '2024-09-14', '2024-09-15', '2024-09-21', '2024-09-22', '2024-09-28', '2024-09-29')
     GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  AND a.distance > 1

);
set @Wknds = (SELECT
   
   FORMAT( sum(b.Distance),0,'en_US')  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          distance ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-02-03', '2024-02-04', '2024-02-10', '2024-02-11', '2024-02-17', '2024-02-18', '2024-02-24', '2024-02-25')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Apr`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  


);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-04-06', '2024-04-07', '2024-04-13', '2024-04-14', '2024-04-20', '2024-04-21', '2024-04-27', '2024-04-28') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Aug`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN('2024-08-03', '2024-08-04', '2024-08-10', '2024-08-11', '2024-08-17', '2024-08-18', '2024-08-24', '2024-08-25','2024-08-31')
   GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Branch_Apr`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company  and b.Branch = Brnch);
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  and b.Branch = Brnch ); 
set @Distance =(SELECT
 
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  and b.Branch = Brnch  AND a.distance > 1

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-04-06', '2024-04-07', '2024-04-13', '2024-04-14', '2024-04-20', '2024-04-21', '2024-04-27', '2024-04-28') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Branch_Aug`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company and Branch = Brnch );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  and b.Branch = Brnch ); 
set @Distance =(SELECT
 
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  and b.Branch = Brnch AND a.distance > 1

);
set @Wknds = (SELECT
   
   FORMAT( sum(b.Distance),0,'en_US')  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          distance ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-08-03', '2024-08-04', '2024-08-10', '2024-08-11', '2024-08-17', '2024-08-18', '2024-08-24', '2024-08-25','2024-08-31')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Branch_Dec`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company  and Branch = Brnch);
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  and b.Branch = Brnch  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  and b.Branch = Brnch


);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN  ('2024-12-01', '2024-12-07', '2024-12-08', '2024-12-14', '2024-12-15', '2024-12-21', '2024-12-22', '2024-12-28','2024-12-29') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Branch_Feb`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company and Branch = Brnch);
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company and b.Branch = Brnch ); 
set @Distance =(SELECT
 
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company and b.Branch = Brnch  AND a.distance > 1

);
set @Wknds = (SELECT
   
   FORMAT( sum(b.Distance),0,'en_US')  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and 
     Branch = Brnch 
    ) a
JOIN
    (
        SELECT
            device_id,
          distance ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-02-03', '2024-02-04', '2024-02-10', '2024-02-11', '2024-02-17', '2024-02-18', '2024-02-24', '2024-02-25')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Branch_July`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company  and Branch = Brnch);
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  and b.Branch = Brnch ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  and b.Branch = Brnch


);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-07-06', '2024-07-07', '2024-07-13', '2024-07-14', '2024-07-20', '2024-07-21', '2024-07-27', '2024-07-28') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Branch_June`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company and Branch = Brnch );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company and b.Branch = Brnch  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company and b.Branch = Brnch 

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-06-01', '2024-06-02', '2024-06-08', '2024-06-09', '2024-06-15', '2024-06-16', '2024-06-22', '2024-06-23','2024-06-29','2024-06-30') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Branch_Mar`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company  and Branch = Brnch);
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  and b.Branch = Brnch ); 
set @Distance =(SELECT
 
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  and b.Branch = Brnch AND a.distance > 1

);
set @Wknds = (SELECT
   
   FORMAT( sum(b.Distance),0,'en_US')  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company  and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          distance ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-03-02', '2024-03-03', '2024-03-09', '2024-03-10', '2024-03-16', '2024-03-17', '2024-03-23', '2024-03-24','2024-03-30','2024-03-31')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Branch_May`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company and Branch = Brnch );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company and b.Branch = Brnch   ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company and b.Branch = Brnch

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-05-04', '2024-05-05', '2024-05-11', '2024-05-12', '2024-05-18', '2024-05-19', '2024-05-25', '2024-05-26') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Branch_Nov`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company and Branch = Brnch );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company and b.Branch = Brnch  ); 
set @Distance =(SELECT
 
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  and b.Branch = Brnch AND a.distance > 1

);
set @Wknds = (SELECT
   
   FORMAT( sum(b.Distance),0,'en_US')  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          distance ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-11-02', '2024-11-03', '2024-11-09', '2024-11-10', '2024-11-16', '2024-11-17', '2024-11-23', '2024-11-24','2024-11-30')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Branch_Oct`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company and Branch = Brnch);
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company and b.Branch = Brnch  ); 
set @Distance =(SELECT
 
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company and b.Branch = Brnch  AND a.distance > 1

);
set @Wknds = (SELECT
   
   FORMAT( sum(b.Distance),0,'en_US')  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          distance ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-10-05', '2024-10-06', '2024-10-12', '2024-10-13', '2024-10-19', '2024-10-20', '2024-10-26', '2024-10-27')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Branch_Sept`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company  and Branch = Brnch);
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  and b.Branch = Brnch ); 
set @Distance =(SELECT
 
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  and b.Branch = Brnch AND a.distance > 1

);
set @Wknds = (SELECT
   
   FORMAT( sum(b.Distance),0,'en_US')  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company and Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
          distance ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-09-07', '2024-09-08', '2024-09-14', '2024-09-15', '2024-09-21', '2024-09-22', '2024-09-28', '2024-09-29')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Dec`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company


);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN  ('2024-12-01', '2024-12-07', '2024-12-08', '2024-12-14', '2024-12-15', '2024-12-21', '2024-12-22', '2024-12-28','2024-12-29') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Feb`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  AND a.distance > 1

);
set @Wknds = (SELECT
   
   FORMAT( sum(b.Distance),0,'en_US')  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          distance ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-02-03', '2024-02-04', '2024-02-10', '2024-02-11', '2024-02-17', '2024-02-18', '2024-02-24', '2024-02-25')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Jan`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  AND a.distance > 1

);
set @Wknds = (SELECT
   
   FORMAT( sum(b.Distance),0,'en_US')  AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          distance ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-01-06', '2024-01-07', '2024-01-13', '2024-01-14', '2024-01-20', '2024-01-21', '2024-01-27', '2024-01-28')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_July`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  


);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-07-06', '2024-07-07', '2024-07-13', '2024-07-14', '2024-07-20', '2024-07-21', '2024-07-27', '2024-07-28') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Jun`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-03-02', '2024-03-03', '2024-03-09', '2024-03-10', '2024-03-16', '2024-03-17', '2024-03-23', '2024-03-24','2024-03-30','2024-03-31') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Mar`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-03-02', '2024-03-03', '2024-03-09', '2024-03-10', '2024-03-16', '2024-03-17', '2024-03-23', '2024-03-24','2024-03-30','2024-03-31') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_May`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  


);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-05-04', '2024-05-05', '2024-05-11', '2024-05-12', '2024-05-18', '2024-05-19', '2024-05-25', '2024-05-26') GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Nov`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN('2024-11-02', '2024-11-03', '2024-11-09', '2024-11-10', '2024-11-16', '2024-11-17', '2024-11-23', '2024-11-24','2024-11-30')
   GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Oct`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-10-05', '2024-10-06', '2024-10-12', '2024-10-13', '2024-10-19', '2024-10-20', '2024-10-26', '2024-10-27')
   GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Fleet_Size_ZETDC_Sept`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
set @Fleet =0;
set @Mileage =0;
set @Distance =0;
set @Wknds =0; 
set @Fleet = (select count(Device_id) as FeetSize from all_devices where  Company_code=Company );
set @Mileage =(select sum(a.Distance) as TotalMileage from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company  ); 
set @Distance =(SELECT
 
    SUM(a.Dist )  AS Distance
FROM
    (
        SELECT
            sum(distance) as Dist,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE GROUP BY  device_id
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
  b.Company_code=Company  

);
set @Wknds = (SELECT
   
  sum(b.Dist) AS Weekend
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
          Company_code=Company 
    ) a
JOIN
    (
        SELECT
            device_id,
          SUM(distance) AS Dist ,
            date
        FROM
            travel_sheet
        WHERE
            date IN('2024-09-07', '2024-09-08', '2024-09-14', '2024-09-15', '2024-09-21', '2024-09-22', '2024-09-28', '2024-09-29')
   GROUP BY device_id
    ) b ON a.device_id = b.device_id
WHERE
    b.Dist >= 0
);
select FORMAT(@Fleet,0,'en_US') as FleetSize,FORMAT(@Mileage,0,'en_US') as TotalMileage
,FORMAT(@Wknds,0,'en_US') as TotalWknds,FORMAT(@Distance,0,'en_US') as AfterHours_Distance;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `OverSpeeding_Branch`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Branch` VARCHAR(100))

select d.Device_name as RegNo,d.Branch as Location,c.top_speed as 'top_speed',
c.Address,
c.max_speed_date as 'date',
c.overspeed_frequency as 'freq'  from (select a.top_speed,a.overspeed_frequency,b.device_id,b.max_speed_date,b.Address from (SELECT 
    MAX(speed) AS top_speed,
    COUNT(*) AS overspeed_frequency,
   
    device_id
FROM 
    travel_sheet
WHERE 
    speed > 119
                                                                                                                             and 
                                                                                                                             speed < 201
    and 
     date >= FROMDATE and date <= TODATE
GROUP BY 
    device_id
ORDER BY 
    device_id DESC) a join (select  date AS max_speed_date,
   Address,
    speed,
    device_id
    from 
    travel_sheet 
    where speed > 119 and speed < 201 and  date >= FROMDATE and date <= TODATE ) b on a.device_id = b.device_id and a.top_speed = b.speed group by a.device_id) c join all_devices d on c.device_id = d.device_id where d.company_code=Company and d.Branch = Branch;

END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `Over_Speeding_Table`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(100), IN `TODATE` VARCHAR(100))
BEGIN

select d.Device_name as RegNo,d.Branch as Location,c.top_speed as 'top_speed',
c.Address,
c.max_speed_date as 'date',
c.overspeed_frequency as 'freq'  from (select a.top_speed,a.overspeed_frequency,b.device_id,b.max_speed_date,b.Address from (SELECT 
    MAX(speed) AS top_speed,
    COUNT(*) AS overspeed_frequency,
   
    device_id
FROM 
    travel_sheet
WHERE 
device_id not in ('8303','8399','8403','8404','9960','8376') and
    speed > 119
    and 
   speed < 201
and
     date >= FROMDATE and date <= TODATE
GROUP BY 
    device_id
ORDER BY 
    device_id DESC) a join (select  date AS max_speed_date,
   Address,
    speed,
    device_id
    from 
    travel_sheet 
    where
device_id not in ('8303','8399','8403','8404','9960','8376') and
 speed > 119 and speed < 201 and  date >= FROMDATE and date <= TODATE ) b on a.device_id = b.device_id and a.top_speed = b.speed group by a.device_id) c join all_devices d on c.device_id = d.device_id where d.company_code=Company;

END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `after_hours_Branch`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Branch` VARCHAR(100))
BEGIN
SELECT
    b.Device_name AS RegNo,
    b.Branch AS Location,
    Format(SUM(CASE WHEN a.hour = '18' THEN a.distance ELSE 0 END),0)  AS Six,
    Format(SUM(CASE WHEN a.hour = '19' THEN a.distance ELSE 0 END),0)  AS Seven,
    Format(SUM(CASE WHEN a.hour = '20' THEN a.distance ELSE 0 END),0)  AS Eight,
    Format(SUM(CASE WHEN a.hour = '21' THEN a.distance ELSE 0 END),0)  AS Nine,
    Format(SUM(CASE WHEN a.hour = '22' THEN a.distance ELSE 0 END),0)  AS Ten,
    Format(SUM(CASE WHEN a.hour = '23' THEN a.distance ELSE 0 END),0)  AS Eleven,
    Format(SUM(CASE WHEN a.hour = '0' THEN a.distance ELSE 0 END),0)  AS Twelve,
    Format(SUM(CASE WHEN a.hour = '1' THEN a.distance ELSE 0 END),0)  AS One,
    Format(SUM(CASE WHEN a.hour = '2' THEN a.distance ELSE 0 END),0)  AS Two,
    Format(SUM(CASE WHEN a.hour = '3' THEN a.distance ELSE 0 END),0)  AS Three,
    Format(SUM(CASE WHEN a.hour = '4' THEN a.distance ELSE 0 END),0)  AS Four,
    Format(SUM(CASE WHEN a.hour = '5' THEN a.distance ELSE 0 END),0)  AS Five
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    ) a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
    b.Company_code = Company AND b.Branch = Branch and a.distance > 1
GROUP BY
    b.Device_name, b.Branch;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `after_hours_ZETDC`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
BEGIN
SELECT
    b.Device_name AS RegNo,
    b.Branch AS Location,
    Format(SUM(CASE WHEN a.hour = '22' THEN a.distance ELSE 0 END),0)  AS Ten,
    Format(SUM(CASE WHEN a.hour = '23' THEN a.distance ELSE 0 END),0)  AS Eleven,
    Format(SUM(CASE WHEN a.hour = '0' THEN a.distance ELSE 0 END),0)  AS Twelve,
    Format(SUM(CASE WHEN a.hour = '1' THEN a.distance ELSE 0 END),0)  AS One,
    Format(SUM(CASE WHEN a.hour = '2' THEN a.distance ELSE 0 END),0)  AS Two,
    Format(SUM(CASE WHEN a.hour = '3' THEN a.distance ELSE 0 END),0)  AS Three,
    Format(SUM(CASE WHEN a.hour = '4' THEN a.distance ELSE 0 END),0)  AS Four,
    Format(SUM(CASE WHEN a.hour = '5' THEN a.distance ELSE 0 END),0)  AS Five
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    ) a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
    b.Company_code = Company AND a.distance > 1
GROUP BY
    b.Device_name, b.Branch;

 END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `after_hours_driving`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(100), IN `TODATE` VARCHAR(100))
BEGIN
SELECT
    b.Device_name AS RegNo,
    b.Branch AS Location,
    Format(SUM(CASE WHEN a.hour = '18' THEN a.distance ELSE 0 END),0)  AS Six,
    Format(SUM(CASE WHEN a.hour = '19' THEN a.distance ELSE 0 END),0)  AS Seven,
    Format(SUM(CASE WHEN a.hour = '20' THEN a.distance ELSE 0 END),0)  AS Eight,
    Format(SUM(CASE WHEN a.hour = '21' THEN a.distance ELSE 0 END),0)  AS Nine,
    Format(SUM(CASE WHEN a.hour = '22' THEN a.distance ELSE 0 END),0)  AS Ten,
    Format(SUM(CASE WHEN a.hour = '23' THEN a.distance ELSE 0 END),0)  AS Eleven,
    Format(SUM(CASE WHEN a.hour = '0' THEN a.distance ELSE 0 END),0)  AS Twelve,
    Format(SUM(CASE WHEN a.hour = '1' THEN a.distance ELSE 0 END),0)  AS One,
    Format(SUM(CASE WHEN a.hour = '2' THEN a.distance ELSE 0 END),0)  AS Two,
    Format(SUM(CASE WHEN a.hour = '3' THEN a.distance ELSE 0 END),0)  AS Three,
    Format(SUM(CASE WHEN a.hour = '4' THEN a.distance ELSE 0 END),0)  AS Four,
    Format(SUM(CASE WHEN a.hour = '5' THEN a.distance ELSE 0 END),0)  AS Five
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    ) a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
    b.Company_code = Company AND a.distance > 1
GROUP BY
    b.Device_name, b.Branch;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `afterhours_ZETDC_Branch`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Branch` VARCHAR(100))
BEGIN
SELECT
    b.Device_name AS RegNo,
    b.Branch AS Location,
    Format(SUM(CASE WHEN a.hour = '22' THEN a.distance ELSE 0 END),0)  AS Ten,
    Format(SUM(CASE WHEN a.hour = '23' THEN a.distance ELSE 0 END),0)  AS Eleven,
    Format(SUM(CASE WHEN a.hour = '0' THEN a.distance ELSE 0 END),0)  AS Twelve,
    Format(SUM(CASE WHEN a.hour = '1' THEN a.distance ELSE 0 END),0)  AS One,
    Format(SUM(CASE WHEN a.hour = '2' THEN a.distance ELSE 0 END),0)  AS Two,
    Format(SUM(CASE WHEN a.hour = '3' THEN a.distance ELSE 0 END),0)  AS Three,
    Format(SUM(CASE WHEN a.hour = '4' THEN a.distance ELSE 0 END),0)  AS Four,
    Format(SUM(CASE WHEN a.hour = '5' THEN a.distance ELSE 0 END),0)  AS Five
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    ) a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
    b.Company_code = Company AND b.Branch = Branch and a.distance > 1
GROUP BY
    b.Device_name, b.Branch;
END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `perfomance_matrix`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(100), IN `TODATE` VARCHAR(100))
BEGIN

select x.Category as ASPECT,

FORMAT(sum(case when x.Branch='ALLIED MUTARE FACTORY' then x.FleetSize else 0 end),0,'en_US') as 'ALLIED MUTARE FACTORY',
FORMAT(sum(case when x.Branch='ALLIED MUTARE OFFICE' then x.FleetSize else 0 end),0,'en_US') as 'ALLIED MUTARE OFFICE',
FORMAT(sum(case when x.Branch='ALLIED TIMBERS BULAWAYO' then x.FleetSize else 0 end),0,'en_US') as 'ALLIED TIMBERS BULAWAYO',
FORMAT(sum(case when x.Branch='ALLIED TIMBERS CASHEL' then x.FleetSize else 0 end),0,'en_US') as 'ALLIED TIMBERS CASHEL',
FORMAT(sum(case when x.Branch='ALLIED TIMBERS MASVINGO' then x.FleetSize else 0 end),0,'en_US') as 'ALLIED TIMBERS MASVINGO',
FORMAT(sum(case when x.Branch='ALLIED TIMBERS CHISENGU' then x.FleetSize else 0 end),0,'en_US') as 'ALLIED TIMBERS CHISENGU',
FORMAT(sum(case when x.Branch='ALLIED TIMBERS ERIN' then x.FleetSize else 0 end),0,'en_US') as 'ALLIED TIMBERS ERIN',
FORMAT(sum(case when x.Branch='ALLIED TIMBERS GWENDINGWE' then x.FleetSize else 0 end),0,'en_US') as 'ALLIED TIMBERS GWENDINGWE',
FORMAT(sum(case when x.Branch='ALLIED TIMBERS GWERU' then x.FleetSize else 0 end ),0,'en_US')as 'ALLIED TIMBERS GWERU',
FORMAT(sum(case when x.Branch='ALLIED TIMBERS HQ' then x.FleetSize else 0 end ),0,'en_US')as 'ALLIED TIMBERS HQ',
FORMAT(sum(case when x.Branch='ALLIED TIMBERS MARTIN' then x.FleetSize else 0 end ),0,'en_US')as 'ALLIED TIMBERS MARTIN',
FORMAT(sum(case when x.Branch='ALLIED TIMBERS MTAO' then x.FleetSize else 0 end ),0,'en_US')as 'ALLIED TIMBERS MTAO',
FORMAT(sum(case when x.Branch='ALLIED TIMBERS NGUNGUNYANA' then x.FleetSize else 0 end ),0,'en_US')as 'ALLIED TIMBERS NGUNGUNYANA',
FORMAT(sum(case when x.Branch='ALLIED TIMBERS STAPLEFORD' then x.FleetSize else 0 end ),0,'en_US')as 'ALLIED TIMBERS STAPLEFORD',
FORMAT(sum(case when x.Branch='AlLLIED TIMBERS NYANGUI' then x.FleetSize else 0 end ),0,'en_US')as 'AlLLIED TIMBERS NYANGUI'
 from (select count(a.Device_id) as FleetSize,b.Branch,'Fleet Size' as Category,'1' as Count from (select  Device_id from all_devices) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company group by b.Branch  union

select sum(a.Distance) as TotalMileage,b.Branch,'Total Mileage' as Category,'2' as Count from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company group by b.Branch  union

select  sum(e.distance) AfterHoursDistance,e.Branch,'After Hours (km)' as Category , '3' as Count from (
 SELECT
 b.Branch,
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
    b.Company_code = Company  AND a.distance > 1
    GROUP BY b.Branch
)e group by e.Branch)x group by x.Category order by x.Count ;






END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `perfomance_matrix_Branch`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
select x.Branch,
FORMAT(sum(case when x.Category='Fleet Size' then x.FleetSize else 0 end),0,'en_US') as 'Fleet Size',
FORMAT(sum(case when x.Category='Total Mileage' then x.FleetSize else 0 end),0,'en_US') as 'Total Mileage',
FORMAT(sum(case when x.Category='After Hours (km)' then x.FleetSize else 0 end),0,'en_US') as 'After Hours (km)'
 from (select count(a.Device_id) as FleetSize,b.Branch,'Fleet Size' as Category from (select  Device_id from all_devices) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company and b.Branch = Brnch group by b.Branch  union

select sum(a.Distance) as TotalMileage,b.Branch,'Total Mileage' as Category from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company and b.Branch = Brnch group by b.Branch  union

select  sum(e.Distance) AfterHoursDistance,e.Branch,'After Hours (km)' as Category from (  SELECT
 b.Branch,
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 18 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
    b.Company_code = Company AND b.Branch = Brnch AND a.distance > 1
    GROUP BY b.Branch
 )e group by e.Branch)x  group by x.Branch$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `perfomance_matrix_ZETDC`(IN `Company` VARCHAR(300), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20))
Begin
select x.Category as ASPECT,

FORMAT(sum(case when x.Branch='ZETDC' then x.FleetSize else 0 end),0,'en_US') as 'ZETDC',
FORMAT(sum(case when x.Branch='ZETDC WESTERN REGION' then x.FleetSize else 0 end),0,'en_US') as 'WESTERN REGION',
FORMAT(sum(case when x.Branch='ZETDC HEAD OFFICE' then x.FleetSize else 0 end),0,'en_US') as 'HEAD OFFICE',
FORMAT(sum(case when x.Branch='ZETDC WYNE DEPOT' then x.FleetSize else 0 end),0,'en_US') as 'WYNE DEPOT',
FORMAT(sum(case when x.Branch='ZETDC HARARE REGION' then x.FleetSize else 0 end),0,'en_US') as 'HARARE REGION',
FORMAT(sum(case when x.Branch='ZETDC CBD DEPOT' then x.FleetSize else 0 end),0,'en_US') as 'CBD DEPOT',
FORMAT(sum(case when x.Branch='ZETDC KUWADZANA' then x.FleetSize else 0 end),0,'en_US') as 'ZETDC KUWADZANA',
FORMAT(sum(case when x.Branch='ZETDC EASTERN REGION' then x.FleetSize else 0 end),0,'en_US') as 'ZETDC EASTERN REGION',
FORMAT(sum(case when x.Branch='ZETDC SOUTHERN REGION' then x.FleetSize else 0 end),0,'en_US') as 'ZETDC SOUTHERN REGION',
FORMAT(sum(case when x.Branch='ZETDC GOKWE' then x.FleetSize else 0 end),0,'en_US') as 'ZETDC GOKWE',
FORMAT(sum(case when x.Branch='ZETDC TRANSMISSION' then x.FleetSize else 0 end),0,'en_US') as 'ZETDC TRANSMISSION'
 from (select count(a.Device_id) as FleetSize,b.Branch,'Fleet Size' as Category,'1' as Count from (select  Device_id from all_devices)a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company group by b.Branch  union

select sum(a.Distance) as TotalMileage,b.Branch,'Total Mileage' as Category,'2' as Count from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id)a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company group by b.Branch  union

select  sum(e.distance) AfterHoursDistance,e.Branch,'After Hours (km)' as Category , '3' as Count from ( SELECT
 b.Branch,
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
    b.Company_code = Company  AND a.distance > 1
    GROUP BY b.Branch
 )e group by e.Branch)x group by x.Category order by x.Count;

End$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `perfomance_matrix_ZETDC_Branch`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(20), IN `TODATE` VARCHAR(20), IN `Brnch` VARCHAR(100))
Begin

select x.Branch,
FORMAT(sum(case when x.Category='Fleet Size' then x.FleetSize else 0 end),0,'en_US') as 'Fleet Size',
FORMAT(sum(case when x.Category='Total Mileage' then x.FleetSize else 0 end),0,'en_US') as 'Total Mileage',
FORMAT(sum(case when x.Category='After Hours (km)' then x.FleetSize else 0 end),0,'en_US') as 'After Hours (km)'
 from (select count(a.Device_id) as FleetSize,b.Branch,'Fleet Size' as Category from (select  Device_id from all_devices) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company and b.Branch = Brnch group by b.Branch  union

select sum(a.Distance) as TotalMileage,b.Branch,'Total Mileage' as Category from (select device_id, sum(distance) as Distance from travel_sheet where date >= FROMDATE and date <= TODATE  group by device_id) a join all_devices b on a.device_id = b.Device_id where b.Company_code=Company and b.Branch = Brnch group by b.Branch  union

select  sum(e.distance) AfterHoursDistance,e.Branch,'After Hours (km)' as Category from ( SELECT
 b.Branch,
    Format(SUM(a.distance ),0)  AS Distance
FROM
    (
        SELECT
            HOUR(time) AS hour,
            distance,
            device_id
        FROM
            travel_sheet
        WHERE
            (HOUR(time) >= 22 OR HOUR(time) <= 5)
            AND date >= FROMDATE AND date <= TODATE
    )a
JOIN
    all_devices b ON a.device_id = b.Device_id
WHERE
    b.Company_code = Company AND b.Branch = Brnch  AND a.distance > 1
    GROUP BY b.Branch
 )e group by e.Branch)x  group by x.Branch;
End$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `sp_weekend`(IN `Company` VARCHAR(100))
Begin
select a.Device_name as VehicleID,a.Branch as Location ,
FORMAT( SUM(CASE WHEN b.date = '2024-01-06' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-06',
FORMAT( SUM(CASE WHEN b.date = '2024-01-07' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-07' ,
FORMAT( SUM(CASE WHEN b.date = '2024-01-13' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-13',
FORMAT( SUM(CASE WHEN b.date = '2024-01-14' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-14',
FORMAT( SUM(CASE WHEN b.date = '2024-01-20' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-20',
FORMAT( SUM(CASE WHEN b.date = '2024-01-21' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-21',
FORMAT( SUM(CASE WHEN b.date = '2024-01-27' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-27',
FORMAT( SUM(CASE WHEN b.date = '2024-01-28' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-28'
from 
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
            Company_code = Company
    ) a
JOIN
    (
        SELECT
            device_id,
            distance,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-01-06', '2024-01-07', '2024-01-13', '2024-01-14', '2024-01-20', '2024-01-21', '2024-01-27', '2024-01-28')
    )b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
GROUP BY
    a.Device_name, a.Branch;


End$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `sp_weekend_Apr`(IN `Company` VARCHAR(100))
Begin
select a.Device_name as VehicleID,a.Branch as Location ,
FORMAT( SUM(CASE WHEN b.date = '2024-04-06' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-06',
FORMAT( SUM(CASE WHEN b.date = '2024-04-07' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-07' ,
FORMAT( SUM(CASE WHEN b.date = '2024-04-13' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-13',
FORMAT( SUM(CASE WHEN b.date = '2024-04-14' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-14',
FORMAT( SUM(CASE WHEN b.date = '2024-04-20' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-20',
FORMAT( SUM(CASE WHEN b.date = '2024-04-21' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-21',
FORMAT( SUM(CASE WHEN b.date = '2024-04-27' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-27',
FORMAT( SUM(CASE WHEN b.date = '2024-04-28' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-28'
from 
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
            Company_code = Company
    ) a
JOIN
    (
        SELECT
            device_id,
            distance,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-04-06', '2024-04-07', '2024-04-13', '2024-04-14', '2024-04-20', '2024-04-21', '2024-04-27', '2024-04-28')
    )b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
GROUP BY
    a.Device_name, a.Branch;


End$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `sp_weekend_Apr_Branch`(IN `Company` VARCHAR(100), IN `Brnch` VARCHAR(100))
Begin
select a.Device_name as VehicleID,a.Branch as Location ,
FORMAT( SUM(CASE WHEN b.date = '2024-04-06' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-06',
FORMAT( SUM(CASE WHEN b.date = '2024-04-07' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-07' ,
FORMAT( SUM(CASE WHEN b.date = '2024-04-13' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-13',
FORMAT( SUM(CASE WHEN b.date = '2024-04-14' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-14',
FORMAT( SUM(CASE WHEN b.date = '2024-04-20' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-20',
FORMAT( SUM(CASE WHEN b.date = '2024-04-21' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-21',
FORMAT( SUM(CASE WHEN b.date = '2024-04-27' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-27',
FORMAT( SUM(CASE WHEN b.date = '2024-04-28' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-04-28'
from 
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
            Company_code = Company and 
            Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
            distance,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-04-06', '2024-04-07', '2024-04-13', '2024-04-14', '2024-04-20', '2024-04-21', '2024-04-27', '2024-04-28')
    )b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
GROUP BY
    a.Device_name, a.Branch;


End$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `sp_weekend_Branch`(IN `Company` VARCHAR(100), IN `Brnch` VARCHAR(100))
select a.Device_name as VehicleID,a.Branch as Location ,case when b.Distance IS NULL  then 0 else FORMAT(b.Distance,0,'en_US') end  as '2024-01-06',case when c.Distance IS NULL  then 0 else FORMAT(c.Distance,0,'en_US') end as '2024-01-07',
case when d.Distance IS NULL  then 0 else FORMAT(d.Distance,0,'en_US') end as '2024-01-13',case when e.Distance IS NULL  then 0 else FORMAT(e.Distance,0,'en_US') end as '2024-01-14',case when j.Distance IS NULL  then 0 else FORMAT(j.Distance,0,'en_US') end as '2024-01-20',case when f.Distance IS NULL  then 0 else FORMAT(f.Distance,0,'en_US') end as '2024-01-21',case when g.Distance IS NULL  then 0 else FORMAT(g.Distance,0,'en_US') end as '2024-01-27',case when h.Distance IS NULL  then 0 else FORMAT(h.Distance,0,'en_US') end as '2024-01-28'  from 
(select Device_name,Device_id,Branch from  all_devices where Company_code=Company and Branch=Brnch)a left join (
select
				device_id,
                sum(distance) as Distance
                from travel_sheet
                where date = '2024-01-06' 
                group by device_id )b on a.device_id = b.device_id left join
                 (
select
				device_id,
                sum(distance) as Distance
                from travel_sheet
                where date = '2024-01-07' 
                group by device_id )c on a.device_id = c.device_id left join
                 (
select
				device_id,
                sum(distance) as Distance
                from travel_sheet
                where date = '2024-01-13' 
                group by device_id )d on a.device_id = d.device_id left join
                 (
select
				device_id,
                sum(distance) as Distance
                from travel_sheet
                where date = '2024-01-14' 
                group by device_id )e on a.device_id = e.device_id left join
                 (
select
				device_id,
                sum(distance) as Distance
                from travel_sheet
                where date = '2024-01-20' 
                group by device_id )j on a.device_id = j.device_id left join
                 (
select
				device_id,
                sum(distance) as Distance
                from travel_sheet
                where date = '2024-01-21' 
                group by device_id )f on a.device_id = f.device_id left join
                 (
select
				device_id,
                sum(distance) as Distance
                from travel_sheet
                where date = '2024-01-27' 
                group by device_id )g on a.device_id = g.device_id left join
                 (
select
				device_id,
                sum(distance) as Distance
                from travel_sheet
                where date = '2024-01-28' 
                group by device_id )h on a.device_id = h.device_id
 where b.Distance >= '1' OR c.Distance >= '1' OR d.Distance >= '1' OR e.Distance >= '1' OR 
                j.Distance >= '1' OR f.Distance >= '1' OR g.Distance >= '1' OR h.Distance >= '1'$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `sp_weekend_FEB`(IN `Company` VARCHAR(100))
Begin
SELECT
    a.Device_name AS VehicleID,
    a.Branch AS Location,
   FORMAT( SUM(CASE WHEN b.date = '2024-02-03' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-03',
    FORMAT(SUM(CASE WHEN b.date = '2024-02-04' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-04',
   FORMAT( SUM(CASE WHEN b.date = '2024-02-10' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-10',
   FORMAT( SUM(CASE WHEN b.date = '2024-02-11' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-11',
    FORMAT(SUM(CASE WHEN b.date = '2024-02-17' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-17',
    FORMAT(SUM(CASE WHEN b.date = '2024-02-18' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-18',
   FORMAT( SUM(CASE WHEN b.date = '2024-02-24' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-24',
    FORMAT(SUM(CASE WHEN b.date = '2024-02-25' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-25'
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
            Company_code = Company
    ) a
JOIN
    (
        SELECT
            device_id,
            distance,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-02-03', '2024-02-04', '2024-02-10', '2024-02-11', '2024-02-17', '2024-02-18', '2024-02-24', '2024-02-25')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
GROUP BY
    a.Device_name, a.Branch;
End$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `sp_weekend_FEB_Branch`(IN `Company` VARCHAR(100), IN `Brnch` VARCHAR(100))
Begin
SELECT
    a.Device_name AS VehicleID,
    a.Branch AS Location,
   FORMAT( SUM(CASE WHEN b.date = '2024-02-03' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-03',
    FORMAT(SUM(CASE WHEN b.date = '2024-02-04' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-04',
   FORMAT( SUM(CASE WHEN b.date = '2024-02-10' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-10',
   FORMAT( SUM(CASE WHEN b.date = '2024-02-11' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-11',
    FORMAT(SUM(CASE WHEN b.date = '2024-02-17' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-17',
    FORMAT(SUM(CASE WHEN b.date = '2024-02-18' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-18',
   FORMAT( SUM(CASE WHEN b.date = '2024-02-24' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-24',
    FORMAT(SUM(CASE WHEN b.date = '2024-02-25' THEN b.Distance ELSE 0 END),0,'en_US')  AS '2024-02-25'
FROM
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
            Company_code = Company and
            Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
            distance,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-02-03', '2024-02-04', '2024-02-10', '2024-02-11', '2024-02-17', '2024-02-18', '2024-02-24', '2024-02-25')
    ) b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
GROUP BY
    a.Device_name, a.Branch;
End$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `sp_weekend_June`(IN `Company` VARCHAR(100))
Begin
select a.Device_name as VehicleID,a.Branch as Location ,
FORMAT( SUM(CASE WHEN b.date = '2024-06-01' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-06-01',
FORMAT( SUM(CASE WHEN b.date = '2024-06-02' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-06-02' ,
FORMAT( SUM(CASE WHEN b.date = '2024-06-08' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-06-08',
FORMAT( SUM(CASE WHEN b.date = '2024-06-09' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-06-09',
FORMAT( SUM(CASE WHEN b.date = '2024-06-15' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-06-15',
FORMAT( SUM(CASE WHEN b.date = '2024-06-16' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-06-16',
FORMAT( SUM(CASE WHEN b.date = '2024-06-22' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-06-22',
FORMAT( SUM(CASE WHEN b.date = '2024-06-23' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-06-23',
FORMAT( SUM(CASE WHEN b.date = '2024-06-29' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-06-29',
FORMAT( SUM(CASE WHEN b.date = '2024-06-30' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-06-30'
from 
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
            Company_code = Company
    ) a
JOIN
    (
        SELECT
            device_id,
            distance,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-06-01', '2024-06-02', '2024-06-08', '2024-06-09', '2024-06-15', '2024-06-16', '2024-06-22', '2024-06-23','2024-06-29','2024-06-30')
    )b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
GROUP BY
    a.Device_name, a.Branch;


End$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `sp_weekend_Mar`(IN `Company` VARCHAR(100))
BEGIN
select a.Device_name as VehicleID,a.Branch as Location ,
FORMAT( SUM(CASE WHEN b.date = '2024-03-02' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-02',
FORMAT( SUM(CASE WHEN b.date = '2024-03-03' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-03' ,
FORMAT( SUM(CASE WHEN b.date = '2024-03-09' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-09',
FORMAT( SUM(CASE WHEN b.date = '2024-03-10' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-10',
FORMAT( SUM(CASE WHEN b.date = '2024-03-16' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-16',
FORMAT( SUM(CASE WHEN b.date = '2024-03-17' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-17',
FORMAT( SUM(CASE WHEN b.date = '2024-03-23' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-23',
FORMAT( SUM(CASE WHEN b.date = '2024-03-24' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-24',
FORMAT( SUM(CASE WHEN b.date = '2024-03-30' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-30',
FORMAT( SUM(CASE WHEN b.date = '2024-03-31' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-31'
from 
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
            Company_code = Company
    ) a
JOIN
    (
        SELECT
            device_id,
            distance,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-03-02', '2024-03-03', '2024-03-09', '2024-03-10', '2024-03-16', '2024-03-17', '2024-03-23', '2024-03-24', '2024-03-30', '2024-03-31')
    )b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
GROUP BY
    a.Device_name, a.Branch;


END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `sp_weekend_Mar_Branch`(IN `Company` VARCHAR(100), IN `Brnch` VARCHAR(100))
BEGIN
select a.Device_name as VehicleID,a.Branch as Location ,
FORMAT( SUM(CASE WHEN b.date = '2024-03-02' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-02',
FORMAT( SUM(CASE WHEN b.date = '2024-03-03' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-03' ,
FORMAT( SUM(CASE WHEN b.date = '2024-03-09' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-09',
FORMAT( SUM(CASE WHEN b.date = '2024-03-10' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-10',
FORMAT( SUM(CASE WHEN b.date = '2024-03-16' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-16',
FORMAT( SUM(CASE WHEN b.date = '2024-03-17' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-17',
FORMAT( SUM(CASE WHEN b.date = '2024-03-23' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-23',
FORMAT( SUM(CASE WHEN b.date = '2024-03-24' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-24',
FORMAT( SUM(CASE WHEN b.date = '2024-03-30' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-30',
FORMAT( SUM(CASE WHEN b.date = '2024-03-31' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-03-31'
from 
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
            Company_code = Company and
            Branch = Brnch
    ) a
JOIN
    (
        SELECT
            device_id,
            distance,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-03-02', '2024-03-03', '2024-03-09', '2024-03-10', '2024-03-16', '2024-03-17', '2024-03-23', '2024-03-24', '2024-03-30', '2024-03-31')
    )b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
GROUP BY
    a.Device_name, a.Branch;


END$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `sp_weekend_May`(IN `Company` VARCHAR(100))
Begin
select a.Device_name as VehicleID,a.Branch as Location ,
FORMAT( SUM(CASE WHEN b.date = '2024-05-04' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-05-04',
FORMAT( SUM(CASE WHEN b.date = '2024-05-05' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-05-05' ,
FORMAT( SUM(CASE WHEN b.date = '2024-05-11' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-05-11',
FORMAT( SUM(CASE WHEN b.date = '2024-05-12' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-05-12',
FORMAT( SUM(CASE WHEN b.date = '2024-05-18' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-05-18',
FORMAT( SUM(CASE WHEN b.date = '2024-05-19' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-05-19',
FORMAT( SUM(CASE WHEN b.date =  '2024-05-25' THEN b.Distance ELSE 0 END),0,'en_US')  as  '2024-05-25',
FORMAT( SUM(CASE WHEN b.date =  '2024-05-26' THEN b.Distance ELSE 0 END),0,'en_US')  as  '2024-05-26'
from 
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
            Company_code = Company
    ) a
JOIN
    (
        SELECT
            device_id,
            distance,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-05-04', '2024-05-05', '2024-05-11', '2024-05-12', '2024-05-18', '2024-05-19', '2024-05-25', '2024-05-26')
    )b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
GROUP BY
    a.Device_name, a.Branch;


End$$
DELIMITER ;

DELIMITER $$
CREATE  PROCEDURE `sp_weekends`(IN `Company` VARCHAR(100), IN `FROMDATE` VARCHAR(100), IN `TODATE` VARCHAR(100))
BEGIN
select a.Device_name as VehicleID,a.Branch as Location ,
FORMAT( SUM(CASE WHEN b.date = '2024-01-06' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-06',
FORMAT( SUM(CASE WHEN b.date = '2024-01-07' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-07' ,
FORMAT( SUM(CASE WHEN b.date = '2024-01-13' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-13',
FORMAT( SUM(CASE WHEN b.date = '2024-01-14' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-14',
FORMAT( SUM(CASE WHEN b.date = '2024-01-20' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-20',
FORMAT( SUM(CASE WHEN b.date = '2024-01-21' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-21',
FORMAT( SUM(CASE WHEN b.date = '2024-01-27' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-27',
FORMAT( SUM(CASE WHEN b.date = '2024-01-28' THEN b.Distance ELSE 0 END),0,'en_US')  as '2024-01-28'
from 
    (
        SELECT
            Device_name,
            Device_id,
            Branch
        FROM
            all_devices
        WHERE
            Company_code = Company
    ) a
JOIN
    (
        SELECT
            device_id,
            distance,
            date
        FROM
            travel_sheet
        WHERE
            date IN ('2024-01-06', '2024-01-07', '2024-01-13', '2024-01-14', '2024-01-20', '2024-01-21', '2024-01-27', '2024-01-28')
    )b ON a.device_id = b.device_id
WHERE
    b.distance >= 1
GROUP BY
    a.Device_name, a.Branch;


END$$
DELIMITER ;
