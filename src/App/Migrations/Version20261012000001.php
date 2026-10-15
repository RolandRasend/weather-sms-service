<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261012000001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create destination table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE `destination` (
            destination_id INT AUTO_INCREMENT NOT NULL,
            destination_user_id INT NOT NULL,
            destination_placename VARCHAR(255) NOT NULL,
            destination_created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\',
            destination_updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\',
            INDEX IDX_3EC0651999F01 (destination_user_id),
            PRIMARY KEY(destination_id),
            CONSTRAINT FK_DEST_USER FOREIGN KEY (destination_user_id) REFERENCES `user` (user_id) ON DELETE CASCADE
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `destination`');
    }
}
