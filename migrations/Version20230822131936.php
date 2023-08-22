<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230822131936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intervention_intervention_type (intervention_id INT NOT NULL, intervention_type_id INT NOT NULL, INDEX IDX_C9B604D68EAE3863 (intervention_id), INDEX IDX_C9B604D68EA2F8F6 (intervention_type_id), PRIMARY KEY(intervention_id, intervention_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE intervention_intervention_type ADD CONSTRAINT FK_C9B604D68EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_intervention_type ADD CONSTRAINT FK_C9B604D68EA2F8F6 FOREIGN KEY (intervention_type_id) REFERENCES intervention_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_intervention DROP FOREIGN KEY FK_D466B039B52A5D56');
        $this->addSql('ALTER TABLE intervention_intervention DROP FOREIGN KEY FK_D466B039ACCF0DD9');
        $this->addSql('ALTER TABLE intervention_type_intervention DROP FOREIGN KEY FK_1C8CE5938EA2F8F6');
        $this->addSql('ALTER TABLE intervention_type_intervention DROP FOREIGN KEY FK_1C8CE5938EAE3863');
        $this->addSql('DROP TABLE intervention_intervention');
        $this->addSql('DROP TABLE intervention_type_intervention');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intervention_intervention (intervention_source INT NOT NULL, intervention_target INT NOT NULL, INDEX IDX_D466B039B52A5D56 (intervention_source), INDEX IDX_D466B039ACCF0DD9 (intervention_target), PRIMARY KEY(intervention_source, intervention_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE intervention_type_intervention (intervention_type_id INT NOT NULL, intervention_id INT NOT NULL, INDEX IDX_1C8CE5938EA2F8F6 (intervention_type_id), INDEX IDX_1C8CE5938EAE3863 (intervention_id), PRIMARY KEY(intervention_type_id, intervention_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE intervention_intervention ADD CONSTRAINT FK_D466B039B52A5D56 FOREIGN KEY (intervention_source) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_intervention ADD CONSTRAINT FK_D466B039ACCF0DD9 FOREIGN KEY (intervention_target) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_type_intervention ADD CONSTRAINT FK_1C8CE5938EA2F8F6 FOREIGN KEY (intervention_type_id) REFERENCES intervention_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_type_intervention ADD CONSTRAINT FK_1C8CE5938EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intervention_intervention_type DROP FOREIGN KEY FK_C9B604D68EAE3863');
        $this->addSql('ALTER TABLE intervention_intervention_type DROP FOREIGN KEY FK_C9B604D68EA2F8F6');
        $this->addSql('DROP TABLE intervention_intervention_type');
    }
}
