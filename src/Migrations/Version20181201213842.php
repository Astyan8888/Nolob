<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181201213842 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bath (id INT AUTO_INCREMENT NOT NULL, userbath VARCHAR(255) NOT NULL, datebath DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diaper (id INT AUTO_INCREMENT NOT NULL, datediaper DATE NOT NULL, diaperamount INT NOT NULL, userdiaper VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editdata (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, password VARCHAR(255) NOT NULL, confirmpassword VARCHAR(255) NOT NULL, gender INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, datevent DATETIME DEFAULT NULL, textevent VARCHAR(255) DEFAULT NULL, userevent VARCHAR(255) NOT NULL, eventstick VARCHAR(255) DEFAULT NULL, pict VARCHAR(255) DEFAULT NULL, datecreate DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feeding (id INT AUTO_INCREMENT NOT NULL, amount DOUBLE PRECISION DEFAULT NULL, datefeeding DATETIME NOT NULL, duration TIME DEFAULT NULL, userfeeding VARCHAR(255) NOT NULL, breast INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pc (id INT AUTO_INCREMENT NOT NULL, pc DOUBLE PRECISION NOT NULL, datepc DATE NOT NULL, userpc VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poids (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, create_atpoids VARCHAR(255) NOT NULL, weight DOUBLE PRECISION NOT NULL, userweight VARCHAR(255) NOT NULL, graph VARCHAR(255) DEFAULT NULL, INDEX IDX_D32E8E0DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, datesize DATE NOT NULL, size DOUBLE PRECISION NOT NULL, usersize VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sleeper (id INT AUTO_INCREMENT NOT NULL, durationsleep TIME NOT NULL, startsleep DATETIME NOT NULL, usersleeper VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, create_at DATETIME NOT NULL, username VARCHAR(255) NOT NULL, activate TINYINT(1) DEFAULT NULL, gender INT NOT NULL, birthdate DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE poids ADD CONSTRAINT FK_D32E8E0DA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE poids DROP FOREIGN KEY FK_D32E8E0DA76ED395');
        $this->addSql('DROP TABLE bath');
        $this->addSql('DROP TABLE diaper');
        $this->addSql('DROP TABLE editdata');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE feeding');
        $this->addSql('DROP TABLE pc');
        $this->addSql('DROP TABLE poids');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP TABLE sleeper');
        $this->addSql('DROP TABLE users');
    }
}
