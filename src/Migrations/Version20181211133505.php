<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181211133505 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sleeper DROP usersleeper');
        $this->addSql('ALTER TABLE sleeper ADD CONSTRAINT FK_9080C247A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_9080C247A76ED395 ON sleeper (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sleeper DROP FOREIGN KEY FK_9080C247A76ED395');
        $this->addSql('DROP INDEX IDX_9080C247A76ED395 ON sleeper');
        $this->addSql('ALTER TABLE sleeper ADD usersleeper VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
