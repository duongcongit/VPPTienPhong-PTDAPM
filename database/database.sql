/* ========= SQL Query for create table ========= */
-- Custommer
CREATE TABLE customers (
    customerID int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    fullname varchar(255) NOT NULL,
    address varchar(255) NOT NULL,
    phone varchar(20) NOT NULL,
    email varchar(255) NOT NULL,
    username varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    status int NOT NULL,
    token varchar(255)
);

-- Employee
CREATE TABLE employees (
    employeeID int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    fullname varchar(255) NOT NULL,
    gender varchar(255) NOT NULL,
    address varchar(255) NOT NULL,
    phone varchar(20) NOT NULL,
    email varchar(255) NOT NULL,
    username varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    status int NOT NULL
);

-- Admin
CREATE TABLE admins (
    adminID int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    adminName varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    username varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL
);

-- Category
CREATE TABLE categories (
    categoryID varchar(30) PRIMARY KEY NOT NULL,
    name varchar(255) NOT NULL
);

-- Supplier
CREATE TABLE suppliers (
    supplierID int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    supplierName varchar(255) NOT NULL,
    address varchar(255) NOT NULL,
    phone varchar(20) NOT NULL,
    email varchar(255) NOT NULL
);

-- Product
CREATE TABLE products (
    productID varchar(10) PRIMARY KEY NOT NULL,
    productName varchar(255) NOT NULL, 
    detail varchar(3000) NOT NULL,
    stock int(20) NOT NULL,
    sold int(20) NOT NULL,
    price int(20) NOT NULL,
    status int(5) NOT NULL,
    categoryID varchar(30) NOT NULL,
    supplierID int NOT NULL,
    FOREIGN KEY (categoryID) REFERENCES categories(categoryID),
    FOREIGN KEY (supplierID) REFERENCES suppliers(supplierID)
);

-- Product images
CREATE TABLE product_image (
    imageID varchar(255) PRIMARY KEY NOT NULL,
    imageURL varchar(1000) NOT NULL,
    productID varchar(10) NOT NULL,
    FOREIGN KEY (productID) REFERENCES products(productID)
);

-- Cart
CREATE TABLE cart (
	customerID int NOT NULL,
    productID varchar(10) NOT NULL,
    quantity int NOT NULL,
    timeAdd DATETIME NOT NULL,
    PRIMARY KEY(customerID, productID),
    FOREIGN KEY (customerID) REFERENCES customers(customerID),
    FOREIGN KEY (productID) REFERENCES products(productID)
);

-- Receipt
CREATE TABLE receiptP (
    receiptPID int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    customerID int NOT NULL,
    employeeID int,
    timeBuy DATETIME NOT NULL,
    paymentMethod int NOT NULL,
    consigneeName varchar(255) NOT NULL,
    phoneNumber varchar(20) NOT NULL,
    deliveryAddress varchar(255) NOT NULL,
    statusR int NOT NULL,
    FOREIGN KEY (customerID) REFERENCES customers(customerID)
);

-- Detail Receipt
CREATE TABLE detailReceiptP (
    receiptPID int NOT NULL,
    productID varchar(10) NOT NULL,
    price int(20) NOT NULL,
    quantityBuy int(20) NOT NULL,
    total int(30) NOT NULL,
    PRIMARY KEY(receiptPID, productID),
    FOREIGN KEY (receiptPID) REFERENCES receiptP(receiptPID),
    FOREIGN KEY (productID) REFERENCES products(productID)
);

