<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260506231904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sign_config (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sign_rule (id INT AUTO_INCREMENT NOT NULL, sign_config_id INT DEFAULT NULL, glue_operator VARCHAR(255) NOT NULL, comparison_operator VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, metadata VARCHAR(255) NOT NULL, INDEX IDX_41B367A51A76C8BE (sign_config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stapling_config (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stapling_rule (id INT AUTO_INCREMENT NOT NULL, stapling_config_id INT DEFAULT NULL, glue_operator VARCHAR(255) NOT NULL, comparison_operator VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, metadata VARCHAR(255) NOT NULL, INDEX IDX_2E41CA93DF339496 (stapling_config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sign_rule ADD CONSTRAINT FK_41B367A51A76C8BE FOREIGN KEY (sign_config_id) REFERENCES sign_config (id)');
        $this->addSql('ALTER TABLE stapling_rule ADD CONSTRAINT FK_2E41CA93DF339496 FOREIGN KEY (stapling_config_id) REFERENCES stapling_config (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sign_rule DROP FOREIGN KEY FK_41B367A51A76C8BE');
        $this->addSql('ALTER TABLE stapling_rule DROP FOREIGN KEY FK_2E41CA93DF339496');
        $this->addSql('DROP TABLE sign_config');
        $this->addSql('DROP TABLE sign_rule');
        $this->addSql('DROP TABLE stapling_config');
        $this->addSql('DROP TABLE stapling_rule');
    }
}
