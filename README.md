# TodoList
## Description
自習で作成したtodo管理システム

## Requirement
※vagrantで開発環境構築した際の構成
* php 5.4.16
* Apache 2.4.6
* MariaDB 5.5.60
* cakephp 2.6.12

## Usage
test というデータベースを作成し、以下SQLを実行
```
CREATE TABLE `layouts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL COMMENT 'レイアウト名',
  `value` tinyint(1) DEFAULT NULL COMMENT '分割値',
  `function_type` tinyint(1) DEFAULT '0' COMMENT '機能種別',
  `created` datetime DEFAULT NULL COMMENT '登録日時',
  `modified` datetime DEFAULT NULL COMMENT '最終更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `layouts` VALUES (1,'1列',1,1,'2019-03-25 13:00:00','2019-03-25 13:00:00'),(2,'2列',2,1,'2019-03-25 13:00:00','2019-03-25 13:00:00'),(3,'3列',3,1,'2019-03-25 13:00:00','2019-03-25 13:00:00'),(4,'4列',4,1,'2019-03-25 13:00:00','2019-03-25 13:00:00'),(5,'6列',6,1,'2019-03-25 13:00:00','2019-03-25 13:00:00');

CREATE TABLE `tasks_layouts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `layouts_id` bigint(20) unsigned NOT NULL COMMENT 'レイアウトID',
  `created` datetime DEFAULT NULL COMMENT '登録日時',
  `modified` datetime DEFAULT NULL COMMENT '最終更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `tasks_layouts` VALUES (2,3,'2019-03-27 11:06:59','2019-03-27 11:38:05');
```

