<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191219134558 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE task DROP description, DROP tags');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A254FAF8F53');
        $this->addSql('DROP INDEX IDX_DADD4A254FAF8F53 ON answer');
        $this->addSql('ALTER TABLE answer ADD quiz_id_id INT NOT NULL, CHANGE question_id_id questions_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25FA3C0E2B FOREIGN KEY (questions_id_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A258337E7D7 FOREIGN KEY (quiz_id_id) REFERENCES quiz (id)');
        $this->addSql('CREATE INDEX IDX_DADD4A25FA3C0E2B ON answer (questions_id_id)');
        $this->addSql('CREATE INDEX IDX_DADD4A258337E7D7 ON answer (quiz_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25FA3C0E2B');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A258337E7D7');
        $this->addSql('DROP INDEX IDX_DADD4A25FA3C0E2B ON answer');
        $this->addSql('DROP INDEX IDX_DADD4A258337E7D7 ON answer');
        $this->addSql('ALTER TABLE answer ADD question_id_id INT NOT NULL, DROP questions_id_id, DROP quiz_id_id');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A254FAF8F53 FOREIGN KEY (question_id_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_DADD4A254FAF8F53 ON answer (question_id_id)');
        $this->addSql('ALTER TABLE task ADD description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD tags VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
