CREATE DATABASE IF NOT EXISTS LaravelMaster;
USE LaravelMaster;

CREATE TABLE IF NOT EXISTS Users(
id                  int(255) auto_increment not null,
role                varchar(20),
name                varchar(100),
surname             varchar(200),
nick                varchar(100),
email               varchar(255),
password            varchar(255),
image               varchar(255),
created_at          datetime,
updated_at           datetime,
remember_token      varchar(255),
CONSTRAINT pK_Users PRIMARY KEY(id)    
)ENGINE=InnoDb;

INSERT INTO Users VALUES(
null,
'User',
'Javier',
'Hernandez',
'EzclavoModerno',
'cuentasirvejavier@gmail.com',
'1234',
null,
CURTIME(),
CURTIME(),
NULL
);
INSERT INTO Users VALUES(
null,
'User',
'Jose',
'Hernandez',
'pablito',
'pablito@gmail.com',
'1234',
null,
CURTIME(),
CURTIME(),
NULL
);
INSERT INTO Users VALUES(
null,
'User',
'Alan',
'Gonzales',
'Chefsito',
'chefsito@gmail.com',
'1234',
null,
CURTIME(),
CURTIME(),
NULL
);

CREATE TABLE IF NOT EXISTS Images(
id                  int(255) auto_increment not null,
User_Id             int(255),
imagePath           varchar(255),
description         text,
created_at          datetime,
updated_at           datetime,
CONSTRAINT pk_Images PRIMARY KEY(Id),
CONSTRAINT fk_Images_Users FOREIGN KEY(User_Id) REFERENCES Users(Id)
)ENGINE=InnoDb;

INSERT INTO Images VALUES(
null,
1,
'Test.jpg',
'Imagen de Prueba',
CURTIME(),
CURTIME()
);

INSERT INTO Images VALUES(
null,
1,
'FotoPlayita.jpg',
'Aqui con la familia en la playa',
CURTIME(),
CURTIME()
);

INSERT INTO Images VALUES(
null,
2,
'Odio.jpg',
'Odio los examenes',
CURTIME(),
CURTIME()
);
INSERT INTO Images VALUES(
null,
2,
'Gym.jpg',
'Saliendo del Gym',
CURTIME(),
CURTIME()
);
INSERT INTO Images VALUES(
null,
3,
'Naruto.jpg',
'Weyyyy Quisiera ser naruto',
CURTIME(),
CURTIME()
);

CREATE TABLE IF NOT EXISTS Likes(
id                  int(255) auto_increment not null,
User_Id             int(255),
Image_Id            int(255),
created_at          datetime,
updated_at           datetime,
CONSTRAINT pk_Likes PRIMARY KEY(Id),
CONSTRAINT fk_Likes_Users FOREIGN KEY(User_Id) REFERENCES Users(Id),
CONSTRAINT fk_Likes_Images FOREIGN KEY(Image_Id) REFERENCES Images(Id) 
)ENGINE=InnoDb;

INSERT INTO Likes VALUES(
null,
2,
1,
CURTIME(),
CURTIME()
);

INSERT INTO Likes VALUES(
null,
2,
2,
CURTIME(),
CURTIME()
);

INSERT INTO Likes VALUES(
null,
1,
3,
CURTIME(),
CURTIME()
);

INSERT INTO Likes VALUES(
null,
2,
5,
CURTIME(),
CURTIME()
);

INSERT INTO Likes VALUES(
null,
3,
2,
CURTIME(),
CURTIME()
);

INSERT INTO Likes VALUES(
null,
3,
2,
CURTIME(),
CURTIME()
);

INSERT INTO Likes VALUES(
null,
1,
3,
CURTIME(),
CURTIME()
);

INSERT INTO Likes VALUES(
null,
3,
3,
CURTIME(),
CURTIME()
);



CREATE TABLE IF NOT EXISTS Comments(
id                  int(255) auto_increment not null,
User_Id             int(255),
Image_Id            int(255),
content             text,
created_at          datetime,
updated_at           datetime,
CONSTRAINT pk_Comments PRIMARY KEY(Id),
CONSTRAINT fk_Comments_Users FOREIGN KEY(User_Id) REFERENCES Users(Id),
CONSTRAINT fk_Comments_Images FOREIGN KEY(Image_Id) REFERENCES Images(Id)
)ENGINE=InnoDb;

INSERT INTO Comments VALUES(
null,
2,
1,
'Como que de Prueba que quieres Probar',
CURTIME(),
CURTIME()
);

INSERT INTO Comments VALUES(
null,
1,
2,
'Oye Calmate',
CURTIME(),
CURTIME()
);

INSERT INTO Comments VALUES(
null,
3,
1,
'Que mala vibra tiene Pablito',
CURTIME(),
CURTIME()
);

INSERT INTO Comments VALUES(
null,
1,
5,
'Bañate Otaku Aprestoso',
CURTIME(),
CURTIME()
);

INSERT INTO Comments VALUES(
null,
3,
4,
'A perro Mamado',
CURTIME(),
CURTIME()
);

INSERT INTO Comments VALUES(
null,
1,
3,
'A bueno pa saber',
CURTIME(),
CURTIME()
);

INSERT INTO Comments VALUES(
null,
3,
2,
'Felicidades me saludas a tu mama',
CURTIME(),
CURTIME()
);