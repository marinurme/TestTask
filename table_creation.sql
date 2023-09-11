create table patient
(
    _id   int(10) unsigned not null auto_increment,
    pn    varchar(11) default null,
    first varchar(15) default null,
    last  varchar(25) default null,
    dob   date        default null,
    primary key (_id)
);

create table insurance
(
    _id        int(10) unsigned not null auto_increment,
    patient_id int(10) unsigned not null,
    iname      varchar(40) default null,
    from_date  date        default null,
    to_date    date        default null,
    primary key (_id),
    foreign key (patient_id) references patient (_id)
);

insert into patient (_id, pn, first, last, dob)
values (default, '000000001', 'John', 'Smith', '1980-07-01');
insert into patient (_id, pn, first, last, dob)
values (default, '000000002', 'James', 'Miller', '1976-09-01');
insert into patient (_id, pn, first, last, dob)
values (default, '000000003', 'Mary', 'Johnson', '1950-10-01');
insert into patient (_id, pn, first, last, dob)
values (default, '000000004', 'Anna', 'Jones', '1999-12-01');
insert into patient (_id, pn, first, last, dob)
values (default, '000000005', 'Hugh', 'Brown', '1964-11-01');

insert into insurance (_id, patient_id, iname, from_date, to_date)
values (default, 1, 'Medicare', '2009-01-01', '2010-01-01');
insert into insurance (_id, patient_id, iname, from_date, to_date)
values (default, 1, 'Blue Cross', '2011-01-01', '2012-01-01');
insert into insurance (_id, patient_id, iname, from_date, to_date)
values (default, 2, 'Medicaid', '2009-01-01', '2010-01-01');
insert into insurance (_id, patient_id, iname, from_date, to_date)
values (default, 2, 'Blue Shiel', '2011-01-01', '2012-01-01');
insert into insurance (_id, patient_id, iname, from_date, to_date)
values (default, 3, 'Medicare', '2009-01-01', '2010-01-01');
insert into insurance (_id, patient_id, iname, from_date, to_date)
values (default, 3, 'Blue Cross', '2011-01-01', '2012-01-01');
insert into insurance (_id, patient_id, iname, from_date, to_date)
values (default, 4, 'Medicaid', '2009-01-01', '2010-01-01');
insert into insurance (_id, patient_id, iname, from_date, to_date)
values (default, 4, 'Blue Shield', '2011-01-01', '2012-01-01');
insert into insurance (_id, patient_id, iname, from_date, to_date)
values (default, 5, 'Medicare', '2009-01-01', '2010-01-01');
insert into insurance (_id, patient_id, iname, from_date, to_date)
values (default, 5, 'Blue Cross', '2011-01-01', '2012-01-01');
