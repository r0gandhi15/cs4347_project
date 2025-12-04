LOAD DATA INFILE 'C:/xampp/htdocs/cs4347_project/sql/Publisher.csv'
INTO TABLE Publisher
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(p_name,address,phone);
LOAD DATA INFILE 'C:/xampp/htdocs/cs4347_project/sql/Book.csv'
INTO TABLE Book
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(book_id, title, isbn, genre, publication_date, @p_name)
SET p_name = TRIM(@p_name);
LOAD DATA  INFILE 'C:/xampp/htdocs/cs4347_project/sql/Author.csv'
INTO TABLE Author
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(book_id,a_name);
LOAD DATA INFILE 'C:/xampp/htdocs/cs4347_project/sql/Member.csv'
INTO TABLE Member
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(member_id,fname,lname,dob,address,phone,email);
LOAD DATA INFILE 'C:/xampp/htdocs/cs4347_project/sql/Loan.csv'
INTO TABLE Loan
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(loan_id,member_id,date_out,due_date,return_date,fee);
LOAD DATA INFILE 'C:/xampp/htdocs/cs4347_project/sql/LoanItem.csv'
INTO TABLE LoanItem
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(loan_id,book_id,quantity);

