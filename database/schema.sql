create table if not exists users (
  id int(11) not null auto_increment,
  name varchar(100) not null,
  picture varchar(200),
  address text,
  primary key (id)
);
