/*==============================================================*/
/*         QCMaster : SQL Script for Database Creation          */
/*                     (SGBD :  MySQL 5.0)                      */
/*==============================================================*/


/*==============================================================*/
/* TABLES CLEANING                                              */
/*==============================================================*/
DROP TABLE IF EXISTS pwsb_Blogpost;
DROP TABLE IF EXISTS pwsb_Comment;
#DROP TABLE IF EXISTS pwsb_User;


/*==============================================================*/
/* TABLE CREATION : pwsb_Blogpost                               */
/*==============================================================*/
CREATE TABLE pwsb_Blogpost
(
    id          INT NOT NULL AUTO_INCREMENT,
    date        DATETIME NOT NULL,
    title       VARCHAR(150) NOT NULL,
    content     VARCHAR(5000) NOT NULL,
    image       VARCHAR(250),
    
    PRIMARY KEY (id)
)
ENGINE=InnoDB
CHARACTER SET utf8
COLLATE utf8_bin;


/*==============================================================*/
/* TABLE CREATION : pwsb_Comment                                */
/*==============================================================*/
CREATE TABLE pwsb_Comment
(
    id          INT NOT NULL AUTO_INCREMENT,
    id_post     INT NOT NULL,
    date        DATETIME NOT NULL,
    content     VARCHAR(240) NOT NULL,
    
    PRIMARY KEY (id)
)
ENGINE=InnoDB
CHARACTER SET utf8
COLLATE utf8_bin;


/*==============================================================*/
/* ADDING CONSTRAINTS (FOREIGN KEYS)                            */
/*==============================================================*/

ALTER TABLE pwsb_Comment ADD CONSTRAINT FK_PostComments foreign KEY (id_post)
      REFERENCES pwsb_Blogpost(id) on delete restrict on update restrict;
	  
#alter TABLE qcmaster_Question ADD CONSTRAINT FK_QuestionQCM foreign KEY (id_QCM)
#      references qcmaster_QCM (id) on delete restrict on update restrict;
	  
#alter TABLE qcmaster_Answer ADD CONSTRAINT FK_AnswerQuestion foreign KEY (id_question)
#      references qcmaster_Question (id) on delete restrict on update restrict;
	  

/*==============================================================*/
/* INSERTING DEFAULT/TEST VALUES                                */
/*==============================================================*/

/* Let's create two Blogposts here */
INSERT INTO pwsb_Blogpost (date, title, content, image) VALUES
('2016-01-01 18:05:00','Ouverture du Blog !', "
Bienvenue à tous, le Blog est désormais ouvert ! N'hésitez pas à commenter mes articles :D
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc cursus, leo vitae congue ullamcorper, diam risus mattis justo, eget blandit sem ligula vehicula odio. Suspendisse nec enim nec erat dapibus porttitor. Nam sed ex orci. In scelerisque maximus viverra. Phasellus eu lectus pharetra, pulvinar sapien non, rhoncus purus. Sed vitae metus et lacus ultricies lobortis vel eu erat. Integer eget malesuada lorem, id vehicula erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus tincidunt, sem gravida suscipit gravida, leo erat luctus lectus, id finibus nibh ex vel risus. Fusce et ligula iaculis, dapibus neque id, tristique massa. Morbi nec imperdiet augue. Quisque mattis nibh eu pellentesque mattis. Nunc ornare, eros ut placerat bibendum, odio dui vestibulum ex, quis mattis sem libero sed tellus. Etiam tincidunt imperdiet mi, at rhoncus erat mollis sed. Etiam in ex ac neque venenatis efficitur. Vestibulum tincidunt augue eu lorem aliquam posuere.
Sed euismod urna nunc, id convallis nisl mollis eu. Proin ultrices feugiat nisl vel mattis. Ut eget gravida quam. Sed tincidunt arcu quis bibendum dictum. Nulla porta elit nec libero faucibus suscipit. Etiam et ullamcorper purus. Morbi ut fermentum leo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent auctor vulputate sodales. Praesent faucibus bibendum volutpat. Integer bibendum arcu ut laoreet pharetra. Nam eget urna quis neque vulputate pulvinar. Maecenas massa magna, laoreet nec volutpat ac, tincidunt id nisi.
", ""),

('2017-12-24 15:30:00','Les Licornes', "
Article sur les licornes et leur existence prouvée
Aliquam pharetra tellus purus, in varius diam aliquam non. Phasellus tempus tincidunt dignissim. Aliquam at erat a sem malesuada egestas. Integer eros nulla, porttitor vitae pretium vel, accumsan vel nisl. Morbi convallis dui in diam eleifend consectetur. Duis sit amet erat nibh. Sed et neque vel mauris aliquam ornare ut nec elit. In venenatis sed massa nec tincidunt. Pellentesque id nulla eget massa dignissim bibendum pharetra vitae mauris. Morbi viverra malesuada nisi, in porta nisi porta in. Cras lectus orci, luctus eu fringilla ac, pulvinar sed lectus. Donec lobortis imperdiet justo, eget semper justo pellentesque nec. Sed accumsan vitae risus nec fringilla. Maecenas ut orci ac turpis ultrices posuere. Integer augue sapien, ornare at fermentum a, rhoncus ut leo.
Vestibulum sagittis orci sed lectus consectetur gravida. Aliquam pharetra faucibus dolor. Suspendisse vulputate, nulla non egestas convallis, nibh ipsum congue nisl, ac pulvinar sapien eros vel dolor. Pellentesque bibendum malesuada pellentesque. Vivamus vitae eleifend lectus. Integer sed nulla non tellus dapibus pulvinar. Nam id leo neque. Cras aliquam sit amet arcu id elementum. Duis vitae erat quis ante aliquam pulvinar. Pellentesque in quam mauris. Morbi feugiat condimentum blandit. Praesent in tempus diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis pretium porta risus id pretium. Phasellus quis viverra massa, at volutpat sem. Nulla ut est sed quam laoreet placerat vitae sit amet tellus.
", "");

/* Let's create four Comments here */
INSERT INTO pwsb_Comment (id_post, date, content) VALUES
(1,'2016-01-01 00:32:02','Génial, un nouveau blog !'),
(1,'2016-02-01 14:24:40','Encore un blog voué à l\'échec...'),
(2,'2017-12-25 00:30:06','Je n\'y crois, Monsieur, vous êtes un Charlatan ! Joyeux Noël tout de même.'),
(2,'2017-12-24 18:30:20','J\'en ai vu une hier :O :D');

/* Let's create two Teachers here */
#INSERT INTO qcmaster_Teacher (email, firstname, lastname, password) VALUES
#('bruno.tellez@univ-lyon1.fr','Bruno','Tellez','BTe'), #This Teacher will automatically get the ID 1
#('hubert.delabath@oss117.fr','Hubert','Bonisseur de La Bath','OSS 117'); #This Teacher will automatically get the ID 2