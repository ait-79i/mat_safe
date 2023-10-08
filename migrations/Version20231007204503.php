<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231007204503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, compagnie_id INT DEFAULT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, destinataire_type TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C35F0816A76ED395 (user_id), INDEX IDX_C35F081652FBE437 (compagnie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compagnie (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, site VARCHAR(255) NOT NULL, secteur VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invetation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date_validation DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', fin_demo DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_confirmed TINYINT(1) NOT NULL, INDEX IDX_36BD0BD6A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE periodicite (id INT AUTO_INCREMENT NOT NULL, tache_id INT NOT NULL, type VARCHAR(255) NOT NULL, frequence VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D13D99F3D2235D39 (tache_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(90) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission_role (permission_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_6A711CAFED90CCA (permission_id), INDEX IDX_6A711CAD60322AC (role_id), PRIMARY KEY(permission_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_user (role_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_332CA4DDD60322AC (role_id), INDEX IDX_332CA4DDA76ED395 (user_id), PRIMARY KEY(role_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, creator_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description TINYTEXT NOT NULL, statut VARCHAR(100) NOT NULL, complexite VARCHAR(100) NOT NULL, priorite VARCHAR(100) NOT NULL, est_recurrente TINYINT(1) NOT NULL, date_debut DATE NOT NULL, mot_cles VARCHAR(255) NOT NULL, referance VARCHAR(255) NOT NULL, referanciel VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, INDEX IDX_9387207561220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache_user (tache_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FFA0B20FD2235D39 (tache_id), INDEX IDX_FFA0B20FA76ED395 (user_id), PRIMARY KEY(tache_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, compagnie_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(90) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, fonction VARCHAR(255) DEFAULT NULL, longue VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64952FBE437 (compagnie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F081652FBE437 FOREIGN KEY (compagnie_id) REFERENCES compagnie (id)');
        $this->addSql('ALTER TABLE invetation ADD CONSTRAINT FK_36BD0BD6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE periodicite ADD CONSTRAINT FK_D13D99F3D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE permission_role ADD CONSTRAINT FK_6A711CAFED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE permission_role ADD CONSTRAINT FK_6A711CAD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_9387207561220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tache_user ADD CONSTRAINT FK_FFA0B20FD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tache_user ADD CONSTRAINT FK_FFA0B20FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64952FBE437 FOREIGN KEY (compagnie_id) REFERENCES compagnie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A76ED395');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F081652FBE437');
        $this->addSql('ALTER TABLE invetation DROP FOREIGN KEY FK_36BD0BD6A76ED395');
        $this->addSql('ALTER TABLE periodicite DROP FOREIGN KEY FK_D13D99F3D2235D39');
        $this->addSql('ALTER TABLE permission_role DROP FOREIGN KEY FK_6A711CAFED90CCA');
        $this->addSql('ALTER TABLE permission_role DROP FOREIGN KEY FK_6A711CAD60322AC');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDD60322AC');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDA76ED395');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_9387207561220EA6');
        $this->addSql('ALTER TABLE tache_user DROP FOREIGN KEY FK_FFA0B20FD2235D39');
        $this->addSql('ALTER TABLE tache_user DROP FOREIGN KEY FK_FFA0B20FA76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64952FBE437');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE compagnie');
        $this->addSql('DROP TABLE invetation');
        $this->addSql('DROP TABLE periodicite');
        $this->addSql('DROP TABLE permission');
        $this->addSql('DROP TABLE permission_role');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_user');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP TABLE tache_user');
        $this->addSql('DROP TABLE user');
    }
}
