    99-- phpMyAdmin SQL Dump
    -- version 4.5.1
    -- http://www.phpmyadmin.net
    --
    -- Host: 127.0.0.1
    -- Generation Time: Jun 25, 2018 at 08:38 PM
    -- Server version: 10.1.19-MariaDB
    -- PHP Version: 5.5.38

    SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
    SET time_zone = "+00:00";


    /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
    /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
    /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
    /*!40101 SET NAMES utf8mb4 */;

    --
    -- Database: `hotel1`
    --

    -- --------------------------------------------------------

    --
    -- Table structure for table `attendance`
    --

    CREATE TABLE `attendance` (
      `Cnic` bigint(20) NOT NULL,
      `Date` date NOT NULL,
      `attendance_status` varchar(10) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- Table structure for table `bill`
    --

    CREATE TABLE `bill` (
      `BillId` int(11) NOT NULL,
      `OrderId` int(11) DEFAULT NULL,
      `MenuId` int(11) DEFAULT NULL,
      `DishQuantity` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- Table structure for table `customer`
    --

    CREATE TABLE `customer` (
      `Id` int(11) NOT NULL,
      `Name` varchar(20) NOT NULL,
      `MobileNumber` bigint(20) NOT NULL,
      `Gender` varchar(1) NOT NULL,
      `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='for customer only';

    -- --------------------------------------------------------

    --
    -- Table structure for table `customercomplaint`
    --

    CREATE TABLE `customercomplaint` (
      `Id` int(11) NOT NULL,
      `MobileNumber` bigint(20) NOT NULL,
      `Text` text NOT NULL,
      `Date` date DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- Table structure for table `customerorder`
    --

    CREATE TABLE `customerorder` (
      `OrderId` int(11) NOT NULL,
      `Total` int(11) NOT NULL,
      `Comment` text NOT NULL,
      `Date` date NOT NULL,
      `Address` varchar(200) NOT NULL,
      `Status` varchar(20) NOT NULL,
      `MobileNumber` bigint(20) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- Table structure for table `employee`
    --

    CREATE TABLE `employee` (
      `Cnic` bigint(20) NOT NULL,
      `PhoneNumber` bigint(11) DEFAULT NULL,
      `Name` varchar(20) NOT NULL,
      `Gender` varchar(1) NOT NULL,
      `Job` varchar(30) NOT NULL,
      `Hours` int(11) DEFAULT NULL,
      `Shift` varchar(10) DEFAULT NULL,
      `filename` varchar(255) NOT NULL,
      `path` varchar(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table of emplyee with data';

    -- --------------------------------------------------------

    --
    -- Table structure for table `employeesalery`
    --

    CREATE TABLE `employeesalery` (
      `Id` int(11) NOT NULL,
      `Cnic` bigint(20) NOT NULL,
      `Amount` int(11) NOT NULL,
      `Month` date NOT NULL,
      `Status` varchar(20) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- Table structure for table `expenditure`
    --

    CREATE TABLE `expenditure` (
      `ExpId` int(11) NOT NULL,
      `ItemNumber` int(11) NOT NULL,
      `UnitPrice` int(11) NOT NULL,
      `Number` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- Table structure for table `favdish`
    --

    CREATE TABLE `favdish` (
      `Num` bigint(20) NOT NULL,
      `DishId` int(11) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- Table structure for table `inventory`
    --

    CREATE TABLE `inventory` (
      `ItemNumber` int(11) NOT NULL,
      `ItemName` varchar(50) NOT NULL,
      `ItemQuantity` int(11) NOT NULL,
      `ItemPrice` int(11) NOT NULL,
      `ItemUnit` varchar(10) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- --------------------------------------------------------

    --
    -- Table structure for table `job_role`
    --

    CREATE TABLE `job_role` (
      `roleid` int(11) NOT NULL,
      `description` varchar(45) NOT NULL,
      `sal_per_day` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

    -- --------------------------------------------------------

    --
    -- Table structure for table `login`
    --

    CREATE TABLE `login` (
      `Id` int(11) NOT NULL,
      `Mnumber` varchar(20) NOT NULL,
      `Password` varchar(100) NOT NULL,
      `Status` varchar(20) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    --
    -- Dumping data for table `login`
    --

    INSERT INTO `login` (`Id`, `Mnumber`, `Password`, `Status`) VALUES
    (1, '3075115388', '81dc9bdb52d04dc20036dbd8313ed055', 'manager'),
    (2, '3338388827', '81dc9bdb52d04dc20036dbd8313ed055', 'employee'),
    (3, '3123456789', '81dc9bdb52d04dc20036dbd8313ed055', 'customer');

    -- --------------------------------------------------------

    --
    -- Table structure for table `menu`
    --

    CREATE TABLE `menu` (
      `MenuId` int(11) NOT NULL,
      `DishName` varchar(30) NOT NULL,
      `Price` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    --
    -- Indexes for dumped tables
    --

    --
    -- Indexes for table `attendance`
    --
    ALTER TABLE `attendance`
      ADD UNIQUE KEY `unique_index` (`Cnic`,`Date`),
      ADD KEY `on emp table` (`Cnic`);

    --
    -- Indexes for table `bill`
    --
    ALTER TABLE `bill`
      ADD PRIMARY KEY (`BillId`),
      ADD KEY `on order table` (`OrderId`),
      ADD KEY `bill_ibfk_1` (`MenuId`);

    --
    -- Indexes for table `customer`
    --
    ALTER TABLE `customer`
      ADD PRIMARY KEY (`MobileNumber`),
      ADD UNIQUE KEY `Id` (`Id`);

    --
    -- Indexes for table `customercomplaint`
    --
    ALTER TABLE `customercomplaint`
      ADD PRIMARY KEY (`Id`),
      ADD KEY `on custom table` (`MobileNumber`);

    --
    -- Indexes for table `customerorder`
    --
    ALTER TABLE `customerorder`
      ADD PRIMARY KEY (`OrderId`),
      ADD KEY `customerM` (`MobileNumber`);

    --
    -- Indexes for table `employee`
    --
    ALTER TABLE `employee`
      ADD PRIMARY KEY (`Cnic`);

    --
    -- Indexes for table `employeesalery`
    --
    ALTER TABLE `employeesalery`
      ADD PRIMARY KEY (`Id`),
      ADD KEY `emp cnic` (`Cnic`);

    --
    -- Indexes for table `expenditure`
    --
    ALTER TABLE `expenditure`
      ADD PRIMARY KEY (`ExpId`),
      ADD KEY `inventory` (`ItemNumber`);

    --
    -- Indexes for table `favdish`
    --
    ALTER TABLE `favdish`
      ADD KEY `Num` (`Num`),
      ADD KEY `favdishToMenu` (`DishId`);

    --
    -- Indexes for table `inventory`
    --
    ALTER TABLE `inventory`
      ADD PRIMARY KEY (`ItemNumber`);

    --
    -- Indexes for table `job_role`
    --
    ALTER TABLE `job_role`
      ADD PRIMARY KEY (`roleid`);

    --
    -- Indexes for table `login`
    --
    ALTER TABLE `login`
      ADD PRIMARY KEY (`Id`),
      ADD KEY `on mobile` (`Mnumber`);

    --
    -- Indexes for table `menu`
    --
    ALTER TABLE `menu`
      ADD PRIMARY KEY (`MenuId`);

    --
    -- AUTO_INCREMENT for dumped tables
    --

    --
    -- AUTO_INCREMENT for table `bill`
    --
    ALTER TABLE `bill`
      MODIFY `BillId` int(11) NOT NULL AUTO_INCREMENT;
    --
    -- AUTO_INCREMENT for table `customer`
    --
    ALTER TABLE `customer`
      MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
    --
    -- AUTO_INCREMENT for table `customercomplaint`
    --
    ALTER TABLE `customercomplaint`
      MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
    --
    -- AUTO_INCREMENT for table `customerorder`
    --
    ALTER TABLE `customerorder`
      MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT;
    --
    -- AUTO_INCREMENT for table `employeesalery`
    --
    ALTER TABLE `employeesalery`
      MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
    --
    -- AUTO_INCREMENT for table `expenditure`
    --
    ALTER TABLE `expenditure`
      MODIFY `ExpId` int(11) NOT NULL AUTO_INCREMENT;
    --
    -- AUTO_INCREMENT for table `inventory`
    --
    ALTER TABLE `inventory`
      MODIFY `ItemNumber` int(11) NOT NULL AUTO_INCREMENT;
    --
    -- AUTO_INCREMENT for table `job_role`
    --
    ALTER TABLE `job_role`
      MODIFY `roleid` int(11) NOT NULL AUTO_INCREMENT;
    --
    -- AUTO_INCREMENT for table `login`
    --
    ALTER TABLE `login`
      MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
    --
    -- AUTO_INCREMENT for table `menu`
    --
    ALTER TABLE `menu`
      MODIFY `MenuId` int(11) NOT NULL AUTO_INCREMENT;
    --
    -- Constraints for dumped tables
    --

    --
    -- Constraints for table `attendance`
    --
    ALTER TABLE `attendance`
      ADD CONSTRAINT `on emp table` FOREIGN KEY (`Cnic`) REFERENCES `employee` (`Cnic`) ON DELETE CASCADE ON UPDATE CASCADE;

    --
    -- Constraints for table `bill`
    --
    ALTER TABLE `bill`
      ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`MenuId`) REFERENCES `menu` (`MenuId`) ON DELETE CASCADE ON UPDATE CASCADE,
      ADD CONSTRAINT `on order table` FOREIGN KEY (`OrderId`) REFERENCES `customerorder` (`OrderId`) ON DELETE CASCADE ON UPDATE CASCADE;

    --
    -- Constraints for table `customercomplaint`
    --
    ALTER TABLE `customercomplaint`
      ADD CONSTRAINT `on custom table` FOREIGN KEY (`MobileNumber`) REFERENCES `customer` (`MobileNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

    --
    -- Constraints for table `customerorder`
    --
    ALTER TABLE `customerorder`
      ADD CONSTRAINT `customerM` FOREIGN KEY (`MobileNumber`) REFERENCES `customer` (`MobileNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

    --
    -- Constraints for table `employeesalery`
    --
    ALTER TABLE `employeesalery`
      ADD CONSTRAINT `emp cnic` FOREIGN KEY (`Cnic`) REFERENCES `employee` (`Cnic`) ON DELETE CASCADE ON UPDATE CASCADE;

    --
    -- Constraints for table `expenditure`
    --
    ALTER TABLE `expenditure`
      ADD CONSTRAINT `inventory` FOREIGN KEY (`ItemNumber`) REFERENCES `inventory` (`ItemNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

    --
    -- Constraints for table `favdish`
    --
    ALTER TABLE `favdish`
      ADD CONSTRAINT `favdishToMenu` FOREIGN KEY (`DishId`) REFERENCES `menu` (`MenuId`) ON DELETE SET NULL ON UPDATE CASCADE,
      ADD CONSTRAINT `favdish_ibfk_1` FOREIGN KEY (`Num`) REFERENCES `customer` (`MobileNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

    /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
    /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
    /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
