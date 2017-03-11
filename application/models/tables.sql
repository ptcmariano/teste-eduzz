CREATE TABLE `TProjetos` (
`prj_cod` INT NOT NULL AUTO_INCREMENT,
`prj_nome` VARCHAR(250) NULL,
`prj_descricao` VARCHAR(250) NULL,
`prj_deleted` INT NULL,
PRIMARY KEY (`prj_cod`));

CREATE TABLE IF NOT EXISTS `TRecurso` (
  `rcs_id` int(11) NOT NULL AUTO_INCREMENT,
  `rcs_nome` varchar(255) NOT NULL,
  `rcs_telefone` varchar(50) NOT NULL,
  `rcs_email` varchar(100) NOT NULL,
  PRIMARY KEY (`rcs_id`)
);

CREATE TABLE IF NOT EXISTS `TRecursoConhecimento` (
  `rc_id` int(11) NOT NULL AUTO_INCREMENT,
  `rcs_id` int(11) NOT NULL,
  `rc_conhecimento` varchar(255) NOT NULL,
  PRIMARY KEY (`rc_id`)
);
