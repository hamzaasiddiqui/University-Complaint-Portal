CREATE TABLE "user"
(
    userID int not null unique,
    user_email    varchar(20) not null unique ,
    user_name     varchar(20) not null,
    user_password varchar(20) not null,

    CONSTRAINT userID_pk PRIMARY KEY (userID)
);

CREATE TABLE student
(
    stu_ID int not null unique,
    batch int not null,
    faculty varchar(10) not null,
    "program" varchar(30) not null,
    hostel int not null,
    room int not null,

    CONSTRAINT stu_ID_pk PRIMARY KEY (stu_ID),
    CONSTRAINT stu_ID_fk FOREIGN KEY (stu_ID) REFERENCES "user"(userID)
);

CREATE TABLE faculty_member
(
    faculty_ID int not null unique,
    faculty varchar(10) not null,
    occupation varchar(20) not null,
    office varchar(30),

    CONSTRAINT faculty_ID_pk PRIMARY KEY (faculty_ID),
    CONSTRAINT faculty_ID_fk FOREIGN KEY (faculty_ID) REFERENCES "user"(userID)
);

CREATE TABLE labourer
(
    labour_ID int not null unique,
    faculty varchar(10) not null,
    hostel int,
    service varchar(30) not null,

    CONSTRAINT labourer_ID_pk PRIMARY KEY (labour_ID),
    CONSTRAINT labour_ID_fk FOREIGN KEY (labour_ID) REFERENCES "user"(userID)
);

CREATE TABLE complaint
(
    complaint_ID int not null unique,
    issue_date date not null,
    resolve_date date not null,
    complaint_type varchar(30) not null,
    description varchar(50) not null,
    lodger_ID int not null unique,

    CONSTRAINT complaint_ID_pk PRIMARY KEY (complaint_ID),
    CONSTRAINT lodger_ID_fk FOREIGN KEY (lodger_ID) REFERENCES "user"(userID)
);

CREATE TABLE respondent
(
    respondent_ID int not null unique,
    respondent_email varchar(20) not null unique,
    respondent_password varchar(20) not null,
    respondent_name varchar(20) not null,
    assigned_complaint int not null,

    CONSTRAINT respondent_ID_name_pk PRIMARY KEY (respondent_ID, respondent_name),
    CONSTRAINT assigned_complaint FOREIGN KEY (assigned_complaint) REFERENCES complaint(complaint_ID)
);

CREATE TABLE admin
(
    admin_ID int not null unique,
    admin_email varchar(20) not null unique,
    admin_password varchar(20) not null,
    complaint_ID int not null,
    res_email varchar(20) not null,

    CONSTRAINT admin_ID_complaint_ID_pk PRIMARY KEY (admin_ID, complaint_ID),
    CONSTRAINT respondent_email_fk FOREIGN KEY (res_email) REFERENCES respondent(respondent_email)
);

CREATE TABLE resolves
(
    res_ID int not null,
    complaint_ID int not null,
    status varchar(20) not null,

    CONSTRAINT res_ID_complain_ID_pk PRIMARY KEY (res_ID, complaint_ID),
    CONSTRAINT res_ID_fk FOREIGN KEY (res_ID) REFERENCES respondent(respondent_ID),
    CONSTRAINT complaint_ID_fk FOREIGN KEY (complaint_ID) REFERENCES complaint(complaint_ID)
);
