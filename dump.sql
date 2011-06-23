SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cmsdev_account` (
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`username`)
);
SET character_set_client = @saved_cs_client;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cmsdev_admin` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);
SET character_set_client = @saved_cs_client;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cmsdev_comment` (
  `id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `adddate` datetime NOT NULL,
  PRIMARY KEY (`id`)
);
SET character_set_client = @saved_cs_client;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cmsdev_config` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `main_img` varchar(255) NOT NULL,
  `copyright` text NOT NULL,
  `adddate` datetime NOT NULL,
  `moddate` datetime NOT NULL,
  PRIMARY KEY (`id`)
);
SET character_set_client = @saved_cs_client;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cmsdev_entry` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `adddate` datetime NOT NULL,
  `moddate` datetime NOT NULL,
  PRIMARY KEY (`id`)
);
SET character_set_client = @saved_cs_client;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cmsdev_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
SET character_set_client = @saved_cs_client;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cmsdev_page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `parent_id` int(11) NOT NULL,
  `adddate` datetime NOT NULL,
  `moddate` datetime NOT NULL,
  PRIMARY KEY (`id`)
);
SET character_set_client = @saved_cs_client;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cmsdev_session` (
  `session_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`session_id`)
);
SET character_set_client = @saved_cs_client;
