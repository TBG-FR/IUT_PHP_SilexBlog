/*==============================================================*/
/*         QCMaster : SQL Script for Database Creation          */
/*                     (SGBD :  MySQL 5.0)                      */
/*==============================================================*/


/*==============================================================*/
/* TABLES CLEANING                                              */
/*==============================================================*/
DROP TABLE IF EXISTS pwsb__Blogpost;
DROP TABLE IF EXISTS pwsb__Comment;
#DROP TABLE IF EXISTS pwsb__User;


/*==============================================================*/
/* TABLE CREATION : pwsb_Blogpost                               */
/*==============================================================*/
CREATE TABLE pwsb_Blogpost
(
    id          INT NOT NULL AUTO_INCREMENT,
    date        VARCHAR(12) NOT NULL,
    title       VARCHAR(150) NOT NULL,
    content     VARCHAR(5000) NOT NULL,
    image       VARCHAR(250),
    
    PRIMARY KEY (id)
)
ENGINE=InnoDB
CHARACTER SET utf8
COLLATE utf8_bin;


/*==============================================================*/
/* ADDING CONSTRAINTS (FOREIGN KEYS)                            */
/*==============================================================*/
#alter TABLE qcmaster_QCM ADD CONSTRAINT FK_QCMTeacher foreign KEY (id_teacher)
#      references qcmaster_Teacher (id) on delete restrict on update restrict;
	  
#alter TABLE qcmaster_Question ADD CONSTRAINT FK_QuestionQCM foreign KEY (id_QCM)
#      references qcmaster_QCM (id) on delete restrict on update restrict;
	  
#alter TABLE qcmaster_Answer ADD CONSTRAINT FK_AnswerQuestion foreign KEY (id_question)
#      references qcmaster_Question (id) on delete restrict on update restrict;
	  

/*==============================================================*/
/* INSERTING DEFAULT/TEST VALUES                                */
/*==============================================================*/

/* Let's create three Blogposts here */
INSERT INTO pwsb_Blogpost (date, title, content, image) VALUES
('01-01-2016','Ouverture du Blog !', "Bienvenue à tous, le Blog est désormais ouvert ! N'hésitez pas à commenter mes articles :D", ""),
('24-12-2017','Les Licornes', 'Article sur les licornes et leur existence prouvée', "");

/* Let's create two Teachers here */
#INSERT INTO qcmaster_Teacher (email, firstname, lastname, password) VALUES
#('bruno.tellez@univ-lyon1.fr','Bruno','Tellez','BTe'), #This Teacher will automatically get the ID 1
#('hubert.delabath@oss117.fr','Hubert','Bonisseur de La Bath','OSS 117'); #This Teacher will automatically get the ID 2