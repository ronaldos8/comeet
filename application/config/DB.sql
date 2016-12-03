create database project_comeet;

use project_comeet;

create table Personnel(
	p_id int primary key auto_increment,
	p_name varchar(20) not null,
	p_type varchar(15)
);

create table Meeting(
	m_id int primary key auto_increment,
	m_name varchar(30) not null,
	m_desc longtext not null,
	venue varchar(30) not null,
	start_period date not null,
	end_period date not null,
	n_accomodate varchar(20)
);
alter table Meeting add column (duration int not null);

create table Meeting_Role(
	mr_id int primary key auto_increment,
	mr_name varchar(20) not null,
	pro_quo int not null
);
alter table Meeting_Role add column (m_id int not null);
alter table Meeting_Role add column (foreign key (m_id) references Meeting(m_id));

create table Personnel_Role(
	pr_id int primary key auto_increment,
	mr_id int not null,
	p_id int not null,
	foreign key (mr_id) references Meeting_Role(mr_id),
	foreign key (p_id)  references Personnel(p_id)
);
alter table Personnel_Role add column(pr_availability int null);
alter table Personnel_Role add column(pr_utility int null);
alter table Personnel_Role add column(pr_pivot int null);

create table Slot(
	slot_id int primary key auto_increment,
	row int not null,
	col int not null,
	desc_time varchar(20) not null
);

create table Timetable(
	t_id int primary key auto_increment,
	m_id int not null,
	slot_id int not null,
	foreign key (m_id) references Meeting(m_id),
	foreign key (slot_id) references Slot(slot_id)
);

create table calendar(
	c_id int primary key auto_increment,
	p_id int not null,
	m_id int not null,
	start_time varchar(5) not null,
	end_time varchar(5) not null,
	foreign key (p_id) references Personnel(p_id),
	foreign key (m_id) references Meeting(m_id)
);