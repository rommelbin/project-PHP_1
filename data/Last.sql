drop database if exists new_shop;
create database if not exists new_shop;

use new_shop;
drop table if exists info_img;
create table if not exists info_img(
	id serial,
	name varchar (100),
	sizeOf bigint,
	views bigint default 0 
);

INSERT info_img (name, sizeOf, views) values 
('img.jpeg', 350, 3), ("img_2.jpg", 350, 3), ('7441имя.jpeg', 750, 10);


drop table if exists news;
create table if not exists news(
	id serial,
	title varchar (100),
	`text` text
);
INSERT news (title, `text`) values 
('Россия лучшая страна в мире', 'Россия топ-1 страна Россия топ-1 странаРоссия топ-1 странаРоссия топ-1 странаРоссия топ-1 странаРоссия топ-1 странаРоссия топ-1 страна');
drop table if exists items;
create table if not exists items(
	id serial,
	name varchar(100),
	price bigint,
	description text,
	item_img varchar(100),
	consistOf text,
	manufacturer varchar(100)
);
INSERT items (name, price, description, item_img, consistOf, manufacturer) values
('apple', 100, 'Очень вкусный ', 'apple.png', 'apple', 'Республика Беларусь'),('pizza', 250, 'Чёткая', 'pizza.png', 'pizza', 'Республика Беларусь'), ('potato', 10, 'Посади и не волнуйся!', 'potato.png', 'potato', 'Республика Беларусь');


drop table if exists reviews;
create table if not exists reviews(
	id serial,
	name varchar(100) not null,
	review text not null,
	item_id bigint unsigned not null,
	foreign key (item_id) references items(id) on update cascade on delete cascade
);
insert into reviews (name, review, item_id) values ('Данил', 'Спасибо', 1);

drop table if exists users;
CREATE TABLE `users` (
  `id` serial,
  `login` text NOT NULL,
  `pass` text NOT NULL,
  `hash` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

drop table if exists basket_items;
create table if not exists basket_items (
	id serial,
	item_id bigint unsigned not null,
	user_id bigint unsigned default null,
	session_id text not null, 
	quantity bigint unsigned default 1,
	foreign key (item_id) references items(id) on UPDATE cascade on DELETE cascade
);
drop table if exists roles;
create table if not exists roles (
	id serial,
	user_login text not null,
	user_role enum('admin', 'user', 'moderator')
);
-- Пожалуйста, сначала создайте пользователя админ, а затем пропишите ему вот эту команду в бд
-- INSERT INTO roles (user_login, user_role) values ('admin', 'admin');
-- P.S работаю в DBeaver, без понятия как здесь сделать дамп базы данных.(

