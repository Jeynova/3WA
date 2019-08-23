<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190813130439 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, artiste_id_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, place VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price INT NOT NULL, INDEX IDX_3BAE0AA7B6D84A9 (artiste_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE support (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, support_type VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_8004EBA5F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE streaming (id INT AUTO_INCREMENT NOT NULL, produit_id_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, quality VARCHAR(255) NOT NULL, INDEX IDX_264318614FD8F9C3 (produit_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artiste (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, style VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, client_id_id INT DEFAULT NULL, screen_name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649DC2902E0 (client_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, artiste_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, production_date DATE NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_29A5EC2721D25844 (artiste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, client_id_id INT DEFAULT NULL, order_number INT NOT NULL, order_date DATE NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_6EEAA67DDC2902E0 (client_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_commande (id INT AUTO_INCREMENT NOT NULL, commande_id_id INT DEFAULT NULL, support_id INT DEFAULT NULL, order_number INT NOT NULL, support_number INT NOT NULL, INDEX IDX_98344FA6462C4194 (commande_id_id), INDEX IDX_98344FA6315B405 (support_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, collection VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D769D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actualite (id INT AUTO_INCREMENT NOT NULL, theme VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, publication_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actualite_client (actualite_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_2E5D809CA2843073 (actualite_id), INDEX IDX_2E5D809C19EB6921 (client_id), PRIMARY KEY(actualite_id, client_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, firt_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city_code INT NOT NULL, city VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C74404559D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_streaming (client_id INT NOT NULL, streaming_id INT NOT NULL, INDEX IDX_CD63C86E19EB6921 (client_id), INDEX IDX_CD63C86E429AEC72 (streaming_id), PRIMARY KEY(client_id, streaming_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7B6D84A9 FOREIGN KEY (artiste_id_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA5F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE streaming ADD CONSTRAINT FK_264318614FD8F9C3 FOREIGN KEY (produit_id_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DC2902E0 FOREIGN KEY (client_id_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2721D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DDC2902E0 FOREIGN KEY (client_id_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA6462C4194 FOREIGN KEY (commande_id_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA6315B405 FOREIGN KEY (support_id) REFERENCES support (id)');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D769D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE actualite_client ADD CONSTRAINT FK_2E5D809CA2843073 FOREIGN KEY (actualite_id) REFERENCES actualite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actualite_client ADD CONSTRAINT FK_2E5D809C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404559D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE client_streaming ADD CONSTRAINT FK_CD63C86E19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_streaming ADD CONSTRAINT FK_CD63C86E429AEC72 FOREIGN KEY (streaming_id) REFERENCES streaming (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA6315B405');
        $this->addSql('ALTER TABLE client_streaming DROP FOREIGN KEY FK_CD63C86E429AEC72');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7B6D84A9');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2721D25844');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D769D86650F');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404559D86650F');
        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA5F347EFB');
        $this->addSql('ALTER TABLE streaming DROP FOREIGN KEY FK_264318614FD8F9C3');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA6462C4194');
        $this->addSql('ALTER TABLE actualite_client DROP FOREIGN KEY FK_2E5D809CA2843073');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DC2902E0');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DDC2902E0');
        $this->addSql('ALTER TABLE actualite_client DROP FOREIGN KEY FK_2E5D809C19EB6921');
        $this->addSql('ALTER TABLE client_streaming DROP FOREIGN KEY FK_CD63C86E19EB6921');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE support');
        $this->addSql('DROP TABLE streaming');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE detail_commande');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE actualite');
        $this->addSql('DROP TABLE actualite_client');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_streaming');
    }
}
