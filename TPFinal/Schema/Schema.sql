/*DROP DATABASE MOVIEPASSDB;*/

CREATE DATABASE MOVIEPASSDB;

USE MOVIEPASSDB;

create table Countries (
    IdCountry int AUTO_INCREMENT,
    CountryName varchar(50) not null UNIQUE,
    CountryCode varchar(10) not null UNIQUE,
    constraint Pk_Countries primary key (IdCountry)
);

create table States (
    IdState int AUTO_INCREMENT,
    StateName varchar(50) not null,
    IdCountry int not null,
    constraint Pk_States primary key (IdState),
    constraint Fk_Country foreign key (IdCountry)
        references Countries (IdCountry)
);

create table Cities (
    IdCity int AUTO_INCREMENT,
    CityName varchar(50) not null,
    ZipCode int not null,
    IdState int not null,
    constraint Pk_Cities primary key (IdCity),
    constraint Fk_State foreign key (IdState)
        references States (IdState)
);

create table Addresses (
    IdAddress int AUTO_INCREMENT,
    Street varchar(100) not null,
    NumberStreet int not null,
    Department varchar(10),
    DepartmentFloor SmallInt,
    IdCity int not null,
    constraint Pk_Addresses primary key (IdAddress),
    constraint Fk_Cities foreign key (IdCity)
        references Cities (IdCity)
);

create table Cinemas (
    IdCinema int AUTO_INCREMENT,
    CinemaName varchar(50) not null,
    IdAddress int not null,
    constraint Pk_Cinema primary key (IdCinema),
    constraint Fk_Address foreign key (IdAddress)
        references Addresses (IdAddress)
);

create table NonWorkDays (
    IdNonWorkDay int AUTO_INCREMENT,
    DateNonWorkDay date not null,
    Reason varchar(300) not null,
    constraint Pk_NonWorkDays primary key (IdNonWorkDay)
);

create table NonWorkDaysXCinemas (
    IdNonWorkDay int not null,
    IdCinema int not null,
    constraint Pk_NonWorkDaysXCinemas primary key (IdNonWorkDay , IdCinema),
    constraint Fk_NonWorkDays foreign key (IdNonWorkDay)
        references NonWorkDays (IdNonWorkDay),
    constraint Fk_Cinema foreign key (IdCinema)
        references Cinemas (IdCinema)
);

create table Clasifications (
    IdClasification int AUTO_INCREMENT,
    ClasificationCode varchar(20),
    Description varchar(200),
    constraint Pk_Clasifications primary key (IdClasification)
);

create table Directors (
    IdDirector int,
    DirectorName varchar(50) not null,
    BirthDate date not null,
    IdCountry int not null,
    constraint Pk_Directors primary key (IdDirector),
    constraint Fk_Country foreign key (IdCountry)
        references Countries (IdCountry)
);

create table Genders (
    IdGender int AUTO_INCREMENT,
    GenderName varchar(50) not null,
    constraint Pk_Genders primary key (IdGender)
);

create table MoviesXGender (
    IdMovie int,
    IdGender int,
    constraint Pk_MoviesXGender primary key (IdMovie , IdGender),
    constraint Fk_Movie foreign key (IdMovie)
        references Movies (IdMovie),
    constraint Fk_Gender foreign key (IdGender)
        references Genders (IdGender)
);

create table Actors (
    IdActor int AUTO_INCREMENT,
    ActorFirstName varchar(30) not null,
    ActorLastName varchar(30) not null,
    BirthDate Date,
    Photo text,
    IdCountry int,
    IdGender int not null,
    constraint Pk_Actors primary key (IdActor),
    constraint Fk_Country foreign key (IdCountry)
        references Countries (IdCountry),
    constraint Fk_Gender foreign key (IdGender)
        references Genders (IdGender)
);

create table MoviesXActor (
    IdMovie int,
    IdActor int,
    constraint Pk_MoviesXActor primary key (IdMovie , IdActor),
    constraint Fk_Movie foreign key (IdMovie)
        references Movies (IdMovie),
    constraint Fk_Actor foreign key (IdActor)
        references Actors (IdActor)
);

create table Movies (
    IdMovie int AUTO_INCREMENT,
    IdMovieIMDB int,
    MovieName varchar(250) not null,
    Duration int,
    Synopsis varchar(800),
    ReleaseDate date,
    Photo varchar(200) DEFAULT null,
    /*IdDirector int not null,
    IdCountry int,*/
    Earnings decimal(15 , 2 ),
    Budget decimal(15 , 2 ),
    OriginalLanguage varchar(30),
    IsPlaying boolean,
    constraint Pk_Movies primary key (IdMovie)

);

create table Rooms (
    IdRoom int AUTO_INCREMENT,
    RoomNumber int not null,
    CinemaId int NOT NULL,
    constraint PK_Rooms primary key (IdRoom),
    constraint Fk_Cinema foreign key (CinemaId)
        references Cinemas (IdCinema)
);

create table Users (
    IdUser int AUTO_INCREMENT,
    UserName varchar(50) not null,
    Email varchar(50) not null UNIQUE,
    UserPassword varchar(50) not null,
    IdGender int not null,
	Photo varchar(250),
    Birthdate date,
	IsAdmin bit,
	ChangedPassword bit,
    constraint Pk_Users primary key (IdUser),
    constraint Fk_UsersxGender foreign key (IdGender)
        references Genders (IdGender)
);

/*Agregarle check para que solo acepte 2d y 3d*/
create table Dimensions (
    IdDimension int AUTO_INCREMENT,
    Dimension varchar(2) not null UNIQUE,
    constraint Pk_Dimensions primary key (IdDimension),
    constraint Chk_Dimension check (DimensionDescrip = '3D'
        OR DimensionDescrip = '2D')
);

create table Languages (
    IdLanguage int AUTO_INCREMENT,
    CodLanguage varchar(10) not null UNIQUE,
    Description varchar(50) not null UNIQUE,
    constraint Pk_Languages primary key (IdLanguage)
);

create table Screenings (
    IdScreening int AUTO_INCREMENT,
    IdMovieIMDB int not null,
	IdMovie int,
    StartDate datetime not null,
    LastDate datetime not null,
    StartHour varchar(10) not null,
    FinishHour datetime not null,
    Price decimal,
    IdRoom int not null,
    IdCinema int not null,
    Subtitles int,
    Audio int not null,
    Dimension int not null,
    constraint Pk_Screenings primary key (IdScreening),
    constraint Fk_Movie foreign key (IdMovieIMDB)
        references Movies (IdMovieIMDB),
    constraint Fk_Room foreign key (IdRoom)
        references Rooms (IdRoom),
    constraint Fk_Cinema foreign key (IdCinema)
        references Cinemas (IdCinema)
);

create table Seats (
    IdRoom int,
    SeatRow int,
    SeatCol int,
    constraint Pk_Seats primary key (IdRoom , SeatRow , SeatCol),
    constraint Fk_Room foreign key (IdRoom)
        references Rooms (IdRoom)
);

create table Orders (
    IdOrder int AUTO_INCREMENT,
    SubTotal decimal(10 , 2 ),
    Total decimal(10 , 2 ),
    DatePurchase datetime not null,
    Discount decimal(6 , 2 ),
    IdUser int not null,
    IdScreening int not null,
    constraint Pk_Orders primary key (IdOrder),
    constraint Fk_User foreign key (IdUser)
        references Users (IdUser),
    constraint Fk_Screening foreign key (IdScreening)
        references Screenings (IdScreening)
);

create table Combos (
    IdCombo int AUTO_INCREMENT,
    ComboName varchar(50) not null UNIQUE,
    Price decimal(10 , 2 ),
    Description varchar(500),
    IdOrder int not null,
    constraint Pk_Combos primary key (IdCombo),
    constraint Fk_Order foreign key (IdOrder)
        references Orders (IdOrder)
);

create table ItemsCombo (
    IdItem int AUTO_INCREMENT,
    ItemName varchar(50) not null UNIQUE,
    Photo text,
    IdCombo int not null,
    constraint Pk_ItemsCombo primary key (IdItem),
    constraint Fk_Combo foreign key (IdCombo)
        references Combos (IdCombo)
);

/*Resolver si las foreign keys que apuntan a Seats van a terminar siendo asi*/
create table Tickets (
    IdTicket int AUTO_INCREMENT,
    Price decimal(10 , 2 ) not null,
    IdRoom int not null,
    IdSeatRow int not null,
    IdSeatCol int not null,
    IdOrder int not null,
    constraint Pk_Tickets primary key (IdTicket),
    constraint Fk_TicketRoom foreign key (IdRoom)
        references Seats (IdRoom),
    constraint Fk_TicketSeatRow foreign key (IdSeatRow)
        references Seats (SeatRow),
    constraint Fk_Ticket foreign key (IdSeatCol)
        references Seats (SeatCol),
    constraint Fk_Order foreign key (IdOrder)
        references Orders (IdOrder)
);

DELIMITER $$

CREATE PROCEDURE GetOrdersByUser(UserId int, TodayDate Date)
BEGIN

select  
orders.idorder,
concat('$',orders.Discount) as Discount,
concat('$',orders.SubTotal) as SubTotal,
concat('$',orders.Total) as Total,
screenings.startdate,
rooms.roomnumber,
movies.moviename,
if(screenings.IdSubsLanguage is null, languages.description, concat('Sub ',languages.description)) as MovieLanguage,
dimensions.dimensiondescrip,
cinemas.cinemaname,
concat(addresses.street,' ',addresses.numberstreet) as CinemaAddress,
users.UserName
FROM orders
inner join screenings on screenings.IdScreening = orders.IdScreening
inner join rooms on screenings.IdRoom = rooms.IdRoom
inner join movies on screenings.IdMovie = movies.IdMovie
inner join languages on languages.IdLanguage = screenings.IdSubsLanguage or languages.IdLanguage = screenings.IdAudioLanguage
inner join dimensions on dimensions.IdDimension = screenings.iddimension
inner join cinemas on rooms.CinemaId = cinemas.IdCinema
inner join addresses on cinemas.IdAddress = addresses.IdAddress
inner join users on users.IdUser = orders.IdUser
WHERE (users.IdUser = UserId AND screenings.StartDate > if(TodayDate is null,'0001-01-01',TodayDate))
GROUP BY(orders.IdOrder) ORDER BY screenings.StartDate ASC;

END $$ 
DELIMITER ;

DELIMITER $$

CREATE PROCEDURE GetMoviesByCity(CityId int)
BEGIN

select movies.MovieName from movies
inner join screenings on screenings.IdMovie = movies.IdMovie 
inner join rooms on screenings.idroom = rooms.IdRoom
inner join cinemas on rooms.cinemaid = cinemas.IdCinema
inner join addresses on addresses.IdAddress = cinemas.IdAddress
inner join cities on cities.IdCity = addresses.IdCity 
where cities.idcity = 1;

END $$
DELIMITER ;

DELIMITER $$

CREATE PROCEDURE GetScreeningsByMovieAndCinema(MovieId int, CinemaId int)
BEGIN

select screenings.StartDate,screenings.price, movies.MovieName from screenings
inner join movies on screenings.IdMovie = movies.IdMovie 
inner join rooms on screenings.idroom = rooms.IdRoom
inner join cinemas on rooms.cinemaid = cinemas.IdCinema
inner join addresses on addresses.IdAddress = cinemas.IdAddress
inner join cities on cities.IdCity = addresses.IdCity 
where cities.idcity = CityId;

END $$
 
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE GetCinemasByCity(CityId int)
BEGIN

select cinemas.cinemaname,cinemas.idcinema from cinemas
inner join addresses on addresses.idaddress = cinemas.idaddress
inner join cities on cities.idcity = addresses.idcity;

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE GetMostPopularMovies()
BEGIN

select 
    count(tickets.idticket) / (select count(tickets.idticket) from tickets) * 100 as Popularity,
    movies.idmovie,
    movies.moviename,
    sum(tickets.price) as moneyCollection
from
    tickets
        inner join
    orders ON orders.idorder = tickets.idorder
        inner join
    screenings ON screenings.idscreening = orders.idscreening
        inner join
    movies ON movies.idmovie = screenings.idmovie
group by 2 , 3
order by (Popularity) desc
limit 3;

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE GetLessPopularMovies()
BEGIN

select 
    count(tickets.idticket) / (select 
            count(tickets.idticket)
        from
            tickets) * 100 as Popularity,
    movies.idmovie,
    movies.moviename,
    sum(tickets.price) as moneyCollection
from
    tickets
        inner join
    orders ON orders.idorder = tickets.idorder
        inner join
    screenings ON screenings.idscreening = orders.idscreening
        inner join
    movies ON movies.idmovie = screenings.idmovie
group by 2 , 3
order by (Popularity) asc
limit 3;

END $$
DELIMITER ;

/*Para probar el stored de estadisticas*/
insert into tickets(price,idroom,idseatrow,idseatcol,idorder) values/*(1,1,1,1,1),*/(1,1,1,1,2)/*,(1,1,1,1,3)*/;
insert into orders(subtotal,total,datepurchase,discount,iduser,idscreening) values(1,1,now(),1,1,1),(1,1,now(),1,1,2),(1,1,now(),1,1,3);
insert into screenings(idmovie,startdate,price,idroom,idsubslanguage,idaudiolanguage,iddimension) values(1,now(),1,1,1,1,1),(2,now(),1,1,1,1,1),(3,now(),1,1,1,1,1);
-- insert into movies(idmovieimdb,moviename,duration,synopsis,releasedate,photo,earnings,budget,originallanguage,isplaying) 
-- values(1,'Rambo',1,"Una peli",now(),'asd',1,1,"spanish",1),(1,'Malefica',1,"Una peli",now(),'asd',1,1,"spanish",1),
-- (1,'Duro de Matar',1,"Una peli",now(),'asd',1,1,"spanish",1);

select * from movies;
select * from screenings;
select * from tickets;
select * from orders;
select * from cities;

select * from users;

insert into cities(CityName,ZipCode,idstate) values('Mar del Plata',7600,1),('Mar Chiquita',7232,1),('Tandil',7234,1),('Olavarria',7100,1);
insert into cinemas(CinemaName,idAddress) values('Ambassador',1),('Aldrey',1),('Diagonal',1);
insert into addresses(street,numberstreet,department,departmentfloor,idcity) values('calle falsa',123,'A',1,1),('calle falsa',123,'A',1,2),('calle falsa',123,'A',1,3),
('calle falsa',123,'A',1,6),('calle falsa',123,'A',1,6),('calle falsa',123,'A',1,5),('calle falsa',123,'A',1,4);





